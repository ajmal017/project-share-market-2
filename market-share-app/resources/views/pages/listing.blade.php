@extends('layouts/main-template')

@section('link')
    <!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <!-- Active session links -->
    @if(Auth::check())
        <a class = "sysoLink" href='../account'>Home</a>
        <a class = "sysoLink" href='../search'>Search</a>
        <a class = "sysoLink" href='../community'>Community</a>
        <a class = "sysoLink" href="#" onClick="history.go(-1);return true;">Back</a>
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
    <a class = "sysoLink" href='../about'>About</a>
@endsection

@section('content')
    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    <!-- Extra scripts specific to this page -->
    <script type="text/javascript">
        function addPurchaseForm(price) {
            var form = "<h3 class = 'sysoHeader1 sysoCenterText' id='listingTitle'>Stock Order</h3><br><br><input type='text' name='qty' id='shareQty' placeholder='Enter Qty' onchange='getTotal("+price+")'></input>";
            var confirm = "<br><button id='buyButton' type='submit'>Confirm Purchase</button>";
            var shareprice = "<br><br><p class = 'sysoPara sysoCenterText' id='sharePrice'>Share Price: $0.00</p>";
            var commprice = "<p class = 'sysoPara sysoCenterText' id='commPrice'>Commission Price: $0.00</p>";
            var total = "<p class = 'sysoPara sysoCenterText' id='totPrice'>Total Price: $0.00</p>";
            GEBI("buyForm").innerHTML = form + shareprice + commprice + total + confirm;
        }
        function getTotal(price) {
            var fixed = 50;
            var percentage = 0.01;
            var qty = GEBI("shareQty").value;
            if (isNaN(qty) || qty < 1) {
                var returnVal = "Please enter valid number greater than 0";
            } else {
                var returnVal = "Share Price: $" + (price*qty).toFixed(2);
                var comm = (price*qty)*percentage+fixed
                GEBI("commPrice").innerHTML = "Commission Price: $" + comm.toFixed(2);
                GEBI("totPrice").innerHTML = "Total Price: $" + (comm+(price*qty)).toFixed(2);
            }
            GEBI("sharePrice").innerHTML = returnVal;
        }
    </script>
    <div class='successMessage'>
    <?php
        use App\Http\Controllers\ShareTransactionController;
        use App\Http\Controllers\ListingsController;
        if (isset($_GET['qty']) && isset($_GET['code'])) {
            $quantity = $_GET['qty'];
            $companycode = $_GET['code'];
            //add try and catch block
            $price = ListingsController::getCurrentPrice($companycode);
            if (!ShareTransactionController::buyShares($companycode,$price, $quantity)) {
                echo "<h1 class = 'sysoHeader1 sysoCenterText'>Error! Transaction failed. Please try again.</h1>";
            } else {
                echo "<h1 class = 'sysoHeader1 sysoCenterText'>Success!</h1>";
                echo "<p class = 'sysoPara sysoCenterText'>You have purchased ".$quantity." shares in ".$companycode;
            }
        }
    ?>
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
            <form method='get'>
                <button class = "sysoButton" id="buyButton" type='button' onclick="addPurchaseForm({{$price}})">Buy Shares</button>
                <input type='hidden' name='code' value='{{$data[0]->company_code}}'>
                <div id="buyForm" class="grid-item"></div>
            </form>
            <button class = "sysoButton">
                <a href="#" onClick="history.go(-1);return true;">Back</a>
            </button>
        </div>
        <div class = "sysoContent sysoContent50">
            <label class="radio_container">Basic
                <input class = "sysoInput" type="radio" checked="checked" name="radio">
                <span class="checkmark"></span>
            </label>
            <label class="radio_container">Advanced
                <input class = "sysoInput" type="radio" name="radio">
                <span class="checkmark"></span>
            </label>
            <!-- EMBEDDED GRAPH GOES HERE -->
            <script src="{{ URL::to('/js/highcharts/highstock.js') }}" integrity=""></script>
            <script src="{{ URL::to('/js/highcharts/modules/drag-panes.js') }}" integrity=""></script>
            <script src="{{ URL::to('/js/highcharts/modules/exporting.js') }}" integrity=""></script>
            <div class="loading_title">
                Loading your chart, please wait.......
            </div>
            <div id="container" style="height: 400px; min-width: 310px" class='{{$data[0]->company_code}}'></div>
        </div>
    </div>
    <!-- END OF CONTENT -->
@endsection