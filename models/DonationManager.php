<?php

class DonationManager
{
    private $donations = [];
    private $jsonFile = 'data/donations_data.json';

    /**
     * DonationManager constructor.
     */
    public function __construct()
    {
        $this->loadDonationsFromJson();
    }

    /**
     * Add a new donation.
     * 
     * @param string $donorName Name of the donor.
     * @param float $amount Amount donated.
     * @param int $charityId ID of the charity receiving donation.
     * 
     * @return void
     */
    public function addDonation(string $donorName, float $amount, int $charityId): void
    {
        try {
            $donation = new Donation($donorName, $amount, $charityId);
            $this->donations[$donation->getId()] = $donation;
            $this->saveDonationsToJson();
            echo "Donation added successfully:\n" . $donation->displayDonationInfo() . "\n";
        } catch (Exception $e) {
            echo "Failed to add donation: " . $e->getMessage() . "\n";
        }
    }

    /**
     * View all donations.
     * 
     * @return void
     */
    public function viewDonations(): void
    {
        if(empty($this->donations)) {
            echo "No donations available. \n";
        } else {
            foreach ($this->donations as $donation) {
                echo $donation->displayDonationInfo() . "\n";
            }
        }
    }

    /**
     * Get a donation by its ID.
     * 
     * @param int $id Donation ID.
     * 
     * @return Donation|null Returns donation if found, or null if not found.
     */
    public function getDonationById(int $id): ?Donation
    {
        return $this->donations[$id] ?? null;
    }

    /**
     * Get donations by charity ID.
     * 
     * @param int $charityId Charity ID.
     * 
     * @return array Returns an array of donations for the given charity ID.
     */
    public function getDonationsByCharityId(int $charityId): array
    {
        return array_filter($this->donations, function ($donation) use ($charityId) {
            return $donation->getCharityId() === $charityId;
        });
    }

    /**
     * Load donations from the JSON file.
     * 
     * @return void
     */
    private function loadDonationsFromJson(): void
    {
        if (file_exists($this->jsonFile)) {
            $jsonHandler = new JsonHandler($this->jsonFile);
            $data = $jsonHandler->loadData();

            foreach ($data as $donationData) {
                $donation = new Donation(
                    $donationData['donorName'],
                    $donationData['amount'],
                    $donationData['charityId'],
                    new DateTime($donationData['dateTime'])
                );
                $donation->setId($donationData['id']);
                $this->donations[$donation->getId()] = $donation;
            }
        }
    }

    /**
     * Save donations to the JSON file.
     * 
     * @return void
     */
    private function saveDonationsToJson(): void
    {
        $jsonHandler = new JsonHandler($this->jsonFile);
        $data = [];

        foreach ($this->donations as $donation) {
            $data[] = [
                'id' => $donation->getId(),
                'donorName' => $donation->getDonorName(),
                'amount' => $donation->getAmount(),
                'charityId' => $donation->getCharityId(),
                'dateTime' => $donation->getDateTime()->format('Y-m-d H:i:s')
            ];
        }

        $jsonHandler->saveData($data);
    }



}