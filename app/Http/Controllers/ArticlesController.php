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
        $latest = Articles::latest()->first();
        return view('articles.main', compact('articles', 'latest'));
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

        $this->createArticle($request);

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

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');

    }

    /**
     * @param Articles $article
     * @param array $tags
     */
    private function syncTags(Articles $article, array $tags)
    {

        $article->tags()->sync($tags);

    }

    /**
     * Create a new article
     * @param ArticleRequest $request
     */
    private function createArticle(ArticleRequest $request)
    {

        $article = \Auth::user()->articles()->create($request->all());

        $this->syncTags($article, $request->input('tag_list'));

    }


}
