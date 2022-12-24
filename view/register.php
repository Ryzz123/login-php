<?php
session_start();
if (isset($_SESSION['login']) == 'login') {
    header('Location: ./../index.php');
    exit();
}
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../service/userService.php';
require_once __DIR__ . '/../model/RegisterRequest.php';
require_once __DIR__ . '/../repository/repository.php';

use Service\userService;
use RegisterUser\RegisterRequest;
use Repository\LoginImpl;

$connection = getConnection();
$request = new RegisterRequest();
$repository = new LoginImpl($connection);
$service = new userService($repository);

if (isset($_POST['register'])) {
        $request->username = htmlspecialchars($_POST['username']);
        $request->password = htmlspecialchars($_POST['password']);
        $request->confirm = htmlspecialchars($_POST['confirm']);

        $service->register($request);
        header('Location: ./login.php');
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
    <link rel="stylesheet" href="../utils/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>

<div class="container">
    <div class="card-login card">

        <?php if (isset($_GET['message']) != null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_GET['message'] ?? '' ?>
                <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card-header text-center">REGISTER</div>
        <div class="card-body">
            <form action="" class="login" method="post">
                <div class="body-card">
                    <div class="input-group mb-3">
                        <input value="<?= $_POST['username'] ?? '' ?>" type="text" class="form-control" name="username" placeholder="Masukan username"
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
                    <button class="btn btn-primary bg-dark" type="submit" name="register">DAFTAR</button>
                </div>
            </form>
        </div>
        <p class="sign-in text-white">Sudah punya akun? <a href="login.php">Sign-in</a></p>
    </div>
</div>

<!-- link javascript bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
