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
            if (!ShareTransactionController::buyShares($companycode,$price, $quantity)) {
                echo "<h1>Error! Transaction failed. Please try again.</h1>";
            } else {
                echo "<h1>Success!</h1>";
                echo "<p>You have purchased ".$quantity." shares in ".$companycode;
            }
            
        ?>
        <button onclick="goBack()">Back to Listing</button>

    </div>
    <!-- END OF CONTENT -->

@endsection