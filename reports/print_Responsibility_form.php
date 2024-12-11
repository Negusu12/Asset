<?php
// Database connection
include '../connect.php';

// Fetch all employees for the dropdown
$employeesQuery = "SELECT employee_id, full_name FROM employee";
$employeesResult = $con->query($employeesQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>IT Equipment Responsibility Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 210mm;
            /* A4 width */
            height: 290mm;
            /* A4 height */
            margin: 20px auto;
            /* Center the container on the page */
            background-image: url('../assets/dist/img/letter_heading.png');
            /* Set your image */
            background-size: contain;
            /* Scale the image to fit the container */
            background-repeat: no-repeat;
            /* Prevent the image from repeating */
            background-position: center;
            /* Optional: Add a border for clarity */
            padding: 20px;
            /* Optional: Add shadow for aesthetics */
            overflow: hidden;
            /* Prevent content overflow */
        }



        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 60px;
            margin-top: 10px;
        }

        .header h1 {
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
        }

        p {
            line-height: 1.6;
            font-size: 14px;
            text-align: justify;
        }

        .equipment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .equipment-table th,
        .equipment-table td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;
        }

        .equipment-table th {
            background-color: transparent;
            font-weight: bold;
        }



        .signature-section label {
            display: block;
            margin-bottom: 10px;
        }

        .signature-section input[type="text"] {
            width: 300px;
            padding: 5px;
            padding-left: 50px;
            border: none;
            border-bottom: 1px solid #000000;
            margin-bottom: 10px;
            background-color: transparent;
        }

        .signature-section label span {
            width: 100px;
        }

        .signature-section input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .signature-section input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .print-button {
            margin: 20px auto;
            display: block;
            width: 50px;
            height: 50px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        .content {
            margin-top: 15%;
            margin-bottom: 10%;
            margin-left: 5%;
            margin-right: 5%;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
        $employeeId = intval($_POST['employee_id']);

        // Fetch employee details
        $employeeQuery = "SELECT borrower_title, full_name, department FROM employee WHERE employee_id = $employeeId";
        $employeeResult = $con->query($employeeQuery);
        $employee = $employeeResult->fetch_assoc();

        // Fetch asset loan details for the employee
        $assetsQuery = "SELECT al.item_code, ar.item_name, ar.brand, ar.model, al.serial_no, al.qty, al.description, ar.item_condition 
                        FROM asset_loan al 
                        JOIN asset_record ar ON al.item_code = ar.item_code 
                        WHERE al.employee_id = $employeeId and al.qty > 0 and ar.item_condition = 'None Moveable'";
        $assetsResult = $con->query($assetsQuery);
    ?>
        <div id="responsibility-form">
            <!-- Render Responsibility Form -->
            <div class="container">
                <div class="content">
                    <div class="header">
                        <h1>IT Equipment Responsibility Form</h1>
                    </div>
                    <p>I acknowledge that I have received the following equipment for use in my work area.</p>
                    <p>I understand that it is my complete responsibility to keep equipment in a safe place within the work area. <b>I also understand that under no circumstances am I to remove the equipment from the work area without first getting permission from IT Department.</b></p>
                    <p>I am aware that if the equipment is broken, stolen or damaged; it is my responsibility to immediately report to the appropriate manager and I also understand that I may be charged for any damages that occurred while in my possession that are a result of misuse or carelessness. (This is based on method of damages).</p>
                    <p>I understand that once my employment ends, it is my responsibility to return all equipment signed out to me. Failure to do so will/may result in the withholding of my final paycheck.</p>
                    <p>By signing below, employee acknowledges that he/she has reviewed this equipment responsibility form, and accepts the condition set forth as related to the equipment described below.</p>

                    <div class="signature-section">
                        <label>
                            <span>Department:</span>
                            <input type="text" name="department" value="<?= htmlspecialchars($employee['department']) ?>" readonly style="font-weight: bold;">
                        </label>
                        <label>
                            <span>Responsible Employee:</span>
                            <input type="text" name="employee" value="<?= htmlspecialchars($employee['borrower_title']) . ' ' . htmlspecialchars($employee['full_name']) ?>" readonly style="font-weight: bold; text-align: left;">

                        </label>
                    </div>

                    <span><b>Equipment</b></span>
                    <table class="equipment-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Equipment Description/Type</th>
                                <th>Model</th>
                                <th>Serial#</th>
                                <th>Qty</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($assetsResult->num_rows > 0) {
                                $no = 1;
                                while ($asset = $assetsResult->fetch_assoc()) {
                                    echo "<tr>
                                        <td>$no</td>
                                        <td>" . htmlspecialchars($asset['item_name']) . " - " . htmlspecialchars($asset['brand']) . "</td>
                                        <td>" . htmlspecialchars($asset['model']) . "</td>
                                        <td>" . htmlspecialchars($asset['serial_no']) . "</td>
                                        <td>" . htmlspecialchars($asset['qty']) . "</td>
                                        <td>" . ($asset['description']) . "</td>
                                    </tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='6'>No assets found for this employee.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="signature-section" style="margin-top: 20px; padding-top: 20px;">
                        <form>
                            <label>
                                <span>Date:</span>
                                <input type="text" name="date" value="<?= date('F j Y') ?>" readonly>
                            </label>
                            <label>
                                <span>Signature:</span>
                                <input type="text" name="date" required readonly>
                            </label>
                        </form>
                    </div>

                    <button class="print-button" onclick="window.print()"><i class="fa-solid fa-print"></i></button>
                </div>
            </div>
        </div>
    <?php
    }
    $con->close();
    ?>
</body>

</html>