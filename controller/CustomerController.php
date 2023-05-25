<?php

declare(strict_types=1);

require_once 'model/DBConnection.php';
require_once 'model/CustomerDB.php';
require_once 'model/Customer.php';

// use Model\DBConnection;
use Model\CustomerDB;
use Model\Customer;

class CustomerController
{
    private CustomerDB $customerDB;
    private const HEADER = "Location: index.php";

    public function __construct()
    {
        $connection = new DBConnection();
        $this->customerDB = new CustomerDB($connection->connect());
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            include 'view/create.php';
        } else {
            $errors = [];
            $fields = ["name", "email", "address"];

            foreach ($fields as $field) {
                if (empty($_POST[$field])) {
                    $errors[$field] = "Can't be empty!";
                }
            }

            if (empty($errors)) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $customer = new Customer($name, $email, $address);

                $this->customerDB->create($customer);
                header(self::HEADER);
            } else {
                include 'view/add.php';
            }
        }
    }

    public function delete()
    {
        $id = +$_GET['id'];
        $this->customerDB->delete($id);
        header(self::HEADER);
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = +$_GET['id'];
            $customer = $this->customerDB->get($id);
            include 'view/edit.php';
        } else {
            $errors = [];
            $fields = ['name', 'email', 'address'];

            foreach ($fields as $field) {
                if (empty($_POST[$field])) {
                    $errors['field'] = "Can't be empty!";
                }
            }

            $id = +$_POST['id'];
            if (empty($errors)) {
                $customer = new Customer(
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['address']
                );
                $this->customerDB->update($id, $customer);
                header(self::HEADER);
            } else {
                $customer = $this->customerDB->get($id);
                include 'view/index.php';
            }
        }
    }

    public function index()
    {
        // $customer = $this->customerDB->getAll();
        include_once 'view/customerDatatables.php';
    }
}
