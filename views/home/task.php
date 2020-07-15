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
    <div ng-controller="taskCtrl">
        <div ng-repeat="item in allTask track by $index" class="bg-warning mb-2 p-3" style="border-radius: 15px;">
            <div>
                <i class="fas fa-laugh-wink"></i>
                <span ng-bind="item.name"></span>
            </div>
            <div>
                <span ng-bind="item.get"></span> <br>
                <span ng-bind="item.start_date"></span> <br>
                <span ng-bind="item.stop_date"></span> <br>
                <span ng-bind="item.price"></span> <i class="fas fa-rupee-sign"></i> <button class="btn btn-primary btn-sm">Get <i class="fab fa-get-pocket"></i></button>
            </div>
        </div>
    </div>
</body>
</html>