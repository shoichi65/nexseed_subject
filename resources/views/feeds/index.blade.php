@extends('layout')
@section('content')

  <!-- Tables
  ================================================== -->
  <div class="bs-docs-section">

<div class="row">
  <div class="col-lg-12">
    <div class="page-header">
      <h1 id="tables">Feeds List</h1>
      @auth  
        <a class="btn btn-primary" href="/feeds/create">Post</a>
      @endauth
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="bs-component">
          {{-- <h2>Feeds List</h2> --}}
            @foreach($feeds as $feed)
              <p class="text-muted">
                <td>{{ $feed['feed'] }}</td>
              </p>
              <small>
                <a href="/feeds/{{ $feed['id'] }}">{{ $feed['created_at'] }}</a>
                <cite>{{ $feed->user['name'] }}</cite>
              </small>
              <hr>
            @endforeach
        </div>
    </div>
  </div>
</div>
</div>
@endsection