@extends('layouts.blog')

@section('content')

<div class="row">
	<div class="col-md-8 blog-main">
		@include('blog.partials.posts-list', ['posts' => $category_posts])
	</div>
	<aside class="col-md-4 blog-sidebar">
		@include('blog.partials.archives')
	</aside>
</div>

@endsection
