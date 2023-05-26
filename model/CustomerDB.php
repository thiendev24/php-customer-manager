<?php

declare(strict_types=1);

namespace Model;

require_once 'Customer.php';

use Model\Customer;
use PDO;

class CustomerDB
{
    private $connection;

    private const INSERT_NEW_CUSTOMER = "INSERT INTO customers(name, email, address, gender_id) VALUES (?, ?, ?, ?);";
    private const GET_ALL_CUSTOMER_PAGING = "SELECT c.id, c.name, c.email, c.address, g.gender AS gender FROM `customers` AS c LEFT JOIN `gender` AS g ON c.gender_id = g.id LIMIT ?, ?;";

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function create(Customer $customer)
    {
        $genderId = 0;
        $gender = $customer->getGender();
        switch ($gender) {
            case "MALE":
                $genderId = 1;
                break;
            case "FEMALE":
                $genderId = 2;
                break;
            case "OTHER":
                $genderId = 3;
                break;
            default:
                echo "Something wrong!";
                break;
        }

        $statement = $this->connection->prepare(SELF::INSERT_NEW_CUSTOMER);
        $statement->bindParam(1, $customer->getName());
        $statement->bindParam(2, $customer->getEmail());
        $statement->bindParam(3, $customer->getAddress());
        $statement->bindParam(4, $genderId);

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
        $genderId = 0;
        $gender = $customer->getGender();
        switch ($gender) {
            case "MALE":
                $genderId = 1;
                break;
            case "FEMALE":
                $genderId = 2;
                break;
            case "OTHER":
                $genderId = 3;
                break;
            default:
                echo "Something wrong!";
                break;
        }
        $sql = "UPDATE customers SET name = ?, email = ?, address = ?, gender_id = ? WHERE id = ?;";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(1, $customer->getName());
        $statement->bindParam(2, $customer->getEmail());
        $statement->bindParam(3, $customer->getAddress());
        $statement->bindParam(4, $genderId);
        $statement->bindParam(5, $id);

        return $statement->execute();
    }

    public function getAllCustomersByQuery(int $start, int $length): array
    {
        $offset = +$start;
        $size = +$length;

        $statement = $this->connection->prepare(self::GET_ALL_CUSTOMER_PAGING);
        $statement->bindParam(1, $offset, PDO::PARAM_INT);
        $statement->bindParam(2, $size, PDO::PARAM_INT);
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
            array_push($customers, $customer);
        }

        return $customers;
    }

    public function getAllPagination(int $start, int $length, int $draw)
    {
        $totalQuery = $this->getAll();
        $totalAllRows = count($totalQuery);

        $customers = $this->getAllCustomersByQuery($start, $length);
        $countRows = count($customers);
        // var_dump($customers);
        // echo '</br>';

        return [
            'draw' => $draw,
            'recordsTotal' => $countRows,
            'recordsFiltered' => $totalAllRows,
            'data' => $customers,
        ];
    }
}
