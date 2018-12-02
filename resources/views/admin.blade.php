@extends('layout')

@section('content')
<div class="bs-docs-section">

    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1 id="tables">User List</h1>
            </div>

            <div class="bs-component">
                <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered date</th>
                    <th>Amout of Feeds</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="info">
                        @foreach($users as $user)
                            <td>{{ $user->id }}}</td>
                            <td>{{ $user->name }}}</td>
                            <td>{{ $user->created_at }}}</td>
                            <td>カラムの内容</td>
                        @endforeach
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
