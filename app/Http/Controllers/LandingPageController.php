<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\AccommodationCategoryService;
use App\Services\GalleryService;
use App\Services\ArticleService;
use App\Services\SettingService;
use App\Models\Accommodation;

class LandingPageController extends Controller
{
    protected BannerService $bannerService;
    protected AccommodationCategoryService $categoryService;
    protected GalleryService $galleryService;
    protected ArticleService $articleService;
    protected SettingService $settingService;

    public function __construct(
        BannerService $bannerService,
        AccommodationCategoryService $categoryService,
        GalleryService $galleryService,
        ArticleService $articleService,
        SettingService $settingService
    ) {
        $this->bannerService = $bannerService;
        $this->categoryService = $categoryService;
        $this->galleryService = $galleryService;
        $this->articleService = $articleService;
        $this->settingService = $settingService;
    }

    /**
     * Menampilkan landing page sekaligus metadata SEO.
     */
    public function index()
    {
        // Banner Hero
        $banner = $this->bannerService->getHero();

        $accommodations = Accommodation::with(['category', 'ratings'])
        ->where('status', 'Available')
        ->latest()
        ->get();

        // Kategori Penginapan
        $categories = $this->categoryService->getPaginated();

        // Gallery
        $galleries = $this->galleryService->getActiveGalleries();

        // Artikel terbaru yang sudah published
        $articles = $this->articleService->getPublishedArticles(3);

        // Pengaturan website
        $settings = $this->settingService->getAll();
        $setting = $settings->first();

        // SEO halaman utama
        $metaTitle = $setting?->meta_title
            ?: 'adakamar.id - Informasi Penginapan';

        $metaDescription = $setting?->meta_description
            ?: 'Temukan penginapan, hotel, homestay, dan informasi wisata di adakamar.id.';

        $metaKeywords = $setting?->meta_keywords
            ?: 'penginapan, hotel, homestay, sewa kamar';

        $metaAuthor = $setting?->site_name
            ?: 'adakamar.id';

        // URL utama website sebagai canonical
        $canonical = url('/');

        // Metadata untuk media sosial
        $ogTitle = $metaTitle;
        $ogDescription = $metaDescription;
        $ogType = 'website';

        // Gunakan logo sebagai gambar default Open Graph
        $ogImage = !empty($setting?->logo)
            ? asset($setting->logo)
            : null;

        $ogImageAlt = $setting?->site_name
            ?: 'adakamar.id - Informasi Penginapan';

        return view('landingpage.index', compact(
            'banner',
            'categories',
            'accommodations',
            'galleries',
            'articles',
            'setting',
            'metaTitle',
            'metaDescription',
            'metaKeywords',
            'metaAuthor',
            'canonical',
            'ogTitle',
            'ogDescription',
            'ogType',
            'ogImage',
            'ogImageAlt'
        ));
    }
}
