<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Services\AccommodationRatingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccommodationRatingController extends Controller
{
    public function __construct(
        protected AccommodationRatingService $ratingService
    ) {
    }

    /**
     * Simpan rating dari landing page.
     */
    public function store(
        Request $request,
        string $slug
    ): RedirectResponse {
        // Validasi input rating.
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'bintang' => [
                'required',
                'integer',
                'between:1,5',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'bintang.required' => 'Silakan pilih rating bintang.',
            'bintang.integer' => 'Rating harus berupa angka.',
            'bintang.between' => 'Rating harus antara 1 sampai 5 bintang.',
            'keterangan.max' => 'Keterangan maksimal 2000 karakter.',
        ]);

        // Cari penginapan berdasarkan slug.
        $accommodation = Accommodation::query()
            ->where('slug', $slug)
            ->firstOrFail();

        // Simpan melalui service.
        $this->ratingService->create(
            $accommodation,
            $validated
        );

        // Kembali ke halaman detail penginapan.
        return redirect()
            ->route('accommodationlanding.detail', [
                'slug' => $accommodation->slug,
            ])
            ->with('success', 'Terima kasih! Rating penginapan berhasil dikirim.');
    }
}
