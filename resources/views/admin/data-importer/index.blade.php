@extends('layouts.dashboard')

@section('content')

<h5>Import data from API endpoint to posts table</h5>
<p onclick="$('#url').val('https://sq1-api-test.herokuapp.com/posts')">Exmaple: https://sq1-api-test.herokuapp.com/posts <small>(Click to use this URL)</small></p>
<form method="POST" action="{{ route('admin.data-importer.import') }}">
	@csrf
	<div class="row">
		<div class="col-12 col-md-6 my-1">
			<input name="url" id="url" type="text" class="form-control" placeholder="API Url" value="{{ old('url') }}">
		</div>
		<div class="col-12 col-md-6 my-1">
			<button class="btn btn-outline-success" title="Import Data"><span data-feather="upload"></span> Import Data</button>
		</div>
	</div>
</form>
@if($queued_jobs)
	<hr>
	<h5>Queued jobs</h5>
	<p>There are {{ $queued_jobs }} queued jobs. <a href="{{ route('admin.data-importer.run-queue-worker') }}">Run the queue worker now.</a></p>
@endif
<hr>
<h5>Notes:</h5>
<ul>
	<li>Please note that the importer may take a few seconds, depending on the amount of data.</li>
	<li>The importer can read up to two levels of array.</li>
	<li>The name of the API keys must match the columns in the database.</li>
	<li>Database columns:</li>
	<ul>
		@foreach($post_columns as $column)
			<li>{{ $column }}</li>
		@endforeach
	</ul>
	<li>In case of mismatch, the value will be ignored or the default value will be inserted.</li>
</ul>

@endsection
