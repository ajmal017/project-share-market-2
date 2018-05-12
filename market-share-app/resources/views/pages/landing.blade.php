@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='account'>Home</a>
        <a class = "sysoLink" href='search'>Search</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='landing'>Home</a>
        <a class = "sysoLink" href='signin'>Login</a>
        <a class = "sysoLink" href='signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='about'>About</a>
@endsection

@section('content')
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoBox sysoBoxFlex">
        <div id = "welcomeBox" class = "sysoContent sysoContent50">
            <div id = "sysoWelcomeImage"></div>
        </div>
        <div class = "sysoContent sysoContent50">
            @if(Auth::check())
                <div class = "sysoBox sysoVerticalCenter">
                    <p class = "sysoPara sysoParaBig sysoCenterText">You're already logged in! Click the link below to continue buying and selling shares.</p>
                    <a class = "sysoLink" href="/account">Show me my account</a>
                </div>
            @else
                <div class = "sysoBox sysoVerticalCenter">
                    <a class = "sysoLink" href="/signin">Login</a>
                    <a class = "sysoLink" href="/signup">Sign Up</a>
                    <a class = "sysoLink" href='about'>About</a>
                    <p class = "sysoPara sysoParaBig sysoCenterText">Buy and sell shares to make your way up the leaderboard.</p>
                    <p class = "sysoPara sysoParaBig sysoCenterText">Sign up now and be given $1,000,000 in game currency!</p>
                </div>
            @endif
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection