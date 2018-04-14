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
<div id = "temporaryBox">
    <h1>Create an account</h1>
    <form>
        <p><input type="text" name="username"></p>
        <p>
            <input type="password" name="password" id="password"><br>
        </p>
        <p><input type="submit" value="Log In"></p>
    </form>
</div>
    <!-- END OF CONTENT -->

@endsection