<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Articles;
use App\Http\Requests\ArticleRequest;
use App\Tags;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $articles = Articles::latest('published_at')->published()->get();

        return view('articles.main', compact('articles'));
    }

    /**
     * @param Articles $articles
     * @return \Illuminate\View\View
     */
    public function show(Articles $articles)
    {

        return view('articles.show', compact('articles'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tags = Tags::lists('name', 'id');

        return view('articles.create', compact('tags'));

    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ArticleRequest $request)
    {
//        $article = new Articles($request->all());
//
//        \Auth::user()->articles()->save($article);

        //Faster way to save an article

        $article = \Auth::user()->articles()->create($request->all());

        $tagIds = $request->input('tag_list');

        $article->tags()->attach($tagIds);

        \Session::flash('flash_message', 'Your article has been created successfully');

        return redirect('articles')->with([
            'flash_message' => 'Your article has been created successfully',
        ]);
    }

    /**
     * @param Articles $article
     * @return \Illuminate\View\View
     */
    public function edit(Articles $article)
    {

        $tags = Tags::lists('name', 'id');

        return view('articles.edit', compact('article', 'tags'));

    }

    /**
     * @param Articles $article
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Articles $article, ArticleRequest $request)
    {

        $article->update($request->all());

        return redirect('articles');

    }

}
