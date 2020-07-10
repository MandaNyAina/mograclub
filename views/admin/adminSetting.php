<?php
    require '../../index.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>Admin</title>
</head>
<body ng-controller="adminCtrl">
    <div class="w-100 bg-light" style="height: 22vh;background-image: url(../../assets/images/bannier.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <h2 class="text-center text-light pt-5" style="opacity: 0.7;">
            Hello Admin
        </h2>
    </div>
    <div>
        <div class="btn-group mx-auto w-100" style="top: 0;position:sticky">
            <a class="btn btn-primary btn-sm" href="admin.php"><i class="fas fa-user-shield"></i><span class="menuMaxLength"> Admin service</span></a>
            <a class="btn btn-primary btn-sm" href="adminComplaint.php"><i class="fab fa-facebook-messenger"></i><span class="menuMaxLength"> Complaints</span>
                <div class="bg-danger" style="width: 18px;height: 18px; display: inline-block;border-radius: 50%;font-size: 12px;">1</div>
            </a>
            <a class="btn btn-outline-primary btn-sm" href="adminSetting.php"><i class="fas fa-user-cog"></i><span class="menuMaxLength"> Account setting</span></a>
            <a class="btn btn-secondary btn-sm"  href="../../controller/delog/delog.controller.php"><i class="fas fa-sign-out-alt"></i><span class="menuMaxLength"> Logout</span></a>
        </div>
    </div>
    <form action="../../controller/admin/admin.controller.php?form=reset" method="post">
        <table class="table table-borderless">
            <tr>
                <td style="width: 22%;">Password</td>
                <td style="width: 50%;"><input type="password" required name="password" class="form-control"></td>
                <td><button class="btn btn-danger">Reset </button></td>
            </tr>
        </table>
    </form>
    <form action="../../controller/admin/admin.controller.php?form=bank" method="post">
        <table class="table table-borderless">
            <tr>
                <td colspan="3" class="text-center bg-light">
                    Your Paypal account
                </td>
            </tr>
            <tr>
                <td>Adress mail</td>
                <td colspan="2"><input type="email" required class="form-control" name="mailPay" ng-model="mailPay"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td colspan="2"><input type="password" required class="form-control" name="passPay" ng-model="passPay"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <button class="btn btn-success" type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>