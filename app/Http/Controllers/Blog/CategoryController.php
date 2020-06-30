<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
    	$category_posts = Post::where('category_id', $category->id)
    		->with(['category', 'user'])
    		->orderByDesc('publication_date')
    		->simplePaginate(8);
    		
    	$title = $category->name;

    	return view('blog.category-posts', compact('category_posts', 'title'));
    }
}
