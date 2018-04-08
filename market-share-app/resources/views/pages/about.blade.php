@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href='landing'>Home</a>
    <a class = "sysoLink" href='signin'>Login</a>
    <a class = "sysoLink" href='about'>About/FAQ</a>
    <a class = "sysoLink" href="#" onClick="history.go(-1);return true;">Back</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <a href="#" onClick="history.go(-1);return true;">Back</a>

    <!-- END OF CONTENT -->

@endsection