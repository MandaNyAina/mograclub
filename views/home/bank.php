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
            Your current bank : 
            <div class="mt-2" ng-if="typeBank">
                <b>Type :</b> {{typeBank}}<br>
                <b>Mail :</b> {{mailBank}}<br>
                <b>Expires date :</b> {{expBank}}
            </div>
        </div>
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
    </div>
</body>
</html>