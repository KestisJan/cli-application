<?php

function displayMenu()
{
    echo "\nCharity Manager CLI\n";
    echo "1. Add Charity\n";
    echo "2. View Charities\n";
    echo "3. Edit Charity\n";
    echo "4. Delete Charity\n";
    echo "5. Add Donation \n";
    echo "6. Import Charities from CSV\n";
    echo "7. Exit\n";
    echo "Enter your choice: "; 
}

function goBack()
{
    echo "Press Enter to return to main menu...\n";
    fgets(STDIN);
}

function handleUserInput($commands)
{
    $choice = trim(fgets(STDIN));

    if (array_key_exists($choice, $commands)) {
        $commands[$choice]();
    } else {
        echo "Invalid choice. Please try again\n";
    }
}

?>