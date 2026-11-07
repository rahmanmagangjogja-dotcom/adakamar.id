<?php

namespace App\Http\Controllers;

use App\Models\AccommodationCategory;
use App\Services\AccommodationCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AccommodationCategoryController extends Controller
{
    /**
     * Batas ukuran thumbnail dalam KB (satuan rule `max` Laravel).
     * 102400 KB = 100 MB.
     */
    private const THUMBNAIL_MAX_KB = 102400; // 100 MB
    private const THUMBNAIL_MAX_MB = 100;

    protected AccommodationCategoryService $service;

    public function __construct(
        AccommodationCategoryService $service
    ) {
        $this->service = $service;
    }

    /**
     * Menampilkan daftar kategori.
     */
    public function index(Request $request)
    {
        $categories = $this->service->getPaginated(
            $request->input('keyword')
        );

        return view(
            'example.content.accomodation.kategori',
            compact('categories')
        );
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->storeRules(),
            $this->validationMessages()
        );

        // Bersihkan slug + pastikan tidak kosong setelah dibersihkan
        $validated['slug'] = $this->normalizeSlug($validated['slug']);

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeThumbnail(
                $request->file('thumbnail')
            );
        }

        // Simpan; jika service gagal, hapus file yang terlanjur diupload
        try {
            $this->service->create($validated);
        } catch (\Throwable $e) {
            if (!empty($validated['thumbnail'])) {
                $this->deleteFile($validated['thumbnail']);
            }
            throw $e;
        }

        return redirect()
            ->route('accommodation-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Mengambil data kategori untuk modal edit.
     */
    public function edit(
        AccommodationCategory $accommodationCategory
    ) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $accommodationCategory->id,
                'name' => $accommodationCategory->name,
                'slug' => $accommodationCategory->slug,
                'thumbnail' => $accommodationCategory->thumbnail,
                'thumbnail_url' => $accommodationCategory->thumbnail
                    ? asset($accommodationCategory->thumbnail)
                    : null,
                'description' => $accommodationCategory->description,
            ],
        ]);
    }

    /**
     * Update kategori.
     */
    public function update(
        Request $request,
        AccommodationCategory $accommodationCategory
    ) {
        $validated = $request->validate(
            $this->updateRules($accommodationCategory),
            $this->validationMessages()
        );

        // Bersihkan slug
        $validated['slug'] = $this->normalizeSlug($validated['slug']);

        // Upload thumbnail baru
        if ($request->hasFile('thumbnail')) {

            $oldThumbnail = $accommodationCategory->thumbnail;

            // Simpan thumbnail baru dulu
            $validated['thumbnail'] = $this->storeThumbnail(
                $request->file('thumbnail')
            );

            try {
                $this->service->update($accommodationCategory, $validated);

                // Update sukses → hapus thumbnail lama
                if ($oldThumbnail) {
                    $this->deleteFile($oldThumbnail);
                }
            } catch (\Throwable $e) {
                // Rollback: hapus thumbnail baru
                if (!empty($validated['thumbnail'])) {
                    $this->deleteFile($validated['thumbnail']);
                }
                throw $e;
            }

            return redirect()
                ->route('accommodation-categories.index')
                ->with('success', 'Kategori berhasil diperbarui.');
        }

        // Tanpa ganti thumbnail
        $this->service->update($accommodationCategory, $validated);

        return redirect()
            ->route('accommodation-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(
        AccommodationCategory $accommodationCategory
    ) {
        if ($accommodationCategory->thumbnail) {
            $this->deleteFile($accommodationCategory->thumbnail);
        }

        $this->service->delete($accommodationCategory);

        return redirect()
            ->route('accommodation-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Validation rules untuk store.
     */
    protected function storeRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:accommodation_categories,slug',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:' . self::THUMBNAIL_MAX_KB, // 100 MB
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }

    /**
     * Validation rules untuk update.
     */
    protected function updateRules(
        AccommodationCategory $accommodationCategory
    ): array {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('accommodation_categories', 'slug')
                    ->ignore($accommodationCategory->id),
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:' . self::THUMBNAIL_MAX_KB, // 100 MB
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }

    /**
     * Pesan validasi.
     */
    protected function validationMessages(): array
    {
        $maxMb = self::THUMBNAIL_MAX_MB;

        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'slug.required' => 'Slug wajib diisi.',
            'slug.unique' => 'Slug tersebut sudah digunakan.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'thumbnail.max' => "Ukuran gambar maksimal {$maxMb} MB.",
            'thumbnail.uploaded' => 'Gambar gagal diupload. Cek konfigurasi upload_max_filesize & post_max_size pada server.',
        ];
    }

    /**
     * Normalisasi slug & pastikan tidak kosong.
     */
    protected function normalizeSlug(string $raw): string
    {
        $slug = Str::slug($raw);

        if (empty($slug)) {
            throw ValidationException::withMessages([
                'slug' => 'Slug tidak valid. Gunakan huruf, angka, atau tanda hubung.',
            ]);
        }

        return $slug;
    }

    /**
     * Simpan thumbnail kategori.
     * File: public/kategori
     * Database: kategori/nama-file.jpg
     */
    protected function storeThumbnail($file): string
    {
        $folder = public_path('kategori');

        if (!File::exists($folder)) {
            if (!File::makeDirectory($folder, 0755, true) && !File::exists($folder)) {
                throw new \RuntimeException('Gagal membuat folder kategori.');
            }
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = Str::uuid() . '.' . $extension;

        $file->move($folder, $filename);

        return 'kategori/' . $filename;
    }

    /**
     * Hapus file dari public.
     */
    protected function deleteFile(string $path): void
    {
        $file = public_path(ltrim($path, '/'));

        if (File::exists($file)) {
            File::delete($file);
        }
    }
}