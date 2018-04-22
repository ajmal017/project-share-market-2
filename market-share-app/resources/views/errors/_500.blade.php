@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href='landing'>Home</a>
    <a class = "sysoLink" href='about'>About/FAQ</a>
    @if(Auth::check())
        <a class = "sysoLink" href='search'>Search</a>
        <a class = "sysoLink" href='account'>Account</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    @else
        <a class = "sysoLink" href='signin'>Login</a>
    @endif
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoBox sysoBoxFlex">
        <div class = "sysoErrorBox">
            <h1 class = "sysoHeader1">500 stocked-off socks</h1>
            <img class = "sysoErrorImage" src = "images/sock.png" alt = "500 error"/>
            <p class = "sysoPara">Something went wrong... Click the link below to return to the home page.</p>
            <a class = "sysoLink" href='landing'>Home</a>
        </div>
    </div>

    <!-- END OF CONTENT -->

@endsection