<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>Document</title>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">My account <i class="fa fa-user-circle" aria-hidden="true"></i></h2> 
    <form ng-controller="accountCtrl" name="myForm" method="post">
        <table class="table table-borderless">
            <tr>
                <td>
                    First name
                </td>
                <td>
                    <input required class="form-control" type="text" name="fname" ng-model="fname"/>
                </td>
            </tr>
            <tr>
                <td>
                    Last name
                </td>
                <td>
                    <input required class="form-control" type="text" name="lname" ng-model="lname"/>
                </td>
            </tr>
            <tr>
                <td>
                    Phone
                </td>
                <td>
                    <input required class="form-control" type="text" name="phone" ng-model="phone"/>
                </td>
            </tr>
            <tr>
                <td>
                    Mail
                </td>
                <td>
                    <input  class="form-control" type="text"  ng-model="mail" name="mail"/>
                </td>
            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input class="form-control" type="password" ng-model="password" name="password" required/>
                </td>
            </tr>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <button ng-disabled="!myForm.$dirty || myForm.$invalid" ng-click="save({'id':'<?php echo $_SESSION['user_loggeg']['id'] ?>','first_name':myForm.fname.$modelValue,'last_name':myForm.lname.$modelValue,'phone':myForm.phone.$modelValue,'mail':myForm.mail.$modelValue,'password':myForm.password.$modelValue})" class="btn btn-success">Save</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>