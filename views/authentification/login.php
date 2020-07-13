<?php 
    session_start();
    if (isset($_COOKIE['game_random_app'])) {
        header("Location:../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <script type="module" src="../../assets/js/script.js"></script>
  <title>Login</title>
</head>
<body>
    <div class="text-center">
        <img src="../../assets/images/logo.png" alt="logo">
    </div>
    <form method="post" action="../../controller/authentification/auth.controller.php">
        <table class="table table-borderless mx-auto loginForm">
            <thead>
                <th class="text-center bg-light text-dark">
                    Your login
                </th>
            </thead>
            <?php if (isset($_SESSION['error_login']) && $_SESSION['error_login']) {?>
            <tr>
                <td class="alert alert-danger text-center">
                    Username or Password invalid
                </td>
            </tr>
            <?php }
                $_SESSION['error_login'] = false;
            ?>
            <?php if (isset($_SESSION['password_change']) && $_SESSION['password_change']) {?>
            <tr>
                <td class="alert alert-success text-center">
                    Your new password is sent in your <br> email address
                </td>
            </tr>
            <?php }
                $_SESSION['password_change'] = false;
            ?>
            <?php if (isset($_SESSION['register_ok']) && $_SESSION['register_ok']) {?>
            <tr>
                <td class="alert alert-success text-center">
                    Your account is registered 
                </td>
            </tr>
            <?php }
                $_SESSION['register_ok'] = false;
            ?>
            <tr>
                <td>
                    <label for="username">Username</label>
                    <input name="username" id="username" type="text" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Password</label>
                    <input name="password" id="password"  type="password" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary w-100">Login</button>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                    <a href="../registration/registre.php" class="btn btn-link">Create an account</a>
                    <a href="../recoverPassword/recover.php" class="btn btn-link">Recover password</a> 
                </td>
            </tr>
        </table>
    </form>
</body>
</html>