@extends('layouts.dashboard')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Categories</h5>
				<a href="{{ route('admin.categories.index') }}" class="btn btn-primary"><span data-feather="list"></span> View Categories</a>
			</div>
		</div>
		</div>
		<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Posts</h5>
				<a href="{{ route('admin.posts.index') }}" class="btn btn-primary"><span data-feather="file"></span> View Posts</a>
			</div>
		</div>
		</div>
		<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Users</h5>
				<a href="{{ route('admin.users.index') }}" class="btn btn-primary"><span data-feather="users"></span> View Users</a>
			</div>
		</div>
	</div>
</div>

@endsection
