<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use App\Services\AccommodationCategoryService;
use App\Services\GalleryService;
use App\Services\ArticleService;
use App\Services\SettingService;

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
     * Menampilkan landing page.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Banner Hero
        |--------------------------------------------------------------------------
        */

        $banner = $this->bannerService
            ->getHero();

        /*
        |--------------------------------------------------------------------------
        | Kategori Penginapan
        |--------------------------------------------------------------------------
        */

        $categories = $this->categoryService
            ->getPaginated();

        /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */

        $galleries = $this->galleryService
            ->getActiveGalleries();

        /*
        |--------------------------------------------------------------------------
        | Artikel
        |--------------------------------------------------------------------------
        |
        | Mengambil artikel yang sudah Published.
        | Maksimal 3 artikel terbaru untuk landing page.
        |
        */

        $articles = $this->articleService
            ->getPublishedArticles(3);  // 👈 UBAH DARI 6 KE 3

        /*
        |--------------------------------------------------------------------------
        | Settings Website
        |--------------------------------------------------------------------------
        |
        | Digunakan untuk:
        | - Nama website
        | - Tagline
        | - Logo
        | - Email
        | - Nomor telepon
        | - WhatsApp
        | - Sosial media
        | - Copyright
        |
        */

        $settings = $this->settingService
            ->getAll();

        $setting = $settings->first();

        /*
        |--------------------------------------------------------------------------
        | Landing Page
        |--------------------------------------------------------------------------
        */

        return view(
            'landingpage.index',
            compact(
                'banner',
                'categories',
                'galleries',
                'articles',
                'setting'
            )
        );
    }
}