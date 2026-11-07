<?php

namespace App\Services;

use App\Models\Accommodation;
use App\Models\AccommodationRating;
use App\Repositories\AccommodationRatingRepository;
use Illuminate\Support\Facades\DB;

class AccommodationRatingService
{
    public function __construct(
        protected AccommodationRatingRepository $ratingRepository
    ) {
    }

    /**
     * Tambahkan rating baru.
     */
    public function create(
        Accommodation $accommodation,
        array $data
    ): AccommodationRating {
        return DB::transaction(function () use (
            $accommodation,
            $data
        ) {
            return $this->ratingRepository->create(
                $accommodation,
                $data
            );
        });
    }

    /**
     * Ambil daftar rating.
     */
    public function getByAccommodation(
        Accommodation $accommodation
    ) {
        return $this->ratingRepository->getByAccommodation(
            $accommodation
        );
    }

    /**
     * Ambil rata-rata bintang.
     */
    public function getAverageRating(
        Accommodation $accommodation
    ): float {
        return $this->ratingRepository->getAverageRating(
            $accommodation
        );
    }

    /**
     * Ambil jumlah rating.
     */
    public function getRatingCount(
        Accommodation $accommodation
    ): int {
        return $this->ratingRepository->getRatingCount(
            $accommodation
        );
    }
}
