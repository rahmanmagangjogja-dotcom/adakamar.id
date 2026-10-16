<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(
        ArticleService $articleService
    ) {
        $this->articleService = $articleService;
    }

    /**
     * ============================================================
     * PUBLIC
     * ============================================================
     */

    /**
     * Detail artikel untuk halaman publik.
     *
     * Artikel dicari berdasarkan slug.
     * Hanya artikel Published yang dapat diakses.
     */
    public function publicDetail(string $slug)
    {
        $article = $this->articleService
            ->getArticleBySlug($slug);

        /*
        |--------------------------------------------------------------------------
        | Artikel tidak ditemukan
        |--------------------------------------------------------------------------
        */

        if (!$article) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Hanya artikel Published yang boleh tampil
        |--------------------------------------------------------------------------
        */

        if (
            $article->status !== 'Published' ||
            !$article->published_at
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Load relasi
        |--------------------------------------------------------------------------
        */

        $article->load([
            'category',
            'user',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Metadata SEO
        |--------------------------------------------------------------------------
        */

        $title = $article->meta_title
            ? $article->meta_title . ' | adakamar.id'
            : $article->title . ' | adakamar.id';

        $metaDescription = $article->meta_description
            ?: \Illuminate\Support\Str::limit(
                strip_tags($article->content),
                155
            );

        /*
        |--------------------------------------------------------------------------
        | Halaman detail artikel
        |--------------------------------------------------------------------------
        */

        return view(
            'landingpage.content.article.detail_artikel',
            compact(
                'article',
                'title',
                'metaDescription'
            )
        );
    }

    /**
     * Halaman semua artikel untuk publik.
     *
     * Dipanggil oleh route: article.semua
     * Menampilkan semua artikel Published dengan pagination.
     */
    public function publicIndex()
    {
        $articles = Article::with('category')
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        /*
        |--------------------------------------------------------------------------
        | Metadata SEO
        |--------------------------------------------------------------------------
        */

        $title = 'Semua Artikel | adakamar.id';

        $metaDescription = 'Kumpulan artikel, tips, dan informasi seputar penginapan di adakamar.id';

        /*
        |--------------------------------------------------------------------------
        | Halaman semua artikel
        |--------------------------------------------------------------------------
        */

        return view(
            'landingpage.content.article.semua_artikel',
            compact(
                'articles',
                'title',
                'metaDescription'
            )
        );
    }

    /**
     * Ambil 3 artikel terbaru untuk landing page.
     *
     * Bisa dipanggil dari HomeController atau langsung di route.
     */
    public function latestThree()
    {
        return Article::with('category')
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();
    }


    /**
     * ============================================================
     * ADMIN
     * ============================================================
     */

    /**
     * Daftar artikel.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $articles = $this->articleService
            ->getArticles($keyword, 10);

        $categories = ArticleCategory::orderBy('name')
            ->get();

        return view(
            'example.content.artikel.article',
            compact(
                'articles',
                'categories'
            )
        );
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'category_id' => [
                    'required',
                    'exists:article_categories,id',
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

                'excerpt' => [
                    'nullable',
                    'string',
                ],

                'content' => [
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

                'meta_keywords' => [
                    'nullable',
                    'string',
                ],

                'status' => [
                    'required',
                    'in:Draft,Published',
                ],

                'published_at' => [
                    'nullable',
                    'date',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | User login sebagai penulis
            |--------------------------------------------------------------------------
            */

            $validated['user_id'] = auth()->id();

            /*
            |--------------------------------------------------------------------------
            | Jika status Published tetapi published_at kosong,
            | otomatis menggunakan waktu sekarang.
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'Published' &&
                empty($validated['published_at'])
            ) {
                $validated['published_at'] = now();
            }

            /*
            |--------------------------------------------------------------------------
            | Jika status Draft, published_at dikosongkan.
            |--------------------------------------------------------------------------
            */

            if ($validated['status'] === 'Draft') {
                $validated['published_at'] = null;
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleService
                ->createArticle($validated);

            /*
            |--------------------------------------------------------------------------
            | Load relasi
            |--------------------------------------------------------------------------
            */

            $article->load([
                'category',
                'user',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Response JSON
            |--------------------------------------------------------------------------
            */

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Artikel berhasil ditambahkan.',
                    'data' => $article,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Redirect
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('articles.index')
                ->with(
                    'success',
                    'Artikel berhasil ditambahkan.'
                );

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

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Detail artikel.
     *
     * Digunakan oleh modal detail artikel di admin.
     */
    public function show(int $id)
    {
        try {

            $article = $this->articleService
                ->getArticle($id);

            if (!$article) {

                return response()->json([
                    'success' => false,
                    'message' => 'Artikel tidak ditemukan.',
                ], 404);
            }

            /*
            |--------------------------------------------------------------------------
            | Load relasi kategori dan user/penulis
            |--------------------------------------------------------------------------
            */

            $article->load([
                'category',
                'user',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Data artikel
            |--------------------------------------------------------------------------
            */

            $data = $article->toArray();

            /*
            |--------------------------------------------------------------------------
            | URL thumbnail
            |--------------------------------------------------------------------------
            */

            $data['thumbnail_url'] = $article->thumbnail
                ? asset($article->thumbnail)
                : null;

            /*
            |--------------------------------------------------------------------------
            | Informasi kategori
            |--------------------------------------------------------------------------
            */

            $data['category_name'] = $article->category
                ? $article->category->name
                : null;

            /*
            |--------------------------------------------------------------------------
            | Informasi penulis
            |--------------------------------------------------------------------------
            */

            $data['author_name'] = $article->user
                ? $article->user->name
                : null;

            /*
            |--------------------------------------------------------------------------
            | Format tanggal publish
            |--------------------------------------------------------------------------
            */

            $data['published_at_formatted'] =
                $article->published_at
                ? $article->published_at->format('d F Y H:i')
                : null;

            /*
            |--------------------------------------------------------------------------
            | Response
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Form edit artikel.
     *
     * Karena edit menggunakan modal,
     * data dikembalikan dalam bentuk JSON.
     */
    public function edit(int $id)
    {
        try {

            $article = $this->articleService
                ->getArticle($id);

            if (!$article) {

                return response()->json([
                    'success' => false,
                    'message' => 'Artikel tidak ditemukan.',
                ], 404);
            }

            /*
            |--------------------------------------------------------------------------
            | Load relasi
            |--------------------------------------------------------------------------
            */

            $article->load([
                'category',
                'user',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Tambahkan URL thumbnail
            |--------------------------------------------------------------------------
            */

            $data = $article->toArray();

            $data['thumbnail_url'] = $article->thumbnail
                ? asset($article->thumbnail)
                : null;

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update artikel.
     */
    public function update(
        Request $request,
        int $id
    ) {
        try {

            $validated = $request->validate([
                'category_id' => [
                    'required',
                    'exists:article_categories,id',
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

                'excerpt' => [
                    'nullable',
                    'string',
                ],

                'content' => [
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

                'meta_keywords' => [
                    'nullable',
                    'string',
                ],

                'status' => [
                    'required',
                    'in:Draft,Published',
                ],

                'published_at' => [
                    'nullable',
                    'date',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Atur published_at
            |--------------------------------------------------------------------------
            */

            if (
                $validated['status'] === 'Published' &&
                empty($validated['published_at'])
            ) {
                $validated['published_at'] = now();
            }

            if ($validated['status'] === 'Draft') {
                $validated['published_at'] = null;
            }

            /*
            |--------------------------------------------------------------------------
            | Update artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleService
                ->updateArticle(
                    $id,
                    $validated
                );

            if (!$article) {

                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Artikel tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('articles.index')
                    ->with(
                        'error',
                        'Artikel tidak ditemukan.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Load relasi terbaru
            |--------------------------------------------------------------------------
            */

            $article->load([
                'category',
                'user',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Response AJAX / JSON
            |--------------------------------------------------------------------------
            */

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Artikel berhasil diperbarui.',
                    'data' => $article,
                ]);
            }

            return redirect()
                ->route('articles.index')
                ->with(
                    'success',
                    'Artikel berhasil diperbarui.'
                );

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

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Hapus artikel.
     */
    public function destroy(
        Request $request,
        int $id
    ) {
        try {

            $deleted = $this->articleService
                ->deleteArticle($id);

            if (!$deleted) {

                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Artikel tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('articles.index')
                    ->with(
                        'error',
                        'Artikel tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Artikel berhasil dihapus.',
                ]);
            }

            return redirect()
                ->route('articles.index')
                ->with(
                    'success',
                    'Artikel berhasil dihapus.'
                );

        } catch (\Throwable $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }
}