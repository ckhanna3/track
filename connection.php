<?php

error_reporting(0);
$mysqli = mysqli_connect('localhost', 'root', '',"visitor_tracking");
if(!$mysqli) {
    die("Cannot connect to the database!");
}
//mysqli_select_db($mysqli, 'visitor_tracking');
?>
