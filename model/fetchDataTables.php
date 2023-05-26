<?php

declare(strict_types=1);

require_once 'DBConnection.php';
require_once 'CustomerDB.php';

use Model\CustomerDB;

$connection = new DBConnection();
$customerDB = new CustomerDB($connection->connect());

// print_r($_REQUEST);
// echo '</br>';
// var_dump($_POST);
// echo '</br>';
// echo 'come here';

$start = +$_POST['start'];
$length = +$_POST['length'];
$draw = intval($_POST['draw']);

// echo '</br>';
// echo $start . '</br>';
// echo $length . '</br>';
// echo $draw . '</br>';

$output = $customerDB->getAllPagination($start, $length, $draw);
var_dump($output);

echo json_encode($output);
