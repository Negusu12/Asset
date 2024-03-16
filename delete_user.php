<?php


if (isset($_GET["id"])) {
    include('connect.php');
    $id = $_GET['id'];
    //Delete the line
    $sql = "DELETE FROM users WHERE id=$id";
    if ($con->query($sql) == TRUE) {
        header('location:index.php?page=user_list');
    } else {
        echo "Error delete record: ";
    }
}
