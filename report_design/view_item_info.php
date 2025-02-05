<?php
require_once '../stimulsoft/vendor/autoload.php';
require_once '../connect.php'; // Include the database connection file

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;
use Stimulsoft\Viewer\Enums\StiViewerTheme;
use Stimulsoft\Viewer\StiViewerOptions;
// Get the item_code from the URL
$item_code = isset($_GET['item_code']) ? intval($_GET['item_code']) : 0;

// Set up the viewer
$viewer = new StiViewer();
$viewer->javascript->relativePath = '../stimulsoft/';
$viewer->options = new StiViewerOptions();


$viewer->options->toolbar->showOpenButton = false;
$viewer->options->toolbar->showBookmarksButton = false;
$viewer->options->toolbar->showAboutButton = false;

$viewer->options->appearance->theme = StiViewerTheme::Office2022BlackBlue;
// Define the data event handler
$viewer->onBeginProcessData = function (StiDataEventArgs $args) use ($item_code, $con) {
    if ($args->connection == 'it_asset') { // Ensure the connection name matches the .mrt file
        // Use the database connection directly from connect.php
        $args->connectionString = sprintf(
            'Server=localhost; Database=%s; UserId=%s; Pwd=%s;',
            $con->query("SELECT DATABASE()")->fetch_row()[0], // Get the selected database name
            $con->user, // Use username from the mysqli connection object
            $con->passwd // Use password from the mysqli connection object
        );
    }

    // Modify the query to filter by item_code
    if ($args->dataSource == 'asset_record') {
        $args->queryString = "SELECT * FROM asset_record WHERE item_code = $item_code";
    }
};

// Process the viewer
$viewer->process();

// Load the report design
$report = new StiReport();
$report->loadFile('item_info.mrt');

// Assign the report to the viewer
$viewer->report = $report;

// Render the viewer
$viewer->printHtml();
