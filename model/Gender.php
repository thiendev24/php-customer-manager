<?php

declare(strict_types=1);

namespace Model;

class Gender
{
    private int $id;
    private string $gender;

    public function __construct(string $gender)
    {
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

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }
}
