<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
	<div class="col-md-6 px-0">
		<h1 class="font-italic">{{ $last_post->title }}</h1>
		<p class="lead my-3">{{ $last_post->description }}</p>
		<p class="lead mb-0">{{ $last_post->publication_date ?? 'Undefined' }} by {{ $last_post->user->name ?? 'Admin' }}</p>
	</div>
</div>