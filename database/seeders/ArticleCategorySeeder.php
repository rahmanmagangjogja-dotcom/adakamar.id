<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;

class ArticleCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Wisata',
                'description' => 'Artikel tentang destinasi wisata menarik, tempat rekreasi, dan objek wisata yang dapat dikunjungi oleh wisatawan.',
                'is_active' => true,
            ],
            [
                'name' => 'Tips Menginap',
                'description' => 'Informasi dan tips untuk membantu wisatawan mendapatkan pengalaman menginap yang nyaman, aman, dan menyenangkan.',
                'is_active' => true,
            ],
            [
                'name' => 'Kuliner',
                'description' => 'Artikel mengenai rekomendasi makanan khas, restoran, tempat makan populer, dan wisata kuliner di sekitar destinasi wisata.',
                'is_active' => true,
            ],
            [
                'name' => 'Rekomendasi Penginapan',
                'description' => 'Informasi dan rekomendasi penginapan berdasarkan lokasi, fasilitas, kenyamanan, dan kebutuhan wisatawan.',
                'is_active' => true,
            ],
            [
                'name' => 'Panduan Perjalanan',
                'description' => 'Panduan perjalanan yang mencakup transportasi, estimasi biaya, rencana perjalanan, dan informasi penting bagi wisatawan.',
                'is_active' => true,
            ],
            [
                'name' => 'Wisata Alam',
                'description' => 'Artikel tentang destinasi wisata alam seperti pantai, pegunungan, air terjun, dan kawasan alam lainnya.',
                'is_active' => true,
            ],
            [
                'name' => 'Budaya dan Tradisi',
                'description' => 'Informasi mengenai budaya lokal, tradisi masyarakat, kesenian, serta kegiatan budaya di berbagai destinasi.',
                'is_active' => true,
            ],
            [
                'name' => 'Promo dan Informasi',
                'description' => 'Informasi mengenai promo penginapan, penawaran khusus, serta kabar terbaru yang relevan bagi calon tamu.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ArticleCategory::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'is_active' => $category['is_active'],
                ]
            );
        }
    }
}
