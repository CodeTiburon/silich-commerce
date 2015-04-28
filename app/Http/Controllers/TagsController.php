<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Tags;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TagsController extends Controller {

	public function show(Tags $tag)
    {
        $articles = $tag->article()->published()->get();

        return view('articles.main', compact('articles'));
    }

}
