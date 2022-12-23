<?php
require_once __DIR__ . '/user/user.php';

session_start();
if ($_SESSION['login'] != 'login') {
    header('Location: ./login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./utils/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Home</title>
</head>
<body>

<div class="container">
    <div class="jumbotron text-center mt-5">
        <h1 class="display-4 text-white">Hello, <?= $_GET['name'] ?? '' ?></h1>
        <p class="lead text-white">Silahkan klik log-out dibawah, jika kamu ingin log-out!</p>
        <a class="btn btn-primary bg-dark btn-lg text-white" href="./logout.php" role="button">LOG-OUT</a>
    </div>
</div>

<!-- link javascript bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>