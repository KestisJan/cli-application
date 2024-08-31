# Charity and Donation Management System

## Overview

This Charity and Donation Management System allows users to manage charities and donations via a command-line interface. Users can add, view, edit, delete charities, add donations, and import charities from a CSV file.

## Features

- **Add a Charity**: Add new charities with name and email.
- **View Charities**: List all charities.
- **Edit a Charity**: Update the details of an existing charity.
- **Delete a Charity**: Remove a charity from the system.
- **Add a Donation**: Record donations made to charities.
- **Import Charities**: Import multiple charities from a CSV file.

## Installation

1. **Clone the Repository**

   ```bash
   git clone <repository-url>

   cd <project-directory>

## Usage

```bash
** Add a Charity
php index.php -a 'Red Cross,info@redcross.org'

** View Charities
php index.php -v

** Edit a Charity
php index.php -e '1,New Name,newemail@domain.com'

** Delete a Charity
php index.php -e '1,New Name,newemail@domain.com'

** Add a Donation
php index.php -n 'John Doe,100,1'

** Import Charities from CSV 
Note that all imported files will be placed in the data directory.

php index.php -i 'charities.csv'


