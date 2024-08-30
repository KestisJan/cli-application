<?php

class JsonHandler
{
    private $filePath;

    /**
     * Constructor to initialize the file path for the JSON data.
     * 
     * @param string $filepath Path to the JSON file.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Load data from the JSON file
     * 
     * @return array Data loaded from the file.
     */
    public function loadData()
    {
        if (file_exists($this->filePath)) {
            $jsonData = file_get_contents($this->filePath);
            return json_decode($jsonData, true) ?? [];
        }
        return [];
    }

    /**
     * Save data to the JSON file.
     * 
     * @param array $data Data to be save.
     * @return bool True on success, false on failure.
     */
    public function saveData(array $data)
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        return file_put_contents($this->filePath, $jsonData) !== false;
    }

    
}