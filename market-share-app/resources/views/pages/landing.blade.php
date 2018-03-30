@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a href='about'>About/FAQ</a>
    <a href='landing'>Test</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoBox sysoBoxFlex">
        <div id = "welcomeBox" class = "sysoContent sysoContent50">
            <h1 id = "welcomeTitle">Welcome to <i>Stock Your Socks Off</i>!</h1>
            <p>Stock Your Socks Off is an ASX stock market investment simulation.</p>
        </div>
        <div class = "sysoContent sysoContent50">
            <a class = "wpLink" href="/signup">Sign Up</a>
            <a class = "wpLink" href="/signin">Login</a>
            <p>Buy and sell shares to make your way up the leaderboard.</p>
            <p>Sign up now and be given $1,000,000 in game currency!</p>
        </div>
    </div>
    <!-- END OF CONTENT -->

@endsection