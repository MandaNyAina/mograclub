<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <title>Document</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">My Address <i class="fa fa-address-book" aria-hidden="true"></i></h2>
    <div ng-controller="addressCtrl" >
        <div class="p-3" style="border: 1px black solid;">
            Your current address : 
            <div>
                {{address}}
            </div>
        </div>
        <div class="p-3 mt-2" style="border: 1px black solid;">
            <form name="myForm">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td colspan="2">
                            <label for="change">Change your address : </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" ng-model="change" name="change" id="change" required>
                        </td>
                        <td>
                            <button ng-disabled="myForm.$invalid" ng-click="setAddress(myForm.change.$modelValue)" type="submit" class="btn btn-success">Set</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>