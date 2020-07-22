<?php
    include '../../config/phpqrcode/qrlib.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ul {
            list-style-type: square;
            list-style-position: outside;
            list-style-image: none;
        }
    </style>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">My promotion <i class="fa fa-paint-brush" aria-hidden="true"></i></h2> 
    <div>
        <table class="table table-bordered table-hover table-sm w-50 text-center mx-auto">
            <tr>
                <td ng-click="goTo('promotion/invite')">
                    Invite my friend <i class="float-right  fas fa-house-damage"></i> 
                </td>
            </tr>
        </table>
        <table class="table table-bordered mimtable bg-light" ng-controller="promotionCtrl">
            <tr>
                <!-- <td class="w-50 text-center">
                    Your bonus : <span ng-bind="bonus">Loading ...</span> <i class="fas fa-rupee-sign    "></i>
                    <div>
                        <button ng-click="convert(bonus)" class="btn btn-primary btn-sm mt-2">Add to your balance</button>
                    </div>
                </td> -->
                <td class="w-50">
                    <div class="text-center">The promotion bonus will be send in your balance. </div> 
                    Active member today : <span ng-bind="active"></span><br>
                    Total people : <span ng-bind="people"></span><br>
                    Contribution : <span ng-bind="contribution"></span><i class="fas fa-rupee-sign"></i>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>