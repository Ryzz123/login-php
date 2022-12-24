<?php
require_once __DIR__ . '/../database/connection.php';
require_once __DIR__ . '/../repository/repository.php';

$connection = getConnection();
$repository = new \Repository\LoginImpl($connection);

$id = $_GET['id'];

$repository->deleteByid($id);
header("Location: ./../index.php");

$connection = null;