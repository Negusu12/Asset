<?php
//for MySQLi OOP
$con = new mysqli('localhost', 'root', '', 'it_asset_test');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
