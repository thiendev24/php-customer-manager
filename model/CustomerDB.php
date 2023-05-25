<?php

declare(strict_types=1);

namespace Model;

require_once 'Customer.php';

use Model\Customer;
use PDO;

class CustomerDB
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create(Customer $customer)
    {
        $query = "INSERT INTO customers(name, email, address) VALUES (?, ?, ?);";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(1, $customer->getName());
        $statement->bindParam(2, $customer->getEmail());
        $statement->bindParam(3, $customer->getAddress());

        return $statement->execute();
    }

    public function get(int $id)
    {
        $sql = "SELECT c.id, c.name, c.email, c.address, g.gender AS gender FROM `customers` AS c LEFT JOIN `gender` AS g ON c.gender_id = g.id WHERE c.id = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function getAll(): array
    {
        $sql = "SELECT c.id, c.name, c.email, c.address, g.gender AS gender FROM `customers` AS c LEFT JOIN `gender` AS g ON c.gender_id = g.id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        $customers = [];

        foreach ($result as $item) {
            $customer = new Customer(
                $item->name,
                $item->email,
                $item->address,
                $item->gender,
            );
            $customer->setId($item->id);

            $customers[] = $customer;
        }

        return $customers;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM customers WHERE id = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $id);

        return $statement->execute();
    }

    public function update(int $id, Customer $customer)
    {
        $sql = "UPDATE customers SET name = ?, email = ?, address = ? WHERE id = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $customer->getName());
        $statement->bindParam(2, $customer->getEmail());
        $statement->bindParam(3, $customer->getAddress());
        $statement->bindParam(4, $id);

        return $statement->execute();
    }

    // public function getAllPagination()
    // {
    //     $sql = "SELECT * FROM customers ";

    //     // $columns = array(
    //     //     0 => 'id',
    //     //     1 => 'name',
    //     //     2 => 'email',
    //     //     3 => 'address'
    //     // );

    //     if ($_POST['length'] != -1) {
    //         $start = $_POST['start'];
    //         $length = $_POST['length'];
    //         $sql .= " LIMIT  " . $start . ", " . $length;
    //     }

    //     $statement = $this->connection->prepare($sql);
    //     $statement->execute();
    //     $result = $statement->fetchAll(PDO::FETCH_OBJ);
    //     $customers = [];

    //     foreach ($result as $item) {
    //         $customer = new Customer(
    //             $item->name,
    //             $item->email,
    //             $item->address
    //         );
    //         $customer->setId($item->id);

    //         $customers[] = $customer;
    //     }

    //     $getAllCustomers = $this->getAll();
    //     $total_all_rows = count($getAllCustomers);

    //     $count_rows = count($customers);
    //     $output = array(
    //         'draw' => intval($_POST['draw']),
    //         'recordsTotal' => $count_rows,
    //         'recordsFiltered' =>   $total_all_rows,
    //         'data' => $customers,
    //     );
    //     return json_encode($output);
    // }
}
