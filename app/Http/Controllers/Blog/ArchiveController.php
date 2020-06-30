<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;
use Carbon\Carbon;

class ArchiveController extends Controller
{
    public function show($post_year, $post_month)
    {
    	$archive_posts = Post::whereYear('publication_date', $post_year)
    		->whereMonth('publication_date', $post_month)
    		->with(['category', 'user'])
    		->orderByDesc('publication_date')
    		->simplePaginate(8);

    	$title = Carbon::parse($archive_posts->first()->publication_date)
    		->format('F Y');

    	return view('blog.archive-posts', compact('archive_posts', 'title'));
    }
}
