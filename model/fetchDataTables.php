<?php

declare(strict_types=1);

require_once 'model/DBConnection.php';

use Model\CustomerDB;
// use Model\DBConnection;
use Model\Customer;

$connection = new DBConnection(
    // "mysql:host=localhost:4306;dbname=customers",
    // 'root',
    // ''
);
$customerDB = new CustomerDB($connection->connect());

$sql = "SELECT * FROM customers ";

// $columns = array(
//     0 => 'id',
//     1 => 'name',
//     2 => 'email',
//     3 => 'address'
// );

if ($_POST['length'] != -1) {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT  " . $start . ", " . $length;
}

$statement = $this->connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_OBJ);
$customers = [];

foreach ($result as $item) {
    $customer = new Customer(
        $item->name,
        $item->email,
        $item->address
    );
    $customer->setId($item->id);

    $customers[] = $customer;
}

$getAllCustomers = $customerDB->getAll();
$total_all_rows = count($getAllCustomers);

$count_rows = count($customers);
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsTotal' => $count_rows,
    'recordsFiltered' =>   $total_all_rows,
    'data' => $customers,
);
echo json_encode($output);
