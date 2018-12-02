@extends('layout')

@section('content')

  <!-- Tables
  ================================================== -->
  <div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
        <div class="page-header">
            <h1 id="tables">User List</h1>
        </div>
        <h3>Feeds count : {{$feeds_count}}</h3>
        <div class="bs-component">
            <table class="table table-striped table-hover ">
            <thead>
                <tr class="info">
                <th>Feed</th>
                <th>Created date</th>
                <th>Likes count</th>
                <th>Comments count</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                {{-- <form action="" method="POST" id="feed-delete-form"> --}}
                @foreach($feeds as $feed)
                    <tr class='hogehoge'>
                        <td>{{ $feed->feed }}</td>
                        <td>{{ $feed->created_at }}</td>
                        <td>{{ $feed->likes_count }}</td>
                        <td>{{ $feed->comments_count }}</td>
                        <td>
                            <span id="feed-{{ $feed->id }}">
                                @if (!isset($feed->deleted_at))
                                    <a href="/admin/feeds/{{ $feed->id }}" 
                                    class="btn btn-sm btn-success feed-delete"
                                    data-btn="valid"
                                    data-feed_id="{{ $feed->id }}">Valid</a>
                                @else
                                    <a href="/admin/feeds/{{ $feed->id }}" 
                                    class="btn btn-sm btn-danger feed-delete"
                                    data-btn="invalid"
                                    data-feed_id="{{ $feed->id }}">Invalid</a>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div><!-- /example -->
        <a class="btn btn-default" href="/admin">Back</a>
        </div>
    </div>
</div>
    
@endsection
