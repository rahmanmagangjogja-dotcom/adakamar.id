<?php

namespace App\Http\Controllers;

use App\Models\AccommodationCategory;
use App\Models\Facility;
use App\Models\Rule;
use App\Services\AccommodationService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccommodationController extends Controller
{
    protected AccommodationService $accommodationService;

    public function __construct(
        AccommodationService $accommodationService
    ) {
        $this->accommodationService = $accommodationService;
    }

    /**
     * Daftar penginapan untuk admin.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $accommodations = $this->accommodationService
            ->getAccommodations($keyword, 5, $categoryId);

        $categories = AccommodationCategory::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        $rules = Rule::orderBy('name')->get();

        return view(
            'example.content.accomodation.penginapan',
            compact(
                'accommodations',
                'categories',
                'facilities',
                'rules'
            )
        );
    }

    /**
     * Menampilkan penginapan berdasarkan kategori
     *
     * URL:
     * /kategori-penginapanlanding/{slug}
     */
    public function byCategory(string $slug)
    {
        $data = $this->accommodationService
            ->getByCategorySlug($slug);

        if (!$data) {
            abort(404);
        }

        return view(
            'landingpage.content.accomodation.kamar',
            [
                'category' => $data['category'],
                'accommodations' => $data['accommodations'],
            ]
        );
    }

    /**
     * Detail penginapan untuk landing page
     *
     * URL:
     * /penginapanlanding/{slug}
     */
    public function publicDetail(string $slug)
    {
        $accommodation = $this->accommodationService
            ->getAccommodationBySlug($slug);

        if (!$accommodation) {
            abort(404);
        }

        $accommodation->load([
            'category',
            'images',
            'facilities',
            'rules',
        ]);


        $title = $accommodation->meta_title
            ? $accommodation->meta_title . ' | adakamar.id'
            : $accommodation->title . ' | adakamar.id';


        $metaDescription = $accommodation->meta_description
            ?: \Illuminate\Support\Str::limit(
                strip_tags($accommodation->description),
                155
            );

        return view(
            'landingpage.content.accomodation.detail_penginapan',
            compact(
                'accommodation',
                'title',
                'metaDescription'
            )
        );
    }

    /**
     * Detail penginapan untuk admin / AJAX.
     */
    public function show(int $id)
    {
        $accommodation = $this->accommodationService
            ->getAccommodation($id);

        if (!$accommodation) {
            return response()->json([
                'success' => false,
                'message' => 'Penginapan tidak ditemukan.',
            ], 404);
        }

        $accommodation->load([
            'category',
            'images',
            'facilities',
            'rules',
        ]);

        $data = $accommodation->toArray();

        $data['facility_ids'] = $accommodation
            ->facilities
            ->pluck('id')
            ->toArray();

        $data['rule_ids'] = $accommodation
            ->rules
            ->pluck('id')
            ->toArray();

        $data['images'] = $accommodation->images
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'image' => $item->image,
                    'image_url' => $item->image
                        ? asset($item->image)
                        : null,
                ];
            })
            ->values();

        $data['thumbnail_url'] = $accommodation->thumbnail
            ? asset($accommodation->thumbnail)
            : null;

        /*
        |--------------------------------------------------------------------------
        | Accessor URL tambahan untuk JS di modal edit
        |--------------------------------------------------------------------------
        */
        $data['whatsapp_url'] = $accommodation->whatsapp_url;
        $data['phone_url'] = $accommodation->phone_url;
        $data['email_url'] = $accommodation->email_url;

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Menyimpan penginapan.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                $this->storeRules()
            );

            $accommodation = $this->accommodationService
                ->createAccommodation($validated);

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penginapan berhasil ditambahkan.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with(
                    'success',
                    'Penginapan berhasil ditambahkan.'
                );

        } catch (ValidationException $e) {

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Terjadi kesalahan: '
                        . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: '
                    . $e->getMessage()
                );
        }
    }

    /**
     * Update penginapan.
     */
    public function update(
        Request $request,
        int $id
    ) {
        try {
            $validated = $request->validate(
                $this->updateRules()
            );

            $accommodation = $this->accommodationService
                ->updateAccommodation(
                    $id,
                    $validated
                );

            if (!$accommodation) {

                if (
                    $request->ajax() ||
                    $request->wantsJson()
                ) {
                    return response()->json([
                        'success' => false,
                        'message' =>
                            'Penginapan tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('accommodations.index')
                    ->with(
                        'error',
                        'Penginapan tidak ditemukan.'
                    );
            }

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => true,
                    'message' =>
                        'Penginapan berhasil diperbarui.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with(
                    'success',
                    'Penginapan berhasil diperbarui.'
                );

        } catch (ValidationException $e) {

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {

            if (
                $request->ajax() ||
                $request->wantsJson()
            ) {
                return response()->json([
                    'success' => false,
                    'message' =>
                        'Terjadi kesalahan: '
                        . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: '
                    . $e->getMessage()
                );
        }
    }

    /**
     * Hapus penginapan.
     */
    public function destroy(int $id)
    {
        try {
            $deleted = $this->accommodationService
                ->deleteAccommodation($id);

            if (!$deleted) {
                return redirect()
                    ->route('accommodations.index')
                    ->with(
                        'error',
                        'Penginapan tidak ditemukan.'
                    );
            }

            return redirect()
                ->route('accommodations.index')
                ->with(
                    'success',
                    'Penginapan berhasil dihapus.'
                );

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: '
                    . $e->getMessage()
                );
        }
    }

    /**
     * Validasi create.
     */
    protected function storeRules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:accommodation_categories,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'thumbnail' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1048576',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sosial Media
            |--------------------------------------------------------------------------
            */
            'facebook' => [
                'nullable',
                'url',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'url',
                'max:255',
            ],

            'youtube' => [
                'nullable',
                'url',
                'max:255',
            ],

            'x' => [
                'nullable',
                'url',
                'max:255',
            ],

            'tiktok' => [
                'nullable',
                'url',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Maps
            |--------------------------------------------------------------------------
            */
            'maps_embed' => [
                'nullable',
                'string',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:2048',
            ],



            /*
            |--------------------------------------------------------------------------
            | Detail
            |--------------------------------------------------------------------------
            */
            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'bedroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'bathroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:Available,Full,Maintenance',
            ],

            'description' => [
                'required',
                'string',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */
            'facility_ids' => [
                'nullable',
                'array',
            ],

            'facility_ids.*' => [
                'exists:facilities,id',
            ],

            'rule_ids' => [
                'nullable',
                'array',
            ],

            'rule_ids.*' => [
                'exists:rules,id',
            ],

            'gallery' => [
                'required',
                'array',
                'min:2',
                'max:10',
            ],

            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ];
    }

    /**
     * Validasi update.
     */
    protected function updateRules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:accommodation_categories,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1048576',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            /*
            |--------------------------------------------------------------------------
            | Kontak
            |--------------------------------------------------------------------------
            */
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Sosial Media
            |--------------------------------------------------------------------------
            */
            'facebook' => [
                'nullable',
                'url',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'url',
                'max:255',
            ],

            'youtube' => [
                'nullable',
                'url',
                'max:255',
            ],

            'x' => [
                'nullable',
                'url',
                'max:255',
            ],

            'tiktok' => [
                'nullable',
                'url',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Maps
            |--------------------------------------------------------------------------
            */
            'maps_embed' => [
                'nullable',
                'string',
            ],

            'google_maps_url' => [
                'nullable',
                'url',
                'max:2048',
            ],



            /*
            |--------------------------------------------------------------------------
            | Detail
            |--------------------------------------------------------------------------
            */
            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'bedroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'bathroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:Available,Full,Maintenance',
            ],

            'description' => [
                'required',
                'string',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */
            'facility_ids' => [
                'nullable',
                'array',
            ],

            'facility_ids.*' => [
                'exists:facilities,id',
            ],

            'rule_ids' => [
                'nullable',
                'array',
            ],

            'rule_ids.*' => [
                'exists:rules,id',
            ],

            'gallery' => [
                'nullable',
                'array',
                'max:10',
            ],

            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ];
    }
}