<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    ) {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Daftar artikel untuk admin.
     */
    public function getArticles(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->articleRepository
            ->getAll(
                $keyword,
                $perPage
            );
    }

    /**
     * Artikel Published untuk landing page.
     *
     * Mengambil artikel yang:
     * - status = Published
     * - published_at tidak null
     * - diurutkan dari artikel terbaru
     */
    public function getPublishedArticles(
        int $limit = 6
    ) {
        return $this->articleRepository
            ->getPublished($limit);
    }

    /**
     * Detail artikel berdasarkan ID.
     *
     * Digunakan untuk kebutuhan admin.
     */
    public function getArticle(
        int $id
    ): ?Article {
        return $this->articleRepository
            ->findById($id);
    }

    /**
     * Detail artikel berdasarkan slug.
     *
     * Digunakan untuk halaman detail artikel publik.
     */
    public function getArticleBySlug(
        string $slug
    ): ?Article {
        return $this->articleRepository
            ->findBySlug($slug);
    }

    /**
     * Buat artikel baru.
     */
    public function createArticle(
        array $data
    ): Article {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug(
                    $data['title']
                );
            }

            $slug = $this->generateUniqueSlug(
                $slug
            );

            /*
            |--------------------------------------------------------------------------
            | Thumbnail
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {
                $data['thumbnail'] =
                    $this->storeThumbnail(
                        $data['thumbnail']
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Published At
            |--------------------------------------------------------------------------
            */

            if (
                ($data['status'] ?? 'Draft') === 'Published'
            ) {
                $data['published_at'] =
                    $data['published_at'] ?? now();
            } else {
                $data['published_at'] = null;
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan slug
            |--------------------------------------------------------------------------
            */

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Create artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleRepository
                ->create($data);

            /*
            |--------------------------------------------------------------------------
            | Load relasi
            |--------------------------------------------------------------------------
            */

            return $article->load([
                'category',
                'user',
            ]);
        });
    }

    /**
     * Update artikel.
     */
    public function updateArticle(
        int $id,
        array $data
    ): ?Article {
        return DB::transaction(function () use ($id, $data) {

            /*
            |--------------------------------------------------------------------------
            | Cari artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleRepository
                ->findById($id);

            if (!$article) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug(
                    $data['title']
                );
            }

            $slug = $this->generateUniqueSlug(
                $slug,
                $article->id
            );

            /*
            |--------------------------------------------------------------------------
            | Thumbnail baru
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {

                /*
                | Hapus thumbnail lama
                */

                if ($article->thumbnail) {
                    $this->deleteFile(
                        $article->thumbnail
                    );
                }

                /*
                | Simpan thumbnail baru
                */

                $data['thumbnail'] =
                    $this->storeThumbnail(
                        $data['thumbnail']
                    );

            } else {

                /*
                | Jangan ubah thumbnail lama
                */

                unset($data['thumbnail']);
            }

            /*
            |--------------------------------------------------------------------------
            | Published At
            |--------------------------------------------------------------------------
            */

            if (
                ($data['status'] ?? $article->status)
                === 'Published'
            ) {

                if (!$article->published_at) {
                    $data['published_at'] = now();
                }

            } else {

                $data['published_at'] = null;
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan slug
            |--------------------------------------------------------------------------
            */

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Update artikel
            |--------------------------------------------------------------------------
            */

            $updated = $this->articleRepository
                ->update(
                    $article,
                    $data
                );

            /*
            |--------------------------------------------------------------------------
            | Cek hasil update
            |--------------------------------------------------------------------------
            */

            if (!$updated) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Refresh artikel
            |--------------------------------------------------------------------------
            */

            return $article
                ->refresh()
                ->load([
                    'category',
                    'user',
                ]);
        });
    }

    /**
     * Hapus artikel.
     */
    public function deleteArticle(
        int $id
    ): bool {
        return DB::transaction(function () use ($id) {

            /*
            |--------------------------------------------------------------------------
            | Cari artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleRepository
                ->findById($id);

            if (!$article) {
                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus thumbnail
            |--------------------------------------------------------------------------
            */

            if ($article->thumbnail) {
                $this->deleteFile(
                    $article->thumbnail
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus artikel
            |--------------------------------------------------------------------------
            */

            return $this->articleRepository
                ->delete($article);
        });
    }

    /**
     * Generate slug unik.
     */
    protected function generateUniqueSlug(
        string $slug,
        ?int $exceptId = null
    ): string {

        $originalSlug = Str::slug(
            $slug
        );

        if (!$originalSlug) {
            $originalSlug = 'artikel';
        }

        $slug = $originalSlug;

        $counter = 1;

        while (
            $this->articleRepository
                ->findBySlug(
                    $slug,
                    $exceptId
                )
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }

        return $slug;
    }

    /**
     * Simpan thumbnail artikel.
     *
     * File:
     * public/articles
     *
     * Database:
     * articles/nama-file.jpg
     */
    protected function storeThumbnail(
        UploadedFile $file
    ): string {

        $directory = public_path(
            'articles'
        );

        /*
        |--------------------------------------------------------------------------
        | Buat directory jika belum ada
        |--------------------------------------------------------------------------
        */

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Nama file asli
        |--------------------------------------------------------------------------
        */

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        /*
        |--------------------------------------------------------------------------
        | Extension
        |--------------------------------------------------------------------------
        */

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        /*
        |--------------------------------------------------------------------------
        | Generate filename
        |--------------------------------------------------------------------------
        */

        $filename =
            time() .
            '_' .
            Str::slug($originalName) .
            '_' .
            uniqid() .
            '.' .
            $extension;

        /*
        |--------------------------------------------------------------------------
        | Move file
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $filename
        );

        /*
        |--------------------------------------------------------------------------
        | Path yang disimpan ke database
        |--------------------------------------------------------------------------
        */

        return 'articles/' . $filename;
    }

    /**
     * Hapus file thumbnail.
     */
    protected function deleteFile(
        string $path
    ): void {

        $filePath = public_path(
            ltrim(
                $path,
                '/'
            )
        );

        if (
            file_exists($filePath) &&
            is_file($filePath)
        ) {
            unlink($filePath);
        }
    }
}