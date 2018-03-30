@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <div id="container" style="width:100%; height:400px;"></div>
    <!-- END OF CONTENT -->

@endsection