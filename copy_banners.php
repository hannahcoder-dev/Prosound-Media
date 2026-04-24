<?php
$source = 'C:/Users/HP/.gemini/antigravity/brain/5108a248-cc92-4a0e-9612-cc2f65804725/';
$dest = __DIR__ . '/public/images/';

$files = [
    'banner_about_1776550890490.png' => 'banner-about.png',
    'banner_services_1776550905533.png' => 'banner-services.png',
    'banner_portfolio_1776550922022.png' => 'banner-portfolio.png',
    'banner_pricing_1776550937610.png' => 'banner-pricing.png',
];

foreach ($files as $src => $dst) {
    if (copy($source . $src, $dest . $dst)) {
        echo "Copied $dst\n";
    } else {
        echo "FAILED: $dst\n";
    }
}
echo "Done!\n";
