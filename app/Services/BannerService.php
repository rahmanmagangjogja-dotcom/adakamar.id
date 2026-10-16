<?php

namespace App\Services;

use App\Repositories\BannerRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerService
{
    protected BannerRepository $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Mengambil semua banner.
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Mengambil banner untuk Hero Section.
     *
     * Mengambil banner terbaru.
     */
    public function getHero()
    {
        return $this->repository->getAll()->first();
    }

    /**
     * Mengambil satu banner berdasarkan ID.
     */
    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Membuat banner baru.
     */
    public function create(array $data)
    {
        if (
            isset($data['image']) &&
            $data['image'] instanceof UploadedFile
        ) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->repository->create($data);
    }

    /**
     * Mengupdate banner.
     */
    public function update(int $id, array $data)
    {
        $banner = $this->repository->findById($id);

        if (!$banner) {
            throw new \Exception('Banner tidak ditemukan.');
        }

        /**
         * Jika upload image baru
         */
        if (
            isset($data['image']) &&
            $data['image'] instanceof UploadedFile
        ) {
            // Hapus image lama
            $this->deleteImage($banner->image);

            // Upload image baru
            $data['image'] = $this->uploadImage($data['image']);
        } else {
            // Pertahankan image lama
            unset($data['image']);
        }

        return $this->repository->update(
            $id,
            $data
        );
    }

    /**
     * Menghapus banner beserta image.
     */
    public function delete(int $id): bool
    {
        $banner = $this->repository->findById($id);

        if (!$banner) {
            throw new \Exception('Banner tidak ditemukan.');
        }

        // Hapus image
        $this->deleteImage($banner->image);

        // Hapus data banner
        return $this->repository->delete($id);
    }

    /**
     * Upload image ke public/banner.
     */
    protected function uploadImage(UploadedFile $file): string
    {
        $folder = public_path('banner');

        // Buat folder jika belum ada
        if (!File::exists($folder)) {
            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }

        /*
        | Nama file dibuat unik agar tidak bentrok.
        */
        $filename =
            time() . '_' .
            Str::random(10) . '.' .
            $file->getClientOriginalExtension();

        /*
        | Pindahkan file langsung ke:
        | public/banner/
        */
        $file->move(
            $folder,
            $filename
        );

        /*
        | Path yang disimpan ke database.
        |
        | Contoh:
        | banner/1234567890_abc123.jpg
        */
        return 'banner/' . $filename;
    }

    /**
     * Menghapus image dari public/banner.
     */
    protected function deleteImage(?string $path): void
    {
        if (empty($path)) {
            return;
        }

        $filePath = public_path($path);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}