<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Wi-Fi Gratis',
                'icon' => 'wifi',
                'description' => 'Penginapan menyediakan akses internet Wi-Fi gratis bagi seluruh tamu selama menginap.',
                'is_active' => true,
            ],
            [
                'name' => 'AC',
                'icon' => 'air-vent',
                'description' => 'Kamar dilengkapi dengan pendingin ruangan untuk memberikan kenyamanan selama beristirahat.',
                'is_active' => true,
            ],
            [
                'name' => 'Kamar Mandi Dalam',
                'icon' => 'bath',
                'description' => 'Setiap kamar dilengkapi dengan kamar mandi pribadi yang dapat digunakan oleh tamu.',
                'is_active' => true,
            ],
            [
                'name' => 'Air Panas',
                'icon' => 'thermometer-sun',
                'description' => 'Fasilitas air panas tersedia untuk menunjang kenyamanan tamu saat mandi.',
                'is_active' => true,
            ],
            [
                'name' => 'Tempat Tidur Nyaman',
                'icon' => 'bed-double',
                'description' => 'Kamar dilengkapi dengan tempat tidur dan perlengkapan tidur untuk mendukung istirahat yang nyaman.',
                'is_active' => true,
            ],
            [
                'name' => 'Televisi',
                'icon' => 'tv',
                'description' => 'Kamar dilengkapi dengan televisi sebagai sarana hiburan bagi tamu.',
                'is_active' => true,
            ],
            [
                'name' => 'Area Parkir',
                'icon' => 'car-front',
                'description' => 'Penginapan menyediakan area parkir bagi tamu yang membawa kendaraan pribadi.',
                'is_active' => true,
            ],
            [
                'name' => 'Layanan Resepsionis',
                'icon' => 'concierge-bell',
                'description' => 'Petugas resepsionis siap membantu kebutuhan tamu terkait check-in, check-out, dan informasi penginapan sesuai jam operasional.',
                'is_active' => true,
            ],
            [
                'name' => 'Layanan Kebersihan',
                'icon' => 'spray-can',
                'description' => 'Penginapan menyediakan layanan kebersihan kamar sesuai jadwal dan kebijakan yang berlaku.',
                'is_active' => true,
            ],
            [
                'name' => 'Perlengkapan Mandi',
                'icon' => 'soap-dispenser-droplet',
                'description' => 'Penginapan menyediakan perlengkapan mandi dasar bagi tamu sesuai fasilitas yang tersedia.',
                'is_active' => true,
            ],
            [
                'name' => 'Air Minum',
                'icon' => 'glass-water',
                'description' => 'Penginapan menyediakan air minum bagi tamu selama menginap sesuai ketentuan yang berlaku.',
                'is_active' => true,
            ],
            [
                'name' => 'Area Bersantai',
                'icon' => 'armchair',
                'description' => 'Tersedia area bersantai yang dapat digunakan tamu untuk duduk dan beristirahat di luar kamar.',
                'is_active' => true,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::updateOrCreate(
                ['name' => $facility['name']],
                [
                    'icon' => $facility['icon'],
                    'description' => $facility['description'],
                    'is_active' => $facility['is_active'],
                ]
            );
        }
    }
}