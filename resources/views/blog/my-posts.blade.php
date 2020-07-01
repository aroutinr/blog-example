@extends('layouts.blog')

@section('content')

<div class="row">
	<div class="col-md-8 blog-main">
		<p>Showing {{ $posts_count }} Posts. <a href="{{ route('blog.my-posts', [($sort == 'desc') ? 'asc' : 'desc']) }}">Sort publication date: {{ ($sort == 'desc') ? 'Ascendant' : 'Descendant' }}</a></p>
		@include('blog.partials.posts-list', ['posts' => $posts])
	</div>
	<aside class="col-md-4 blog-sidebar">
		<div class="p-4">
			<h4 class="font-italic">Create new Post</h4>
			<form method="POST" action="{{ route('blog.posts.store') }}">
				@csrf
				<div class="row">
					<div class="col-12 my-1">
						<input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}">
					</div>
					<div class="col-12 my-1">
						<select name="category_id" class="form-control">
							<option value="">Category</option>
							@foreach($post_categories as $key => $value)
								<option value="{{ $key }}" @if(old('category_id') == $key) selected="select" @endif>{{ $value }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-12 my-1">
						<textarea name="description" type="text" class="form-control" placeholder="Description" rows="4" value="{{ old('description') }}"></textarea>
					</div>
					<div class="col-12 my-1">
						<button class="btn btn-sm btn-outline-secondary py-2 btn-block" title="Save Post"><span data-feather="save"></span> Save Post</button>
					</div>
				</div>
			</form>
	        @if (session('status'))
	            <div class="alert alert-primary" role="alert">
	                {{ session('status') }}
	            </div>
	        @endif
	        @if ($errors->any())
	            <div class="alert alert-danger" role="alert">
	                @foreach ($errors->all() as $error)
	                    <p class="mb-0">{{ $error }}</p>
	                @endforeach
	            </div>
	        @endif
		</div>
		@include('blog.partials.archives')
	</aside>
</div>

@endsection
