<?php
if (isset($_GET["id"])) {
    include('connect.php');
    $id = $_GET['id'];
    //Delete the line
    $sql = "DELETE FROM users WHERE id=$id";
    if ($con->query($sql) == TRUE) {
        header('location:users.php');
    } else {
        echo "Error delete record: ";
    }
}
