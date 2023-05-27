<?php

declare(strict_types=1);

namespace Model;

class Customer
{
    private int $id;
    private string $name;
    private string $email;
    private string $address;
    private string $gender;

    public function __construct(string $name, string $email, string $address, string $gender)
    {
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->gender = $gender;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }
}
