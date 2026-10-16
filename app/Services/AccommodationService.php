<?php

namespace App\Services;

use App\Models\Accommodation;
use App\Repositories\AccommodationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccommodationService
{
    protected AccommodationRepository $accommodationRepository;

    public function __construct(
        AccommodationRepository $accommodationRepository
    ) {
        $this->accommodationRepository = $accommodationRepository;
    }

    /**
     * Daftar accommodation untuk admin.
     */
    public function getAccommodations(
        ?string $keyword = null,
        int $perPage = 5,
        ?int $categoryId = null
    ): LengthAwarePaginator {
        return $this->accommodationRepository->getAll(
            $keyword,
            $perPage,
            $categoryId
        );
    }

    /**
     * Detail accommodation berdasarkan ID.
     */
    public function getAccommodation(
        int $id
    ): ?Accommodation {
        return $this->accommodationRepository->findById($id);
    }

    /**
     * Detail accommodation berdasarkan slug.
     */
    public function getAccommodationBySlug(
        string $slug
    ): ?Accommodation {
        return $this->accommodationRepository->findBySlug($slug);
    }

    /**
     * Ambil accommodation berdasarkan slug kategori.
     */
    public function getByCategorySlug(
        string $slug
    ): ?array {
        $category = $this->accommodationRepository
            ->findCategoryBySlug($slug);

        if (!$category) {
            return null;
        }

        $accommodations = $this->accommodationRepository
            ->getAccommodationsByCategory($category->id);

        return [
            'category' => $category,
            'accommodations' => $accommodations,
        ];
    }

    /**
     * Buat accommodation baru.
     */
    public function createAccommodation(
        array $data
    ): Accommodation {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Normalisasi data
            |--------------------------------------------------------------------------
            */

            $data = $this->normalizeContactData($data);

            /*
            |--------------------------------------------------------------------------
            | Generate slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $data['slug'] = $this->generateUniqueSlug($slug);

            /*
            |--------------------------------------------------------------------------
            | Thumbnail
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {
                $data['thumbnail'] = $this->storeThumbnail(
                    $data['thumbnail']
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $facilityIds = $data['facility_ids'] ?? [];
            $ruleIds = $data['rule_ids'] ?? [];
            $gallery = $data['gallery'] ?? [];

            unset(
                $data['facility_ids'],
                $data['rule_ids'],
                $data['gallery']
            );

            /*
            |--------------------------------------------------------------------------
            | Create
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->create($data);

            /*
            |--------------------------------------------------------------------------
            | Facilities
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->facilities()
                ->sync($facilityIds);

            /*
            |--------------------------------------------------------------------------
            | Rules
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->rules()
                ->sync($ruleIds);

            /*
            |--------------------------------------------------------------------------
            | Gallery
            |--------------------------------------------------------------------------
            */

            if (!empty($gallery)) {
                $this->storeGallery(
                    $accommodation,
                    $gallery
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Return
            |--------------------------------------------------------------------------
            */

            return $accommodation->fresh([
                'category',
                'images',
                'facilities',
                'rules',
            ]);
        });
    }

    /**
     * Update accommodation.
     */
    public function updateAccommodation(
        int $id,
        array $data
    ): ?Accommodation {
        return DB::transaction(function () use ($id, $data) {

            /*
            |--------------------------------------------------------------------------
            | Cari accommodation
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->findById($id);

            if (!$accommodation) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Normalisasi data
            |--------------------------------------------------------------------------
            */

            $data = $this->normalizeContactData($data);

            /*
            |--------------------------------------------------------------------------
            | Generate slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $data['slug'] = $this->generateUniqueSlug(
                $slug,
                $accommodation->id
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

                if ($accommodation->thumbnail) {
                    $this->deleteFile(
                        $accommodation->thumbnail
                    );
                }

                /*
                | Simpan thumbnail baru
                */

                $data['thumbnail'] = $this->storeThumbnail(
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
            | Relasi
            |--------------------------------------------------------------------------
            */

            $facilityIds = $data['facility_ids'] ?? [];
            $ruleIds = $data['rule_ids'] ?? [];
            $gallery = $data['gallery'] ?? [];

            unset(
                $data['facility_ids'],
                $data['rule_ids'],
                $data['gallery']
            );

            /*
            |--------------------------------------------------------------------------
            | Update data utama
            |--------------------------------------------------------------------------
            */

            $this->accommodationRepository->update(
                $accommodation,
                $data
            );

            /*
            |--------------------------------------------------------------------------
            | Sync Facilities
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->facilities()
                ->sync($facilityIds);

            /*
            |--------------------------------------------------------------------------
            | Sync Rules
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->rules()
                ->sync($ruleIds);

            /*
            |--------------------------------------------------------------------------
            | Tambah Gallery Baru
            |--------------------------------------------------------------------------
            */

            if (!empty($gallery)) {
                $this->storeGallery(
                    $accommodation,
                    $gallery
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Return data terbaru
            |--------------------------------------------------------------------------
            */

            return $accommodation->fresh([
                'category',
                'images',
                'facilities',
                'rules',
            ]);
        });
    }

    /**
     * Hapus accommodation.
     */
    public function deleteAccommodation(
        int $id
    ): bool {
        return DB::transaction(function () use ($id) {

            /*
            |--------------------------------------------------------------------------
            | Cari accommodation
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->findById($id);

            if (!$accommodation) {
                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus thumbnail
            |--------------------------------------------------------------------------
            */

            if ($accommodation->thumbnail) {
                $this->deleteFile(
                    $accommodation->thumbnail
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus gallery
            |--------------------------------------------------------------------------
            */

            foreach ($accommodation->images as $image) {

                if ($image->image) {
                    $this->deleteFile(
                        $image->image
                    );
                }

                $image->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus facilities
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->facilities()
                ->detach();

            /*
            |--------------------------------------------------------------------------
            | Hapus rules
            |--------------------------------------------------------------------------
            */

            $accommodation
                ->rules()
                ->detach();

            /*
            |--------------------------------------------------------------------------
            | Soft delete
            |--------------------------------------------------------------------------
            */

            return $this->accommodationRepository
                ->delete($accommodation);
        });
    }

    /**
     * Normalisasi data kontak dan sosial media.
     *
     * - Trim whitespace
     * - String kosong menjadi null
     * - Menambahkan https:// pada sosial media
     */
    protected function normalizeContactData(
        array $data
    ): array {

        /*
        |--------------------------------------------------------------------------
        | Contact
        |--------------------------------------------------------------------------
        */

        $contactFields = [
            'phone',
            'whatsapp',
            'email',
        ];

        foreach ($contactFields as $field) {

            if (
                isset($data[$field]) &&
                is_string($data[$field])
            ) {
                $value = trim($data[$field]);

                $data[$field] = $value !== ''
                    ? $value
                    : null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Social Media
        |--------------------------------------------------------------------------
        */

        $socialFields = [
            'facebook',
            'instagram',
            'youtube',
            'x',
            'tiktok',
        ];

        foreach ($socialFields as $field) {

            if (
                isset($data[$field]) &&
                is_string($data[$field])
            ) {
                $value = trim($data[$field]);

                if ($value !== '') {

                    /*
                    | Jika user memasukkan:
                    |
                    | instagram.com/user
                    |
                    | maka menjadi:
                    |
                    | https://instagram.com/user
                    */

                    if (!preg_match('/^https?:\/\//i', $value)) {
                        $value = 'https://' . ltrim($value, '/');
                    }

                    $data[$field] = $value;

                } else {

                    $data[$field] = null;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Google Maps URL
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['google_maps_url']) &&
            is_string($data['google_maps_url'])
        ) {
            $value = trim($data['google_maps_url']);

            $data['google_maps_url'] = $value !== ''
                ? $value
                : null;
        }

        /*
        |--------------------------------------------------------------------------
        | Maps Embed
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['maps_embed']) &&
            is_string($data['maps_embed'])
        ) {
            $value = trim($data['maps_embed']);

            $data['maps_embed'] = $value !== ''
                ? $value
                : null;
        }

        return $data;
    }

    /**
     * Generate slug unik.
     */
    protected function generateUniqueSlug(
        string $slug,
        ?int $exceptId = null
    ): string {

        $originalSlug = Str::slug($slug);

        $uniqueSlug = $originalSlug;

        $counter = 1;

        while (
            $this->accommodationRepository
                ->findBySlug(
                    $uniqueSlug,
                    $exceptId
                )
        ) {
            $uniqueSlug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }

        return $uniqueSlug;
    }

    /**
     * Simpan thumbnail.
     */
    protected function storeThumbnail(
        UploadedFile $file
    ): string {

        $directory = public_path(
            'accommodations'
        );

        if (!is_dir($directory)) {
            mkdir(
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
            uniqid() .
            '.' .
            $extension;

        $file->move(
            $directory,
            $filename
        );

        return 'accommodations/' . $filename;
    }

    /**
     * Simpan gallery.
     */
    protected function storeGallery(
        Accommodation $accommodation,
        array $files
    ): void {

        $directory = public_path(
            'galery_accommodation'
        );

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        foreach ($files as $file) {

            if (!$file instanceof UploadedFile) {
                continue;
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
                uniqid() .
                '.' .
                $extension;

            $file->move(
                $directory,
                $filename
            );

            $accommodation
                ->images()
                ->create([
                    'image' =>
                        'galery_accommodation/' .
                        $filename,
                ]);
        }
    }

    /**
     * Hapus file.
     */
    protected function deleteFile(
        string $path
    ): void {

        $filePath = public_path(
            ltrim($path, '/')
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}