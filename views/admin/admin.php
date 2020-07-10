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
                <div ng-if="nbrComplaint != 0" class="bg-danger" style="width: 18px;height: 18px; display: inline-block;border-radius: 50%;font-size: 12px;">{{nbrComplaint}}</div>
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
                    <b>ID</b>: {{i.id}}<br>
                    <b>First name :</b> {{i.first_name}}<br>
                    <b>Last name :</b> {{i.last_name}}<br>
                    <b>Phone :</b> {{i.phone}}<br>
                    <b>Address :</b> {{i.address}}<br>
                    <b>Mail :</b> <a href="mailto:{{i.mail}}">{{i.mail}}</a>
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
                <td>{{nbrOfPlayer}}</td>
                <td>{{amount}}</td>
                <td>{{winner}}</td>
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
                <td>{{agate}}</td>
                <td>{{w_agate}}</td>
            </tr>
                <td>Beryl</td>
                <td>{{beryl}}</td> 
                <td>{{w_beryl}}</td>
            </tr>
            <tr>
                <td>Celestine</td>
                <td>{{celestine}}</td>
                <td>{{w_celestine}}</td>
            </tr>
            <tr>
                <td>Diamond</td>
                <td>{{diamond}}</td>
                <td>{{w_diamond}}</td>
            </tr>
            <tr>
                <td>Emerald</td>
                <td>{{emerald}}</td>
                <td>{{w_emerald}}</td>
            </tr>
            <tr>
                <td>Flint</td>
                <td>{{flint}}</td>
                <td>{{w_flint}}</td>
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
                {{wallet}} <br>
                <button data-toggle="modal" data-target="#sendMoney"  class="btn btn-outline-warning btn-sm">Send</button></td>
            <td>
                {{profit}} <br> 
                <button data-toggle="modal" data-target="#sendMoney"  class="btn btn-outline-warning btn-sm">Send</button></td>
            </td>
        </tbody>
    </table>
    <div class="modal fade" id="sendMoney" tabindex="-1" role="dialog" aria-labelledby="sendMoneyTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="sendMoneyTitle">SEND MONEY <i class="spinner-grow"></i></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <select name="" id="" class="form-control-sm">
                        <?php
                            $pourcent = 0;
                            $i = 0;
                            while ($i <= 100) {
                                echo "
                                    <option value='$i'>$i%</option>
                                ";
                                $i += 5;
                            }
                        ?>
                    </select>
                    or
                    <input type="text" class="form-control-sm">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
        </div>
    </div>
</body>
</html>