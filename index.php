#!/usr/bin/php
<?php

require_once __DIR__ . '/app/includes/init.php';
require_once __DIR__ . '/app/includes/commandHandlers.php';
require_once __DIR__ . '/app/includes/help.php';
require_once __DIR__ . '/app/includes/menu.php';

// Parse command-line options
$shortOptions = "h:a:v:e:d:n:i:";
$longOptions = [
    "help",               
    "add-charity:",      
    "view-charities",    
    "edit-charity:",  
    "delete-charity:",
    "add-donation:",
    "import-csv:"
];
$options = getopt($shortOptions, $longOptions);

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
if (isset($options['h']) || isset($options['help'])) {
    displayHelp();
    exit();
} else {
    handleCommandOptions($options, $donationManager, $charityManager);
}

// Run interactive mode if no options are provided
echo "No options detected, running interactive mode.\n";
runInteractiveMode($commands);

?>
