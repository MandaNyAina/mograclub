<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <title>Password</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">Account security <i class="fas fa-user-secret    "></i></h2> 
    <div ng-controller="pswController">
        <form name="myForm" method="post">
            <div class="form-group">
                <label for="older">Older password</label>
                <input ng-model="older" name="older" id="older" type="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new">New password</label>
                <input ng-change="passwordChange()" ng-model="password" name="password" id="password" type="password" class="form-control {{PassclassPass}}">
                <span ng-show="myForm.password.$touched && errorPassLength" class="text-danger" style="margin-top: -2px;font-size:10px">The password length must be 8 characters</span>
            </div>
            <div class="form-group">
                <label for="confirm">Confirm</label>
                <input ng-change="passwordAbort()" ng-model="confirm" name="confirm" id="confirm" type="password" class="form-control {{PassConfclassPass}}">
                <span ng-show="myForm.confirm.$touched && errorNotMatch" class="text-danger" style="margin-top: -2px;font-size:10px">The password is not match</span>
            </div>
            <div>
                <button ng-disabled="cantPost" ng-click="send('<?php echo $_SESSION['user_loggeg']['id'] ?>',older,password)" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</body>
</html>