<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Tampak Depan Penginapan',
                'image' => 'galleries/tampak-depan.jpg',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Area Lobby',
                'image' => 'galleries/lobby.jpg',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Resepsionis',
                'image' => 'galleries/resepsionis.jpg',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Kamar Deluxe',
                'image' => 'galleries/kamar-deluxe.jpg',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Kamar Superior',
                'image' => 'galleries/kamar-superior.jpg',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Kamar Standard',
                'image' => 'galleries/kamar-standard.jpg',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'title' => 'Interior Kamar',
                'image' => 'galleries/interior-kamar.jpg',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Tempat Tidur',
                'image' => 'galleries/tempat-tidur.jpg',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Kamar Mandi',
                'image' => 'galleries/kamar-mandi.jpg',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'title' => 'Area Kolam Renang',
                'image' => 'galleries/kolam-renang.jpg',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Kolam Renang Outdoor',
                'image' => 'galleries/kolam-renang-outdoor.jpg',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'title' => 'Restoran',
                'image' => 'galleries/restoran.jpg',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Area Sarapan',
                'image' => 'galleries/area-sarapan.jpg',
                'sort_order' => 13,
                'is_active' => true,
            ],
            [
                'title' => 'Menu Makanan',
                'image' => 'galleries/menu-makanan.jpg',
                'sort_order' => 14,
                'is_active' => true,
            ],
            [
                'title' => 'Area Taman',
                'image' => 'galleries/taman.jpg',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'Pemandangan Alam',
                'image' => 'galleries/pemandangan-alam.jpg',
                'sort_order' => 16,
                'is_active' => true,
            ],
            [
                'title' => 'Area Parkir',
                'image' => 'galleries/area-parkir.jpg',
                'sort_order' => 17,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Keluarga',
                'image' => 'galleries/ruang-keluarga.jpg',
                'sort_order' => 18,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Santai',
                'image' => 'galleries/ruang-santai.jpg',
                'sort_order' => 19,
                'is_active' => true,
            ],
            [
                'title' => 'Area Balkon',
                'image' => 'galleries/balkon.jpg',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'title' => 'Pemandangan dari Balkon',
                'image' => 'galleries/pemandangan-balkon.jpg',
                'sort_order' => 21,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Meeting',
                'image' => 'galleries/ruang-meeting.jpg',
                'sort_order' => 22,
                'is_active' => true,
            ],
            [
                'title' => 'Area Playground',
                'image' => 'galleries/playground.jpg',
                'sort_order' => 23,
                'is_active' => true,
            ],
            [
                'title' => 'Fasilitas Fitness',
                'image' => 'galleries/fitness.jpg',
                'sort_order' => 24,
                'is_active' => true,
            ],
            [
                'title' => 'Area BBQ',
                'image' => 'galleries/area-bbq.jpg',
                'sort_order' => 25,
                'is_active' => true,
            ],
            [
                'title' => 'Suasana Malam',
                'image' => 'galleries/suasana-malam.jpg',
                'sort_order' => 26,
                'is_active' => true,
            ],
            [
                'title' => 'Pemandangan Matahari Terbit',
                'image' => 'galleries/sunrise.jpg',
                'sort_order' => 27,
                'is_active' => true,
            ],
            [
                'title' => 'Pemandangan Matahari Terbenam',
                'image' => 'galleries/sunset.jpg',
                'sort_order' => 28,
                'is_active' => true,
            ],
            [
                'title' => 'Suasana Penginapan',
                'image' => 'galleries/suasana-penginapan.jpg',
                'sort_order' => 29,
                'is_active' => true,
            ],
            [
                'title' => 'Aktivitas Pengunjung',
                'image' => 'galleries/aktivitas-pengunjung.jpg',
                'sort_order' => 30,
                'is_active' => false,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['title' => $gallery['title']],
                $gallery
            );
        }
    }
}
