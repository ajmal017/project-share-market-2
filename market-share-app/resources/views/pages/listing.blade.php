@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
   
    <!-- Extra scripts specific to this page -->
    <script type="text/javascript">
        function addPurchaseForm() {
            $form = "<input type='text' placeholder='Enter Qty'></input>";
            $confirm = "<button type='button'>Confirm Purchase</button>";
            $total = "<p>Total Price: $XXXX </p>";
        
            GEBI("buyForm").innerHTML = $form + $total + $confirm ;
        }
    </script>
    

    
        
    <div id = "temporaryBox">
        
        <div class="grid-item" id="company_details"><b>{{$data[0]->company_name}}</b><br>{{$data[0]->gics_industry}}</div>
        
        
        <table>
            <tr>
                <th>Company Name</th>
                <td>{{$data[0]->company_name}}</td>
            <tr>
            <tr>
                <th>Industry</th>
                <td>{{$data[0]->gics_industry}}</td>
            <tr>
            <tr>
                <th>ASX Company Code</th>
                <td>{{$data[0]->company_code}}</td>
            <tr>
            <tr>
                <th>Current Stock Price</th>
                <td>...</td>
            <tr>
        </table>
        <form>
            <button type='button' onclick="addPurchaseForm()">Buy Shares</button>
            <div id="buyForm" class="grid-item"></div>
        </form>
    

    
    </div>
    
  
    

    <!-- END OF CONTENT -->

@endsection