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
    <div class="pt-4 pb-4 pl-5 pr-5 w-100 text-center mt-4">
        <form name="myForm" method="POST" action="../../controller/paiement/paiement.controller.php?type=save" ng-controller="bankCtrl">
            <div class="form-group">
              <label for="nameAcc">Actual name</label>
              <input required type="text" name="nameAccount" id="nameAccount" class="form-control text-center" placeholder="Actual name" ng-model="name">
            </div>
            <div class="form-group">
              <label for="ifcs">IFSC code</label>
              <input required type="text" name="ifcs" id="ifcs" class="form-control text-center" placeholder="IFSC code"  ng-model="ifcs">
            </div>
            <div class="form-group">
              <label for="numberAcc">Account number</label>
              <input required type="text" name="numberAcc" id="numberAcc" class="form-control text-center" placeholder="Account number"  ng-model="number">
            </div>
            <div class="form-group">
              <label for="state">State</label>
              <input required type="text" name="state" id="state" class="form-control text-center" placeholder="State"  ng-model="state">
            </div>
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" name="city" id="city" class="form-control text-center" placeholder="City"  ng-model="city">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input required type="text" name="address" id="address" class="form-control text-center" placeholder="Address"  ng-model="address">
            </div>
            <div class="form-group">
              <label for="mobile">Mobile number</label>
              <input type="text" name="mobile" id="mobile" class="form-control text-center" placeholder="Mobile number"  ng-model="mobile">
            </div>
            <div class="form-group">
              <label for="emailAcc">Email</label>
              <input required type="email" name="emailAcc" id="emailAcc" class="form-control text-center" placeholder="Email"  ng-model="email">
            </div>
            <div class="form-group">
                <label for="otpverif">OTP verication</label>
                <div class="input-group">
                    <input required type="text" class="form-control text-center" ng-model="otpverif" ng-change="checkValidator(otpverif)" name="otpverif">
                    <div class="input-group-append">
                        <button ng-disabled="loader || myForm.emailAcc.$invalid" ng-click="sendMail(email)" type="button" class="btn btn-success">OTP <div ng-if="loader" class="loader">Loading...</div></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button ng-disabled="myForm.$invalid || !otpok" type="submit" class="btn btn-success w-100">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</body>
</html>