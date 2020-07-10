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
    <title>Validation</title>
</head>
<body style="background-color: rgba(0, 0, 0, 0.801);">

    <div class="validator p-3">
        <?php if (isset($_SESSION['invalid_code']) && $_SESSION['invalid_code']) {?>
        <div class="alert alert-danger text-center w-100">
            Code invalid
        </div>
        <?php }
            $_SESSION['invalid_code'] = false;
        ?>
        <?php if (isset($_SESSION['resend_ok']) && $_SESSION['resend_ok']) {?>
        <div class="alert alert-success text-center w-100">
            Code resended
        </div>
        <?php }
            $_SESSION['resend_ok'] = false;
        ?>
        Please enter the activation code in your mail:
        <form class="m-2" action="../../controller/validator/check.php" method="POST">
            <div class="input-group">
                <input name="response" id="response" class="form-control" required />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </div>
        </form>
        You did not receive the email
        <form action="../../controller/validator/resend.php" method="POST">
            <button class="btn btn-primary" type="submit">Resend</button>
            <a class="btn btn-primary" href="../../controller/delog/delog.controller.php">Log out <i class="fas fa-door-open"></i></a>
        </form>
    </div>
</body>
</html>