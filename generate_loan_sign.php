<?php
require_once 'stimulsoft/vendor/autoload.php';

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;

// Get the loan_id from the URL
$loan_id = isset($_GET['loan_id']) ? intval($_GET['loan_id']) : 0;

// Set up the viewer
$viewer = new StiViewer();
$viewer->javascript->relativePath = './stimulsoft/';
$viewer->options->toolbar->showSaveButton = false;
$viewer->options->toolbar->showOpenButton = false;

// Define the data event handler
$viewer->onBeginProcessData = function (StiDataEventArgs $args) use ($loan_id) {
    if ($args->connection == 'MyConnectionName') {
        $args->connectionString = 'Server=localhost; Database=it_asset; UserId=root; Pwd=;';
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
$report->loadFile('report_design/loan.mrt');

// Assign the report to the viewer
$viewer->report = $report;

// Render the viewer
$viewer->printHtml();
