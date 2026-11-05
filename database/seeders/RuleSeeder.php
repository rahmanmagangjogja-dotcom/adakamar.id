<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rule;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            [
                'name' => 'Waktu Check-in dan Check-out',
                'description' => 'Tamu dapat melakukan check-in mulai pukul 14.00 WIB dan wajib melakukan check-out paling lambat pukul 12.00 WIB.',
                'is_active' => true,
            ],
            [
                'name' => 'Identitas Tamu',
                'description' => 'Setiap tamu wajib menunjukkan identitas diri yang masih berlaku saat melakukan check-in.',
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan dan Ketertiban',
                'description' => 'Tamu wajib menjaga kebersihan kamar dan lingkungan penginapan serta tidak mengganggu kenyamanan tamu lainnya.',
                'is_active' => true,
            ],
            [
                'name' => 'Larangan Merokok',
                'description' => 'Tamu dilarang merokok di dalam kamar dan area penginapan yang telah ditetapkan sebagai kawasan bebas rokok.',
                'is_active' => true,
            ],
            [
                'name' => 'Kerusakan Fasilitas',
                'description' => 'Tamu bertanggung jawab atas kerusakan atau kehilangan fasilitas penginapan yang disebabkan oleh kelalaian atau tindakan tamu selama menginap.',
                'is_active' => true,
            ],
            [
                'name' => 'Kapasitas Kamar',
                'description' => 'Tamu wajib menggunakan kamar sesuai dengan kapasitas maksimum yang telah ditentukan oleh pihak penginapan.',
                'is_active' => true,
            ],
            [
                'name' => 'Larangan Membawa Barang Terlarang',
                'description' => 'Tamu dilarang membawa atau menggunakan narkotika, obat-obatan terlarang, senjata ilegal, maupun barang lain yang melanggar hukum di area penginapan.',
                'is_active' => true,
            ],
            [
                'name' => 'Pembatalan Reservasi',
                'description' => 'Pembatalan reservasi dan pengembalian dana mengikuti kebijakan pembatalan yang berlaku di penginapan.',
                'is_active' => true,
            ],
            [
                'name' => 'Kehilangan Barang Pribadi',
                'description' => 'Tamu bertanggung jawab menjaga barang pribadi masing-masing selama menginap. Segera laporkan kepada petugas apabila terjadi kehilangan.',
                'is_active' => true,
            ],
            [
                'name' => 'Ketenangan Malam',
                'description' => 'Tamu diharapkan menjaga ketenangan pada pukul 22.00 hingga 06.00 WIB dan dilarang membuat kebisingan yang dapat mengganggu tamu lainnya.',
                'is_active' => true,
            ],
        ];

        foreach ($rules as $rule) {
            Rule::updateOrCreate(
                ['name' => $rule['name']],
                [
                    'description' => $rule['description'],
                    'is_active' => $rule['is_active'],
                ]
            );
        }
    }
}