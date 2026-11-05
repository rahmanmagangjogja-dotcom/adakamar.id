<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository
{
    protected Article $model;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * Daftar artikel untuk admin.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {

        return $this->model
            ->with([
                'category',
                'user',
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
                                'excerpt',
                                'like',
                                '%' . $keyword . '%'
                            )
                            ->orWhere(
                                'content',
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
                            )
                            ->orWhere(
                                'meta_keywords',
                                'like',
                                '%' . $keyword . '%'
                            );
                    });
                }
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Detail artikel berdasarkan ID.
     */
    public function findById(
        int $id
    ): ?Article {

        return $this->model
            ->with([
                'category',
                'user',
            ])
            ->find($id);
    }

    /**
     * Detail artikel berdasarkan slug.
     *
     * Digunakan untuk halaman detail artikel publik.
     */
    public function findBySlug(
        string $slug,
        ?int $exceptId = null
    ): ?Article {

        return $this->model
            ->with([
                'category',
                'user',
            ])
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
     * Simpan artikel baru.
     */
    public function create(
        array $data
    ): Article {

        return $this->model
            ->create($data);
    }

    /**
     * Update artikel.
     */
    public function update(
        Article $article,
        array $data
    ): bool {

        return $article
            ->update($data);
    }

    /**
     * Hapus artikel.
     */
    public function delete(
        Article $article
    ): bool {

        return $article
            ->delete();
    }

    /**
     * Artikel untuk dashboard.
     *
     * Mengambil semua artikel tanpa filter status.
     */
    public function getDashboardArticles(
        int $limit = 6
    ) {

        return $this->model
            ->with([
                'category',
                'user',
            ])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Artikel Published untuk landing page.
     *
     * Hanya mengambil artikel yang:
     * - status = Published
     * - published_at tidak null
     * - diurutkan berdasarkan tanggal publish terbaru
     */
    public function getPublished(
        int $limit = 6
    ) {

        return $this->model
            ->with([
                'category',
                'user',
            ])
            ->where(
                'status',
                'Published'
            )
            ->whereNotNull(
                'published_at'
            )
            ->orderByDesc(
                'published_at'
            )
            ->limit($limit)
            ->get();
    }

    /**
     * Total seluruh artikel.
     */
    public function getTotal(): int
    {
        return $this->model
            ->count();
    }

    /**
     * Total artikel Published.
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
     * Total artikel Draft.
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
}