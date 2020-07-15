<?php

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
        <button ng-click="goTo('redenvelop/start')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <div ng-controller="redCtrl">
        <div class="btn-group w-100 mt-2">
            <button ng-click="navTo(1)" id="btn1" class="btn btn-outline-primary">Given Record</button>
            <button ng-click="navTo(2)" id="btn2" class="btn btn-primary">Received Record</button>
        </div>

        <div ng-if="nav == 1" class="mt-2">
            <div ng-repeat="item in allSend track by $index" class="bg-light mb-2 p-2">
                Value : {{item.send_value}} <br>
                Date : {{item.date}} <br>
                Code : {{item.link}} <br>
                Link : <a href="{{varLink+'/'+item.link}}" target="_blank">{{varLink}}/{{item.link}}</a>
            </div>
        </div>

        <div ng-if="nav == 2" class="mt-2">
            <div ng-repeat="item in allReceived track by $index" class="bg-light mb-2 p-2">
                Value : {{item.received_value}} <br>
                Date : {{item.date}} <br>
            </div>
        </div>
    </div>
    

</body>
</html>