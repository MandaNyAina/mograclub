<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">My Bank <i class="fa fa-credit-card" aria-hidden="true"></i></h2>
    <div ng-controller="bankCtrl">
        <div class="p-3" style="border: 1px black solid;">
            Your bank : 
            <div ng-if="!setting">
                <button class="btn btn-primary btn-sm w-100" ng-click="goTo('addBank')">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            
            <div ng-if="setting" class="mt-3">
                <form name="myForm" method="POST" action="../../controller/paiement/paiement.controller.php?type=update">
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
                        <input required type="text" name="emailAcc" id="emailAcc" class="form-control text-center" placeholder="Email"  ng-model="email">
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
                        <button ng-disabled="myForm.$invalid || !otpok" type="submit" class="btn btn-success w-100">Save</button>
                    </div>
                    <div class="form-group">
                        <a href="../../controller/paiement/paiement.controller.php?type=delete" class="btn btn-danger w-100">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>
                </form>
            </div>
            <!--
            <div class="mt-2" ng-if="typeBank">
                <b>Type :</b> {{typeBank}}<br>
                <b>Mail :</b> {{mailBank}}<br>
                <b>Expires date :</b> {{expBank}}
            </div>
            -->
        </div>
        <!--
        <div class="p-3 mt-2" style="border: 1px black solid;">
            Change your bank? <input type="checkbox" class="checkbox-inline" ng-model="changeBank">
            <div ng-if="changeBank">
                <small id="typeId" class="form-text text-muted">Type</small>
                <select ng-model="typeValue" ng-change="change(typeValue)" aria-describedby="typeId" class="form-control w-50">
                    <option></option>
                    <option value="PayPal">PayPal</option>
                    <option value="Master">Master card</option>
                    <option value="Google">Google pay</option>
                    <option value="Paytm">Paytm</option>
                    <option value="Phone">Phone pay</option>
                    <option value="Amazon">Amazon pay</option>
                    <option value="Bhim">Bhim upi</option>
                    <option value="Perfectmoney">Perfectmoney</option>
                </select>
                <div class="mt-2" ng-if="typeValue == 'PayPal'">
                    <form name="paypalForm">
                        <small id="typeId" class="form-text text-muted">Your e-mail address</small>
                        <input type="email" class="form-control" name="bankMail" ng-model="bankMail" required>
                        <center><button type="submit" ng-disabled="paypalForm.bankMail.$invalid" ng-click="saveBankPaypal(bankMail)" class="btn btn-success mt-2">Save</button></center>
                    </form>
                </div>
                <div class="mt-2" ng-if="typeValue == 'Master'">
                    <form name="masterForm">
                        <small id="typeId" class="form-text text-muted">Numero</small>
                        <input type="text" class="form-control" ng-model="bankNumer" name="bankNumer" required>
                        <small id="typeId" class="form-text text-muted">Code</small>
                        <input type="number" class="form-control" ng-model="bankCode" name="bankCode" required>
                        <small id="typeId" class="form-text text-muted">Date</small>
                        <input type="date" class="form-control" ng-model="bankDate" name="bankDate" required>
                        <center><button ng-disabled="masterForm.$invalid" ng-click="saveBankMaster({bankDate,bankCode,bankDate})" class="btn btn-success mt-2">Save</button></center>
                    </form>
                </div>
            </div>
        </div>
        -->
    </div>
</body>
</html>