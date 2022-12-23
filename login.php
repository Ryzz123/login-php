<?php
//session_start();
//if ($_SESSION['login'] == 'login') {
//    header('Location: ./index.php');
//    exit();
//}
require_once __DIR__ . '/database/connection.php';
require_once __DIR__ . '/service/userService.php';
require_once __DIR__ . '/model/LoginRequest.php';
require_once __DIR__ . '/repository/repository.php';
require_once __DIR__ . '/exception/exception.php';

use Service\userService;
use LoginRequest\LoginRequest;
use Repository\LoginImpl;
use Exception\ExceptionMessage;

$connection = getConnection();
$request = new LoginRequest();
$repository = new LoginImpl($connection);
$service = new userService($repository);
$exception = new ExceptionMessage();


if (isset($_POST['login'])) {
    if ($_POST['password'] != $_POST['confirm']) {
        $exception->message = "Harus sama password dan konfirmasi";
    } else {
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->confirm = $_POST['confirm'];

        $service->login($request);
        $_SESSION['login'] = 'login';
        header("Location: ./index.php?name=$request->username");
    }
}

$connection = null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--  link css bootsrap  -->
    <link rel="stylesheet" href="./utils/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

<div class="container">
    <div class="card-login card">

        <?php if ($exception->message != null || isset($_GET['message']) != null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $exception->message; ?>
                <?= $_GET['message'] ?? '' ?>
                <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card-header text-center">LOGIN</div>
        <div class="card-body">
            <form action="" class="login" method="post">
                <div class="body-card">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" value="<?= $_POST['username'] ?? '' ?>" placeholder="Masukan username"
                               aria-label="Username"
                               aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Masukan password"
                               aria-label="Username"
                               aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm" placeholder="Konfirmasi password"
                               aria-label="Username"
                               aria-describedby="basic-addon1">
                    </div>
                    <button class="btn btn-primary bg-dark" type="submit" name="login">LOGIN</button>
                </div>
            </form>
        </div>
        <p class="sign-in text-white">Belum punya akun? <a href="./register.php">Sign-up</a></p>
    </div>
</div>

<!-- link javascript bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>