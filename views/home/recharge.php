<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="text-center">Recharge your account</h2>
    <form action="/"  ng-controller="rechargeCtrl" name="myForm">
        <div class="input-group">
            <div class="form-group">
                <input type="number"  min="60" class="form-control" name="recharge" ng-model="recharge" id="" ng-change="valueAdd(recharge)" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Enter your recharge value minimal 60 (value in Rupees)</small>
            </div>
            <div>
                <button ng-disabled="canAdd" class="btn btn-success input-group-append" ng-click="addBalance('<?php echo $_SESSION['user_loggeg']['id'] ?>',recharge)">Add</button>
            </div>
        </div>
        
    </form>
</body>
</html>