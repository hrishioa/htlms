<?php session_start(); ?>
<html>
<head>
<?php
	include("db.php"); //connects to database
	$table = "login";
	$query = "SELECT * FROM $table WHERE hash='";
//-------------------------------------------
	
	if(isset($_SESSION['uid']))
	{
		$row = mysql_fetch_row(mysql_query("SELECT * FROM $table WHERE UID=".$_SESSION['uid'])) or die("<meta http-equiv='Refresh' content='1;url='index.php?new=yes'>");
		echo "<script type='text/javascript'>window.parent.status_update('Welcome',1);</script>";
		die();
	}
	
	$qresult = mysql_query("SELECT * FROM $table WHERE hash='".sha1(trim(addslashes($_GET["usn"])).trim(addslashes($_GET["pwd"])))."';") or die("Error Code HT#3.");
	
	if(mysql_num_rows($qresult)==0)
	{
		echo "<script type='text/javascript'>window.parent.status_update('Login failed: Incorrect username/password',0);</script>";
		die();
	}
	$row = mysql_fetch_row($qresult);
	
	//set session variable and redirect
	$_SESSION['uid'] = $row['0'];
	
	if(isset($_POST['remember'])) 
		setcookie('uid',$_SESSION['uid'],time()+86400*7);
	echo "<script type='text/javascript'>window.parent.status_update('Welcome!',1);</script>";
?>
	
	