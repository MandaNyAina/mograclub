<?php
    include '../../config/phpqrcode/qrlib.php';
?>
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
    <h2 class="text-center">My promotion <i class="fa fa-paint-brush" aria-hidden="true"></i></h2> 
    <div>
        <table class="table table-bordered table-hover table-sm w-50 text-center mx-auto">
            <tr>
                <td ng-click="goTo('promotion/invite')">
                    Invite my friend <i class="float-right  fas fa-house-damage"></i> 
                </td>
            </tr>
        </table>
    </div>
</body>
</html>