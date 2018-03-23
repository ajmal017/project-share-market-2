@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <div class="main-container">
        <div class="grid-container">
            <div class="grid-item">
                <canvas id="myChart" width="25%" height="25%"></canvas>
            </div>
            <div class="grid-item">2</div>
            <div class="grid-item">3</div>
            <div class="grid-item">4</div>
            <div class="grid-item">5</div>
            <div class="grid-item">6</div>
            <div class="grid-item">7</div>
            <div class="grid-item">8</div>
            <div class="grid-item">9</div>
        </div> 
    </div>
    <!-- END OF CONTENT -->

@endsection