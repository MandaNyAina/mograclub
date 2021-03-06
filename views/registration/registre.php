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
    <title>Registration</title>
</head>
<body ng-controller="registreCtrl">
    <form action="../../controller/registration/registration.controller.php" method="POST" name="myForm">
        
    <table class="table table-borderless mx-auto registreForm">
            <thead>
                <th colspan="2" class="bg-light text-dark text-center">
                <a href="../../index.php" class="btn btn-primary btn-sm float-left"><i class="fa fa-caret-left" aria-hidden="true"></i> Go to home</a>
                    REGISTRATION
                </th>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['form_vide']) && $_SESSION['form_vide']) { ?>
                <tr>
                    <td colspan="2" class="alert alert-danger text-center">
                        Value invalid
                    </td>
                </tr>
                <?php } $_SESSION['form_vide'] = false; ?>
                <?php if (isset($_SESSION['not_save_exist']) && $_SESSION['not_save_exist']) { ?>
                <tr>
                    <td colspan="2" class="alert alert-danger text-center">
                        Username already exist
                    </td>
                </tr>
                <?php } $_SESSION['not_save_exist'] = false; ?>
                <?php if (isset($_SESSION['not_save_error']) && $_SESSION['not_save_error']) { ?>
                <tr>
                    <td colspan="2" class="alert alert-danger text-center">
                        Error to save your account
                    </td>
                </tr>
                <?php } $_SESSION['not_save_error'] = false; ?>
                <?php if (isset($_SESSION['invite_code_error']) && $_SESSION['invite_code_error']) { ?>
                <tr>
                    <td colspan="2" class="alert alert-danger text-center">
                        Invitation code ivalid
                    </td>
                </tr>
                <?php } $_SESSION['invite_code_error'] = false; ?>
                <tr>
                    <td style="width: 40%;">First name</td>
                    <td><input required name="fname" id="fname" type="text" class="form-control"></td>
                </tr>
                <tr>
                    <td>Last name</td>
                    <td><input required name="lname" id="lname" type="text" class="form-control"></td>
                </tr>
                <tr>
                    <td>E-mail address</td>
                    <td>
                        <input required ng-change="changeMail()" name="mail" id="mail" type="email" ng-model="mail" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>Your address</td>
                    <td>
                        <textarea required name="aname" id="aname" type="text" class="form-control"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>
                        <div class="input-group">
                            <!-- <div class="input-group-prepend w-25">
                                <select required ng-model="indicatif" name="indicatif" style="position:relative" name="" id="" class="input-group-text custom-select float-left">
                                    <option value="">Country</option>
                                    <option value="{{item.dial_code}}" ng-repeat="item in indicatifList | orderBy:'name'"> {{item.dial_code}} {{item.code}} {{item.name}}</option>
                                </select>
                            </div> -->
                            <input required name="phone" id="phone" type="number" ng-model="phone" maxlength="10" minlength="9" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input required name="username" id="username" type="text" class="form-control"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input ng-change="passwordChange()" ng-model="password" name="password" id="password" type="password" class="form-control {{PassclassPass}}">
                        <span ng-show="myForm.password.$touched && errorPassLength" class="text-danger" style="margin-top: -2px;font-size:10px" ng-bind="'The password length must be 8 characters'"></span>
                    </td>
                </tr>
                <tr>
                    <td>Confirm</td>
                    <td>
                        <input ng-change="passwordAbort()" ng-model="confirm" name="confirm" id="confirm" type="password" class="form-control {{PassConfclassPass}}">
                        <span ng-show="myForm.confirm.$touched && errorNotMatch" class="text-danger" style="margin-top: -2px;font-size:10px" ng-bind="'The password is not match'"></span>
                    </td>
                </tr>
                <tr>
                    <td>Invitation code</td>
                    <td>
                        <input required ng-model="invite" ng-value="'<?php echo @$_GET['key'] ?>'" name="invite" id="invite" type="text" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button ng-disabled="invalid" class="btn btn-success">Register <i class="fas fa-save"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</body>
</html>
