<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Pro-Sound Media', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Premium Audio & Media Production', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'info@prosoundmedia.com', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+234 800 PRO SOUND', 'group' => 'general'],
            ['key' => 'site_address', 'value' => '15 Studio Lane, Victoria Island, Lagos, Nigeria', 'group' => 'general'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/prosoundmedia', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/prosoundmedia', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/prosoundmedia', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@prosoundmedia', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@prosoundmedia', 'group' => 'social'],
            ['key' => 'currency', 'value' => 'NGN', 'group' => 'payment'],
            ['key' => 'currency_symbol', 'value' => '₦', 'group' => 'payment'],
            ['key' => 'tax_rate', 'value' => '7.5', 'group' => 'payment'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
