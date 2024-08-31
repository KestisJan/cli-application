<?php

class CharityManager
{
    private $charities = [];
    private $jsonFile = 'data/charities_data.json';
    private $donationManager;


    /**
     * CharityManager constructor.
     * 
     * @param DonationManager $donationManager
     */
    public function __construct(DonationManager $donationManager)
    {
        $this->donationManager = $donationManager;
        $this->loadCharitiesFromJson();
    }

    /**
     * Add a new charity.
     * 
     * @param string $name Name of the charity
     * @param string $email Representative's email.
     * 
     * @return void
     */
    public function addCharity(string $name, string $email): void
    {
        try {
            Validator::validateString($name, "Charity Name");
            $email = trim($email);
            Validator::validateEmail($email);

            $charity = new Charity($name, $email, null);
            $this->charities[$charity->getId()] = $charity;
            $this->saveCharitiesToJson();
            echo "Charity added successfully: " . $charity->getName() . "\n";
        } catch (Exception $e) {
            echo "Failed to add charity: " . $e->getMessage() . "\n";
        }
    }

    /**
     * View all charities.
     * 
     * @return void
     */
    public function viewCharities(): void
    {
        if (empty($this->charities)) {
            echo "No charities available.\n";
        } else {
            foreach ($this->charities as $charity) {
                echo $charity->displayCharityInfo() . "\n";

                $donations = $this->donationManager->getDonationsByCharityId($charity->getId());

                if (!empty($donations)) {
                    echo "Donations for " . $charity->getName() . ":\n";
                    foreach ($donations as $donation) {
                        echo " Donation ID: " . $donation->getId() . "\n";
                        echo " Donor Name: " . $donation->getDonorName() . "\n";
                        echo " Amount: $" . $donation->getAmount() . "\n";
                        echo " Date: " . $donation->getDateTime()->format('Y-m-d H:i:s') . "\n";
                    }
                } else {
                    echo "No donations for this charity. \n";
                }

                echo "----------------------\n";
            }
        }
    }

    /**
     * Edit charity by ID
     * 
     * @param int $id Charity ID.
     * @param string $newName New charity name.
     * @param string $newEmail New represantative's email.
     * 
     * @return void
     */
    public function editCharity(int $id, string $newName, string $newEmail): void
    {
        if (isset($this->charities[$id])) {
            $charity = $this->charities[$id];
            try {
                Validator::validateString($newName, "Charity Name");
                Validator::validateEmail($newEmail);

                $charity->setName($newName);
                $charity->setRepresentativeEmail($newEmail);
                $this->saveCharitiesToJson();
                echo "Charity updated successfully.\n";
            } catch (Exception $e) {
                echo "Failed to update charity: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Charity with ID $id not found.\n";
        }
    }


    /**
     * Delete charity by ID.
     * 
     * @param init $id Charity ID.
     * 
     * @return void
     */
    public function deleteCharity(int $id): void
    {
        if (isset($this->charities[$id])) {
            $charity = $this->charities[$id];
            echo "Are you sure you want to delete this charity\n";
            echo $charity->displayCharityInfo() . "\n";
            echo "Type 'yes' or 'y' to confirm, or anything else to cancel: ";

            $confirmation = trim(fgets(STDIN));
            if (in_array(strtolower($confirmation), ['yes', 'y'])) {
                unset($this->charities[$id]);
                $this->saveCharitiesToJson();
                echo "Charity deleted successfully.\n";
            } else {
                echo "Charity deletion canceled.\n";
            }
        } else {
            echo "Charity with $id not found \n";
        }
    }

    /**
     * Find charity by ID.
     * 
     * @param int $id Charity ID.
     * 
     * @return Charity|null Returns the charity if found, or null if not found.
     */
    public function findCharityById(int $id): ?Charity
    {
        return $this->charities[$id] ?? null;
    }

    /**
     * Add donation to charity.
     * 
     * @param Donation $donation Donation object.
     * 
     * @return void
     */
    public function addDonationToCharity(Donation $donation): void
    {
        $charityId = $donation->getCharityId();
        if (isset($this->charities[$charityId])) {
            $this->saveCharitiesToJson();
        } else {
            echo "Charity with ID $charityId not found.\n";
        }
    }

    /**
     * Load charities from the JSON file.
     * 
     * @return void
     */
    public function loadCharitiesFromJson(): void
    {
        $jsonHandler = new JsonHandler($this->jsonFile);
        $data = $jsonHandler->loadData();

        foreach ($data as $charityData) {
            $name = isset($charityData['name']) ? (string)$charityData['name'] : '';
            $representativeEmail = isset($charityData['representativeEmail']) ? (string)$charityData['representativeEmail'] : '';
            $id = isset($charityData['id']) ? (int)$charityData['id'] : null;

            $charity = new Charity(
                $name,
                $representativeEmail,
                $id
            );
            $this->charities[$charity->getId()] = $charity;
        }
    }

    /**
     * Save charities to the JSON file
     * 
     * @return void
     */
    private function saveCharitiesToJson(): void
    {
        $jsonHandler = new JsonHandler($this->jsonFile);
        $data = [];

        foreach ($this->charities as $charity) {
            $data[] = [
                'id' => $charity->getId(),
                'name' => $charity->getName(),
                'representativeEmail' => $charity->getRepresentativeEmail(),
            ];

            $jsonHandler->saveData($data);
        }
    }
}

?>