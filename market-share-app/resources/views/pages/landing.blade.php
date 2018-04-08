@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href='landing'>Home</a>
    <a class = "sysoLink" href='signin'>Login</a>
    <a class = "sysoLink" href='about'>About/FAQ</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoBox sysoBoxFlex">
        <div id = "welcomeBox" class = "sysoContent sysoContent50">
            <div id = "sysoWelcomeImage"></div>
        </div>
        <div id = "landing" class = "sysoContent sysoContent50">
            <a class = "sysoLink" href="/signup">Sign Up</a>
            <a class = "sysoLink" href="/signin">Login</a>
            <div id = "intro">
                <p>Buy and sell shares to make your way up the leaderboard.</p>
                <p>Sign up now and be given $1,000,000 in game currency!</p>
                <a href='about'>About/FAQ</a>
            </div>
        </div>
    </div>
    <!-- END OF CONTENT -->

@endsection