<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Articles;
use App\Http\Requests\ArticleRequest;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller {

	public function index()
    {

        $articles = Articles::latest('published_at')->published()->get();

        return view('articles.main', compact('articles'));
    }

    public function show($id)
    {
        $articles = Articles::findOrFail($id);

        return view('articles.show', compact('articles'));

    }

    public function create()
    {

        return view('articles.create');

    }

    public function store(ArticleRequest $request)
    {

        Articles::create($request->all());

        return redirect('articles');
    }

    public function edit($id)
    {

        $article = Articles::findOrFail($id);

        return view('articles.edit', compact('article'));

    }

    public function update($id, ArticleRequest $request)
    {

        $article = Articles::findOrFail($id);

        $article->update($request->all());

        return redirect('articles');

    }

}
