<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">    
    <script type="module" src="../../assets/js/script.js"></script>
    <title>Validation</title>
</head>
<body style="background-color: rgba(0, 0, 0, 0.801);">

    <div class="validator p-3" ng-controller="pswController">
        <a href="../../index.php" class="btn btn-primary btn-sm"><i class="fa fa-caret-left" aria-hidden="true"></i> Go to home</a>
        <form class="m-2" method="POST" name="myForm" ng-hide="valideTrue">
            Enter your phone email address : 
            <?php if(isset($_SESSION['error_num']) && $_SESSION['error_num']) { ?>
            <div class="alert alert-danger text-center">
                Error email address
            </div>
            <?php } $_SESSION['error_num'] = false;?>
            <div class="input-group">
                <input ng-model="response" name="response" id="response" class="form-control" required />
                <div class="input-group-append">
                    <button ng-disabled="myForm.$invalid" class="btn btn-primary" ng-click="recover(response)" type="submit">Send <i ng-if="loader" class="spinner-border" style="width: 15px;height: 15px;border: 2px black dashed;"></i> </button>
                </div>
            </div>
        </form>

        <div ng-show="valideTrue">
            <p>Choose your account : </p>
            <div ng-repeat="item in results">
                <p><a href="../../controller/recoverPassword/recover.controller.php?user={{item.id}}"><i class="fa fa-angle-right" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i> {{item.first_name}} {{item.last_name}} <br>(Phone : {{item.phone}})</a></p>
            </div>
        </div>
    </div>
</body>
</html>