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
    * @param float $amount Amount donated. Must be a positive number.
    * @param int $charityId ID of the charity receiving the donation.
    * @param int|null $id Optional ID of the donation. If not provided, a new ID is generated.
    * @param DateTime|null $dateTime Optional date and time of the donation. If not provided, the current date and time is used.
    */
    public function __construct(string $donorName, float $amount, int $charityId, ?int $id = null, ?DateTime $dateTime = null)
    {
        Validator::validateString($donorName, "Donor Name");
        Validator::validateAmount($amount);

        echo "Start 1";
        if ($id === null) {
            echo "#1 ID -> {$this->id}\n";

            $this->id = self::$idCounter++;
            echo "#2 ID -> {$this->id}\n";
        } else {
            $this->id = $id;

            if ($id >= self::$idCounter) {
                self::$idCounter = $id + 1;
            }
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