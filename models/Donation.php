<?php

class Donation
{
    private static $idCounter = 1;
    private $id;
    private $donorName;
    private $amount;
    private $charityId;
    private $dateTime;

    /**
     * Constructor to initialize a new Donation object.
     * 
     * @param string $donorName Name of the donor.
     * @param float $amount Donation amount.
     * @param int $charityId ID of the associated charity.
     * @param int|null $id Optional unique identifier for the donation. If not provided, a new ID will be generated.
     */
    public function __construct(string $donorName, float $amount, int $charityId, ?int $id = null)
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
        $this->dateTime = new DateTime();
    }

    // Getters 

    /**
     * Get the unique identifier of the donation.
     * 
     * @return int Donation ID.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the donor.
     * 
     * @return string Donor's name.
     */
    public function getDonorName(): string
    {
        return $this->donorName;
    }

    /**
     * Get the amount of the donation.
     * 
     * @return float Donation amount.
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the ID of the associated charity.
     * 
     * @return int Charity ID.
     */
    public function getCharityId(): int
    {
        return $this->charityId;
    }

    /**
     * Get the date and time of the donation.
     * 
     * @return DateTime Date and time of the donation.
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    // Display donation info

    /**
     * Display donation information.
     * 
     * @return string Information about the donation.
     */
    public function displayDonationInfo(): string
    {
        return  "ID: {$this->id}, Donor: {$this->donorName}, Amount: $" . number_format($this->amount, 2) . 
                ", Charity ID: {$this->charityId}, Date: " . $this->dateTime->format('Y-m-d H:i:s');
    }
}
