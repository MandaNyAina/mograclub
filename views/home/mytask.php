<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <button ng-click="goTo('task')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <div ng-controller="taskCtrl">
        <div class="btn-group w-100 mt-2 mb-2">
            <button id="btn1" ng-click="navTo(1)" class="btn btn-outline-primary">All</button>
            <button id="btn2" ng-click="navTo(2)" class="btn btn-primary">Finish</button>
        </div>
        <div ng-if="nav == 1">
            <div class="bg-light p-3 mt-2" ng-repeat="item in all track by $index">
                <span ng-bind="item.name"></span> <br>
                Price : <span ng-bind="item.price"></span> <i class="fas fa-rupee-sign"></i> <br>
                Completed : <span ng-bind="item.completed"></span> <br>
                Link : <input type="text" ng-model="links+''+item.key" readonly class="form-control"> <br>
                <button ng-if="item.etat == 0 && item.status == 'close'" class="btn disabled btn-secondary-sm disabled">Unfinish</button>
                <button ng-if="item.etat == 1 && item.status == 'close'" class="btn disabled btn-secondary-sm disabled">Finish</button>
            </div>
        </div>
        <div ng-if="nav == 2">
            <div class="bg-light p-3  mt-2" ng-repeat="item in finish track by $index">
                <span ng-bind="item.name"></span> <br>
                Price : <span ng-bind="item.price"></span> <i class="fas fa-rupee-sign"></i> <br>
                Completed : <span ng-bind="item.completed"></span>
            </div>
        </div>
    </div>
</body>
</html>