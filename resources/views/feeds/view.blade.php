@extends('layout')
@section('content')

<div class="bs-docs-section">
	<div class="row">
		<div class="col-lg-12">
			<div class="page-header">
				<h1 id="tables">Feeds List</h1>
			</div>

			<div class="row">
				<div class="col-lg-4">
					<div class="bs-component">
						{{-- <h2>Feeds List</h2> --}}
							<p class="text-muted">
							<td>{{ $feed['feed'] }}</td>
							</p>
							<small>
							{{ $feed['created_at'] }}
							<cite class="mt-5">{{ $feed->user['name'] }}</cite>
							</small>
					</div>
					<br>
					<div class="mt-50">
						<a class="btn btn-success round-2" href="/feeds/{{ $feed['id'] }}/edit">Edit</a>
						<form action="/feeds/{{ $feed['id'] }}" method="POST" style="display: inline">
							{{ csrf_field() }}
							{{-- これを書くことで、メソッドを偽装する --}}
							<input type="hidden" name="_method" value="DELETE">
							<button class="btn btn-danger" type="submit">Delete</button>
						</form>
						<a class="btn btn-default" href="/feeds">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection