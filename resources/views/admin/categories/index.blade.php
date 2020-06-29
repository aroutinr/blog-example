@extends('layouts.dashboard')

@section('content')

<h5>New Category</h5>
<form method="POST" action="{{ route('admin.categories.store') }}">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6 my-1">
			<input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}">
		</div>
		<div class="col-12 col-md-6 my-1">
			<button class="btn btn-outline-success" title="Save Category"><span data-feather="save"></span> Save Category</button>
		</div>
	</div>
</form>
<hr>
<h5>All Categories ({{ $categories_count }})</h5>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th class="text-center" width="82x">Actions</th>
			</tr>
		</thead>
		<tbody>
			@forelse($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>
						<button class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#edit-category" data-id="{{ $category->id }}" data-name="{{ $category->name }}" title="Edit">
							<span data-feather="edit"></span>
						</button>
						<button class="btn btn-sm btn-outline-danger" title="Delete" onclick="document.getElementById('delete-form-{{ $category->id }}').submit();">
							<span data-feather="trash-2"></span>
						</button>
						<form id="delete-form-{{ $category->id }}" method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
							@method('DELETE')
							@csrf
						</form>
					</td>
				</tr>
			@empty
				<p>There are no categories yet!</p>
			@endforelse
		</tbody>
	</table>
	{{ $categories->links() }}
</div>

<div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="edit-category-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update-form" method="POST" action="#">
				@method('PUT')
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Edit Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="category-name">Name</span>
						</div>
						<input name="name" id="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="category-name">
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
    $('#edit-category').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        modal.find('.modal-content #update-form').attr('action', '{{ url('admin/categories') }}/' + id)
		modal.find('.modal-title').text('Edit Category ' + name)
        modal.find('.modal-body #name').val(name)
    })
</script>

@endsection
