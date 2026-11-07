<?php

namespace App\Repositories;

use App\Models\Accommodation;
use App\Models\AccommodationRating;

class AccommodationRatingRepository
{
    /**
     * Simpan rating untuk penginapan tertentu.
     */
    public function create(
        Accommodation $accommodation,
        array $data
    ): AccommodationRating {
        return $accommodation->ratings()->create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'bintang' => $data['bintang'],
            'keterangan' => $data['keterangan'] ?? null,
        ]);
    }

    /**
     * Ambil semua rating milik penginapan.
     */
    public function getByAccommodation(
        Accommodation $accommodation
    ) {
        return $accommodation->ratings()
            ->latest()
            ->get();
    }

    /**
     * Hitung rata-rata rating penginapan.
     */
    public function getAverageRating(
        Accommodation $accommodation
    ): float {
        return (float) (
            $accommodation->ratings()->avg('bintang') ?? 0
        );
    }

    /**
     * Hitung jumlah rating penginapan.
     */
    public function getRatingCount(
        Accommodation $accommodation
    ): int {
        return $accommodation->ratings()->count();
    }
}
