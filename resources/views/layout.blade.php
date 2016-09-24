<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{{ asset('assets/img/favicon.ico') }}}">
    <link rel="apple-touch-icon" href="{{{ asset('assets/img/apple-touch-icon.png') }}}"/>

    <title>ALG&Eacute;BRICO!</title>

    <!-- Bootstrap core CSS -->
    <link href="{{{ asset('/assets/dist/css/all.css') }}}" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <!-- <link href="starter-template.css" rel="stylesheet"> -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/">  
                    <img class="pull-left" src="{{{ asset('/assets/img/apple-touch-icon.png') }}}" style="width: 46px; padding: 8px 3px 8px 8px;">
                    <span class="navbar-brand">ALG&Eacute;BRICO!</span>
                </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                @if(Auth::check())
                <ul class="nav navbar-nav">
                    <li class="{{ Menu::isActiveRoute('transactions') }}"><a href="{{ route('transactions.index') }}">Transactions</a></li>
                    <li class="{{ Menu::isActiveRoute('accounts') }}"><a href="{{ route('accounts.index') }}">Accounts</a></li>
                    <li class="{{ Menu::isActiveRoute('categories') }}"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="{{ Menu::isActiveRoute('subcategories') }}"><a href="{{ route('subcategories.index') }}">Subcategories</a></li>
                    <!--li class="{{ Menu::isActiveRoute('types') }}"><a href="{{ route('types.index') }}">Types</a></li-->
                    <li class="{{ Menu::isActiveRoute('vendors') }}"><a href="{{ route('vendors.index') }}">Vendors</a></li>
                    <li class="{{ Menu::isActiveRoute('bookmarks') }}"><a href="{{ route('bookmarks.index') }}">Bookmarks</a></li>
                    <li class="{{ Menu::isActiveRoute('importer') }}"><a href="{{ url('importer') }}">Importer</a></li>
                </ul>
                @endif            
                <ul class="nav navbar-nav" style="float: right;">
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> {{Auth::check() ? Auth::user()->name : 'Account'}}</a></li>
                    <li><a href="{{Auth::check() ? url('auth/logout') : url('auth/login')}}"><i class="glyphicon glyphicon-lock"></i> {{Auth::check() ? 'Logout' : 'Login'}}</a></li>
                    @if(!Auth::check())<li><a href="{{url('auth/register')}}"><i class="glyphicon glyphicon-pencil"></i> Register</a></li>@endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('header')
        @yield('content')
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{{ asset('/assets/dist/js/all.js') }}}"></script>
    @yield('footer')
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
</body>
</html>
