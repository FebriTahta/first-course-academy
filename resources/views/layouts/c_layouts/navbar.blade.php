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
    <meta property="og:image"              content="{{ asset('assets/media/drawkit/8-SCENE.svg') }}" />
    <title>Course Academy</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>    
    <div class="wrapper">
        <div class="nav">
            <div class="logo links">
                <a href="/" class="mainlink"><h4>Course Academy.</h4></a>                                
            </div>
            <div class="links">
                {{-- <a href="#" class="mainlink">Corona Updates</a> --}}                
                <a href="{{ route('berita') }}">News</a>
                <a href="{{ route('forum') }}">Forum</a>
                @auth
                    @if (auth()->user()->role=='siswa')
                    <a href="{{ route('home') }}">Kursus Saya</a>
                    <a href="{{ 'logout' }}">Logout</a>
                    @else
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    <a href="{{ 'logout' }}">Logout</a>
                    @endif                
                @else
                <a href="{{ 'login' }}">Masuk</a>
                <a href="{{ 'register' }}">Daftar</a>
                @endauth                
            </div>
        </div>