<?php

class CsvHandler
{
    private $charityManager;

    /**
     * Constructor to initialize the CsvHandler with CharityManager.
     * 
     * @param CharityManager $charityManager CharityManager instance.
     */
    public function __construct(CharityManager $charityManager)
    {
        $this->charityManager = $charityManager;
    }

    /**
     * Import charities from a CSV file.
     * 
     * Reads a CSV file and adds charities to the CharityManager.
     * The CSV should have columns: ID, Name, Representative Email.
     * ID is ignored, and new IDs are assigned internally.
     * 
     * @param string $filepath Path to the CSV file.
     */
    public function importCharitiesFromCSV(string $filepath): void
    {
        if (!file_exists($filepath)) {
            echo "File not found: $filepath\n";
            return;
        }

        $file = fopen($filepath, 'r');
        if ($file === false) {
            echo "Failed to open file: $filepath\n";
            return;
        }

        $header = fgetcsv($file);

        if ($header === false) {
            echo "Failed to read the header row.\n";
            fclose($file);
            return;
        }

        while (($data = fgetcsv($file)) !== false) {
            if (count($data) >= 3) {
                $id = $data[0];            // Read ID (ignored)
                $name = $data[1];          // Charity name
                $email = $data[2];         // Representative email
                $this->charityManager->addCharity($name, $email);
                echo "Charity imported successfully: $name\n";
            } else {
                echo "Invalid CSV format on line: " . implode(", ", $data) . "\n";
            }
        }

        fclose($file);
    }
}

?>
