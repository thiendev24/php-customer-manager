<?php

declare(strict_types=1);

// namespace Model;

// use PDO;

class DBConnection
{
    private const DSN = "mysql:host=localhost:4306;dbname=customers";
    private const USERNAME = "root";
    private const PASSWORD = "";


    public function __construct()
    {
        // return new PDO(self::DSN, self::USERNAME, self::PASSWORD);
    }

    public function connect(): PDO
    {
        // return new PDO($this->dsn, $this->username, $this->password);
        return new PDO(self::DSN, self::USERNAME, self::PASSWORD);
    }

    // $this->dsn = $dsn;
    //     $this->username = $username;
    //     $this->password = $password;


    // string $dsn,
    // string $username,
    // string $password



    // private string $dsn;
    // private string $username;
    // private string $password;

    // public function getDsn(): string
    // {
    //     return $this->dsn;
    // }

    // public function setDsn(string $dsn): void
    // {
    //     $this->dsn = $dsn;
    // }

    // public function getUsername(): string
    // {
    //     return $this->username;
    // }

    // public function setUsername(string $username): void
    // {
    //     $this->username = $username;
    // }

    // public function getPassword(): string
    // {
    //     return $this->password;
    // }

    // public function setPassword(string $password): void
    // {
    //     $this->password = $password;
    // }
}
