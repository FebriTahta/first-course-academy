<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>CA | course</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
        <meta property="og:site_name" content="Codebase">
        <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->

        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,600,700">
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/codebase.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/summernote/summernote-bs4.css') }}">
        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
        <!-- END Stylesheets -->
    </head>
    <body>

        <!-- Page Container -->
        <!--
            Available classes for #page-container:

        GENERIC

            'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

        SIDEBAR & SIDE OVERLAY

            'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
            'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
            'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
            'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
            'sidebar-inverse'                           Dark themed sidebar

            'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
            'side-overlay-o'                            Visible Side Overlay by default

            'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

            'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

        HEADER

            ''                                          Static Header if no class is added
            'page-header-fixed'                         Fixed Header

        HEADER STYLE

            ''                                          Classic Header style if no class is added
            'page-header-modern'                        Modern Header style
            'page-header-inverse'                       Dark themed Header (works only with classic Header style)
            'page-header-glass'                         Light themed Header with transparency by default
                                                        (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
            'page-header-glass page-header-inverse'     Dark themed Header with transparency by default
                                                        (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

        MAIN CONTENT LAYOUT

            ''                                          Full width Main Content if no class is added
            'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
            'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
        -->
        <div id="page-container" class="sidebar-inverse side-scroll page-header-fixed page-header-inverse main-content-boxed">

            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow bg-black-op-10">
                        <div class="content-header-section text-center align-parent">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="index.html">
                                    <i class="si si-fire text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                    </div>
                    <!-- END Side Header -->

                    <!-- Side Main Navigation -->
                    <div class="content-side content-side-full">
                        <!--
                        Mobile navigation, desktop navigation can be found in #page-header

                        If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
                        -->
                        <ul class="nav-main">
                            <li>
                                @auth                                    
                                    @if (auth()->user()->role=='siswa')
                                        <a href="bd_dashboard.html"><i class="si si-compass"></i>Dashboard</a>
                                    @else
                                        <a href="{{ route('daftar_user.index') }}"><i class="si si-compass"></i>Dashboard</a>
                                    @endif
                                @endauth
                            </li>
                            
                            @auth
                                @if (auth()->user()->role=='siswa')
                                    <li class="open">
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-book"></i>My Course</a>
                                        <ul>
                                            @foreach (auth()->user()->profile->kursus as $item)
                                                <li>
                                                    <a href="/my-course/{{ $item->slug }}">{{ $item->mapel->mapel_name }} <br>| {{ $item->kelas->kelas_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif                
                            @endauth
                            <li class="nav-main-heading">DAFTAR PAGE</li>
                            <li class="open">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-info"></i>Menu</a>
                                <ul>                        
                                    <li>
                                        <a href="{{ route('forum') }}">Forum</a>                            
                                    </li>
                                    <li>
                                        <a href="{{ route('allkursus') }}">All Course</a>                            
                                    </li>
                                </ul>
                            </li>

                            <li>
                                @auth                                                
                                    @if (auth()->user()->role=='siswa')
                                        <a href="{{ route('/logout') }}"><i class="si si-action-undo"></i>Logout </a>
                                    
                                @endauth
                                    @else
                                        <a href="/login"><i class="fa fa-lock"></i>Login </a>
                                        <a href="/register"><i class="si si-lock"></i>register </a>
                                    @endif                                            
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Main Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->