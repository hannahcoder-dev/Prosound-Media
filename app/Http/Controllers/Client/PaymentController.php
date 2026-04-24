<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = auth()->user()->payments()->with('booking')->latest()->paginate(10);
        return view('client.payments.index', compact('payments'));
    }

    public function initializePaystack(Invoice $invoice)
    {
        $this->authorize('view', $invoice->booking);

        $reference = 'PS-' . Str::random(16);

        $payment = Payment::create([
            'user_id' => auth()->id(),
            'booking_id' => $invoice->booking_id,
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total,
            'gateway' => 'paystack',
            'gateway_reference' => $reference,
        ]);

        $response = Http::withToken(config('services.paystack.secret_key'))
            ->post('https://api.paystack.co/transaction/initialize', [
                'email' => auth()->user()->email,
                'amount' => $invoice->total * 100, // Kobo
                'reference' => $reference,
                'callback_url' => route('client.payments.callback', ['gateway' => 'paystack']),
                'metadata' => [
                    'payment_id' => $payment->id,
                    'invoice_id' => $invoice->id,
                ],
            ]);

        if ($response->successful() && $response->json('status')) {
            return redirect($response->json('data.authorization_url'));
        }

        $payment->update(['status' => 'failed']);
        return back()->with('error', 'Unable to initialize payment. Please try again.');
    }

    public function callback(Request $request, string $gateway)
    {
        $reference = $request->query('reference') ?? $request->query('tx_ref');

        if (!$reference) {
            return redirect()->route('client.dashboard')->with('error', 'Invalid payment reference.');
        }

        $payment = Payment::where('gateway_reference', $reference)->firstOrFail();

        if ($gateway === 'paystack') {
            $response = Http::withToken(config('services.paystack.secret_key'))
                ->get("https://api.paystack.co/transaction/verify/{$reference}");

            if ($response->successful() && $response->json('data.status') === 'success') {
                $payment->update([
                    'status' => 'successful',
                    'gateway_response' => $response->json('data'),
                    'paid_at' => now(),
                ]);

                if ($payment->invoice) {
                    $payment->invoice->update(['status' => 'paid', 'paid_at' => now()]);
                }

                return redirect()->route('client.bookings.show', $payment->booking_id)
                    ->with('success', 'Payment successful!');
            }
        }

        $payment->update(['status' => 'failed']);
        return redirect()->route('client.dashboard')->with('error', 'Payment verification failed.');
    }
}
