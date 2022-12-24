<?php
session_start();
if ($_SESSION['login'] != 'login') {
    header('Location: ./view/login.php');
    exit();
}

require_once __DIR__ . '/user/user.php';
require_once __DIR__ . '/database/connection.php';
require_once __DIR__ . '/repository/repository.php';

use Repository\LoginImpl;

$connection = getConnection();
$repository = new LoginImpl($connection);

$data = $repository->selectAll();

$connection = null;
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
<a href="./view/logout.php" class="btn bg-dark my-3 mx-3 btn-primary">LOG-OUT</a>
<div class="container">
    <div class="jumbotron text-center">
        <div class="card bg-dark">
            <table class="table text-white">
                <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">AKSI</th>
                </tr>
                </thead>
                <tbody>
                <?php $id = 1; ?>
                <?php foreach ($data as $datas) : ?>
                    <tr class="mb-4">
                        <th scope="row"><?= $id ?></th>
                        <td class="uppercase"><?= $datas['username'] ?></td>
                        <td>
                            <a href="./view/delete.php?id=<?= $datas['id'] ?>" class="btn btn-primary bg-dark">HAPUS</a>
                        </td>
                    </tr>
                <?php $id++; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
</div>

<!-- link javascript bootsrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>