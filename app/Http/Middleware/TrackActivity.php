<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;

class TrackActivity
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if ($request->user() && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            ActivityLog::log(
                action: strtolower($request->method()) . ':' . $request->path(),
                description: $request->method() . ' ' . $request->path(),
            );
        }

        return $response;
    }
}
