@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a href="#" onClick="history.go(-1);return true;">Back</a>
    <a href='landing'>Home</a>
@endsection

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <a href="#" onClick="history.go(-1);return true;">Back</a>

    <!-- END OF CONTENT -->

@endsection