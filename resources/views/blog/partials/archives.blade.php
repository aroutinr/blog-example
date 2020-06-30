<div class="p-4">
	<h4 class="font-italic">Archives</h4>
	<ol class="list-unstyled mb-0">
		@foreach($posts_filter_by_month as $post)
			<li><a href="{{ route('blog.archives.show', [$post->post_year, $post->post_month]) }}">{{ $post->post_month_and_year }}</a></li>
		@endforeach
	</ol>
</div>