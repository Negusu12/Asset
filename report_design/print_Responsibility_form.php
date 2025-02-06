<?php
require_once '../stimulsoft/vendor/autoload.php';
require_once '../connect.php'; // Include the database connection file

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;
use Stimulsoft\Viewer\Enums\StiViewerTheme;
use Stimulsoft\Viewer\StiViewerOptions;
// Get the item_code from the URL

// Set up the viewer
$viewer = new StiViewer();
$viewer->javascript->relativePath = '../stimulsoft/';
$viewer->options = new StiViewerOptions();


$viewer->options->toolbar->showOpenButton = false;
$viewer->options->toolbar->showBookmarksButton = false;
$viewer->options->toolbar->showAboutButton = false;

$viewer->options->appearance->theme = StiViewerTheme::Office2022BlackBlue;
// Define the data event handler


// Process the viewer
$viewer->process();

// Load the report design
$report = new StiReport();
$report->loadFile('print_Responsibility_form.mrt');

// Assign the report to the viewer
$viewer->report = $report;

// Render the viewer
$viewer->printHtml();
