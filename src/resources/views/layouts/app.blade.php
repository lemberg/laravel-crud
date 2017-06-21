<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
</head>
<body class="sidebar-mini skin-black fixed">
<div class="wrapper">
    <header class="main-header">
        <a href="/" class="logo">
            <span class="logo-mini">SC</span>
            <span class="logo-lg">{{ config('app.name') }}</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        @if (Auth::guest())
                            <a href="{{ url('/login') }}">Login</a>
                        @else
                            <a href="{{ url('/logout') }}">
                                <span class="hidden-xs">{{ Auth::user()->first_name }} (logout)</span>
                            </a>
                        @endif

                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
    </aside>
    <div class="content-wrapper">
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="text-right hidden-xs">
            <strong>Copyright &copy; {{ date("Y") }}.</strong> All rights reserved.
        </div>
    </footer>
</div>
@stack('scripts')
</body>
</html>
