@extends('layouts/main-template')

@section('content')
    <script type = "text/javascript" src = "{{ URL::to('/js/stockmarket.js') }}"></script>
    {{--  <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>  --}}
    {{--  <script src="https://code.highcharts.com/highcharts.js"></script>  --}}

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
   

    
        
    <div id = "temporaryBox">
    <div id = "asx_code">{{$symbol}}</div>
        <div class="grid-item" id="company_details"></div>

    </div>
    <script type="text/javascript">
        function getCompanyName(symbol) {
            var mysym = symbol;
            var asx_results;
        
            
            $.ajax({
                
                url: "/listing/companycode/" + symbol,
                success: function (results) {
                    asx_results = results;
        
                    if (results != '') {
                        $("#company_details").html("<b>" + results[0]['company_name'] + "</b><br>" + results[0]['gics_industry']);
                    } else{
                        $("#company_details").html("<b>No companies found matching that ASX code</b>");
                    }
                }
            });
        }

        getCompanyName(document.getElementById("asx_code").textContent);
        

    </script>
    
    <!-- END OF CONTENT -->

@endsection