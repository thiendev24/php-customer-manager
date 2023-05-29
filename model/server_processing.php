<?php

$table = 'customers';

$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'name', 'dt' => 1),
    array('db' => 'email', 'dt' => 2),
    array('db' => 'address', 'dt' => 3),
    array(
        'db' => 'gender_id', 'dt' => 4,
        'formatter' => function ($d, $row) {
            $gender = "MALE";
            switch ($d) {
                case 1:
                    $gender = "MALE";
                    break;
                case 2:
                    $gender = "FEMALE";
                    break;
                case 3:
                    $gender = "OTHER";
                    break;
                default:
                    echo "Something wrong!";
                    break;
            }
            return $gender;
        }
    ),
);

$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'customers',
    'host' => 'localhost:4306', 'charset' => 'utf8'
);

require_once '../utils/SSP.php';

echo json_encode(
    SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
);
