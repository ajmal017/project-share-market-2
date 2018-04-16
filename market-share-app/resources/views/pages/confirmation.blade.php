@extends('layouts/main-template')

@section('content')

    <!-- PAGE SPECIFIC CONTENT GOES HERE -->
    <div class = "sysoContent sysoContent50" id="listingContent">
        <?php
            use App\Http\Controllers\ShareTransactionController;
            use App\Http\Controllers\ListingsController;
            $quantity = $_GET['qty'];
            $companycode = $_GET['code'];
            
            //add try and catch block
            $price = ListingsController::getCurrentPrice($companycode);
            ShareTransactionController::buyShares($companycode,$price, $quantity)
        ?>
    </div>
    <!-- END OF CONTENT -->

@endsection