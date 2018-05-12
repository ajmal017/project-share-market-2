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
    <div class = "sysoBox">
        <div class = "sysoAboutBox sysoCenterText">
            <h1 class = "sysoHeader1">About This Website</h1>
            <p class = "sysoPara">Welcome to Stock Your Socks Off; an online game designed to introduce 
            you to the Australian Securities Exchange (ASX). As a player, you'll be given one-million 
            shillings of fictitious capital to invest in any ASX listing. The game uses real, live ASX 
            data for trading. Stock Your Socks Off is a useful tool for investor training, trading 
            practice and learning share market trends. Sign up now to compete in the current game!</p>
            <h1 class = "sysoHeader1">Frequently Asked Questions (FAQ)</h1>
            <h2 class = "sysoHeader2">How much play-money do I get?</h2>
            <p class = "sysoPara">One million Australian Dollars ($1,000,000 AUD).</p>
            <h2 class = "sysoHeader2">What do I win?</h2>
            <p class = "sysoPara">Satisfaction.</p>
            <h2 class = "sysoHeader2">How long does the game go for?</h2>
            <p class = "sysoPara">One (1) month.</p>
            <h2 class = "sysoHeader2">How do I sign up?</h2>
            <p class = "sysoPara">Click <a href = "signup">this</a> link and follow the on-screen prompts.</p>
            <h2 class = "sysoHeader2">How do I log in to play?</h2>
            <p class = "sysoPara">Click <a href = "signin">this</a> link and enter your email address and 
            password. If you don't have an account, click <a href = "signup">this</a> link and follow the 
            on-screen prompts.</p>
            <h2 class = "sysoHeader2">How do I search for shares?</h2>
            <p class = "sysoPara">The search page has two ways to locate companies. The first is to enter 
            the ASX code. If you don't know the ASX code of the company you're looking for, you can use the 
            second search field to search by company name. Click <a href = "search">this</a> link to navigate 
            to the search page.</p>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection