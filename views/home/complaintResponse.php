<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
</head>
<body>
    <div>
        <button ng-click="goTo('complaint')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">Response <i class="fa fa-reply-all" aria-hidden="true"></i></h2> 
    <div ng-controller="complaintCtrl">
        <div ng-if="responseById.length == 0"  style="border: 1px solid grey;" class="p-3 bg-light mt-3 text-center">
            You haven't a complaints or suggestion <br>
            <button ng-click="goTo('complaint/new')" class="btn btn-primary btn-sm">Create one <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
        </div>
        <div style="border: 1px solid grey;" class="p-3 bg-light mt-3" ng-repeat="item in responseById track by $index">
            <b>Ticket ID :</b> {{item.parent.ticket_id}} <br>
            <b>Date :</b> {{item.parent.date}} {{item.parent.time}} <br>
            <b>Type :</b> {{item.parent.message_type}} <br>
            <b>Details :</b> {{item.parent.message}} <br>
            <b>Status :</b> {{item.parent.solved | solving}} <br>
            Response ({{item.response.length}}) 
            <input type="checkbox" name="" id="" ng-model="interpretation[$index + 'A']">
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
                    Pas de reponse
                </div>

                <div ng-repeat="res in item.response track by $index">
                    <b>Sender :</b>
                    <span ng-if="res.id_user == '<?php echo $_SESSION["user_loggeg"]["id"] ?>'">You</span>
                    <span ng-if="res.id_user != '<?php echo $_SESSION["user_loggeg"]["id"] ?>'">Admin</span> <br>
                    <b>Response :</b> <br>
                    {{res.message}}
                    <hr>
                </div>
            </div>
        </div>
    </div>
</body>
</html>