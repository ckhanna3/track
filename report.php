<?php
include("db_connect.php");

$view   = "all";
$sql    = "SELECT * FROM visitor_tracking";
$result = mysqli_query($mysqli, $sql);
if ($result == false) 
{
    $view  = "error";
    $error = "Could not retrieve values";
}
function display_date($time)
{
    return date("F j, Y, g:i a", $time);
}

?>
<html>
<head>
<title>IP Tracker Report Page</title>
<style>
html
{font-family:tahoma,verdana,arial,sans serif;}
body
{	background-image: url(bg01.jpg);
	background-size:100% 100%;
	font-size:62.5%;}
table tr th
{
    font-size:0.8em;
    background-color:#FADBD8;;    
    padding:0.2em 0.6em 0.2em 0.6em;
}
table tr td
{
    font-size:0.8em;
    background-color:#eec;
    margin:0.3em;
    padding:0.3em;
}
table tr td a
{
	color:red;
	text-decoration:none;	
}

</style>
</head>
<body>
<h1>IP Tracker Report</h1>
<?php
if ($view == "all") {
    if ($row = mysqli_fetch_array($result)) {
?>
   <table>
      <tbody>
      <tr>
      <th>ID</th>
      <th>IP Address</th>
      <th>Page Name</th>
      <th>Referer</th>
      <th>User Agent</th>
      <th>Time</th>
	  <th>Block</th>
	  
      </tr>
    <?php
		
        do {
            $timestamp = display_date(strtotime($row["timestamp"]));
            $source    = mb_strimwidth($row['referer'], 0, 40, "...");
            $useragent = mb_strimwidth($row['useragent'], 0, 40, "...");
            echo "<tr>";
            echo "<td>{$row['entry_id']}</td>";
            echo "<td>{$row['ip_address']}</td>";
            echo "<td>{$row['page_name']}</td>";
            echo "<td><abbr title='{$row['referer']}'>{$referer}</abbr></td>";
            echo "<td><abbr title='{$row['useragent']}'>{$useragent}</abbr></td>";
            echo "<td>{$timestamp}</td>";
			
			echo "<td><a href='ip_block.php?ip={$row['ip_address']}&id={$row['entry_id']}'>" ;if($row['block_ip']=='block'){
				echo "UNBLOCK";
			}
             else if($row['block_ip']=='')	
			 {
				 echo "BLOCK";
			 }
		  echo "</a></td>";
				
				
            echo "</tr>";
        } while ($row = mysqli_fetch_array($result));
?>
     </tbody>
    </table>
    <?php } else { ?>
     <h3>No records in the table yet</h3>
    <?php }
?>
<?php
} elseif ($view == "error") { ?>
   <h3>There was an error</h3>
    <?php echo $error;
  }
?>

</body>
</html>
