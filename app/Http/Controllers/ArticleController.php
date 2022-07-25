<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\ValueObjects\Domains;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('domain', Domains::BLOG);

        if(request()->has('filter')) {
            $filters = explode(',', request()->filter);
            $articles = Article::where('visible', 1)->withAnyTags($filters, 'article')->orderBy('publish_date', 'desc')->orderBy('publish_date', 'DESC')->simplePaginate(6);
        } else {
            $filters = null;
            $articles = Article::where('visible', 1)->orderBy('publish_date', 'desc')->orderBy('publish_date', 'DESC')->simplePaginate(6);
        }

        return view('articles.index', ['articles' => $articles, 'filters' => $filters]);
    }

    public function show(Article $article, Request $request)
    {
        $request->session()->put('domain', Domains::BLOG);

        return view('articles.show', [
            'article' => $article,
            'tags' => $article->getMappedTags(),
        ]);
    }
}
