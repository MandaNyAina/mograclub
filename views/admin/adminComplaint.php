<?php
    require '../../config/constant.php';
    $database->execute("UPDATE t_complaint SET is_read=1");
    $GLOBALS['database'] = $database;
    function nameById($id) {
        return $GLOBALS['database']->select("t_user_info","last_name","id='$id'")["last_name"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>Complaints</title>
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
            <a class="btn btn-outline-primary btn-sm" href="adminComplaint.php"><i class="fab fa-facebook-messenger"></i><span class="menuMaxLength"> Complaints</span></a>
            <a class="btn btn-primary btn-sm" href="adminSetting.php"><i class="fas fa-user-cog"></i><span class="menuMaxLength"> Account setting</span></a>
            <a class="btn btn-secondary btn-sm"  href="../../controller/delog/delog.controller.php"><i class="fas fa-sign-out-alt"></i><span class="menuMaxLength"> Logout</span></a>
        </div>
    </div>

    <div ng-if="item.parent.solved == 0" style="border: 1px solid grey;" class="p-3 bg-light mt-3" ng-repeat="item in responseAll track by $index">
            <b>Ticket ID :</b> {{item.parent.ticket_id}} <br>
            <b>Date :</b> {{item.parent.date}} {{item.parent.time}} <br>
            <b>Type :</b> {{item.parent.message_type}} <br>
            <b>Details :</b> {{item.parent.message}} <br>
            <b>Status :</b> {{item.parent.solved | solving}} <br>
            Response ({{item.response.length}}) <input type="checkbox" name="" id="" ng-model="interpretation[$index + 'A']">
            <div ng-if="interpretation[$index + 'A']" style="background-color: white;margin-left: 10%;border-radius: 10px" class="p-3 mt-2">
                <div class="input-group">
                    <input ng-disabled="item.parent.solved == 1" ng-model="item.res.id" type="text" class="form-control">
                    <div class="input-group-append">
                        <button ng-disabled="!item.res.id" class="btn btn-primary" ng-click="response(
                        '<?php echo $_SESSION["user_loggeg"]["id"] ?>',
                        {
                        message: item.res.id,
                        source: item.parent.ticket_id
                        })" type="reset">Send</button>
                    </div>
                    <button ng-disabled="item.parent.solved == 1" ng-click="solved(item.parent.id)" class="btn btn-success w-100 btn-sm mt-2 mb-2">Solved</button>
                </div>
                <div ng-if="item.response.length == 0" class="bg-light text-center m-2 p-2">
                    No answer
                </div>

                <div ng-repeat="res in item.response track by $index">
                    <b>Sender :</b>
                    <span ng-if="res.id_user == '<?php echo $_SESSION["user_loggeg"]["id"] ?>'">You</span>
                    <span ng-if="res.id_user != '<?php echo $_SESSION["user_loggeg"]["id"] ?>'"><?php echo "{{res.id_user}}" ?></span> <br>
                    <b>Response :</b> <br>
                    {{res.message}}
                    <hr>
                </div>
            </div>
        </div>
</body>
</html>