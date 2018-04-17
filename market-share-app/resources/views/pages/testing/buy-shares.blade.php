@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
<h1>{{$balance}}</h1>
    <!-- END OF CONTENT -->
<?php
    use App\Http\Controllers\MarketDataController;
                            // query userid in open transactions table
                            $json = DB::table('open_transactions')->where('user_id', '=',2)
                                ->get();
                            $data = json_decode($json);
                            //print_r($data);
                            if (empty($data)) {
                                echo "this works";
                            }
?>
@endsection