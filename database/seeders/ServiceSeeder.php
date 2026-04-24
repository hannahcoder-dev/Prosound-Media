<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Audio Production',
                'slug' => 'audio-production',
                'description' => 'Professional audio recording, mixing, and mastering services.',
                'icon' => 'fas fa-microphone-alt',
                'services' => [
                    ['name' => 'Music Recording', 'short_description' => 'Professional studio recording sessions', 'description' => 'Full studio recording session with professional equipment. Includes vocal recording, instrument tracking, and session engineering.', 'base_price' => 50000, 'features' => ['Professional studio environment', '48-track recording capability', 'Experienced session engineer', 'High-end microphone selection', 'Complimentary headphone mix']],
                    ['name' => 'Mixing & Mastering', 'short_description' => 'Industry-standard mixing and mastering', 'description' => 'Transform your raw recordings into polished, radio-ready tracks with professional mixing and mastering services.', 'base_price' => 75000, 'features' => ['Full stereo mix', 'Stem mastering', 'Three revision rounds', 'Industry-standard loudness', 'Digital delivery in multiple formats']],
                    ['name' => 'Beat Production', 'short_description' => 'Custom beat making and instrumentals', 'description' => 'Custom beat production for any genre including Afrobeats, Hip-hop, R&B, Gospel, and more.', 'base_price' => 30000, 'features' => ['Custom beat creation', 'Genre-specific production', 'Full ownership rights', 'WAV + MP3 delivery', 'One revision included']],
                ],
            ],
            [
                'name' => 'Video Production',
                'slug' => 'video-production',
                'description' => 'End-to-end video production for music, corporate, and social media.',
                'icon' => 'fas fa-video',
                'services' => [
                    ['name' => 'Music Video', 'short_description' => 'Cinematic music video production', 'description' => 'Full-service music video production from concept development to final delivery.', 'base_price' => 200000, 'features' => ['Creative concept development', 'Professional cinematography', 'Color grading & VFX', 'Multi-camera setup', '4K delivery']],
                    ['name' => 'Corporate Video', 'short_description' => 'Professional corporate content', 'description' => 'Brand videos, commercials, training videos, and corporate communications.', 'base_price' => 150000, 'features' => ['Script development', 'Professional crew', 'On-location filming', 'Voice-over recording', 'Motion graphics']],
                    ['name' => 'Social Media Content', 'short_description' => 'Engaging social media videos', 'description' => 'Short-form content optimized for social media platforms.', 'base_price' => 50000, 'features' => ['Platform-optimized formats', 'Quick turnaround', 'Trending visual styles', 'Caption integration', 'Thumbnail design']],
                ],
            ],
            [
                'name' => 'Media Services',
                'slug' => 'media-services',
                'description' => 'Comprehensive media and branding services to amplify your presence.',
                'icon' => 'fas fa-bullhorn',
                'services' => [
                    ['name' => 'Podcast Production', 'short_description' => 'End-to-end podcast services', 'description' => 'Complete podcast production including recording, editing, mixing, and distribution setup.', 'base_price' => 40000, 'features' => ['Studio recording', 'Professional editing', 'Intro/outro production', 'Distribution setup', 'Show notes writing']],
                    ['name' => 'Jingle Production', 'short_description' => 'Catchy jingles and sonic branding', 'description' => 'Custom jingle and sonic branding creation for radio, TV, and digital.', 'base_price' => 100000, 'features' => ['Custom composition', 'Professional vocalists', 'Multiple versions', 'Full licensing', 'Broadcast-ready quality']],
                    ['name' => 'Voiceover Services', 'short_description' => 'Professional voice talent and recording', 'description' => 'High-quality voiceover recording for commercials, narrations, IVR, and more.', 'base_price' => 25000, 'features' => ['Professional voice talent', 'Multiple language options', 'Fast delivery', 'Noise-free recording', 'Format flexibility']],
                ],
            ],
        ];

        $sortOrder = 0;
        foreach ($categories as $catData) {
            $category = ServiceCategory::create([
                'name' => $catData['name'],
                'slug' => $catData['slug'],
                'description' => $catData['description'],
                'icon' => $catData['icon'],
                'sort_order' => $sortOrder++,
            ]);

            $svcOrder = 0;
            foreach ($catData['services'] as $svcData) {
                Service::create([
                    'category_id' => $category->id,
                    'name' => $svcData['name'],
                    'slug' => Str::slug($svcData['name']),
                    'short_description' => $svcData['short_description'],
                    'description' => $svcData['description'],
                    'base_price' => $svcData['base_price'],
                    'price_unit' => 'per project',
                    'features' => $svcData['features'],
                    'is_featured' => $svcOrder < 2,
                    'is_active' => true,
                    'sort_order' => $svcOrder++,
                ]);
            }
        }
    }
}
