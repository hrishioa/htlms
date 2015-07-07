<?php
	
	if((addslashes($_GET['usn'])=="") || (addslashes($_GET['name'])=="") ||(addslashes($_GET['pwd'])=="") ||(addslashes($_GET['email'])=="") ||(addslashes($_GET['class'])==""))
		die("<script type='text/javascript'>window.parent.status_update('Incomplete entry',0);</script>");
		
	include("db.php");
	
	if(isset($_GET['tcode']))
	{
		if(addslashes($_GET['tcode'])==$tccode) $type='t';
		else $type='s';
	}
	
	if (addslashes($_GET['captcha'])!=$captcha)
		die("<script type='text/javascript'>window.parent.status_update('Incorrect captcha',0);</script>"); 
	
	if(mysql_num_rows(mysql_query("SELECT * FROM login WHERE username='".$_GET['usn']."'"))>0) 
		die("<script type='text/javascript'>window.parent.status_update('User exists',0);</script>");
		
	$hsh = sha1(trim(addslashes($_GET['usn'])).trim(addslashes($_GET['pwd'])));
	$success = mysql_query("INSERT INTO login (type, hash, username, descr, email) VALUES ('$type', '$hsh', '".addslashes($_GET['usn'])."', '".addslashes($_GET['name']).", class of ".addslashes($_GET['class'])."','".addslashes($_GET['email'])."')");
	if($success) echo "<script type='text/javascript'>window.parent.status_update('Registration Sucessful. Please Login',1);</script>";
	else die("<script type='text/javascript'>window.parent.status_update('Database Error.Chack your entries',0);</script>");
?>