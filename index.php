#!/usr/bin/php
<?php

require_once __DIR__ . '/app/includes/init.php';
require_once __DIR__ . '/app/includes/commandHandlers.php';
require_once __DIR__ . '/app/includes/menu.php';

$options = getopt("h:a:v:e:d:n", ["help", "add-charity:", "view-charities", "edit-charity:", "delete-charity:", "add-donation:"]);

if (isset($options['h']) || isset($options['help'])) {
    echo "Usage: php index.php [options]\n";
    echo "Options:\n";
    echo "  -h, --help          Show help message\n";
    echo "  -a, --add-charity   Add a charity. Provide name and email as arguments (e.g., 'name,email').\n";
    echo "  -v, --view-charities View all charities.\n";
    echo "  -e, --edit-charity  Edit a charity. Provide ID, new name, and new email as arguments (e.g., 'id,newName,newEmail').\n";
    echo "  -d, --delete-charity Delete a charity. Provide ID as an argument.\n";
    echo "  -n, --add-donation  Add a donation. Provide donor name, amount, and charity ID as arguments (e.g., 'donorName,amount,charityId').\n";
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
    '6' => function() { exit("Exiting program.\n"); }
];

// Handle command-line options
if (isset($options['a'])) {
    $input = explode(',', $options['a']);
    if (count($input) == 2) {
        $charityManager->addCharity(trim($input[0]), trim($input[1]));
    } else {
        echo "Invalid input for adding charity. Provide both name and email.\n";
    }
} elseif (isset($options['v'])) {
    handleViewCharities($charityManager);
} elseif (isset($options['e'])) {
    $input = explode(',', $options['e']);
    if (count($input) == 3) {
        $charityManager->editCharity((int)$input[0], trim($input[1]), trim($input[2]));
    } else {
        echo "Invalid input for editing charity. Provide ID, new name, and new email.\n";
    }
} elseif (isset($options['d'])) {
    $charityManager->deleteCharity((int)$options['d']);
} elseif (isset($options['n'])) {
    $input = explode(',', $options['n']);
    if (count($input) == 3) {
        $donationManager->addDonation(trim($input[0]), (float)$input[1], (int)$input[2]);
    } else {
        echo "Invalid input for adding donation. Provide donor name, amount, and charity ID.\n";
    }
} else {
    while (true) {
        displayMenu();
        handleUserInput($commands);
    }
}
