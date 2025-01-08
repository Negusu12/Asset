<?php
$con = new mysqli('localhost', 'root', '', 'it_asset'); // Replace with your database details
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Add these properties to make them accessible in generate_loan_sign.php
$con->user = 'root'; // Replace with your database username
$con->passwd = '';   // Replace with your database password
