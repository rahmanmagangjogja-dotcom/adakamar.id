<?php

namespace App\Services;

use App\Models\AccommodationCategory;
use App\Models\Facility;
use App\Repositories\AccommodationRepository;
use App\Repositories\ArticleRepository;

class DashboardService
{
    protected AccommodationRepository $accommodationRepository;

    protected ArticleRepository $articleRepository;

    public function __construct(
        AccommodationRepository $accommodationRepository,
        ArticleRepository $articleRepository
    ) {
        $this->accommodationRepository = $accommodationRepository;
        $this->articleRepository = $articleRepository;
    }

    public function getDashboardData(): array
    {
        $accommodations = $this->accommodationRepository
            ->getDashboardAccommodations(6);

        $articles = $this->articleRepository
            ->getDashboardArticles(6);

        return [
            'accommodations' => $accommodations
                ->map(function ($accommodation) {

                    $image = $accommodation->images->first();

                    return [
                        'id' => $accommodation->id,
                        'title' => $accommodation->title,

                        'category_name' => $accommodation->category
                            ? $accommodation->category->name
                            : 'Tanpa Kategori',

                        'thumbnail' => $image
                            ? $image->image
                            : $accommodation->thumbnail,

                        'price' => $accommodation->price,
                        'status' => $accommodation->status,
                    ];
                })
                ->values()
                ->toArray(),

            'articles' => $articles
                ->map(function ($article) {

                    return [
                        'id' => $article->id,
                        'title' => $article->title,

                        'category_name' => $article->category
                            ? $article->category->name
                            : 'Tanpa Kategori',

                        'thumbnail' => $article->thumbnail,

                        'status' => $article->status,

                        'published_at' => $article->published_at
                            ? $article->published_at->format('Y-m-d H:i:s')
                            : null,
                    ];
                })
                ->values()
                ->toArray(),

            'totalAccommodations' => $this->accommodationRepository
                ->getTotal(),

            'publishedAccommodations' => $this->accommodationRepository
                ->getPublishedTotal(),

            'totalArticles' => $this->articleRepository
                ->getTotal(),

            'publishedArticles' => $this->articleRepository
                ->getPublishedTotal(),

            'draftArticles' => $this->articleRepository
                ->getDraftTotal(),

            'totalCategories' => AccommodationCategory::count(),

            'totalFacilities' => Facility::count(),
        ];
    }
}