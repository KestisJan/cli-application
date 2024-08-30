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
     * @param $representativeEmail Representative's email.
     * @param int|null $id Optional unique identifier for the charity. If not provided, a new ID will be generated.
     */
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

        $this->name = $name;
        $this->representativeEmail = $representativeEmail;
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


    /**
     * Display charity information.
     * 
     * @return string Information about the charity.
     */
    public function displayCharityInfo(): string
    {
        return "ID: {$this->id}, Name: {$this->name}, Email: {$this->representativeEmail}.";
    }
}