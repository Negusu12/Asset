<?php
require_once 'stimulsoft/vendor/autoload.php';

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;

// Set the path to the license file
// Creating a viewer object and set the necessary javascript options
$viewer = new StiViewer();
$viewer->javascript->relativePath = './stimulsoft/';

// Disable the "Save" button on the toolbar

$viewer->onBeginProcessData = function (StiDataEventArgs $args) {
    if ($args->connection == 'MyConnectionName')
        $args->connectionString = 'Server=localhost; Database=it_asset; UserId=root; Pwd=;';

    // You can change the SQL query
    if ($args->dataSource == 'MyDataSource')
        $args->queryString = 'SELECT * FROM MyTable';

    if ($args->dataSource == 'MyDataSourceWithParams') {
        $args->parameters['Parameter1']->value = 'TableName';
        $args->parameters['Parameter2']->value = 10;
        $args->parameters['Parameter3']->value = '2019-01-20';
    }
};

$viewer->process();

// Creating a report object
$report = new StiReport();

$report->loadFile('report_design/payment.mrt');

$viewer->report = $report;

$viewer->printHtml();
