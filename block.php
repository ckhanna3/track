<?php
include("db_connect.php");
$ip = $_GET['ip'];
$id = $_GET['id'];
$s = "select * from `visitor_tracking` where ip_address='$ip' AND `block_ip` = 'block' ";
$r = mysqli_query($mysqli,$s);
	if(mysqli_num_rows($r)>0)
	{
		
		
		$query = "UPDATE `visitor_tracking` SET `block_ip`='' WHERE ip_address = '$ip';";
		$run = mysqli_query($mysqli,$query);
	if($run)
	{
		echo "<script> alert('user has been unblocked');</script>";
		echo "<script>window.open('report.php','_self');</script>";
	}
	}
	else
	{
		
		$query = "UPDATE `visitor_tracking` SET `block_ip`='block' WHERE ip_address = '$ip';";
	$run = mysqli_query($mysqli,$query);
	if($run)
	{
		echo "<script> alert('user has been blocked');</script>";
		echo "<script>window.open('report.php','_self');</script>";
	}

}
?>
