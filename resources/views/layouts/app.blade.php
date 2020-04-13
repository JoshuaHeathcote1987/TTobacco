<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>T-Tobacco</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('jquery.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stripe.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <style>
        #myBtn {
            display: none; /* Hidden by default */
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            background-color: #a30000; /* Set a background color */
            color: white; /* Text color */
            cursor: pointer; /* Add a mouse pointer on hover */
            padding: 15px; /* Some padding */
            font-size: 18px; /* Increase font size */
            opacity: 0.5;
            border-radius: 5px;
        }

        #myBtn:hover {
            background-color: #ad5864; /* Add a dark-grey background on hover */
        }
    </style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'T-Tobacco') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Navigation <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                                    @if (auth()->user()->is_admin != 1)
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            Home
                                        </a>
                                        <a class="dropdown-item" href="{{ url('view-products') }}">
                                            Products
                                        </a>
                                        <a class="dropdown-item" href="{{ url('view-cart') }}">
                                            Cart
                                        </a>
                                        <a class="dropdown-item" href="{{ url('purchases') }}">
                                            Purchases
                                        </a>
                                    @endif


                                    @if (auth()->user()->is_admin == 1)
                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            Home
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-users') }}">
                                            Users
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-products') }}">
                                            Products
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-orders') }}">
                                            Purchases
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-transactions') }}">
                                            Transactions
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-carts') }}">
                                            Carts
                                        </a>
                                        <a class="dropdown-item" href="{{ url('read-shippings') }}">
                                            Shippings
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="">
            @yield('content')
        </main>
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button> 
    </div>

    <script>
        //Get the button:
        mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        } 
    </script>

</body>
</html>
