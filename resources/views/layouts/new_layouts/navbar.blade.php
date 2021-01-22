<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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

    <title>Course Academy</title>

    <link href="//fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ asset('assets/assets/css/style-starter.css') }}">
	
	@yield('head')
	
  </head>
  <body>
<!-- header -->
<header class="w3l-header">
	<div class="container">
	<!--/nav-->
	<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-sm-3 px-0">
			<a class="navbar-brand" href="/">
				<span class="fa fa-newspaper-o"></span> Course Academy</a>
			<!-- if logo is image enable this   
						<a class="navbar-brand" href="#index.html">
							<img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
						</a> -->

			
			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<!-- <span class="navbar-toggler-icon"></span> -->
				<span class="fa icon-expand fa-bars"></span>
				<span class="fa icon-close fa-times"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<nav class="mx-auto">
					{{-- <div class="search-bar">
						<div class="search">
							<input type="search" id="search" class="search__input" name="search" placeholder="cari kursus"
								onload="equalWidth()" required>
							<input type="text" id="search" class="search__input">
							<span class="fa fa-search search__icon"></span>
						</div>
					</div> --}}
				</nav>
				<ul class="navbar-nav">
					{{-- <li class="nav-item active">
						<a class="nav-link" href="index.html">Home</a>
					</li> --}}
					<li class="nav-item dropdown @@pages__active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							More <span class="fa fa-angle-down"></span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item @@fa__active" onclick="news()">News</a>
							<a class="dropdown-item @@b__active" href="{{ route('forums') }}">Daftar Forum</a>
							<a class="dropdown-item @@fa__active" href="{{ route('allinstruktur') }}">Daftar Instruktur</a>
							<a class="dropdown-item @@fa__active" href="{{ route('allkursus') }}">Daftar Kursus</a>
						</div>
					</li>					
					@auth
						<li class="nav-item @@contact__active">
							@if (auth()->user()->role==='admin')
							<a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
															
							@elseif(auth()->user()->role==='instruktur')
								<a class="nav-link" href="{{ route('home') }}">Dashboard</a>
																
							@elseif(auth()->user()->role==='siswa')
								<a class="nav-link" href="{{ route('home') }}">Dashboard</a>
								
							@endif
						</li>
					@else
						<li class="nav-item @@pages__active">
							<a class="nav-link" href="{{ route('login') }}">login</a>
						</li>
						<li class="nav-item @@pages__active">
							<a class="nav-link" href="{{ route('register') }}">register</a>
						</li>
					@endauth
					<li class="nav-item ">
						@auth
							@if (auth()->user()->role==='admin')
							<a class="nav-link" href="{{ route('logout') }}">logout</a>
																
							@elseif(auth()->user()->role==='instruktur')
							<a class="nav-link" href="{{ route('logout') }}">logout</a>
																
							@elseif(auth()->user()->role==='siswa')
							<a class="nav-link" href="{{ route('logout') }}">logout</a>
							@endif	
						@endauth
					</li>
				</ul>
			</div>
			<!-- toggle switch for light and dark theme -->
			<div class="mobile-position">
				<nav class="navigation">
					<div class="theme-switch-wrapper">
						<label class="theme-switch" for="checkbox">
							<input type="checkbox" id="checkbox">
							<div class="mode-container">
								<i class="gg-sun"></i>
								<i class="gg-moon"></i>
							</div>
						</label>
					</div>
				</nav>
			</div>
			<!-- //toggle switch for light and dark theme -->
		</div>
	</nav>
	<!--//nav-->
</header>
<!-- //header -->

