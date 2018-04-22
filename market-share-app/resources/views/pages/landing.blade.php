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
    <a class = "sysoLink" href='about'>About/FAQ</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoBox sysoBoxFlex">
        <div id = "welcomeBox" class = "sysoContent sysoContent50">
            <div id = "sysoWelcomeImage"></div>
        </div>
        <div id = "landing" class = "sysoContent sysoContent50">
            @if(Auth::check())
                <div id = "intro">
                    <p>You're already logged in! Click the link below to continue buying and selling shares.</p>
                    <a class = "sysoLink" href="/account">Show me my account</a>
                </div>
            @else
                <a class = "sysoLink" href="/signup">Sign Up</a>
                <a class = "sysoLink" href="/signin">Login</a>
                <div id = "intro">
                    <p>Buy and sell shares to make your way up the leaderboard.</p>
                    <p>Sign up now and be given $1,000,000 in game currency!</p>
                    <a class = "sysoLink" href='about'>About/FAQ</a>
                </div>
            @endif
        </div>
    </div>
    <!-- END OF CONTENT -->

@endsection