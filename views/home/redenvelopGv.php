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
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <div ng-controller="redCtrl">
        <div ng-if="redEnvelopData.length == 0" class="bg-danger w-100 mt-2 p-5 mt-5 text-center">
            Sorry, this red envelope code does not exist or already used !
        </div>
        <div ng-if="redEnvelopData.length != 0" ng-repeat="item in redEnvelopData track by $index" class="bg-success w-100 mt-2 p-5 mt-5 text-center">
            Price : <span ng-bind="item.send_value"></span> <i class="fas fa-rupee-sign"></i>
            <button class="btn btn-primary btn-sm" ng-click="get(item.id, '<?php echo $_SESSION['user_loggeg']['id']; ?>');redirectTo('/')">Get <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        </div>
    </div>
</body>
</html>