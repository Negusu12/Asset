<?php
$con = new mysqli('localhost', 'root', '', 'it_asset');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
