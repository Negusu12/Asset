<?php
require __DIR__ . '/vendor/autoload.php'; // Adjust this path as needed

use PHPJasper\PHPJasper;

// Include the database connection file
include 'connect.php'; // Assuming connect.php is in the same directory

// Get record_id from URL
$record_id = $_GET['loan_id'];

// Path to JasperStarter (update to your installation path)
$jasperstarter_path = 'C:/Program Files (x86)/JasperStarter/bin/jasperstarter';

// Paths for input (Jasper file) and temporary output
$input = __DIR__ . '/jasper/print_loan.jasper';
$output = sys_get_temp_dir() . '/print_loan_' . $record_id; // Save temporarily
$output_format = 'pdf'; // Format: pdf, xlsx, etc.

// Database connection parameters (using $con from connect.php)
$db_host = 'localhost';
$db_port = '3306';
$db_name = 'it_asset';
$db_user = 'root';
$db_pass = ''; // Leave empty if no password

// Initialize PHPJasper
$jasper = new PHPJasper();

try {
    // Prepare the database connection parameters
    $db_connection = [
        'driver' => 'mysql',
        'username' => $db_user,
        'host' => $db_host,
        'database' => $db_name,
        'port' => $db_port,
    ];

    // Include the password only if it's not empty
    if (!empty($db_pass)) {
        $db_connection['password'] = $db_pass;
    }

    // Execute the Jasper process with database connection
    $jasper->process(
        $input,
        $output,
        [
            'format' => [$output_format],
            'params' => [
                'record_id' => $record_id
            ],
            'db_connection' => $db_connection,
        ],
        $jasperstarter_path
    )->execute();

    // Redirect to the generated file
    $output_file = $output . '.' . $output_format;

    // Send the PDF file to the browser without saving it permanently
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="loan_report_' . $record_id . '.pdf"');
    readfile($output_file);

    // Delete the temporary file after sending it
    unlink($output_file);
} catch (Exception $e) {
    echo 'Error generating report: ' . $e->getMessage();
}
