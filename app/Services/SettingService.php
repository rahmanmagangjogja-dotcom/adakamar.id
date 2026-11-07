<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingService
{
    protected SettingRepository $repository;

    public function __construct(
        SettingRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Mengambil semua pengaturan.
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Mengambil pengaturan pertama.
     */
    public function first(): ?Setting
    {
        return $this->repository->first();
    }

    /**
     * Mengambil pengaturan dengan pagination.
     */
    public function getPaginated(
        int $perPage = 10
    ) {
        return $this->repository->getPaginated($perPage);
    }

    /**
     * Mengambil pengaturan berdasarkan ID.
     */
    public function findById(int $id): ?Setting
    {
        return $this->repository->findById($id);
    }

    /**
     * Membuat pengaturan baru.
     */
    public function create(
        array $data,
        ?UploadedFile $logo = null
    ): Setting {

        if ($logo) {
            $data['logo'] = $this->storeLogo($logo);
        }

        return $this->repository->create($data);
    }

    /**
     * Update pengaturan.
     */
    public function update(
        Setting $setting,
        array $data,
        ?UploadedFile $logo = null
    ): Setting {

        if ($logo) {

            if ($setting->logo) {
                $this->deleteFile(
                    $setting->logo
                );
            }

            $data['logo'] = $this->storeLogo($logo);

        } else {

            unset($data['logo']);
        }

        return $this->repository->update(
            $setting,
            $data
        );
    }

    /**
     * Hapus pengaturan.
     */
    public function delete(
        Setting $setting
    ): bool {

        if ($setting->logo) {
            $this->deleteFile(
                $setting->logo
            );
        }

        return $this->repository->delete(
            $setting
        );
    }

    /**
     * Menyimpan logo.
     */
    protected function storeLogo(
        UploadedFile $file
    ): string {

        $directory = public_path(
            'settings'
        );

        if (!File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename =
            time() .
            '_' .
            Str::slug($originalName) .
            '_' .
            Str::random(10) .
            '.' .
            $extension;

        $file->move(
            $directory,
            $filename
        );

        return 'settings/' . $filename;
    }

    /**
     * Menghapus file dari public.
     */
    protected function deleteFile(
        string $path
    ): void {

        $filePath = public_path(
            ltrim($path, '/')
        );

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}