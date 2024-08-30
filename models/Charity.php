<?php


class Charity
{
    private static $idCounter = 1;
    private $id;
    private $name;
    private $representativeEmail;

    /**
     * Constructor to initialize a new Charity object.
     * 
     * @param string $name Name of the charity.
     * @param string $representativeEmail Representative's email.
     * @param int|null $id Optional ID of the charity. If not provided, a new ID is generated.
     */
    public function __construct(string $name, string $representativeEmail, ?int $id)
    {
        Validator::validateString($name, "Charity Name");
        Validator::validateEmail($representativeEmail);

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
        Validator::validateString($name, "Charity Name");

        $this->name = $name;
    }

    public function getRepresentativeEmail(): string
    {
        return $this->representativeEmail;
    }

    public function setRepresentativeEmail(string $newEmail): void
    {
        Validator::validateEmail($newEmail);

        $this->representativeEmail = $newEmail;
    }

    public function displayCharityInfo(): string
    {
        return "ID: {$this->id}, Name: {$this->name}, Email: {$this->representativeEmail}.";
    }
}