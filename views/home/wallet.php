<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/sweetalert2/dist/sweetalert2.css">
    <style>
        .lds-facebook {
  position: absolute;
  align-content: center;
  width: 80px;
  height: 80px;
}
.lds-facebook div {
  display: inline-block;
  position: absolute;
  left: 15px;
  width: 16px;
  background: #fcf;
  animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
  left: 8px;
  animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
  left: 32px;
  animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
  left: 56px;
  animation-delay: 0;
}
@keyframes lds-facebook {
  0% {
    top: 8px;
    height: 64px;
  }
  50%, 100% {
    top: 24px;
    height: 32px;
  }
}

    </style>
</head>
<body>
    <div>
        <button ng-click="goTo('')" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</button>
    </div>
    <h2 class="text-center">My wallet <i class="fas fa-wallet"></i></h2> 
    <div ng-controller="walletCtrl">
        <div class="btn-group w-100">
            <button id="c_wallet" ng-click="walletNav('c')" class="btn btn-secondary w-50">Current <i class="fas fa-wallet    "></i></button>
            <button id="h_wallet" ng-click="walletNav('h')" class="btn btn-outline-secondary w-50">History <i class="fa fa-history" aria-hidden="true"></i></button>
        </div>
        
        <div class="bg-light mt-5 p-3 w-75 text-center mx-auto" style="font-weight: 25px;" ng-if="selected == 'c'">
            You have {{balanceValue}} <i class="fas fa-rupee-sign"></i> in your wallet <br>
            <a ng-click="choiceMenu('')" class="btn btn-warning btn-sm mt-3" href="#!/recharge">Add <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            <button ng-disabled="senderLoader" class="btn btn-warning btn-sm mt-3" data-toggle="modal" data-target="#exampleModalCenter1">Withdrawal</button>
            <div ng-if="senderLoader" class="position-absolute d-block mx-auto">
                <div class="lds-facebook"><div></div><div></div><div></div></div>
            </div>
        </div>

        <div ng-if="selected == 'h'">
            <table class="table table-bordered table-sm mt-5">
                <thead>
                    <th>Date and time</th>
                    <th>Price</th>
                    <th>From</th>
                </thead>
                <?php 
                    require '../../config/constant.php';
                    $id = $_SESSION['user_loggeg']["id"];
                    $row = $database->selectMore("t_recharge","*","id_user='$id'");
                    foreach ($row as $value) {
                        echo "<tr>";
                        echo "<td>".$value["date"]."</td>";
                        echo "<td>".$value["price"]."</td>";
                        echo "<td>".$value["type"]."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Withdrawal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Amount : <br>
                <input type="number" ng-model="amountWith" min="1" max="{{balanceValue}}" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="../../index.php" ng-disabled="balanceValue == 0 || !amountWith" class="btn btn-primary" ng-click="withdrawal('<?php echo $_SESSION['user_loggeg']['id']; ?>',amountWith)" data-dismiss="modal">Ok</a>
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>