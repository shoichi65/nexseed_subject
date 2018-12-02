@extends('layout')

@section('content')
<div class="bs-docs-section">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1 id="forms">Post feed</h1>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="well bs-component">
          <form class="form-horizontal" action="/feeds/" method="POST">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label for="textArea" class="col-lg-2 control-label">Post feed</label>
                <div class="col-lg-10">
                  <textarea class="form-control" rows="3" id="textArea" name="feed"></textarea>
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="submit" class="btn btn-primary">Post</button>
                  <a href="/feeds" class="btn btn-default">Cancel</a>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection