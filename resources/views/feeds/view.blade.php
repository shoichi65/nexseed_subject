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
						@if (Auth::check() && Auth::user()->id == $feed['user_id'])
							<a class="btn btn-success round-2" href="/feeds/{{ $feed['id'] }}/edit">Edit</a>
							<form action="/feeds/{{ $feed['id'] }}" method="POST" style="display: inline">
								{{ csrf_field() }}
								{{-- これを書くことで、メソッドを偽装する --}}
								<input type="hidden" name="_method" value="DELETE">
								<button class="btn btn-danger" type="submit">Delete</button>
							</form>
						@endif
						@auth
							<form action="/likes" method="POST" style="display: inline" id="like_form">
								{{ csrf_field() }}
								<input type="hidden" name="feed_id" value="{{ $feed['id'] }}">
								<span id="like_button">
									@if ($like_count == 0)
										<input type="hidden" name="btn" value="like">
										<button class="btn btn-primary"><i class="fa fa-star solid"></i>Good!(<span id="Likes_Count">{{$feed['likes_count']}}</span>)</button>
									@else
										<input type="hidden" name="btn" value="unlike">
										<button class="btn btn-default"><i class="fa fa-star star"></i>Cancel...(<span id="Likes_Count">{{$feed['likes_count']}}</span>)</button>
									@endif
								</span>
							</form>
						@endif
						<a class="btn btn-default" href="/feeds">Back</a>
					</div>
				</div>
			</div>
			<hr>

			@auth
				<div class="row">
					<div class="col-lg-6">
						<div class="well bs-component">
						<form class="form-horizontal" action="/comments" method="POST" id="comment_form">
							{{ csrf_field() }}
							<input type="hidden" name="feed_id" value="{{ $feed['id'] }}">
							<fieldset>
							<div class="form-group">
								<label for="textArea" class="col-lg-2 control-label">Comment</label>
								<div class="col-lg-10">
								<textarea class="form-control" rows="3" id="textArea" name="comment"></textarea>
								<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
								<button type="submit" class="btn btn-primary">Comment</button>
								{{-- <button type="reset" class="btn btn-default">キャンセル</button> --}}
								{{-- <a href="/feeds" class="btn btn-default">Cancel</a> --}}
								</div>
							</div>
							</fieldset>
						</form>
						</div>
					</div>
				</div>
				<hr>
			@endauth

			<div class="col-lg-4">
				<div class="bs-component" id="comment_list">
					@foreach($comments as $comment)
						<blockquote id="comment-{{ $comment['id'] }}" class="delete-link">
							{{-- <h2>Feeds List</h2> --}}
							<p class="text-muted">
								<td>{{ $comment['comment'] }}</td>
							</p>
							<small>
							{{ $comment['created_at'] }}
							<cite class="mt-5">{{ $comment->user['name'] }}</cite>
							</small>
							@if (Auth::check() && Auth::user()->id == $comment['user_id'])
								<a href="/comments/{{ $comment['id'] }}" 
									data-feed_id="{{ $feed['id'] }}" 
									data-comment_id="{{ $comment['id'] }}"
								>Delete</a>
							@endauth
						</blockquote>
					@endforeach
				</div>
			</div>

		</div>
	</div>
</div>
@endsection