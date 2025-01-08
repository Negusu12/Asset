<?php
require_once 'stimulsoft/vendor/autoload.php';

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;

// Creating a viewer object and set the necessary JavaScript options
$viewer = new StiViewer();
$viewer->javascript->relativePath = './stimulsoft/';

// Disable the "Save" and "Open" buttons on the toolbar
$viewer->options->toolbar->showSaveButton = false;
$viewer->options->toolbar->showOpenButton = false;

// Dynamically handle the database connection
$viewer->onBeginProcessData = function (StiDataEventArgs $args) {
    // Override the connection string dynamically in PHP
    if ($args->connection == 'it_asset') { // Match the Alias used in the .mrt file
        $args->connectionString = 'Server=localhost;Database=it_asset;UserId=root;Pwd=;';
    }
};

// Creating a report object
$report = new StiReport();

// Load the report template (.mrt file)
$report->loadFile('report_design/payment.mrt');

// Bind the report to the viewer
$viewer->report = $report;

// Process the viewer
$viewer->process();

// Print the viewer as HTML
$viewer->printHtml();
