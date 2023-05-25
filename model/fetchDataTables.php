<?php

declare(strict_types=1);

require_once 'DBConnection.php';
require_once 'CustomerDB.php';

use Model\CustomerDB;

var_dump($_POST);
$connection = new DBConnection();
$customerDB = new CustomerDB($connection->connect());


echo 'come here';
$start = +$_POST['start'];
$length = +$_POST['length'];
$draw = intval($_POST['draw']);

$output = $customerDB->getAllPagination($start, $length, $draw);

echo json_encode($output);
