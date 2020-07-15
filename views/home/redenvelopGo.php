<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">Red envelop <i class="fas fa-mail-bulk"></i></h2> 
    <div ng-controller="redCtrl">
        <div class="form-group">
            <label for="">Type</label>
            <select class="form-control" ng-model="type">
                <option value=""></option>
                <option value="fixed">Fixed red envelope</option>
                <option value="lucky">Lucky red envelope</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Total</label>
            <input type="number" class="form-control" ng-model="total">
        </div>
        <div class="form-group">
            <label for="">Numbers of Red-Envelope</label>
            <input type="number" class="form-control" ng-model="number">
        </div>
        <div class="form-group">
            <form name="myFormOtp">
                <label for="">OTP verication</label>
                <div class="input-group">
                    <input type="text" class="form-control" ng-model="otpverif" ng-change="checkCode(otpverif)" name="otpverif">
                    <div class="input-group-append">
                        <button ng-disabled="loader" ng-click="sendMail()" type="button" class="btn btn-success">OTP <div ng-if="loader" class="loader">Loading...</div></button>
                    </div>
                </div>
                <span ng-if="!verified && myFormOtp.otpverif.$touched && otpverif" class="text-danger text-center">Code not match</span>
            </form>
            
        </div>
        <div>
            <button ng-disabled="!verified || !total || !number || !type" class="w-100 btn btn-warning" data-toggle="modal" data-target="#exampleModalLong4">Put in</button>
            <button ng-click="goTo('redenvelop/record')" class="w-100 btn btn-secondary mt-2 mb-2">Records</button>
        </div>
        <div class="modal fade" id="exampleModalLong4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirm your password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Enter your password
                <input type="password" ng-model="password" class="form-control" placeholder="Your password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                    ng-click="send({
                        user_id:'<?php echo $_SESSION['user_loggeg']['id']; ?>',
                        type,
                        total,
                        number,
                        password
                    })"  data-dismiss="modal"
                >Send</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>