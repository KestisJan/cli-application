<?php

/**
 * Displays the help message explaining the usage and available options.
 */
function displayHelp() {
    echo "Usage: php index.php [options]\n";
    echo "Options:\n";
    echo "  -h, --help          Show help message\n";
    echo "  -a, --add-charity   Add a charity. Provide name and email as arguments (e.g., 'name,email').\n";
    echo "  -v, --view-charities View all charities.\n";
    echo "  -e, --edit-charity  Edit a charity. Provide ID, new name, and new email as arguments (e.g., 'id,newName,newEmail').\n";
    echo "  -d, --delete-charity Delete a charity. Provide ID as an argument.\n";
    echo "  -n, --add-donation  Add a donation. Provide donor name, amount, and charity ID as arguments (e.g., 'donorName,amount,charityId').\n";
    echo "  -i, --import-csv    Import charities from a CSV file. The CSV file must be placed in the 'data' directory. Provide only the file name (e.g., 'charities.csv').\n";
}

?>
