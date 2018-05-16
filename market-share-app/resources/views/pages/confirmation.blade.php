@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='/account'>Home</a>
        <a class = "sysoLink" href='/search'>Search</a>
        <a class = "sysoLink" href='/community'>Community</a>
        <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='/landing'>Home</a>
        <a class = "sysoLink" href='/signin'>Login</a>
        <a class = "sysoLink" href='/signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='/about'>About</a>
@endsection

@section('content')
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoContent sysoContent100 sysoCenterText" id="listingContent">
        <?php
            use App\Http\Controllers\ShareTransactionController;
            use App\Http\Controllers\ListingsController;
            $quantity = $_GET['qty'];
            $companycode = $_GET['code'];
            //add try and catch block
            $price = ListingsController::getCurrentPrice($companycode);
            if (!ShareTransactionController::buyShares($companycode,$price, $quantity)) {
                echo "<h1 class = 'sysoHeader1'>Error! Transaction failed. Please try again.</h1>";
            } else {
                echo "<h1 class = 'sysoHeader1'>Success!</h1>";
                echo "<p class = 'sysoPara'>You have purchased ".$quantity." shares in ".$companycode;
            }
        ?>
        <a class = "sysoLink" href='#' onclick="goBack()">Back to Listing</a>
        <a class = "sysoLink" href='search'>Search for another Listing</a>
        <a class = "sysoLink" href='account'>Return to Account</a>
    </div>
    <!-- END OF CONTENT -->
@endsection