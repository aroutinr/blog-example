<nav class="nav d-flex justify-content-between">
	@foreach($categories as $category)
		<a class="p-2 text-muted" href="{{ route('blog.categories.show', $category->name) }}">{{ $category->name }}</a>
	@endforeach
</nav>
