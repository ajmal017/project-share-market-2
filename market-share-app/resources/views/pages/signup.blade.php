@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a href="about">About/FAQ</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
{{ __('Logout') }} </a> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf </form>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <h1>Create an account</h1>
    <form>
        <p><input type="text" name="username"></p>
        <p>
            <input type="password" name="password" id="password" onblur="pwStrengthCheck()"><br>
            <span id="pw-strength"></span>
        </p>
        <p><input type="submit" value="Sign Up"></p>
    </form>

    <!-- END OF CONTENT -->

@endsection