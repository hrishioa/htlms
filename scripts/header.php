<?php session_start();
	
	if(!isset($_SESSION['uid']) && isset($_COOKIE['uid'])) $_SESSION['uid'] = $_COOKIE['uid'];
	
	if(!isset($_SESSION['uid']))
	{			
		echo "<title>Login Error</title></head><body>Sorry, you need to login to view this page.";
		echo "<meta http-equiv='Refresh' content='1;url=index.php?new=yes'></body></html>";
		die();
	}
	//---------------DATABASE LOGIN--------------
	include("db.php");
	
	$table = "login";	
	$query = "SELECT * FROM $table WHERE UID='";
	//-------------------------------------------
		
	$qresult = mysql_query("SELECT * FROM login WHERE UID=".$_SESSION['uid']) or die("Error Code HT#3.<meta http-equiv='Refresh' content='1;url=index.php?new=yes'>");
	
	if(mysql_num_rows($qresult)==0)
	{
		echo "<title>Login Error</title></head><body>User not found. Redirecting...";
		echo "<meta http-equiv='Refresh' content='1;url=index.php?new=yes'></body></html>";
		die();
	}
	
	$row = mysql_fetch_row($qresult);
	$user = $row['3'];
?>	
