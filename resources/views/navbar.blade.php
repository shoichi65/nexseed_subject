
  <!-- Navbar
  ================================================== -->

<div class="bs-component">
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/feeds">NexSeed Subject</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">高坂 穂乃果</a></li>
                <li><a href="#">南 ことり</a></li>
                <li><a href="#">園田 海未</a></li>
                <li class="divider"></li>
                <li><a href="#">小泉 花陽</a></li>
                <li><a href="#">星空 凛</a></li>
                <li><a href="#">西木野 真姫</a></li>
                <li class="divider"></li>
                <li><a href="#">矢澤 にこ</a></li>
                <li><a href="#">絢瀬 絵里</a></li>
                <li><a href="#">東條 希</a></li>
            </ul>
            </li>
        </ul> -->
        <!-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">検索</button>
        </form> -->
        <ul class="nav navbar-nav navbar-right">
            @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Profile</a></li>
                    <li><a href="/feeds">Feed</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                </li>
            @endguest
        </ul>
        </div>
    </div>
    </nav>
</div><!-- /example -->
