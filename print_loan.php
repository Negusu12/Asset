<?php
include 'connect.php';
$loan_id = $_GET['loan_id'];
$sql = "SELECT * FROM asset_loan_v WHERE loan_id = $loan_id";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query!");
}
$row = $result->fetch_assoc();

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Asset Management System - Print Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Add your print styles here */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th{
            width: 180px;
        }
        .table td{
            font-family: Verdana;
        }
        .table td, .table th {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .table th {
            background-color: #f7f7f7;
            text-align: left;
        }
        /* Hide the print button when printing */
        @media print {
            .print-button {
                display: none;
                
            }
            
        }
        /* Style the signature section */
        .signature-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
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
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
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
        .text {
            text-align: center;
            font-size: 41px;
            font-weight: 600;
            font-family:sans-serif;
        }
        .text_box {
    margin-bottom: 18px;
    display: flex;
    justify-content: center; 
    align-items: center; 
    flex-direction: column 2; 
}

        button.print-button {
            height: 50px;
            weidth: 50px;
        }
        p {
            font-size: 16px;
            font-family:sans-serif;            
            line-height: 25px;
        }
        h13 {
            font-size: 16px;
            font-family:sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="text_box">
<div class="text">
    <span style="font-size: 41px;">ABH IT Item Borrowing Form</span>
    </div>
    &nbsp;&nbsp;&nbsp;<img src="assets/dist/img/logo.png" alt="Logo" style="height: 61px;">
</div>

    <div class="container">
        <table class="table">
            <tr>
                <th>Loan ID</th>
                <td>' . $row['loan_id'] . '</td>
            </tr>
            <tr>
                <th>Item Name</th>
                <td>' . $row['item_name'] . '</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>' . $row['brand'] . '</td>
            </tr>
            <tr>
                <th>Model</th>
                <td>' . $row['model'] . '</td>
            </tr>
            <tr>
                <th>Serial No.</th>
                <td>' . $row['serial_no'] . '</td>
            </tr>
            <tr>
                <th>Borrower Name</th>
                <td>' . $row['full_name'] . '</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>' . $row['qty'] . '</td>
            </tr>
            <tr>
    <th>Document Date</th>
    <td>' . date('F j Y', strtotime($row['doc_date'])) . '</td>
</tr>
            <tr>
                <th>Description</th>
                <td>' . $row['description'] . '</td>
            </tr>
        </table>
        <div class="signature-section">
        <h13>I acknowledge:</h13>
        <p>
•  I will ensure the borrowed item(s) are used properly and safely, kept in good condition, and returned on time.</p>
<p>
•  I understand that I am responsible for the cost of repair or replacement in case of any damage or loss to the item(s) while in my possession.
</p></div>
        <div class="signature-section">
            <form>
                <label>
                    <span>Borrower Name:</span>
                    <input type="text" name="name" value="' . $row['full_name'] . '" required readonly>
                </label>
                <label>
                    <span>Borrowed Date:</span>
                    <input type="text" name="name" value="' . date('F j Y', strtotime($row['doc_date'])) . '" required readonly>
                </label>
                <label>
                    <span>Borrower signature :</span>
                    <input type="text" name="date" required readonly>
                </label>
            </form>
        </div>
        <button class="print-button" onclick="window.print()"><i class="fa-solid fa-print fa-2xl"></i></button>
    </div>
</body>
</html>';
