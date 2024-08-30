<?php


class Donation
{
    private static $idCounter = 1;
    private $id;
    private $donorName;
    private $amount;
    private $charityId;
    private $dateTime;


    public function __construct(string $donorName, float $amount, int $charityId, ?int $id = null, ?DateTime $dateTime = null)
    {
        if ($id !== null) {
            $this->id = $id;

            if ($id >= self::$idCounter) {
                self::$idCounter = $id + 1;
            }
        } else {
            $this->id = self::$idCounter++;
        }

        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charityId = $charityId;
        $this->dateTime = $dateTime ?? new DateTime();
    }


    // Getters 
    public function getId(): int
    {
        return $this->id;
    }

    public function getDonorName(): string
    {
        return $this->donorName;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCharityId(): int
    {
        return $this->charityId;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    // Set ID
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    // Display donation info
    public function displayDonationInfo(): string
    {
        return  "ID: {$this->id}, Donor: {$this->donorName}, Amount: $" . number_format($this->amount, 2) . 
                ", Charity ID: {$this->charityId}, Date: " . $this->dateTime->format('Y-m-d H:i:s');
    }
}