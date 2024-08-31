#!/usr/bin/php
<?php

require_once __DIR__ . '/app/includes/init.php';
require_once __DIR__ . '/app/includes/commandHandlers.php';
require_once __DIR__ . '/app/includes/menu.php';

// Parse command-line options
$shortOptions = "h:a:v:e:d:n:i:";
$longOptions = [
    "help",               // No value required
    "add-charity:",       // Requires a value
    "view-charities",     // No value required
    "edit-charity:",      // Requires a value
    "delete-charity:",    // Requires a value
    "add-donation:",      // Requires a value
    "import-csv:"        // Requires a value
];
$options = getopt($shortOptions, $longOptions);



// Check for help option
if (isset($options['h']) || isset($options['help'])) {
    echo "Usage: php index.php [options]\n";
    echo "Options:\n";
    echo "  -h, --help          Show help message\n";
    echo "  -a, --add-charity   Add a charity. Provide name and email as arguments (e.g., 'name,email').\n";
    echo "  -v, --view-charities View all charities.\n";
    echo "  -e, --edit-charity  Edit a charity. Provide ID, new name, and new email as arguments (e.g., 'id,newName,newEmail').\n";
    echo "  -d, --delete-charity Delete a charity. Provide ID as an argument.\n";
    echo "  -n, --add-donation  Add a donation. Provide donor name, amount, and charity ID as arguments (e.g., 'donorName,amount,charityId').\n";
    echo "  -i, --import-csv    Import charities from a CSV file. The CSV file must be placed in the 'data' directory. Provide only the file name (e.g., 'charities.csv').\n";
    exit();
}

// Initialize managers
$donationManager = new DonationManager();
$charityManager = new CharityManager($donationManager);

// Commands array for interactive mode
$commands = [
    '1' => function() use ($charityManager) { handleAddCharity($charityManager); },
    '2' => function() use ($charityManager) { handleViewCharities($charityManager); },
    '3' => function() use ($charityManager) { handleEditCharity($charityManager); },
    '4' => function() use ($charityManager) { handleDeleteCharity($charityManager); },
    '5' => function() use ($donationManager, $charityManager) { handleAddDonation($donationManager, $charityManager); },
    '6' => function() use ($charityManager) { handleImportCharitiesFromCSV($charityManager); },
    '7' => function() { exit("Exiting program.\n"); }
];

// Handle command-line options
if (isset($options['a'])) {
    echo "Add charity option detected with input: " . $options['a'] . "\n";
    $input = explode(',', $options['a']);
    if (count($input) == 2) {
        $charityManager->addCharity(trim($input[0]), trim($input[1]));
    } else {
        echo "Invalid input for adding charity. Provide both name and email in the format: 'name,email'.\n";
        echo "Example: php index.php -a 'Red Cross,info@redcross.org'\n";
    }
} elseif (isset($options['v'])) {
    echo "View charities option detected.\n";
    handleViewCharities($charityManager);
} elseif (isset($options['e'])) {
    echo "Edit charity option detected with input: " . $options['e'] . "\n";
    $input = explode(',', $options['e']);
    if (count($input) == 3) {
        $charityManager->editCharity((int)$input[0], trim($input[1]), trim($input[2]));
    } else {
        echo "Invalid input for editing charity. Provide ID, new name, and new email in the format: 'id,newName,newEmail'.\n";
        echo "Example: php index.php -e '1,New Name,newemail@domain.com'\n";
    }
} elseif (isset($options['d'])) {
    echo "Delete charity option detected with ID: " . $options['d'] . "\n";
    if (is_numeric($options['d'])) {
        $charityManager->deleteCharity((int)$options['d']);
    } else {
        echo "Invalid input for deleting charity. Provide the ID of the charity to be deleted.\n";
        echo "Example: php index.php -d '1'\n";
    }
} elseif (isset($options['n'])) {
    echo "Add donation option detected with input: " . $options['n'] . "\n";
    $input = explode(',', $options['n']);
    if (count($input) == 3) {
        $donationManager->addDonation(trim($input[0]), (float)$input[1], (int)$input[2]);
    } else {
        echo "Invalid input for adding donation. Provide donor name, amount, and charity ID in the format: 'donorName,amount,charityId'.\n";
        echo "Example: php index.php -n 'John Doe,100,1'\n";
    }
} elseif (isset($options['i'])) {
    echo "Import CSV option detected with file: " . $options['i'] . "\n";
    $filename = $options['i'];
    if (!empty($filename)) {
        $filepath = 'data/' . $filename;
        handleImportCharitiesFromCSV($charityManager, $filepath);
    } else {
        echo "Invalid input for importing CSV. Provide the name of the CSV file located in the 'data' directory.\n";
        echo "Example: php index.php -i 'charities.csv'\n";
    }
} else {
    // Run interactive mode if no options are provided
    echo "No options detected, running interactive mode.\n";
    while (true) {
        displayMenu();
        handleUserInput($commands);
    }
}
