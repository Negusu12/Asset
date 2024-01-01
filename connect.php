<?php
//for MySQLi OOP
$con = new mysqli('localhost', 'root', '', 'asset1');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
