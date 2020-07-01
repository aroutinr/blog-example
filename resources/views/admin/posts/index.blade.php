@extends('layouts.dashboard')

@section('content')

<h5>New Post</h5>
<form method="POST" action="{{ route('admin.posts.store') }}">
	@csrf
	<div class="row">
		<div class="col-xs-12 col-md-4 my-1">
			<input name="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}">
		</div>
		<div class="col-xs-12 col-md-4 my-1">
			<select name="category_id" class="form-control">
				<option value="">Category</option>
				@foreach($categories as $key => $value)
					<option value="{{ $key }}" @if(old('category_id') == $key) selected="select" @endif>{{ $value }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-12 col-md-4 my-1">
			<select name="user_id" class="form-control">
				<option value="">Author</option>
				@foreach($users as $key => $value)
					<option value="{{ $key }}" @if(old('user_id') == $key) selected="select" @endif>{{ $value }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-xs-12 col-md-8 my-1">
			<textarea name="description" type="text" class="form-control" placeholder="Description" rows="1" value="{{ old('description') }}"></textarea>
		</div>
		<div class="col-xs-12 col-md-4 my-1">
			<button class="btn btn-outline-success" title="Save Post"><span data-feather="save"></span> Save Post</button>
		</div>
	</div>
</form>
<hr>
<h5>All Posts ({{ $posts_count }})</h5>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Category</th>
				<th>Author</th>
				<th class="text-center" width="82x">Actions</th>
			</tr>
		</thead>
		<tbody>
			@forelse($posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->category->name }}</td>
					<td>{{ $post->user->name }}</td>
					<td>
						<button 
							data-toggle="modal" 
							data-target="#edit-post" 
							data-id="{{ $post->id }}" 
							data-title="{{ $post->title }}" 
							data-description="{{ $post->description }}" 
							data-category_id="{{ $post->category_id }}" 
							data-user_id="{{ $post->user_id }}" 
							class="btn btn-sm btn-outline-warning" title="Edit">
							<span data-feather="edit"></span>
						</button>
						<button class="btn btn-sm btn-outline-danger" title="Delete" onclick="document.getElementById('delete-form-{{ $post->id }}').submit();">
							<span data-feather="trash-2"></span>
						</button>
						<form id="delete-form-{{ $post->id }}" method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
							@method('DELETE')
							@csrf
						</form>
					</td>
				</tr>
			@empty
				<p>There are no posts yet!</p>
			@endforelse
		</tbody>
	</table>
	{{ $posts->links() }}
</div>

<div class="modal  fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="edit-post-label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="update-form" method="POST" action="#">
				@method('PUT')
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Edit Post</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="post-title">Title</span>
						</div>
						<input name="title" id="title" type="text" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="post-title">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="post-description">Description</span>
						</div>
						<textarea name="description" id="description" type="text" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="post-description"></textarea>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="category_id">Category</label>
						</div>
						<select name="category_id" id="category_id" class="custom-select" id="category_id">
							<option selected>Choose...</option>
							@foreach($categories as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="user_id">Author</label>
						</div>
						<select name="user_id" id="user_id" class="custom-select" id="user_id">
							<option selected>Choose...</option>
							@foreach($users as $key => $value)
								<option value="{{ $key }}">{{ $value }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" data-dismiss="modal"><span data-feather="x"></span> Close</button>
					<button class="btn btn-success"><span data-feather="save"></span> Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script>
    $('#edit-post').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var title = button.data('title')
        var description = button.data('description')
        var category_id = button.data('category_id')
        var user_id = button.data('user_id')
        modal.find('.modal-content #update-form').attr('action', '{{ url('admin/posts') }}/' + id)
		modal.find('.modal-title').text('Edit Post ' + name)
        modal.find('.modal-body #title').val(title)
        modal.find('.modal-body #description').val(description)
        modal.find('.modal-body #category_id').val(category_id)
        modal.find('.modal-body #user_id').val(user_id)
    })
</script>

@endsection
