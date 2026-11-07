<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class BannerController extends Controller
{
    protected BannerService $service;

    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan halaman banner.
     */
    public function index()
    {
        $banners = $this->service->getAll();

        return view(
            'example.content.konten.banner',
            compact('banners')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    /**
     * Menyimpan banner baru.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'subtitle' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:1048576', // 1 GB
                ],
            ]);

            $banner = $this->service->create($validated);

            // Jika request dari AJAX
            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Banner berhasil ditambahkan.',
                    'data' => $banner,
                ], 201);
            }

            return redirect()
                ->route('banners.index')
                ->with('success', 'Banner berhasil ditambahkan.');

        } catch (ValidationException $e) {

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (Throwable $e) {

            \Log::error('Gagal menambahkan banner', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil data banner untuk modal edit.
     */
    public function edit(int $id)
    {
        try {
            $banner = $this->service->findById($id);

            if (!$banner) {
                return response()->json([
                    'success' => false,
                    'message' => 'Banner tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $banner->id,
                    'title' => $banner->title,
                    'subtitle' => $banner->subtitle,
                    'image' => $banner->image,

                    // Path gambar dari folder public/banner
                    'image_url' => $banner->image
                        ? asset('banner/' . $banner->image)
                        : null,
                ],
            ], 200);

        } catch (Throwable $e) {

            \Log::error('Gagal mengambil data banner', [
                'id' => $id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    /**
     * Mengupdate banner.
     */
    public function update(Request $request, int $id)
    {
        try {
            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'subtitle' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:1048576', // 1 GB
                ],
            ]);

            $banner = $this->service->update(
                $id,
                $validated
            );

            // Jika request dari AJAX
            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Banner berhasil diperbarui.',
                    'data' => $banner,
                ]);
            }

            return redirect()
                ->route('banners.index')
                ->with('success', 'Banner berhasil diperbarui.');

        } catch (ValidationException $e) {

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (Throwable $e) {

            \Log::error('Gagal memperbarui banner', [
                'id' => $id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    /**
     * Menghapus banner beserta image.
     */
    public function destroy(Request $request, int $id)
    {
        try {
            $this->service->delete($id);

            // Jika request dari AJAX
            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Banner berhasil dihapus.',
                ]);
            }

            return redirect()
                ->route('banners.index')
                ->with('success', 'Banner berhasil dihapus.');

        } catch (Throwable $e) {

            \Log::error('Gagal menghapus banner', [
                'id' => $id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->route('banners.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    /**
     * Cek apakah request berasal dari AJAX.
     */
    protected function isAjax(Request $request): bool
    {
        return $request->ajax()
            || $request->wantsJson()
            || $request->expectsJson();
    }
}
