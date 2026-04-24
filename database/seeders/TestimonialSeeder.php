<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['client_name' => 'DJ Spinall', 'client_title' => 'Music Producer', 'client_company' => 'TheCAP Music', 'content' => 'Pro-Sound Media delivered an exceptional mix for my latest album. The attention to detail and sound quality is world-class. I wouldn\'t trust anyone else with my music.', 'rating' => 5, 'is_featured' => true],
            ['client_name' => 'Aisha Mohammed', 'client_title' => 'CEO', 'client_company' => 'Zenith Communications', 'content' => 'Their corporate video production exceeded our expectations. Professional crew, stunning visuals, and delivered ahead of schedule. A truly premium experience.', 'rating' => 5, 'is_featured' => true],
            ['client_name' => 'Chinedu Ikedieze', 'client_title' => 'Independent Artist', 'client_company' => null, 'content' => 'The beat production and mixing services transformed my sound completely. My streaming numbers tripled after releasing tracks produced at Pro-Sound.', 'rating' => 5, 'is_featured' => true],
            ['client_name' => 'Pastor Grace Olu', 'client_title' => 'Senior Pastor', 'client_company' => 'Living Word Church', 'content' => 'We\'ve been using Pro-Sound for all our church recordings and live event coverage. Their podcast production service helped us reach a global audience.', 'rating' => 4, 'is_featured' => true],
            ['client_name' => 'Tunde Bakare', 'client_title' => 'Marketing Director', 'client_company' => 'Nexus Brands', 'content' => 'The jingle they created for our radio campaign became instantly recognizable. Creative, catchy, and perfectly aligned with our brand identity.', 'rating' => 5, 'is_featured' => true],
            ['client_name' => 'Folake Coker', 'client_title' => 'Content Creator', 'client_company' => 'FolakeTV', 'content' => 'Their social media content package is a game-changer. Fast turnaround, trendy edits, and the quality rivals major production houses. Highly recommend!', 'rating' => 5, 'is_featured' => true],
        ];

        foreach ($testimonials as $i => $data) {
            Testimonial::create(array_merge($data, ['sort_order' => $i, 'is_active' => true]));
        }
    }
}
