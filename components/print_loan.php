<?php
include '../connect.php';
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
            border: none;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }
        .signature-section label span {
            display: inline-block;
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
        

    </style>
</head>
<body>
<div class="text">
            IT Item Borrow Form
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
                <th>Loaner Name</th>
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
            <form>
                <label>
                    <span>Name:</span>
                    <input type="text" name="name" value="' . $row['full_name'] . '" required>
                </label>
                <label>
                    <span>Date:</span>
                    <input type="text" name="name" value="' . date('F j Y', strtotime($row['doc_date'])) . '" required>
                </label>
                <label>
                    <span>signature :</span>
                    <input type="text" name="date" required>
                </label>
            </form>
        </div>
        <button class="print-button" onclick="window.print()"><img src="printer_icon.png" alt="Print"></button>
    </div>
</body>
</html>';
