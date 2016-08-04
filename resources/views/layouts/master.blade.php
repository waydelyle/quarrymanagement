<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Wansley QMS - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
</head>
<body>

@yield('modals')
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Wansley Quarries</a>
        </div>
        @if( ! Auth::check())
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/stats"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Stats<span class="sr-only">(current)</span></a></li>
                    <li><a href="/history"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> History</a></li>
                    <li><a href="/diesel"><span class="glyphicon glyphicon-oil" aria-hidden="true"></span> Diesel</a></li>
                    <li><a href="/oil"><span class="glyphicon glyphicon-tint" aria-hidden="true"></span> Oil</a></li>
                    <li><a href="/vehicles"><span class="glyphicon glyphicon-scale" aria-hidden="true"></span> Vehicles</a></li>
                </ul>
                {{--<form class="navbar-form navbar-right" role="form" action="/auth/login" method="post">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" name="email" placeholder="Email" class="form-control" required>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="password" name="password" placeholder="Password" class="form-control" required>--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-success">Sign in</button>--}}
                    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">Register</button>--}}
                {{--</form>--}}
            </div><!--/.navbar-collapse -->
        @else
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right" role="form">
                    <a href="/auth/logout" type="button" class="btn btn-primary" >Sign out</a>
                </form>
            </div><!--/.navbar-collapse -->
        @endif
    </div>
</nav>

<div class="container">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="page-header">
        <div class="container">
            <h1>
                Quarry Management System
                <span class="glyphicon glyphicon-leaf wansley" aria-hidden="true"></span>
            </h1>
        </div>
    </div>

        @yield('content')

    <hr>

    <footer>
        <p>&copy; Wansley Quaries 2017</p>
    </footer>
</div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

@if( ! Auth::check())
    <!-- Registration Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="QMS Registration" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quarry Manager Registration</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/auth/register">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input type="text" name="name" placeholder="First Name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="text" name="surname" placeholder="Surname" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm Registration</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@endif

<script>window.jQuery || document.write('<script src="{{ asset('js/vendor/jquery-1.11.2.min.js') }}"><\/script>')</script>

<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

@yield('scripts')

<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
