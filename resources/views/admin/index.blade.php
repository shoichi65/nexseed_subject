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

        <div class="bs-component">
            <table class="table table-striped table-hover ">
            <thead>
                <tr class="info">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered date</th>
                <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td><a href="/admin/view/{{ $user->id }}" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <!-- page control -->
            {!! $users->render() !!}
        </div><!-- /example -->
        </div>
    </div>
</div>
    
@endsection
