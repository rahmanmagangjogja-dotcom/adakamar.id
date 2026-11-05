<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationCategory;
use App\Models\Facility;
use App\Models\Rule;
use App\Services\AccommodationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
     * Halaman publik: semua penginapan.
     */
    public function publicIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category_id');

        $query = Accommodation::with(['category', 'ratings'])
            ->where('status', 'Available')
            ->when($keyword, function ($q, $keyword) {
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('title', 'like', "%{$keyword}%")
                        ->orWhere('address', 'like', "%{$keyword}%");
                });
            })
            ->when($categoryId, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->latest();

        $accommodations = $query->paginate(12)->withQueryString();
        $categories = AccommodationCategory::orderBy('name')->get();

        $siteName = 'adakamar.id';
        $title = 'Semua Penginapan | ' . $siteName;
        $metaDescription = 'Temukan berbagai pilihan penginapan terbaik dan nyaman di ' . $siteName;

        return view(
            'landingpage.content.accomodation.semua_penginapan',
            compact(
                'accommodations',
                'categories',
                'title',
                'metaDescription'
            )
        );
    }

    /**
     * Daftar penginapan berdasarkan kategori + SEO.
     */
    public function byCategory(string $slug)
    {
        $data = $this->accommodationService
            ->getByCategorySlug($slug);

        if (!$data) {
            abort(404);
        }

        $category = $data['category'];
        $siteName = 'adakamar.id';

        // Judul SEO.
        $title = $category->name
            . ' - Penginapan | '
            . $siteName;

        // Deskripsi SEO.
        $metaDescription = trim(strip_tags(
            (string) $category->description
        ));

        if ($metaDescription === '') {
            $metaDescription = 'Temukan pilihan penginapan kategori '
                . $category->name
                . ' di adakamar.id. Lihat informasi, harga, fasilitas, '
                . 'dan lokasi penginapan.';
        }

        $metaDescription = preg_replace(
            '/\s+/u',
            ' ',
            $metaDescription
        );

        $metaDescription = Str::limit(
            $metaDescription,
            160,
            ''
        );

        // URL canonical.
        // Pastikan nama route sesuai dengan routes/web.php.
        $canonical = url()->current();

        // Gambar Open Graph.
        $ogImage = $category->thumbnail
            ? asset($category->thumbnail)
            : null;

        // Structured data kategori.
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $title,
            'description' => $metaDescription,
            'url' => $canonical,
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => url('/'),
            ],
        ];

        if ($ogImage) {
            $structuredData['primaryImageOfPage'] = [
                '@type' => 'ImageObject',
                'url' => $ogImage,
            ];
        }

        return view(
            'landingpage.content.accomodation.kamar',
            [
                'category' => $category,
                'accommodations' => $data['accommodations'],

                // SEO metadata.
                'title' => $title,
                'metaTitle' => $title,
                'metaDescription' => $metaDescription,
                'metaAuthor' => $siteName,
                'metaKeywords' => $category->name
                    . ', penginapan, akomodasi',
                'canonical' => $canonical,
                'robots' => 'index, follow',

                // Open Graph.
                'ogTitle' => $title,
                'ogDescription' => $metaDescription,
                'ogImage' => $ogImage,
                'ogImageAlt' => $category->name,
                'ogType' => 'website',

                // Structured data.
                'structuredData' => $structuredData,
            ]
        );
    }

    /**
     * Detail penginapan untuk landing page + SEO.
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
            'ratings',
        ]);

        $siteName = 'adakamar.id';

        // Judul SEO dari input admin.
        $customTitle = trim(
            (string) $accommodation->meta_title
        );

        $pageTitle = $customTitle !== ''
            ? $customTitle
            : $accommodation->title;

        $title = $pageTitle . ' | ' . $siteName;

        // Deskripsi SEO dari input admin.
        $metaDescription = trim(strip_tags(
            (string) $accommodation->meta_description
        ));

        if ($metaDescription === '') {
            $metaDescription = trim(strip_tags(
                (string) $accommodation->description
            ));
        }

        if ($metaDescription === '') {
            $metaDescription = 'Informasi penginapan '
                . $accommodation->title
                . ', harga, fasilitas, alamat, dan detail lainnya '
                . 'di adakamar.id.';
        }

        $metaDescription = preg_replace(
            '/\s+/u',
            ' ',
            $metaDescription
        );

        $metaDescription = Str::limit(
            $metaDescription,
            160,
            ''
        );

        // URL halaman publik.
        $canonical = url()->current();

        // Thumbnail utama untuk Open Graph.
        $ogImage = $accommodation->thumbnail
            ? asset($accommodation->thumbnail)
            : null;

        if (!$ogImage) {
            $firstImage = $accommodation->images->first();

            if ($firstImage && $firstImage->image) {
                $ogImage = asset($firstImage->image);
            }
        }

        // Structured data dasar untuk halaman penginapan.
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'LodgingBusiness',
            'name' => $accommodation->title,
            'description' => $metaDescription,
            'url' => $canonical,
        ];

        if ($ogImage) {
            $structuredData['image'] = [$ogImage];
        }

        if ($accommodation->address) {
            $structuredData['address'] = [
                '@type' => 'PostalAddress',
                'streetAddress' => $accommodation->address,
                'addressCountry' => 'ID',
            ];
        }

        // Harga aktual. Gunakan Offer hanya jika harga dan
        // satuan sewanya memang sesuai dengan penawaran publik.
        if (
            is_numeric($accommodation->price)
            && (float) $accommodation->price >= 0
        ) {
            $structuredData['priceRange'] = 'IDR '
                . number_format(
                    (float) $accommodation->price,
                    0,
                    ',',
                    '.'
                );
        }

        // Informasi kategori sebagai breadcrumb tambahan.
        if ($accommodation->category) {
            $structuredData['category'] =
                $accommodation->category->name;
        }

        return view(
            'landingpage.content.accomodation.detail_penginapan',
            compact(
                'accommodation',
                'title',
                'metaDescription',
                'canonical',
                'ogImage',
                'structuredData'
            )
        )->with([
                    'metaTitle' => $title,
                    'metaAuthor' => $siteName,
                    'metaKeywords' => implode(', ', array_filter([
                        $accommodation->title,
                        $accommodation->category?->name,
                        'penginapan',
                        'akomodasi',
                    ])),
                    'ogTitle' => $title,
                    'ogDescription' => $metaDescription,
                    'ogImageAlt' => $accommodation->title,
                    'ogType' => 'website',
                    'robots' => 'index, follow',
                ]);
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
            'ratings',
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

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penginapan berhasil ditambahkan.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with('success', 'Penginapan berhasil ditambahkan.');

        } catch (ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {
            report($e);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan penginapan.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan penginapan.');
        }
    }

    /**
     * Update penginapan.
     */
    public function update(Request $request, int $id)
    {
        try {
            $validated = $request->validate(
                $this->updateRules()
            );

            $accommodation = $this->accommodationService
                ->updateAccommodation($id, $validated);

            if (!$accommodation) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Penginapan tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('accommodations.index')
                    ->with('error', 'Penginapan tidak ditemukan.');
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penginapan berhasil diperbarui.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with('success', 'Penginapan berhasil diperbarui.');

        } catch (ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {
            report($e);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui penginapan.',
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui penginapan.');
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
                    ->with('error', 'Penginapan tidak ditemukan.');
            }

            return redirect()
                ->route('accommodations.index')
                ->with('success', 'Penginapan berhasil dihapus.');

        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus penginapan.');
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
            'maps_embed' => [
                'nullable',
                'string',
            ],
            'google_maps_url' => [
                'nullable',
                'url',
                'max:2048',
            ],
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
                'max:500',
            ],
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
                'max:1048576',
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
            'maps_embed' => [
                'nullable',
                'string',
            ],
            'google_maps_url' => [
                'nullable',
                'url',
                'max:2048',
            ],
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
                'max:500',
            ],
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
                'max:1048576',
            ],
        ];
    }
}
