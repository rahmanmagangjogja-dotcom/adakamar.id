<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GalleryRepository
{
    /**
     * Model Gallery.
     */
    protected Gallery $model;

    /**
     * Constructor.
     */
    public function __construct(Gallery $model)
    {
        $this->model = $model;
    }

    /**
     * Ambil semua gallery dengan pagination.
     *
     * Digunakan untuk halaman admin.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {

        return $this->model
            ->when(
                filled($keyword),
                function ($query) use ($keyword) {

                    $query->where(
                        'title',
                        'like',
                        '%' . $keyword . '%'
                    );
                }
            )
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Ambil gallery berdasarkan ID.
     */
    public function findById(
        int $id
    ): ?Gallery {

        return $this->model
            ->find($id);
    }

    /**
     * Buat gallery baru.
     */
    public function create(
        array $data
    ): Gallery {

        return $this->model
            ->create($data);
    }

    /**
     * Update gallery.
     */
    public function update(
        Gallery $gallery,
        array $data
    ): bool {

        return $gallery
            ->update($data);
    }

    /**
     * Hapus gallery.
     */
    public function delete(
        Gallery $gallery
    ): bool {

        return $gallery
            ->delete();
    }

    /**
     * Ambil semua gallery aktif.
     *
     * Digunakan untuk landing page.
     *
     * Hanya gallery dengan:
     *
     * is_active = true
     *
     * yang akan ditampilkan.
     */
    public function getActiveGalleries()
    {
        return $this->model
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('id')
            ->get();
    }
}
