<?php
	$host = "localhost";
	$user = "525567_hrishioa";
	$db = "htlms_clanteam_db";
	$pass = "6.626068";
	$captcha="GUH";
	$tccode="sca";
	$file_reader="http://htlms.clanteam.com/fileread.php";
	$home_redirect="<script type='text/javascript'>window.location.href='feed.php';</script>";
	$feed_redirect="<meta http-equiv='Refresh' content='1;url=framefeed.php'>";
	$connection = mysql_connect($host,$user,$pass) or die("Error Code #HT1. Please check your internet connection or <a href='mailto:toonistic@gmail.com'>report a bug</a>.");
	mysql_select_db($db) or die("Error Code #HT2. Please check your internet connection or <a href='mailto:toonistic@gmail.com'>report a bug</a>.".$home_redirect);
?>