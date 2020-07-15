<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .select:hover {
            box-shadow: 2px 5px 8px 2px grey;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div>
        <button ng-click="goTo('bank')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <div class="pt-4 pb-4 pl-5 pr-5 w-100 text-center mt-4 select" style="border-radius: 5px; border: 1px solid grey; display: inline-block;">
        PayPal <i class="fab fa-paypal"></i>
    </div>
    <div class="pt-4 pb-4 pl-5 pr-5 w-100 text-center mt-4 select" style="border-radius: 5px; border: 1px solid grey; display: inline-block;">
        Google Pay <i class="fab fa-google-wallet" aria-hidden="true"></i>
    </div>
    <div class="pt-4 pb-4 pl-5 pr-5 w-100 text-center mt-4 select" style="border-radius: 5px; border: 1px solid grey; display: inline-block;">
        PhoneEp <i class="fa fa-phone-square" aria-hidden="true"></i>
    </div>
    <div class="pt-4 pb-4 pl-5 pr-5 w-100 text-center mt-4 mb-2 select" style="border-radius: 5px; border: 1px solid grey; display: inline-block;">
        Paytm <i class="fa fa-id-card" aria-hidden="true"></i>
    </div>
</body>
</html>