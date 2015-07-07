<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript" >
<!--

function submitter(form)
{
    validate(form);
    return false;
}

function pass_data(form)
{
	var f = form.elements;
	var el = document.createElement("iframe");
	el.setAttribute('id','processor');
	var container = document.getElementById("processbox");
	container.appendChild(el);
	var source = 'scripts/register.php?';
	for(i=0;i<(form.elements.length-1);i++)
		source+=(i==0 ? "" : "&")+form.elements[i].name+"="+form.elements[i].value;
	el.setAttribute('src',source);
}

function validate(form)
{
	var e = form.elements;
        var notif = document.getElementById('notify');
	if(e['pwd'].value != e['cpwd'].value)
		notif.innerHTML="ALERT:The passwords do not match.";
	else if(e['usn'].value == "")
		notif.innerHTML="ALERT:The Username field is blank.";
	else if(e['name'].value == "")
		notif.innerHTML="ALERT:The Name field is blank.";
	else if(e['pwd'].value == "")
		notif.innerHTML="ALERT:The Password field is blank.";
	else if(e['email'].value == "")
		notif.innerHTML="ALERT:The EMail field is blank.";
	else if(e['class'].value == "")
		notif.innerHTML="ALERT:The Class field is blank.";
	else if(e['captcha'].value == "")
		notif.innerHTML="ALERT:The Captcha field is blank.";
	else pass_data(form);
}           

function status_update(msg,status)
{
	alert(msg);
	if(status==1)
		window.location.href="../index.php";
	else
	{
		document.getElementById('processbox').removeChild(document.getElementById('processor'));
		document.forms['register-form'].reset;
	}
}

-->
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HTLMS Register</title>

<link href="stylesheets/register-box.css" rel="stylesheet" type="text/css" />
</head>

<body background="images/registerform_php/body-bg.jpg">

<br />
<br />
<div align="center">
	<div id="login-box">
		<div id="background">
			<img src="images/registerform_php/login-box-backg.png" class="stretch" alt="" />
		</div>

		<H2>HT LMS Registration</H2>
		<p id="notify" style="font-size:18px"></p>
		<form id = "simple-form" name="register-form" method="post" action="register.php" onsubmit="return false;">
			<div id="login-box-name" style="margin-top:20px;">Username :</div><div id="login-box-field" style="margin-top:20px;"><input id="input1" name="usn" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
			<div id="login-box-name">Name :</div><div id="login-box-field"><input id="input1" name="name" class="form-login" title="Name" value="" size="30" maxlength="2048" /></div>
			<div id="login-box-name">Password :</div><div id="login-box-field"><input id="input1" name="pwd" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
			<div id="login-box-name">Confirm Password :</div><div id="login-box-field"><input id="input1" name="cpwd" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
			<div id="login-box-name">Email :</div><div id="login-box-field"><input id="input1" name="email" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
			<div id="login-box-name">Class :</div><div id="login-box-field"><input id="input1" name="class" class="form-login" title="Password" value="" size="30" maxlength="2048" onblur="validate(document.register);"/></div>
			<div id="login-box-name">(Teacher's only) HTCode:</div><div id="login-box-field"><input id="input1" name="tcode" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
			<br /><img src="images/registerform_php/captcha.png" /><br /><br />
			<div id="captcha">Please enter only the CAPITAL Letters :</div>
			<div style="float:center;margin:0 0 0 0;"><input id = "input2" name="captcha" class="form-login" title="captcha" value="" size="30" maxlength="2048" /></div>
			<br />
			<a href="javascript:validate(document.forms['register-form']);"><img src="images/registerform_php/register-btn.png" width="103" height="42" style="margin-left:90px;margin-top:20px;" /></a>
			<input type="submit" style="position: absolute; left: -9999px" onclick="javascript:validate(document.forms['register-form']);"/>
		</form>
	</div>
</div>
<div id="processbox" style="visibility:hidden;">
</div>
</body>
</html>
