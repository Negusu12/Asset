<?php
require_once '../stimulsoft/vendor/autoload.php';
require_once '../connect.php'; // Include the database connection file

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;

// Get the loan_id from the URL
$loan_id = isset($_GET['loan_id']) ? intval($_GET['loan_id']) : 0;

// Set up the viewer
$viewer = new StiViewer();
$viewer->javascript->relativePath = '../stimulsoft/';

// Define the data event handler
$viewer->onBeginProcessData = function (StiDataEventArgs $args) use ($loan_id, $con) {
    if ($args->connection == 'it_asset') { // Ensure the connection name matches the .mrt file
        // Use the database connection directly from connect.php
        $args->connectionString = sprintf(
            'Server=localhost; Database=%s; UserId=%s; Pwd=%s;',
            $con->query("SELECT DATABASE()")->fetch_row()[0], // Get the selected database name
            $con->user, // Use username from the mysqli connection object
            $con->passwd // Use password from the mysqli connection object
        );
    }

    // Modify the query to filter by loan_id
    if ($args->dataSource == 'asset_loan_v') {
        $args->queryString = "SELECT * FROM asset_loan_v WHERE loan_id = $loan_id";
    }
};

// Process the viewer
$viewer->process();

// Load the report design
$report = new StiReport();
$report->loadFile('../report_design/loan.mrt');

// Assign the report to the viewer
$viewer->report = $report;

// Render the viewer
$viewer->printHtml();
