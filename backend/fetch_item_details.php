<?php
include '../connect.php';


if (isset($_POST['transaction_id'])) {
    $transaction_id = mysqli_real_escape_string($con, $_POST['transaction_id']);

    $sql = "SELECT 
stl.transaction_id,
stl.transaction_id_line,
c.charge AS charge,
e.full_name AS owner,
stl.phone_number,
stl.payment_period,
stl.expire_date,
stl.taken_date,
stl.payment_type,
stl.status,
stl.description_line
from sim_card_transactions_line stl
LEFT JOIN charges c ON stl.charge = c.charge_id
LEFT JOIN employee e ON stl.owner = e.employee_id
            WHERE stl.transaction_id = '$transaction_id'";
    $result = mysqli_query($con, $sql);

    $total = 0; // Initialize total

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['transaction_id_line']} - {$row['transaction_id_line']}</td>";
            echo "<td>{$row['charge']}</td>";
            echo "<td>{$row['owner']}</td>";
            echo "<td>{$row['phone_number']}</td>";
            echo "<td>{$row['payment_period']}</td>";
            echo "<td>{$row['expire_date']}</td>";
            echo "<td>{$row['taken_date']}</td>";
            echo "<td>{$row['payment_type']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['description_line']}</td>";
            echo "</tr>";
        }
    }
}
