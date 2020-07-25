<?php
    require '../../config/constant.php';
    $nbr_page = 1;
    if (@$_GET['page']) {
        $nbr_page = @$_GET['page'];
    }
    $fin = $nbr_page * 10;
    $debut = $fin - 10;
    $allUser = $database->query("SELECT * FROM t_user_info LIMIT $debut, $fin");
    $allUser_ = [];
    $i = 1;
    foreach ($allUser as $v) {
        $v['nb'] = $i;
        $i++;
        array_push($allUser_,$v);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script type="module" src="../../assets/js/script.js"></script>
    <title>User list</title>
</head>
<body  ng-controller="adminCtrl">
    <div class="w-100 bg-light" style="height: 22vh;background-image: url(../../assets/images/bannier.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;">
        <h2 class="text-center text-light pt-5" style="opacity: 0.7;">
            Hello Admin
        </h2>
    </div>
    <div class="btn-group mx-auto w-100 mb-3" style="position: sticky;top: 0;z-index: 10;">
        <a class="btn btn-primary btn-sm" href="admin.php"><i class="fas fa-user-shield"></i><span class="menuMaxLength"> Admin service</span></a>
        <a class="btn btn-primary btn-sm" href="adminComplaint.php"><i class="fab fa-facebook-messenger"></i><span class="menuMaxLength"> Complaints</span>
            <div ng-if="nbrComplaint != 0" class="bg-danger" style="width: 18px;height: 18px; display: inline-block;border-radius: 50%;font-size: 12px;" ng-bind="nbrComplaint"></div>
        </a>
        <a class="btn btn-primary btn-sm" href="adminSetting.php"><i class="fas fa-user-cog"></i><span class="menuMaxLength"> Account setting</span></a>
        <a class="btn btn-outline-primary btn-sm" href="userList.php"><i class="fa fa-user-circle" aria-hidden="true"></i><span class="menuMaxLength"> User list</span></a>
        <a class="btn btn-secondary btn-sm"  href="../../controller/delog/delog.controller.php"><i class="fas fa-sign-out-alt"></i><span class="menuMaxLength"> Logout</span></a>
    </div>
    <div class="container">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($allUser_ as $v) {
                        echo '<tr class="xtable">';
                        echo '<th scope="row">'.$v['nb'].'</th>';
                        echo '<td>'.$v['first_name'].'</td>';
                        echo '<td>'.$v['last_name'].'</td>';
                        echo '<td>'.$v['phone'].'</td>';
                        echo '<td>'.$v['mail'].'</td>';
                        echo '</tr>';
                    }
                    if (count($allUser_) == 0) {
                        echo '<tr>';
                        echo '<td>No data</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($nbr_page > 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $nbr_page-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php } ?>
                    <?php
                        echo '<li class="page-item"><a class="page-link" href="#">'.$nbr_page.'</a></li>';
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $nbr_page+1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
            </ul>
        </nav>
    </div>
</body>
</html>