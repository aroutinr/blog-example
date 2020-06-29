@extends('layouts.dashboard')

@section('content')

<h5>New User</h5>
<form method="POST" action="{{ route('admin.users.store') }}">
	@csrf
	<div class="row">
		<div class="col-xs-12 col-md-3 col-sm-6 my-1">
			<input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}">
		</div>
		<div class="col-xs-12 col-md-3 col-sm-6 my-1">
			<input name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email') }}">
		</div>
		<div class="col-xs-12 col-md-3 col-sm-6 my-1">
			<select name="role" class="form-control">
				<option value="">Role</option>
				<option value="Admin" @if(old('role') == 'Admin') selected="selected" @endif>Admin</option>
				<option value="Author" @if(old('role') == 'Author') selected="selected" @endif>Author</option>
			</select>
		</div>
		<div class="col-xs-12 col-md-3 col-sm-6 my-1">
			<input type="hidden" name="password" value="password">
			<button class="btn btn-outline-success" title="Save User"><span data-feather="save"></span> Save User</button>
		</div>
	</div>
</form>
<hr>
<h5>All Users ({{ $users_count }})</h5>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th class="text-center" width="82x">Actions</th>
			</tr>
		</thead>
		<tbody>
			@forelse($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->role }}</td>
					<td>
						<button 
							data-toggle="modal" 
							data-target="#edit-user" 
							data-id="{{ $user->id }}" 
							data-name="{{ $user->name }}" 
							data-email="{{ $user->email }}" 
							data-role="{{ $user->role }}" 
							class="btn btn-sm btn-outline-warning" title="Edit">
							<span data-feather="edit"></span>
						</button>
						<button class="btn btn-sm btn-outline-danger" title="Delete" onclick="document.getElementById('delete-form-{{ $user->id }}').submit();">
							<span data-feather="trash-2"></span>
						</button>
						<form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
							@method('DELETE')
							@csrf
						</form>
					</td>
				</tr>
			@empty
				<p>There are no users yet!</p>
			@endforelse
		</tbody>
	</table>
	{{ $users->links() }}
</div>

<div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="edit-user-label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="update-form" method="POST" action="#">
				@method('PUT')
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Edit User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="user-name">Name</span>
						</div>
						<input name="name" id="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="user-name">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="user-email">Email</span>
						</div>
						<input name="email" id="email" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="user-email">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text" for="role">Role</label>
						</div>
						<select name="role" id="role" class="custom-select" id="role">
							<option selected>Choose...</option>
							<option value="Admin">Admin</option>
							<option value="Author">Author</option>
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
    $('#edit-user').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var email = button.data('email')
        var role = button.data('role')
        modal.find('.modal-content #update-form').attr('action', '{{ url('admin/users') }}/' + id)
		modal.find('.modal-title').text('Edit User ' + name)
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #role').val(role)
    })
</script>

@endsection
