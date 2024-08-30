<?php

/**
 * Handles adding a new charity by reading user input.
 *
 * @param CharityManager $charityManager The CharityManager instance to handle charity operations.
 */
function handleAddCharity($charityManager) {
    echo "Enter charity name and email (comma-separated): ";
    $input = trim(fgets(STDIN));
    $data = explode(',', $input);
    
    if (count($data) === 2) {
        list($name, $email) = $data;
        $name = trim($name);
        $email = trim($email);
        
        if ($name && $email) {
            $charityManager->addCharity($name, $email);
        } else {
            echo "Invalid input adding charity. Provide both name and email.\n";
        }
    } else {
        echo "Invalid input. Provide both name and email separated by a comma.\n";
    }
    goBack();
}

/**
 * Handles viewing all charities by calling the CharityManager.
 *
 * @param CharityManager $charityManager The CharityManager instance to handle charity operations.
 */
function handleViewCharities($charityManager) {
    $charityManager->viewCharities();
    goBack();
}

/**
 * Handles editing an existing charity by reading user input.
 *
 * @param CharityManager $charityManager The CharityManager instance to handle charity operations.
 */
function handleEditCharity($charityManager) {
    echo "Enter charity ID, new name, and new email (comma-separated): ";
    $input = trim(fgets(STDIN));
    $data = explode(',', $input);
    
    if (count($data) === 3) {
        list($id, $newName, $newEmail) = $data;
        if (is_numeric($id) && $newName && $newEmail) {
            $charityManager->editCharity((int)$id, trim($newName), trim($newEmail));
        } else {
            echo "Invalid input. Ensure ID is numeric and both new name and email are provided.\n";
        }
    } else {
        echo "Invalid input. Provide ID, new name, and new email separated by commas.\n";
    }
    goBack();
}

/**
 * Handles deleting a charity by reading user input.
 *
 * @param CharityManager $charityManager The CharityManager instance to handle charity operations.
 */
function handleDeleteCharity($charityManager) {
    echo "Enter charity ID to delete: ";
    $input = trim(fgets(STDIN));
    
    if (is_numeric($input)) {
        $charityManager->deleteCharity((int)$input);
    } else {
        echo "Invalid input. Provide a numeric charity ID to delete.\n";
    }
    goBack();
}

/**
 * Handles adding a donation by reading user input and updating both DonationManager and CharityManager.
 *
 * @param DonationManager $donationManager The DonationManager instance to handle donation operations.
 * @param CharityManager $charityManager The CharityManager instance to handle charity operations.
 */
function handleAddDonation($donationManager, $charityManager) {
    echo "Enter donor name, amount, and charity ID (comma-separated): ";
    $input = trim(fgets(STDIN));
    $data = explode(',', $input);
    
    if (count($data) === 3) {
        list($donorName, $amount, $charityId) = $data;
        $donorName = trim($donorName);
        if (is_numeric($amount) && is_numeric($charityId) && $donorName) {
            $donation = new Donation($donorName, (float)$amount, (int)$charityId);
            $donationManager->addDonation($donorName, $amount, $charityId);
            $charityManager->addDonationToCharity($donation);
            echo "Donation added successfully.\n";
        } else {
            echo "Invalid input. Ensure donor name is provided, and amount and charity ID are numeric.\n";
        }
    } else {
        echo "Invalid input. Provide donor name, amount, and charity ID separated by commas.\n";
    }
    goBack();
}

?>
