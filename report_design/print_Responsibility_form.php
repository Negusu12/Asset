<?php
require_once '../stimulsoft/vendor/autoload.php';
require_once '../connect.php'; // Database connection

use Stimulsoft\Events\StiDataEventArgs;
use Stimulsoft\Report\StiReport;
use Stimulsoft\Viewer\StiViewer;
use Stimulsoft\Viewer\Enums\StiViewerTheme;

// Get selected full_name from URL
$full_name = isset($_GET['full_name']) ? $con->real_escape_string($_GET['full_name']) : '';

// Fetch employee names for dropdown
$sql = "SELECT DISTINCT full_name FROM employee";
$result = $con->query($sql);
$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row['full_name'];
}

// Set up the viewer
$viewer = new StiViewer();
$viewer->javascript->relativePath = '../stimulsoft/';
$viewer->options->appearance->theme = StiViewerTheme::Office2022BlackGreen;

// Define the data event handler (fetch data from responsibility_form)
$viewer->onBeginProcessData = function (StiDataEventArgs $args) use ($full_name, $con) {
    if ($args->connection == 'it_asset') { // Ensure the connection name matches the .mrt file
        $args->connectionString = sprintf(
            'Server=localhost; Database=%s; UserId=%s; Pwd=%s;',
            $con->query("SELECT DATABASE()")->fetch_row()[0], // Get database name
            $con->user, // MySQL username
            $con->passwd // MySQL password
        );
    }

    // Ensure all records for selected full_name are retrieved
    if ($args->dataSource == 'employee') {
        $args->queryString = "SELECT * FROM employee WHERE full_name = '$full_name'";
    } elseif ($args->dataSource == 'asset_loan_v') {
        $args->queryString = "SELECT 
                                al.item_code, 
                                ar.item_name, 
                                ar.brand, 
                                ar.model, 
                                al.serial_no, 
                                al.qty, 
                                al.description, 
                                ar.item_condition
                            FROM asset_loan_v al 
                            JOIN asset_record ar ON al.item_code = ar.item_code 
                            LEFT JOIN employee e ON al.employee_id = e.employee_id
                            WHERE e.full_name = '$full_name' 
                            AND al.qty > 0 
                            AND ar.item_condition = 'None Moveable'";
    }
};

// Process the viewer
$viewer->process();

// Load the report design
$report = new StiReport();
$report->loadFile('../report_design/print_Responsibility_form.mrt');

// Assign the report to the viewer
$viewer->report = $report;
$viewer->printHtml();
