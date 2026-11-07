<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class GalleryService
{
    protected GalleryRepository $galleryRepository;

    public function __construct(
        GalleryRepository $galleryRepository
    ) {
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * Daftar gallery.
     *
     * Digunakan untuk halaman admin.
     */
    public function getGalleries(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {

        return $this->galleryRepository
            ->getAll(
                $keyword,
                $perPage
            );
    }

    /**
     * Detail gallery.
     */
    public function getGallery(
        int $id
    ): ?Gallery {

        return $this->galleryRepository
            ->findById($id);
    }

    /**
     * Ambil gallery aktif.
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
        return $this->galleryRepository
            ->getActiveGalleries();
    }

    /**
     * Buat gallery baru.
     */
    public function createGallery(
        array $data
    ): Gallery {

        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Upload gambar
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['image']) &&
                $data['image'] instanceof UploadedFile
            ) {

                $data['image'] =
                    $this->storeImage(
                        $data['image']
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Default sort order
            |--------------------------------------------------------------------------
            |
            | Jika sort_order tidak dikirim,
            | otomatis diletakkan di urutan terakhir.
            |
            */

            if (!isset($data['sort_order'])) {

                $data['sort_order'] =
                    (Gallery::max('sort_order') ?? 0) + 1;
            }

            /*
            |--------------------------------------------------------------------------
            | Default status aktif
            |--------------------------------------------------------------------------
            */

            if (!isset($data['is_active'])) {

                $data['is_active'] = true;
            }

            /*
            |--------------------------------------------------------------------------
            | Create gallery
            |--------------------------------------------------------------------------
            */

            return $this->galleryRepository
                ->create($data);
        });
    }

    /**
     * Update gallery.
     */
    public function updateGallery(
        int $id,
        array $data
    ): ?Gallery {

        return DB::transaction(function () use ($id, $data) {

            /*
            |--------------------------------------------------------------------------
            | Cari gallery
            |--------------------------------------------------------------------------
            */

            $gallery =
                $this->galleryRepository
                    ->findById($id);

            if (!$gallery) {

                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Upload gambar baru
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['image']) &&
                $data['image'] instanceof UploadedFile
            ) {

                /*
                |--------------------------------------------------------------------------
                | Hapus gambar lama
                |--------------------------------------------------------------------------
                */

                if ($gallery->image) {

                    $this->deleteFile(
                        $gallery->image
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Simpan gambar baru
                |--------------------------------------------------------------------------
                */

                $data['image'] =
                    $this->storeImage(
                        $data['image']
                    );

            } else {

                /*
                |--------------------------------------------------------------------------
                | Jangan ubah image
                |--------------------------------------------------------------------------
                */

                unset($data['image']);
            }

            /*
            |--------------------------------------------------------------------------
            | Update gallery
            |--------------------------------------------------------------------------
            */

            $this->galleryRepository
                ->update(
                    $gallery,
                    $data
                );

            /*
            |--------------------------------------------------------------------------
            | Return data terbaru
            |--------------------------------------------------------------------------
            */

            return $gallery->fresh();
        });
    }

    /**
     * Hapus gallery.
     */
    public function deleteGallery(
        int $id
    ): bool {

        return DB::transaction(function () use ($id) {

            /*
            |--------------------------------------------------------------------------
            | Cari gallery
            |--------------------------------------------------------------------------
            */

            $gallery =
                $this->galleryRepository
                    ->findById($id);

            if (!$gallery) {

                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus file gambar
            |--------------------------------------------------------------------------
            */

            if ($gallery->image) {

                $this->deleteFile(
                    $gallery->image
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus data gallery
            |--------------------------------------------------------------------------
            */

            return $this->galleryRepository
                ->delete($gallery);
        });
    }

    /**
     * Simpan image ke public/galleries.
     *
     * Database:
     *
     * galleries/nama-file.jpg
     *
     * File:
     *
     * public/galleries/nama-file.jpg
     */
    protected function storeImage(
        UploadedFile $file
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Folder penyimpanan
        |--------------------------------------------------------------------------
        */

        $directory =
            public_path('galleries');

        /*
        |--------------------------------------------------------------------------
        | Pastikan folder tersedia
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
        | Extension
        |--------------------------------------------------------------------------
        */

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );

        /*
        |--------------------------------------------------------------------------
        | Nama file
        |--------------------------------------------------------------------------
        */

        $filename =
            time() .
            '_' .
            uniqid() .
            '.' .
            $extension;

        /*
        |--------------------------------------------------------------------------
        | Pindahkan file
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

        return 'galleries/' . $filename;
    }

    /**
     * Hapus file dari public.
     */
    protected function deleteFile(
        string $path
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Path file
        |--------------------------------------------------------------------------
        */

        $filePath =
            public_path(
                ltrim(
                    $path,
                    '/'
                )
            );

        /*
        |--------------------------------------------------------------------------
        | Hapus jika file ada
        |--------------------------------------------------------------------------
        */

        if (
            file_exists($filePath) &&
            is_file($filePath)
        ) {

            unlink($filePath);
        }
    }
}
