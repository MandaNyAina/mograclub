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
            <a class="btn btn-outline-primary btn-sm" href="admin.php"><i class="fas fa-user-shield"></i><span class="menuMaxLength"> Admin service</span></a>
            <a class="btn btn-primary btn-sm" href="adminComplaint.php"><i class="fab fa-facebook-messenger"></i><span class="menuMaxLength"> Complaints</span>
                <div ng-if="nbrComplaint != 0" class="bg-danger" style="width: 18px;height: 18px; display: inline-block;border-radius: 50%;font-size: 12px;" ng-bind="nbrComplaint"></div>
            </a>
            <a class="btn btn-primary btn-sm" href="adminSetting.php"><i class="fas fa-user-cog"></i><span class="menuMaxLength"> Account setting</span></a>
            <a class="btn btn-secondary btn-sm"  href="../../controller/delog/delog.controller.php"><i class="fas fa-sign-out-alt"></i><span class="menuMaxLength"> Logout</span></a>
        </div>
    </div>
    <div class="searchBar mt-3 mb-3 p-4" style="border: 1px black solid;">
        <div class="input-group">
            <input ng-model="searchValue" type="text" class="form-control" placeholder="Search an person">
            <div class="input-group-append">
                <button ng-click="onSearch(searchValue)" class="btn btn-primary btn"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="mt-2">
            <div ng-if="results.length == 0">
                No result
            </div>
            <div ng-repeat="i in results">
                <div class="mt-2">
                    <b>ID</b>: <span ng-bind="i.id"></span><br>
                    <b>First name :</b> <span ng-bind="i.first_name"></span><br>
                    <b>Last name :</b> <span ng-bind="i.last_name"></span><br>
                    <b>Phone :</b> <span ng-bind="i.phone"></span><br>
                    <b>Address :</b> <span ng-bind="i.address"></span><br>
                    <b>Mail :</b> <a href="mailto:{{i.mail}}"><span ng-bind="i.mail"></span></a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-sm table-striped text-center table-success mimtable">
        <thead class="text-light text-dark">
            <th class="w-25">Number of player</th>
            <th class="w-25">Price profit</th>
            <th class="w-25">Winner</th>
        </thead>
        <tbody>
            <tr>
                <td ng-bind="nbrOfPlayer">Loading ..,</td>
                <td ng-bind="amount">Loading ...</td>
                <td ng-bind="winner">Loading ...</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-primary text-center table-bordered table-sm table-striped mimtable">
        <thead class="text-light text-dark">
            <th>Group</th>
            <th>Amount bided</th>
            <th>Winner value</th>
        </thead>
        <tbody>
            <tr>
                <td>Agate</td>
                <td ng-bind="agate">Loading ...</td>
                <td ng-bind="w_agate">Loading ...</td>
            </tr>
                <td>Beryl</td>
                <td ng-bind="beryl">Loading ...</td> 
                <td ng-bind="w_beryl">Loading ...</td>
            </tr>
            <tr>
                <td>Celestine</td>
                <td ng-bind="celestine">Loading ...</td>
                <td ng-bind="w_celestine">Loading ...</td>
            </tr>
            <tr>
                <td>Diamond</td>
                <td ng-bind="diamond">Loading ...</td>
                <td ng-bind="w_diamond">Loading ...</td>
            </tr>
            <tr>
                <td>Emerald</td>
                <td ng-bind="emerald">Loading ...</td>
                <td ng-bind="w_emerald">Loading ...</td>
            </tr>
            <tr>
                <td>Flint</td>
                <td ng-bind="flint">Loading ...</td>
                <td ng-bind="w_flint">Loading ...</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-warning text-center table-bordered table-sm">
        <thead class="text-light text-dark">
            <th class="w-50">Wallet</th>
            <th class="w-50">Wallet profit</th>
        </thead>
        <tbody>
            <td>
                <span ng-bind="wallet">Loading ...</span> <br>
                <!-- <button data-toggle="modal" data-target="#sendMoney1"  class="btn btn-outline-warning btn-sm">Send</button></td> -->
            <td>
                <span ng-bind="profit">Loading ...</span> <br> 
                <!-- <button data-toggle="modal" data-target="#sendMoney2"  class="btn btn-outline-warning btn-sm">Send</button></td>-->
            </td>
        </tbody>
    </table>

    <div class="modal fade" id="sendMoney1" tabindex="-1" role="dialog" aria-labelledby="sendMoneyTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="sendMoneyTitle">SEND MONEY FROM WALLET</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div>
                    Enter the amount <br>
                    <input type="number" class="form-control" ng-model="amountWallet">
                    Choose the payment
                    <select class="form-control" ng-model="walletPay">
                        <option value=""></option>
                        <option value="PayPal">PayPal</option>
                        <option value="Master">Master card</option>
                        <option value="Google">Google pay</option>
                        <option value="Paytm">Paytm</option>
                        <option value="Phone">Phone pay</option>
                        <option value="Amazon">Amazon pay</option>
                        <option value="Bhim">Bhim upi</option>
                        <option value="Perfectmoney">Perfectmoney</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" ng-disabled="!amountWallet || !walletPay" class="btn btn-primary" data-dismiss="modal">Send</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="sendMoney2" tabindex="-1" role="dialog" aria-labelledby="sendMoneyTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="sendMoneyTitle">SEND MONEY FROM WALLET PROFIT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div>
                    Enter the amount <br>
                    <input type="text" class="form-control" ng-model="amountWalletProfit">
                    Choose the payment
                    <select class="form-control" ng-model="walletPayProfit">
                        <option value=""></option>
                        <option value="PayPal">PayPal</option>
                        <option value="Master">Master card</option>
                        <option value="Google">Google pay</option>
                        <option value="Paytm">Paytm</option>
                        <option value="Phone">Phone pay</option>
                        <option value="Amazon">Amazon pay</option>
                        <option value="Bhim">Bhim upi</option>
                        <option value="Perfectmoney">Perfectmoney</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" ng-disabled="!amountWalletProfit || !walletPayProfit" class="btn btn-primary" data-dismiss="modal">Send</button>
            </div>
        </div>
        </div>
    </div>
</body>
</html>