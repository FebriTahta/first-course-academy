<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <!-- Logo -->
            <div class="content-header-item">
                <a class="link-effect font-w700 mr-5" href="/">
                    <i class="si si-fire text-primary"></i>
                    <span class="font-size-xl text-dual-primary-dark">course</span><span class="font-size-xl text-primary">academy</span>
                </a>
            </div>
            <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Middle Section -->
        <div class="content-header-section d-none d-lg-block">
            <!-- Header Navigation -->
            <!--
            Desktop Navigation, mobile navigation can be found in #sidebar

            If you would like to use the same navigation in both mobiles and desktops, you can use exactly the same markup inside sidebar and header navigation ul lists
            If your sidebar menu includes headings, they won't be visible in your header navigation by default
            If your sidebar menu includes icons and you would like to hide them, you can add the class 'nav-main-header-no-icons'
            -->
            <ul class="nav-main-header">
                <li>
                    @auth                                    
                        @if (auth()->user()->role=='siswa')
                            <a href="/home"><i class="fa fa-user"></i>HOME</a>
                        @elseif(auth()->user()->role=='instruktur')
                            <a href="{{ route('dashboard') }}"><i class="si si-compass"></i>Dashboard</a>
                        @else
                        <a href="{{ route('home') }}"><i class="si si-compass"></i>Dashboard</a>
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
                        @elseif(auth()->user()->role=='pengunjung')
                            <a href="{{ route('/logout') }}"><i class="si si-action-undo"></i>Logout </a>
                            @elseif(auth()->user()->role=='instruktur')
                            <a href="{{ route('/logout') }}"><i class="si si-action-undo"></i>Logout </a>
                            @elseif(auth()->user()->role=='admin')
                            <a href="{{ route('/logout') }}"><i class="si si-action-undo"></i>Logout </a>
                    @endauth
                        @else
                            <a href="/login"><i class="fa fa-lock"></i>Login </a>
                            <a href="{{ 'register' }}"><i class="si si-lock"></i>register </a>
                        @endif                                            
                </li>
            </ul>
            <!-- END Header Navigation -->
        </div>
        <!-- END Middle Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <!-- Color Themes + A few of the many header options (used just for demonstration) -->
            <!-- Themes functionality initialized in Template._uiHandleTheme() -->
            <div class="btn-group ml-5" role="group">
                <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-paint-brush"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-themes-dropdown">
                    <h6 class="dropdown-header text-center">Color Themes</h6>
                    <div class="row no-gutters text-center">
                        <div class="col-4 mb-5">
                            <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-4 mb-5">
                            <a class="text-elegance" data-toggle="theme" data-theme="{{ asset('assets/css/themes/elegance.min.css') }}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-4 mb-5">
                            <a class="text-pulse" data-toggle="theme" data-theme="{{ asset('assets/css/themes/pulse.min.css') }}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-4 mb-5">
                            <a class="text-flat" data-toggle="theme" data-theme="{{ asset('assets/css/themes/flat.min.css') }}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-4 mb-5">
                            <a class="text-corporate" data-toggle="theme" data-theme="{{ asset('assets/css/themes/corporate.min.css') }}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                        <div class="col-4 mb-5">
                            <a class="text-earth" data-toggle="theme" data-theme="{{ asset('assets/css/themes/earth.min.css') }}" href="javascript:void(0)">
                                <i class="fa fa-2x fa-circle"></i>
                            </a>
                        </div>
                    </div>
                    <h6 class="dropdown-header text-center">Header</h6>
                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                    <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="header_style_inverse_toggle">Style</button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="be_layout_api.html">
                        <i class="si si-chemistry"></i> All Options (API)
                    </a>
                </div>
            </div>
            <!-- END Color Themes + A few of the many header options -->

            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-search"></i>
            </button>
            <!-- END Open Search Section -->

            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    {{-- <div id="page-header-search" class="overlay-header">
        <div class="content-header content-header-fullrow">
            <form action="bd_search.html" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Close Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-times"></i>
                        </button>
                        <!-- END Close Search Section -->
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary px-15">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->