<?php
    require '../../index.php';
    $id = $_SESSION['user_loggeg']["id"];
    $code = $database->select("t_reward","*","id_user='$id'")['id_para'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>Admin</title>
    <style>
        .loader {
            display: inline-block;
            margin-left: 10px;
            color: #ffffff;
            font-size: 10px;
            text-indent: -9999em;
            overflow: hidden;
            width: 1em;
            height: 1em;
            border-radius: 50%; 
            position: relative;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            animation: load6 1.7s infinite ease, round 1.7s infinite ease;
            }
            @-webkit-keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            }
            @keyframes load6 {
            0% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            5%,
            95% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            10%,
            59% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
            }
            20% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
            }
            38% {
                box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
            }
            100% {
                box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
            }
            }
            @-webkit-keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }
            @keyframes round {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body ng-controller="adminCtrl">
    <div class="w-100 bg-light" style="height: 22vh;background-image: url(../../assets/images/bannier.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <h2 class="text-center text-light pt-5" style="opacity: 0.7;">
            Hello Admin
        </h2>
    </div>
    <div class="btn-group mx-auto w-100" style="position: sticky;top: 0;z-index: 10;">
        <a class="btn btn-primary btn-sm" href="admin.php"><i class="fas fa-user-shield"></i><span class="menuMaxLength"> Admin service</span></a>
        <a class="btn btn-primary btn-sm" href="adminComplaint.php"><i class="fab fa-facebook-messenger"></i><span class="menuMaxLength"> Complaints</span>
            <div ng-if="nbrComplaint != 0" class="bg-danger" style="width: 18px;height: 18px; display: inline-block;border-radius: 50%;font-size: 12px;" ng-bind="nbrComplaint"></div>
        </a>
        <a class="btn btn-outline-primary btn-sm" href="adminSetting.php"><i class="fas fa-user-cog"></i><span class="menuMaxLength"> Account setting</span></a>
        <a class="btn btn-secondary btn-sm"  href="../../controller/delog/delog.controller.php"><i class="fas fa-sign-out-alt"></i><span class="menuMaxLength"> Logout</span></a>
    </div>
    <form action="../../controller/admin/admin.controller.php?form=reset" method="post">
        <table class="table table-borderless">
            <tr>
                <td colspan="3" class="text-center bg-light">
                    Default setting <i class="fas fa-user-cog"></i>
                </td>
            </tr>
            <tr>
                <td style="width: 30%;" colspan="2">
                    <button type="button" class="w-100 btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Invitation code</button>
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-body">
                                Code : 
                                <input type="text" class="form-control mb-2" readonly value="<?php echo $code ?>">
                                QR-Code :
                                <div class="w-100 text-center">
                                    <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{links}}&choe=UTF-8" title="Link to invitation code" />
                                </div>
                                Link :
                                <input type="text" class="form-control" readonly ng-value="links">
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="width: 30%;">Password</td>
                <td>
                    <div class="input-group">
                        <input type="password" required name="password" class="form-control">
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td style="width: 30%;">Default payment</td>
                <td>
                    <select required class="form-control" name="defaultPay">
                        <option value="paypal">Paypal</option>
                        <option value="gpay">Google pay</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <button class="btn btn-success" type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <form action="../../controller/admin/admin.controller.php?form=paypal" method="post">
        <table class="table table-borderless">
            <tr>
                <td colspan="3" class="text-center bg-light">
                    Your Paypal account <i class="fab fa-paypal"></i>
                </td>
            </tr>
            <tr>
                <td>Adress mail</td>
                <td colspan="2"><input type="email" required class="form-control" name="paypalMail" ng-model="paypalMail"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td colspan="2"><input type="password" required class="form-control" name="paypalPassword" ng-model="paypalPassword"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-center">
                    <button class="btn btn-success" type="submit">Save</button>
                </td>
            </tr>
        </table>
    </form>
    <form action="../../controller/admin/admin.controller.php?form=gpay" method="post">
        <table class="table table-borderless">
            <tr>
                <td colspan="3" class="text-center bg-light">
                    Your Google Pay Account <i class="fab fa-google"></i>
                </td>
            </tr>
            <tr>
                <td>Adress mail</td>
                <td colspan="2"><input type="email" required class="form-control" name="gpayMail" ng-model="gpayMail"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td colspan="2"><input type="password" required class="form-control" name="gpayPassword" ng-model="gpayPassword"></td>
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