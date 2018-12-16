<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Database Monitor</title>

        <meta name="description" content="Dashmix - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
        <link rel="stylesheet" href="{{ mix('/css/dashmix.css') }}">

        <link rel="stylesheet" href="/css/form.css">
        <link rel="stylesheet" href="/css/tooltip.css">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" href="{{ mix('css/themes/xwork.css') }}"> -->
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

          <script>
               function resizeBody() {
                    var height = window.innerHeight;
                    var width = window.innerWidth;

                    $('#main-container').css('max-height', (height - 140) + 'px');

                    var homeContainer = $('#home-container');

                    if (homeContainer[0] !== undefined) {
                         var homeContainerHeight = homeContainer[0].clientHeight;
                         var homeContainerWidth = homeContainer[0].clientWidth;

                         homeContainer.height(height - 340);
                    }
//                    var m = document.getElementById("main-container");

//                    m.style.max-height = (height - 140) + "px";
               }
               window.onload = window.onresize = function () {
                    resizeBody();
               }
          </script>
     </head>
     <body  onresize="resizeBody()">
          <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header page-header-dark main-content-narrow">
               <div id="app-menu">
                    <appmenu user-full-name="{{ Auth::User() ? Auth::user()->name : '' }}" request-url="{{ request()->path() }}" email-verification-date="{{ Auth::user() ? Auth::user()->email_verified_at : '' }}"></appmenu>
               </div>
               <div id="app-header">
                    <appheader user-full-name="{{ Auth::User() ? Auth::user()->name : '' }}" email-verification-date="{{ Auth::user() ? Auth::user()->email_verified_at : '' }}"
                         login-url="{{ route('login') }}" logout-url="{{ route('logout') }}" settings-url="{{ route('settings') }}"></appheader>
               </div>
               <main id="main-container">
                    <div id="app">
                         @yield('content')
                    </div>
               </main>
               <div id="app-footer">
                    <appfooter></appfooter>
               </div>
        </div>
        <script src="{{ mix('/js/dashmix.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('/js/laravel.app.js') }}"></script>

        <!-- Semaphore -->
        <script src="{{ mix('/js/semaphore.js') }}"></script>

       <script src="/js/filtertoolbar.js"></script>
       <script src="/js/Chart.bundle.min.js"></script>
        @yield('js_after')
    </body>
</html>
