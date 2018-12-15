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
            <!-- Side Overlay-->
            <aside id="side-overlay">
                <!-- Side Header -->
                <div class="bg-image" style="background-image: url('{{ asset('media/various/bg_side_overlay_header.jpg') }}');">
                    <div class="bg-primary-op">
                        <div class="content-header">
                            <!-- User Avatar -->
                            <a class="img-link mr-1" href="javascript:void(0)">
                                <img class="img-avatar img-avatar48" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                            </a>
                            <!-- END User Avatar -->

                            <!-- User Info -->
                            <div class="ml-2">
                                <a class="text-white font-w600" href="javascript:void(0)"></a>
                                <div class="text-white-75 font-size-sm font-italic"></div>
                            </div>
                            <!-- END User Info -->

                            <!-- Close Side Overlay -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="ml-auto text-white" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                                <i class="fa fa-times-circle"></i>
                            </a>
                            <!-- END Close Side Overlay -->
                        </div>
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Content -->
                <div class="content-side">
                    <p>
                        Content..
                    </p>
                </div>
                <!-- END Side Content -->
            </aside>
            <!-- END Side Overlay -->

            <!-- Sidebar -->
            <nav id="sidebar" aria-label="Main Navigation">
                <!-- Side Header -->
                <div class="side-header">
                    <div class="content-header ">
                        <!-- Logo -->
                        <a class="link-fx font-w600 font-size-lg text-white" href="/">
                            <h2 class="text-white-75 mb-0">Royce Consulting</h2>
                        </a>
                        <!-- END Logo -->

                        <!-- Options -->
                        <div>
                            <!-- Toggle Sidebar Style -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->

                            <!-- END Toggle Sidebar Style -->

                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                                <i class="fa fa-times-circle"></i>
                            </a>
                            <!-- END Close Sidebar -->
                        </div>
                        <!-- END Options -->
                    </div>
                </div>
                <!-- END Side Header -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <!-- Right Side Of Navbar -->
                    @if (Auth::user() && Auth::user()->email_verified_at != '')
                    <ul class="nav-main">
                        <li class="nav-main-item nav-item-bordered">
                            <a class="nav-main-link{{ request()->is('monitor') ? ' active' : '' }}" href="/monitor">
                                <i class="nav-main-link-icon si si-eyeglasses"></i>
                                <span class="nav-main-link-name">Monitor</span>
                                <span class="nav-main-link-badge badge badge-pill badge-success">5</span>
                            </a>
                        </li>
                        <li class="nav-main-item{{ request()->is('admin/*') ? ' open' : '' }} nav-item-bordered">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <i class="nav-main-link-icon si si-settings"></i>
                                <span class="nav-main-link-name">Administration</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font {{ (substr(request()->path(), 0, 12) == 'admin/server') ? ' active' : '' }}" href="/admin/server">
                                        <span class="nav-main-link-name">Servers</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, 17) == 'admin/environment') ? ' active' : '' }}" href="/admin/environment">
                                        <span class="nav-main-link-name">Environments</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, 16) == 'admin/datacenter') ? ' active' : '' }}" href="/admin/datacenter">
                                        <span class="nav-main-link-name">Datacenters</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, 13) == 'admin/cluster')  ? ' active' : '' }}" href="/admin/cluster">
                                        <span class="nav-main-link-name">Clusters</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, 14) == 'admin/dnsalias') ? ' active' : '' }}" href="/admin/dnsalias">
                                        <span class="nav-main-link-name">DNS Aliases</span>
                                    </a>
                                </li>




                                <li class="nav-main-item{{ request()->is('admin/alert/*') ? ' open' : '' }} ">
                                    <a class="nav-main-link nav-main-link-submenu nav-main-link-font" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                        <span class="nav-main-link-name">Alerts</span>
                                    </a>
                                    <ul class="nav-main-submenu">
                                        <li class="nav-main-item">
                                            <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, strlen('admin/alert/repllag')) == 'admin/alert/repllag') ? ' active' : '' }}" href="/admin/alert/repllag">
                                                <span class="nav-main-link-name">Replication Lag</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, strlen('admin/alert/disk')) == 'admin/alert/disk') ? ' active' : '' }}" href="/admin/alert/disk">
                                                <span class="nav-main-link-name">Disk Space</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link nav-main-link-font{{ (substr(request()->path(), 0, strlen('admin/alert/cpuload')) == 'admin/alert/cpuload') ? ' active' : '' }}" href="/admin/alert/cpuload">
                                                <span class="nav-main-link-name">CPU Load</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li  style="display: none;" class="nav-main-item{{ request()->is('reports/*') ? ' open' : '' }} nav-item-bordered">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                                <i class="nav-main-link-icon si si-chart"></i>
                                <span class="nav-main-link-name">Reports</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ request()->is('reports/dataintegrity') ? ' active' : '' }}" href="/reports/dataintegrity">
                                        <span class="nav-main-link-name">Data Integrity</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-font{{ request()->is('reports/dbcompare') ? ' active' : '' }}" href="/reports/dbcompare">
                                        <span class="nav-main-link-name">Database Comparison</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
          @endif
                </div>
                <!-- END Side Navigation -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header" class="bb-2-white">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <h1 class="app-title justify-content-center">Database Monitor</h1>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div>
                        <!-- User Dropdown -->
                        @if (!Auth::user() || Auth::user()->email_verified_at == '')
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">Guest</span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="page-header-user-dropdown">
                                <div class="">
                                   <a class="nav-main-link" href="{{ route('login') }}">
                                        <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Login
                                   </a>
                                </div>
                        </div>
                        @else
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="">
                                   <a class="nav-main-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                        <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Log Out
                                   </a>

                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                   @csrf
                                   </form>
                                </div>
                                <div class="">
                                   <a class="nav-main-link" href="{{ route('settings') }}">
                                        <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Settings
                                   </a>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- END User Dropdown -->

                        <!-- Notifications Dropdown -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-bell"></i>
                                <span class="badge badge-secondary badge-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 notifications-main-div" aria-labelledby="page-header-notifications-dropdown ">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                   <h2 class="color-white mt-0 mb-0">Notifications</h2>
                                </div>
                                <ul class="nav-items">
                                    <li class="notification">
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mx-3">
                                                <i class="fa fa-fw fa-check-circle text-success"></i>
                                            </div>
                                            <div class="media-body font-size-sm pr-2">
                                                <div>App was updated to v5.6!</div>
                                                <div class="font-italic">3 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification">
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mx-3">
                                                <i class="fa fa-fw fa-user-plus text-info"></i>
                                            </div>
                                            <div class="media-body font-size-sm pr-2">
                                                <div>New Subscriber was added! You now have 2580!</div>
                                                <div class="font-italic">10 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="notification">
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mx-3">
                                                <i class="fa fa-fw fa-times-circle text-danger"></i>
                                            </div>
                                            <div class="media-body font-size-sm pr-2">
                                                <div>Server backup failed to complete!</div>
                                                <div class="font-italic">30 min ago</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="javascript:void(0)">
                                            <div class="mx-3">
                                                <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                                            </div>
                                            <div class="media-body font-size-sm pr-2">
                                                <div>You are running out of space. Please consider upgrading your plan.</div>
                                                <div class="font-italic">1 hour ago</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="p-2 border-top">
                                    <a class="btn btn-light btn-block text-center" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-eye mr-1"></i> View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END Notifications Dropdown -->

                        <!-- Toggle Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!--
                        <button type="button" class="btn btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                            <i class="far fa-fw fa-list-alt"></i>
                        </button>
                         -->
                        <!-- END Toggle Side Overlay -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary-darker">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                     @yield('content')
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="footer-bg">
                <div class="content py-0">
                    <div class="row font-size-sm">
                        <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="" target="_blank">Ronald Royce</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                            <a class="font-w600" href="" target="_blank">Royce Consulting</a> &copy; <span data-toggle="year-copy">2018</span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!-- Dashmix Core JS -->
        <script src="{{ mix('/js/dashmix.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->
        <script src="{{ mix('/js/laravel.app.js') }}"></script>

        <!-- Semaphore -->
        <script src="{{ mix('/js/semaphore.js') }}"></script>

       <script src="/js/filtertoolbar.js"></script>

        @yield('js_after')
    </body>
</html>
