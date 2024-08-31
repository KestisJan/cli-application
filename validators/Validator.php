<?php

class Validator
{
    /**
     * Validate if a value is a non-empty string with maximum length.
     * 
     * @param string $value Value to be validated.
     * @param string $fieldName Name of the field for error messages.
     * @param int $maxLength Maximum allowed length.
     * @throws InvalidArgumentException If validation fails
     */
    public static function validateString($value, $fieldName, $maxLength = 50)
    {
        if (!is_string($value) || empty($value)) {
            throw new InvalidArgumentException("$fieldName cannot be empty.");
        }

        if (strlen($value) > $maxLength) {
            throw new InvalidArgumentException("$fieldName cannot exceed $maxLength characters.");
        }
    }

    /**
     * Validate if a value is a valid email address.
     * 
     * @param string $email Email address to be validated.
     * @throws InvalidArgumentException If the email format is invalid.
     */
    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format.");
        }
    }

    /**
     * Validate if a value is a positive number (greater than zero)
     * 
     * @param mixed $amount Value to be validated.
     * @throws InvalidArgumentException If the amount is not a positive number.
     */
    public static function validateAmount($amount)
    {
        if (!is_numeric($amount) || $amount <= 0) {
            throw new InvalidArgumentException("Amount must be a positive number greater than zero.");
        }
    }

    /**
     * Validate if data is an array.
     * 
     * @param mixed $data Data to be validated.
     * @throws InvalidArgumentException If the data is not an array.
     */
    public static function validateArray($data)
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException("Data must be an array.");
        }
    }

    /**
     * Validate if a file path is a non-empty string.
     * 
     * @param string $filePath File path to be validated.
     * @throws InvalidArgumentException If the file path is not valid.
     */
    public static function validateFilePath($filePath)
    {
        if (!is_string($filePath) || empty($filePath)) {
            throw new InvalidArgumentException("Invalid file path provided.");
        }   
    }
}

?>