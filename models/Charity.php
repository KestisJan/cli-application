<?php


class Charity
{
    private static $idCounter = 1;
    private $id;
    private $name;
    private $representativeEmail;


    public function __construct(string $name, string $representativeEmail, ?int $id)
    {
        if ($id !== null) {
            $this->id = $id;

            if ($id >= self::$idCounter) {
                self::$idCounter = $id + 1;
            }
        } else {
            $this->id = self::$idCounter++;
        }
    }

    // Getters & Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRepresentativeEmail(): string
    {
        return $this->representativeEmail;
    }

    public function setRepresentativeEmail(string $newEmail): void
    {
        $this->representativeEmail = $newEmail;
    }

    public function displayCharityInfo(): string
    {
        return "ID: {$this->id}, Name: {$this->name}, Email: {$this->representativeEmail}.";
    }
}