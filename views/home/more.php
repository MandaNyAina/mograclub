<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More</title>
</head>
<body>
    <div>
        <button ng-click="goBackMore()" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <div ng-controller="appCtrl">
        <table class="table table-bordered mt-4">
            <thead class="bg-light">
                <th>Period</th>
                <th>Price</th>
                <th>Number</th>
                <th>Result</th>
            </thead>
            <tbody>
                <tr ng-repeat="item in moreData track by item.period">
                    <td>{{item.period}}</td>
                    <td>{{item.price}}</td>
                    <td>{{item.number}}</td>
                    <td>
                        <div ng-repeat="i in item.result.split(',') track by $index" class="{{i}} mr-2" style="width: 15px; height: 15px; border-radius: 50%;display: inline-block;">

                        </div>
                    </td>    
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>