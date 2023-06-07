<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Traits\SanitizeTags;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ArticleRequest;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;

class ArticleController extends Controller
{
    use SanitizeTags;

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.articles.index', ['articles' => Article::paginate(), 'title' => 'Articles']);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.articles.create', ['title' => 'Create Article']);
    }

    /**
     * @param ArticleRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $tags = $this->sanitizeTags($validated['tags']);

        unset(
            $validated['tags'],
            $validated['image_1'],
            $validated['image_2'],
        );

        $article = Article::create($validated);

        $article->syncTagsWithType($tags, 'article');

        if($request->has('image_1')) {
            $article
                ->addMediaFromRequest('image_1')
                ->toMediaCollection('article_one');
        }

        if($request->has('image_2')) {
            $article
                ->addMediaFromRequest('image_2')
                ->toMediaCollection('article_two');
        }

        return redirect()
            ->route('admin.articles.edit', ['article' => $article])
            ->with('success', 'Article created');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', ['article' => $article, 'title' => 'Edit Article']);
    }

    /**
     * @param ArticleRequest $request
     * @param Article $article
     * @return RedirectResponse
     */
    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->validated();

        try {
            if ($request->has('image_1')) {
                $article->clearMediaCollection('article_one');

                $article
                    ->addMediaFromRequest('image_1')
                    ->toMediaCollection('article_one');
            }

            if ($request->has('image_2')) {
                $article->clearMediaCollection('article_two');

                $article
                    ->addMediaFromRequest('image_2')
                    ->toMediaCollection('article_two');
            }
        } catch (FileDoesNotExist | FileIsTooBig $e) {
            info('ArticleController::update');
            info($e->getMessage());
        }

        $article->syncTagsWithType($this->sanitizeTags($validated['tags']), 'article');

        unset(
            $validated['tags'],
            $validated['image_1'],
            $validated['image_2'],
        );

        $article->update($validated);

        return redirect()
            ->route('admin.articles.edit', ['article' => $article])
            ->with('success', 'Article updated');
    }

    /**
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('success', 'Article deleted');
    }
}
