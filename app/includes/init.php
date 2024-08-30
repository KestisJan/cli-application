<?php

require_once './models/Charity.php';
require_once './models/Donation.php';
require_once './models/CharityManager.php';
require_once './models/DonationManager.php';
require_once './validators/Validator.php';
require_once './utils/utils.php';
require_once './utils/JsonHandler.php';

$donationManager = new DonationManager();
$charityManager = new CharityManager($donationManager);

ensureDirectoryExists('data');

return [
    'donationManager' => $donationManager,
    'charityManager' => $charityManager,
];
