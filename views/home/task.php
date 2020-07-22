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
    <h2 class="text-center">My Task <i class="fas fa-tasks"></i></h2> 
    <div class="text-center"  style="position: fixed;">
        <button ng-click="goTo('task/mytask')" class="btn btn-success"><i class="fas fa-thumbtack    "></i> My task <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
    </div>
    <div ng-controller="taskCtrl">
        <div ng-repeat="item in allTask track by $index" class="bg-warning mb-2 p-3" style="border-radius: 15px;">
            <div>
                <i class="fas fa-laugh-wink"></i>
                <span ng-bind="item.name"></span>
            </div>
            <div>
                Get date : <span ng-bind="item.get_date"></span> 07:15<br>
                Start date : <span ng-bind="item.start_date"></span> 08:15<br>
                Stop date : <span ng-bind="item.stop_date"></span> 08:15<br>
                <span ng-bind="item.price"></span> <i class="fas fa-rupee-sign"></i> <button ng-disabled="currentExist" class="btn btn-primary btn-sm" ng-click="getTask(item.id)">Get <i class="fab fa-get-pocket"></i></button>
            </div>
        </div>
    </div>
</body>
</html>