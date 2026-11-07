<?php

namespace Database\Seeders;

use App\Models\AccommodationCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AccommodationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kamar',
                'description' => 'Kamar penginapan nyaman dengan berbagai tipe dan fasilitas lengkap.',
                'thumbnail' => 'landingpage/kamar.jpg',
            ],
            [
                'name' => 'Villa',
                'description' => 'Villa mewah dengan pemandangan indah dan fasilitas premium.',
                'thumbnail' => 'landingpage/villa.jpg',
            ],
            [
                'name' => 'Guest House',
                'description' => 'Guest house dengan suasana rumah yang nyaman dan harga terjangkau.',
                'thumbnail' => 'landingpage/guest-house.jpg',
            ],
            
        ];

        foreach ($categories as $category) {
            AccommodationCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                    'thumbnail' => $category['thumbnail'],
                ]
            );
        }
    }
}