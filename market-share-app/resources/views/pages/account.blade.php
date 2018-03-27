@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <h1>Welcome {{ Auth::user()->name }}!</h1>
    <!-- END OF CONTENT -->

@endsection