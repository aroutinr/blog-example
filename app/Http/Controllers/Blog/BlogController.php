<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
    	$last_post = Post::with(['category', 'user'])
    		->latest('publication_date')
    		->first();
        
        if (!$last_post) 
        {
            return view('no-posts')->with('title', 'No posts yet');
        }

    	$posts = Post::whereNotIn('id', [$last_post->id])
    		->with(['category', 'user'])
    		->orderByDesc('publication_date')
    		->simplePaginate(8);

        return view('blog.index', compact('last_post', 'posts'));
    }
}
