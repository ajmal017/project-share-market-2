@extends('layouts/main-template')

@section('link')
<!-- ADD LINKS DISPLAYED ON HEADER NAV BAR -->
    <a class = "sysoLink" href="#" onClick="history.go(-1);return true;">Back</a>
    <a class = "sysoLink" href='account'>Account</a>
    <a class = "sysoLink" id="logoutLink" href="{{ route('logout') }}" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <a class = "sysoLink" href='about'>About/FAQ</a>
@endsection

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
   
    <!-- Extra scripts specific to this page -->
    <script type="text/javascript">
        function addPurchaseForm() {
            $form = "<input type='text' placeholder='Enter Qty'></input>";
            $confirm = "<button id='buyButton' type='button'>Confirm Purchase</button>";
            $total = "<p id='totPrice'>Total Price: $XXXX </p>";
        
            GEBI("buyForm").innerHTML = $form + $total + $confirm ;
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
                    <td>...</td>
                <tr>
            </table>

            <form>
                <button id="buyButton" type='button' onclick="addPurchaseForm()">Buy Shares</button>

        </div>
        <div class = "sysoContent sysoContent50">
                <h3 id="listingTitle">Stock Order</h3>
                <div id="buyForm" class="grid-item"></div>
            </form>
        </div>
    </div>
    
  
    

    <!-- END OF CONTENT -->

@endsection