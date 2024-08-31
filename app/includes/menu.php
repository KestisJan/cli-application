<?php

/**
 * Displays the interactive menu options to the user.
 */
function displayMenu()
{
    echo "\nCharity Manager CLI\n";
    echo "1. Add Charity\n";
    echo "2. View Charities\n";
    echo "3. Edit Charity\n";
    echo "4. Delete Charity\n";
    echo "5. Add Donation\n";
    echo "6. Import Charities from CSV\n";
    echo "7. Exit\n";
    echo "Enter your choice: "; 
}

/**
 * Prompts the user to press Enter to return to the main menu.
 */
function goBack()
{
    echo "Press Enter to return to the main menu...\n";
    fgets(STDIN);
}

/**
 * Handles user input by executing the corresponding command function.
 *
 * @param array $commands An associative array of command choices and their corresponding functions.
 */
function handleUserInput($commands)
{
    $choice = trim(fgets(STDIN));

    if (array_key_exists($choice, $commands)) {
        $commands[$choice]();
    } else {
        echo "Invalid choice. Please try again.\n";
    }
}

/**
 * Runs the interactive mode by repeatedly displaying the menu and handling user input.
 *
 * @param array $commands An associative array of command choices and their corresponding functions.
 */
function runInteractiveMode($commands)
{
    while (true) {
        displayMenu();
        handleUserInput($commands);
        goBack(); // Ensure the user presses Enter to return to the menu
    }
}

?>
