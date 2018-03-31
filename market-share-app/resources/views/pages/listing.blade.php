@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    {{--  <div id="container" style="width:100%; height:400px;"></div>  --}}

    <div class="grid-container">
        <div class="grid-item">
            <label for="asx_code"><b>Enter an ASX Code:</b></label>
            <br>
            <input type="text" name="asx_code" id="asx_code" style="text-align:center;" maxlength="3">
            <br>
            <input type="button" value="Search" id="search_companies" style="margin-top:0.5em;">
        </div>
        <div class="grid-item" id="company_details"></div>
        <div class="grid-item" id="get_daily_data"></div>
    </div> 
    <!-- END OF CONTENT -->

@endsection