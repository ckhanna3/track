<?php
session_start();
include("connection.php");

$ip_address = $_SERVER["REMOTE_ADDR"];
$page_name = $_SERVER["SCRIPT_NAME"];
$referer = $_SERVER["HTTP_REFERER"];
$useragent = $_SERVER["HTTP_USER_AGENT"];
$s = "select * from `visitor_tracking` where ip_address='$ip_address' AND `block_ip` = 'block' ";
$r = mysqli_query($mysqli,$s);
if(mysqli_num_rows($r)>0)
	{
		die('<h1>YOUR IP IS BLOCKED</h1>');
		
	}
else
{
$sql = "INSERT INTO test (ip_address, page_name, referer, useragent) VALUES ('$ip_address', '$page_name', '$referer', '$useragent')";
if(!mysqli_query($mysqli, $sql)){
    echo "Failed to add new visitor into tracking log";
    echo mysqli_error($mysqli);
}
}
