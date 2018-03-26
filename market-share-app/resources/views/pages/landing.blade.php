@extends('layouts/main-template')

@section('link')
    <a href='about'>About/FAQ</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div id = "landingBox">
        <div id = "welcomeBox">
            <h1 id = "welcomeTitle">Welcome to <i>Stock Your Socks Off</i>!</h1>
            <p>Stock Your Socks Off is an ASX stock market investment simulation.</p> 
        </div>
        <div id = "actionBox">
            <div id = "actionContentBox">
                <a class = "wpLink" href="/signup">Sign Up</a>
                <a class = "wpLink" href="/login">Login</a>
                <p>Buy and sell shares to make your way up the leaderboard.</p>
                <p>Sign up now and be given $1,000,000 in game currency!</p>
            <div>
        </div>
    </div>
    <!-- END OF CONTENT -->

@endsection