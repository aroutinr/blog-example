<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($sort = 'desc')
    {
    	$posts = Post::where('user_id', auth()->user()->id)
    		->with(['category', 'user'])
    		->orderBy('publication_date', $sort)
    		->simplePaginate(8);

    	$posts_count = $posts->count();

    	$post_categories = Category::all()
    		->sortBy('name')
    		->pluck('name', 'id');

    	return view('blog.my-posts', compact('sort', 'posts', 'posts_count','post_categories'))->with('title', 'My Posts');
    }

    public function store(PostRequest $request)
    {
    	$post = auth()->user()->posts()->create($request->all());

        return back()->with('status', 'Post Created.');
    }
}
