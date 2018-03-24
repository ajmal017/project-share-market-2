@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <!-- END OF CONTENT -->

@endsection