@foreach($posts as $post)
	<div class="blog-post">
		<h2 class="blog-post-title">{{ $post->title ?? 'Untitled' }}</h2>
		<p class="blog-post-meta">Category: {{ $post->category->name ?? 'Uncategorized' }} | {{ $post->publication_date ?? 'Undefined' }} by {{ $post->user->name ?? 'Undefined' }}</p>
		{!! $post->description ?? 'Empty' !!}
	</div>
	@if (!$loop->last)
        <hr>
    @endif
@endforeach
{{ $posts->links('blog.partials.blog-paginator') }}
