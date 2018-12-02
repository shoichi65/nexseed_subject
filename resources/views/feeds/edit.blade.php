@extends('layout')

@section('content')
<div class="bs-docs-section">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-header">
        <h1 id="forms">Edit feed</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="well bs-component">
        <form class="form-horizontal" action="/feeds/{{ $feed['id'] }}" method="POST">
          {{ csrf_field() }}
          <fieldset>
            <div class="form-group">
              <label for="textArea" class="col-lg-2 control-label">Edit feed</label>
              <div class="col-lg-10">
                {{-- これを書くことで、メソッドを偽装する --}}
                <input type="hidden" name="_method" value="PATCH">
                <textarea class="form-control" rows="3" id="textArea" name="feed">{{ $feed['feed'] }}</textarea>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/feeds/{{ $feed['id'] }}" class="btn btn-default">Cancel</a>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection