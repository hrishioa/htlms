<?php session_start();
	echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>";
	echo "<head>";
	include("scripts/db.php");
	if(isset($_GET['new'])) 
	{
		if(isset($_SESSION['uid'])) $_SESSION['uid'] = null;
		if(isset($_COOKIE['uid'])) setcookie('uid',null,time()-3600); //remove cookies and session data
	}
	else if((isset($_SESSION['uid']) || isset($_COOKIE['uid']))) 
	{
		echo "<title>Redirecting...</title></head><body>Redirecting...";
		echo $home_redirect."</body></html>";
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HMS Beta Login</title>

<link href="stylesheets/login-box.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function status_update(msg,status)
{
	if(status==1)
		window.location.href="../feed.php";
	else
	{
		alert(msg);
		document.getElementById('loginbox').removeChild(document.getElementById('loginform'));
		document.forms['login-form'].reset;
	}
}

function pass_data(form,caller)
{
	var f = form.elements;
	var el = document.createElement("iframe");
	el.setAttribute('id','loginform');
	var container = document.getElementById("loginbox");
	container.appendChild(el);
	el.setAttribute('src','scripts/login.php?usn='+f['usn'].value+'&pwd='+f['pwd'].value);
	if(caller==1)
            return false;
}
</script>
</head>

<body background="images/index_php/body-bg.jpg">

<br />
<br />
<div align="center">
<div id="login-box">
<H2>HT LMS</H2>
Login to ACS Indep Class Portal
<br />
<br />
<form id="login-form" name="login-form" method="post" action="login.php" onsubmit="return pass_data(this,1);">
<div id="login-box-name" style="margin-top:20px;">Username</div><div id="login-box-field" style="margin-top:20px;"><input name="usn" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
<div id="login-box-name">Password:</div><div id="login-box-field"><input name="pwd" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
<br /><br />
<span class="login-box-options"><input type="checkbox" name="remember" value="1"> Remember Me <a href="registerform.php" style="margin-left:30px;">Register</a><br /><a href="#" style="margin-left:230px" onclick="javascript:alert('Due to security reasons, your password cannot be retrieved. To set a new password, contact the admin at toonistick@gmail.com.');">Forgot password</a>
</span>
<br />
<br />
<a href="javascript:pass_data(document.forms['login-form'],0);"><img src="images/index_php/login-btn.png" width="103" height="42" style="margin-left:90px;" /></a>
<button type="submit" style="position: absolute; left: -9999px" />
</form>
</div>
</div>
<div id="loginbox" style="visibility:hidden;">
</div>
</body>
</html>
	