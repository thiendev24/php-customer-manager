<?php

// DB table to use
$table = 'customers';

// Table's primary key
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
    // array(
    //     'db'        => 'salary',
    //     'dt'        => 5,
    //     'formatter' => function( $d, $row ) {
    //         return '$'.number_format($d);
    //     }
    // )
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'customers',
    'host' => 'localhost:4306'
    // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);

require_once 'ssp.class.php';

echo json_encode(
    SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
);
