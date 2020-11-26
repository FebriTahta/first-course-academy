<!DOCTYPE html>
{{-- <html lang="en"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-focus">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url"            content="course-academy.top" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Course Academy" />
    <meta property="og:description"        content="Kini kami hadir dalam bentuk digital untuk memenuhi kebutuhan belajar anda" />
    <meta property="og:image"              content="{{ asset('gawr/gawr.jpg') }}"/> 
    <title>Course Academy</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> 
</head>
<body>    
    <div class="wrapper">
        <div class="nav">
            <div class="logo links">
                <a href="/" class="mainlink"><h3>CourseAcademy</h3></a>                                
            </div>
            <div class="links" style="text-align: center">
                
                <a href="{{ route('berita') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; News</a>
                <a href="{{ route('forum') }}">Forum</a>
                @auth
                    @if (auth()->user()->role=='siswa')
                        <a href="{{ route('home') }}">My Course</a>
                        <a href="{{ route('logout') }}">Logout</a>
                    @elseif(auth()->user()->role=='instruktur') 
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ 'logout' }}">Logout</a>
                    @else
                        <a href="{{ route('home') }}">Dashboard</a>
                        <a href="{{ route('logout') }}">Logout</a>
                    @endif                
                @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>