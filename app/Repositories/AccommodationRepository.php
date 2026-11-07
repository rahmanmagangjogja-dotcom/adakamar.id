<?php

namespace App\Repositories;

use App\Models\Accommodation;
use App\Models\AccommodationCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AccommodationRepository
{
    protected Accommodation $model;

    public function __construct(Accommodation $model)
    {
        $this->model = $model;
    }

    /**
     * Daftar accommodation.
     *
     * Digunakan untuk halaman admin/list accommodation.
     *
     * @param  string|null  $keyword
     * @param  int          $perPage
     * @param  int|null     $categoryId
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 5,
        ?int $categoryId = null
    ): LengthAwarePaginator {

        return $this->model
            ->with([
                'category',
                'images',
            ])
            ->when(
                filled($keyword),
                function ($query) use ($keyword) {

                    $query->where(function ($q) use ($keyword) {

                        $q->where(
                            'title',
                            'like',
                            '%' . $keyword . '%'
                        )
                            ->orWhere(
                                'address',
                                'like',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                'description',
                                'like',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                'meta_title',
                                'like',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                'meta_description',
                                'like',
                                '%' . $keyword . '%'
                            );
                    });
                }
            )
            ->when(
                filled($categoryId),
                function ($query) use ($categoryId) {

                    $query->where(
                        'category_id',
                        $categoryId
                    );
                }
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Detail accommodation berdasarkan ID.
     */
    public function findById(
        int $id
    ): ?Accommodation {

        return $this->model
            ->with([
                'category',
                'images',
                'facilities',
                'rules',
            ])
            ->find($id);
    }

    /**
     * Create accommodation.
     */
    public function create(
        array $data
    ): Accommodation {

        return $this->model->create($data);
    }

    /**
     * Update accommodation.
     */
    public function update(
        Accommodation $accommodation,
        array $data
    ): bool {

        return $accommodation->update($data);
    }

    /**
     * Delete accommodation.
     */
    public function delete(
        Accommodation $accommodation
    ): bool {

        return $accommodation->delete();
    }

    /**
     * Cari accommodation berdasarkan slug.
     *
     * Digunakan untuk validasi slug dan kebutuhan detail.
     */
    public function findBySlug(
        string $slug,
        ?int $exceptId = null
    ): ?Accommodation {

        return $this->model
            ->when(
                $exceptId !== null,
                function ($query) use ($exceptId) {

                    $query->where(
                        'id',
                        '!=',
                        $exceptId
                    );
                }
            )
            ->where(
                'slug',
                $slug
            )
            ->first();
    }

    /**
     * Cari kategori accommodation berdasarkan slug.
     *
     * Contoh:
     * /penginapan/kamar
     * /penginapan/villa
     * /penginapan/guesthouse
     */
    public function findCategoryBySlug(
        string $slug
    ): ?AccommodationCategory {

        return AccommodationCategory::query()
            ->where(
                'slug',
                $slug
            )
            ->first();
    }

    /**
     * Ambil accommodation berdasarkan category ID.
     *
     * Digunakan untuk halaman landing:
     *
     * /penginapan/{slug}
     *
     * Hasilnya adalah LengthAwarePaginator
     * yang berisi object Accommodation.
     */
    public function getAccommodationsByCategory(
        int $categoryId,
        int $perPage = 9
    ): LengthAwarePaginator {

        return $this->model
            ->with([
                'category',
                'images',
                'facilities',
                'rules',
            ])
            ->where(
                'category_id',
                $categoryId
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Accommodation untuk dashboard.
     */
    public function getDashboardAccommodations(
        int $limit = 6
    ) {

        return $this->model
            ->with([
                'category',
                'images',
            ])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Total seluruh accommodation.
     */
    public function getTotal(): int
    {
        return $this->model->count();
    }

    /**
     * Total accommodation published.
     */
    public function getPublishedTotal(): int
    {
        return $this->model
            ->where(
                'status',
                'Published'
            )
            ->count();
    }

    /**
     * Total accommodation draft.
     */
    public function getDraftTotal(): int
    {
        return $this->model
            ->where(
                'status',
                'Draft'
            )
            ->count();
    }

    /**
     * Jumlah accommodation berdasarkan kategori.
     *
     * Digunakan untuk statistik dashboard.
     *
     * Method ini sengaja dipertahankan
     * dan berbeda dengan getAccommodationsByCategory().
     */
    public function getByCategory()
    {
        return $this->model
            ->select(
                'category_id',
                DB::raw('COUNT(*) as total')
            )
            ->with(
                'category:id,name'
            )
            ->groupBy(
                'category_id'
            )
            ->get()
            ->map(function ($item) {

                return [
                    'category_name' => $item->category
                        ? $item->category->name
                        : 'Tanpa Kategori',

                    'total' => (int) $item->total,
                ];
            });
    }
}