<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <title>Complaint</title>
</head>
<body>
    <div>
        <button ng-click="goTo('complaint')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">New <i class="fa fa-plus-circle" aria-hidden="true"></i></h2> 
    <div ng-controller="complaintCtrl">
        <form name="myForm">
            <table class="table table-borderless">
                <tr>
                    <td class="w-25">Type</td>
                    <td>
                        <select required name="type" ng-model="type" id="" class="custom-select">
                            <option value=""></option>
                            <option value="Suggestion">Suggestion</option>
                            <option value="Consult">Consult</option>
                            <option value="Recharge problem">Recharge problem</option>
                            <option value="Withdraw problem">Withdraw problem</option>
                            <option value="Parity problem">Parity problem</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Details</td>
                    <td>
                        <textarea required ng-model="detail" name="detail" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Order ID</td>
                    <td>
                        <input ng-model="orderId" name="orderId" type="text" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button 
                        ng-disabled="myForm.$invalid" 
                        ng-click="send(
                            '<?php echo $_SESSION["user_loggeg"]["id"] ?>',
                            {
                            type: myForm.type.$modelValue,
                            detail: myForm.detail.$modelValue,
                            orderId: myForm.orderId.$modelValue
                        })" 
                        class="btn btn-primary btn-sm w-100">Send</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>