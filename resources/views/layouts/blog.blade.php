<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/blog.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<header class="blog-header py-3">
			<div class="row flex-nowrap justify-content-between align-items-center">
				<div class="col-8">
					<a class="blog-header-logo text-dark" href="{{ route('blog.index') }}">{{ config('app.name', 'Laravel') }}</a>
				</div>
				<div class="col-4 d-flex justify-content-end align-items-center">
                    @guest
						<a class="btn btn-sm btn-outline-secondary mx-1" href="{{ route('login') }}">Login</a>
						<a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Register</a>
                    @else
                    	@if(auth()->user()->hasRole('Admin'))
							<a class="btn btn-sm btn-outline-secondary mx-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
						@endif
						@if(auth()->user()->hasRole('Author') || auth()->user()->hasRole('Admin'))
							<a class="btn btn-sm btn-outline-secondary mx-1" href="{{ route('blog.my-posts') }}">My posts</a>
						@endif
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
				</div>
			</div>
		</header>
		<div class="nav-scroller py-1 mb-2">
			@include('blog.partials.categories')
		</div>
		@includeWhen(request()->is('/'), 'blog.partials.last-post')
		@includeUnless(request()->is('/'), 'blog.partials.section-title')
	</div>
	<main role="main" class="container">
		@yield('content')
	</main>
	<footer class="blog-footer">
		<p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
	</footer>
</body>
</html>
