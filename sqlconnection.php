<?php
$mysqli = new mysqli("localhost", "root", "mysql", "school_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>