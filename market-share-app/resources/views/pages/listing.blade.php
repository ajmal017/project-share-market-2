@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='../account'>Home</a>
        <a class = "sysoLink" href='../search'>Search</a>
        <a class = "sysoLink" id="../logoutLink" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    <!-- No session links -->
    @else
        <a class = "sysoLink" href='../landing'>Home</a>
        <a class = "sysoLink" href='../signin'>Login</a>
        <a class = "sysoLink" href='../signup'>Sign up</a>
    @endif
    <!-- Generic links -->
    <a class = "sysoLink" href='../about'>About/FAQ</a>
@endsection

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->

    <!-- Extra scripts specific to this page -->
    <script type="text/javascript">
        function addPurchaseForm(price) {
            
            var form = " <h3 id='listingTitle'>Stock Order</h3><br><br><input type='text' name='qty' id='shareQty' placeholder='Enter Qty' onchange='getTotal("+price+")'></input>";
            var confirm = "<br><button id='buyButton' type='submit'>Confirm Purchase</button>";
            var total = "<p id='totPrice'>Total Price: $0.00</p>";
        
            GEBI("buyForm").innerHTML = form + total + confirm ;
        }

        function getTotal(price) {
            var qty = GEBI("shareQty").value;
            if (isNaN(qty) || qty < 1) {
                var returnVal = "Please enter valid number greater than 0";
            } else {
                var returnVal = "Total Price: $" + (price*qty).toFixed(2);
            }

            GEBI("totPrice").innerHTML = returnVal;
            
        }
    </script>

    <div class = "sysoContent sysoContent50" id="listingContent">        
        <div class="grid-item" id="company_details"><b>{{$data[0]->company_name}}</b><br>{{$data[0]->gics_industry}}</div>        
            <table id = "listingTable">
                <tr id = "listingRow">
                    <th>Company Name</th>
                    <td>{{$data[0]->company_name}}</td>
                <tr>
                <tr id = "listingRow">
                    <th>Industry</th>
                    <td>{{$data[0]->gics_industry}}</td>
                <tr>
                <tr id = "listingRow">
                    <th>ASX Company Code</th>
                    <td>{{$data[0]->company_code}}</td>
                <tr>
                <tr id = "listingRow">
                    <th>Current Stock Price</th>
                    <td>{{$price}}</td>
                <tr>
            </table>

            <form action='/confirmation' method='get'>
                <button id="buyButton" type='button' onclick="addPurchaseForm({{$price}})">Buy Shares</button>
                <input type='hidden' name='code' value='{{$data[0]->company_code}}'>
                <div id="buyForm" class="grid-item"></div>
            </form>
        </div>

        <div class = "sysoContent sysoContent50">

        <!-- EMBEDDED GRAPH GOES HERE -->

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/stock/modules/drag-panes.js"></script>
        <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>


        <div id="container" style="height: 400px; min-width: 310px"></div>

        </div>
    </div>
    

    <!-- END OF CONTENT -->

@endsection