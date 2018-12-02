<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @if (app('env') == 'local')
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/main.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    @endif
    @if(app('env')=='production')
        <link rel="stylesheet" type="text/css" media="screen" href="{{ secure_asset('/css/main.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('/css/bootstrap.css') }}">
    @endif

</head>
<body>
    @include('navbar')

    <div class="container">
        <div class="page-header" id="banner">
            <div style="margin-top:100px"></div>
            {{-- 処理完了メッセージの表示 --}}
            @if (Session::has('flash_message'))
                <div class="alert alert-success">{{ Session::get('flash_message') }}
                </div>
            @endif

            {{-- エラーメッセージの表示 --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="list-style: none;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            @endif
            @yield('content')
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @if (app('env') == 'local')
        <script src="{{ asset('/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
    @endif
    @if(app('env')=='production')
        <script src="{{ secure_asset('/js/bootstrap.js') }}"></script>
        <script src="{{ secure_asset('/js/main.js') }}"></script>
    @endif
</body>
</html>