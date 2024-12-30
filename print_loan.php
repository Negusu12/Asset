<?php
include 'connect.php';
$loan_id = $_GET['loan_id'];
$sql = "SELECT * FROM asset_loan_v WHERE loan_id = $loan_id";
$result = $con->query($sql);
if (!$result) {
    die("Invalid query!");
}
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
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
            width: 210mm;
            /* A4 width */
            height: 290mm;
            /* A4 height */
            margin: 20px auto;
            /* Center the container on the page */
            background-image: url('assets/dist/img/letter_heading.png');
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

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            width: 180px;
        }

        .table td {
            font-family: Verdana;
        }

        .table td,
        .table th {
            padding: 7px;
            border: 1px solid #ccc;
        }

        .table td p {
            font-size: 14px;
            line-height: 12px;
            font-family: Verdana;
        }

        .table th {
            background-color: transparent;
            text-align: left;
        }

        /* Hide the print button when printing */
        @media print {
            .print-button {
                display: none;

            }

            @page {
                size: A4;
                /* Set the page size to A4 or any desired size */
                margin-left: -10%;
                /* Remove default margins */
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

        .text {
            text-align: center;
            font-size: 41px;
            font-weight: 600;
            font-family: sans-serif;
            padding-bottom: 15px;
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
            width: 50px;
        }

        p {
            font-size: 14px;
            font-family: sans-serif;
            line-height: 25px;
        }

        h13 {
            font-size: 16px;
            font-family: sans-serif;
            font-weight: bold;
        }

        .img-container {
            float: right;
            /* Float the container to the right */
            width: 200px;
            /* Set a fixed width for the container */
            margin-top: 10px;
            /* Adjust margin as needed */
            margin-left: 10px;
            /* Adjust margin as needed */
        }

        .img-thumbnail {
            max-width: 150px;
            height: 150px;
            display: block;
            margin-top: -165px;
            margin-left: 50px;
        }

        .content {
            margin-top: 10%;
            margin-bottom: 10%;
            margin-left: 5%;
            margin-right: 5%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="content">
            <div class="text">
                <span style="font-size: 20px; text-decoration: underline;"><b>ABH IT Item Borrowing Form</b></span>
            </div>
            <table class="table">
                <tr>
                    <th>Loan ID</th>
                    <td><?php echo $row['loan_id']; ?></td>
                </tr>
                <tr>
                    <th>Item Name</th>
                    <td><?php echo $row['item_name']; ?></td>
                </tr>
                <tr>
                    <th>Item Condition</th>
                    <td><?php echo $row['item_condition']; ?></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><?php echo $row['brand']; ?></td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td><?php echo $row['model']; ?></td>
                </tr>
                <tr>
                    <th>Serial No.</th>
                    <td><?php echo $row['serial_no']; ?></td>
                </tr>
                <tr>
                    <th>Borrower Name</th>
                    <td><?php echo $row['borrower_title'] . ' ' . $row['full_name']; ?></td>
                </tr>

                <tr>
                    <th>Quantity</th>
                    <td><?php echo $row['qty']; ?></td>
                </tr>
                <tr>
                    <th>Document Date</th>
                    <td><?php echo date('F j Y', strtotime($row['doc_date'])); ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $row['description']; ?></td>
                </tr>
            </table>
            <div class="signature-section">
                <h13>I acknowledge:</h13>
                <p>
                    • I will ensure the borrowed item(s) are used properly and safely, kept in good condition, and returned on time.</p>
                <p>
                    • I understand that I am responsible for the cost of repair or replacement in case of any damage or loss to the item(s) while in my possession.
                </p>
            </div>
            <div class="signature-section">
                <form>
                    <label>
                        <span>Borrower Name:</span>
                        <input type="text" name="name" value="<?php echo $row['borrower_title'] . ' ' . $row['full_name']; ?>" required readonly>
                    </label>
                    <label>
                        <span>Borrowed Date:</span>
                        <input type="text" name="name" value="<?php echo date('F j Y', strtotime($row['doc_date'])); ?>" required readonly>
                    </label>
                    <label>
                        <span>Borrower signature :</span>
                        <input type="text" name="date" required readonly>
                    </label>
                </form>
            </div>
            <div class="img-container">
                <?php
                $image_data = $row['item_image'];
                if (!empty($image_data)) {
                    $base64_image = base64_encode($image_data);
                    if ($base64_image) {
                        echo '<img src="data:image/jpeg;base64,' . $base64_image . '" alt="Image" class="img-thumbnail" style="cursor: pointer;">';
                    } else {
                        echo '<p>Error: Unable to encode image data.</p>';
                    }
                } else {
                    echo '<p></p>';
                }
                ?>
            </div>

            <button class="print-button" onclick="window.print()"><i class="fa-solid fa-print fa-2xl"></i></button>
        </div>
    </div>


</body>

</html>