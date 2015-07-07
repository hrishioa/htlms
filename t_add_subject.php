<?php include "scripts/header.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  


<head>  
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>ACSI CLASS PORTAL</title><head>
	<link href="stylesheets/feed.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="scripts/jquery-latest.js"></script>
	<script type="text/javascript" src="scripts/nav.js"></script>

	<link rel="stylesheet" href="stylesheets/jqtransform.css" type="text/css" media="all" />
	<link rel="stylesheet" href="stylesheets/demo.css" type="text/css" media="all" />
	
	<script type="text/javascript" src="scripts/jquery-latest.js" ></script>
	<script type="text/javascript" src="scripts/jquery.jqtransform.js" ></script>
	<script language="javascript">
		$(function(){
			$('form').jqTransform({imgPath:'images/t_add_subject_php/'});
		});
	</script>
	
	<script language="javascript" type="text/javascript" >
<!--

function submitter(form, no)
{
    if(no==1) validate(form);
	else pass_data(form);
    return false;
}

function pass_data(form)
{
	var f = form.elements;
	var el = document.createElement("iframe");
	el.setAttribute('id','processor');
	var container = document.getElementById("processbox");
	container.appendChild(el);
	var source = 'scripts/process_t_subject.php?';
	for(i=0;i<(form.elements.length-1);i++)
		source+=(i==0 ? "" : "&")+form.elements[i].name+"="+form.elements[i].value;
	el.setAttribute('src',source);
}

function validate(form)
{
	var e = form.elements;
        var notif = document.getElementById('notify');
	if(e['subject'].value == "")
		notif.innerHTML="ALERT:The Subject field is blank.";
	else pass_data(form);
}           

function status_update(msg,status)
{
	alert(msg);
	if(status==1)
		window.location.href="../t_add_subject.php";
	else
	{
		document.getElementById('processbox').removeChild(document.getElementById('processor'));
		document.forms['register-form'].reset;
	}
}

-->
</script>

</head>  


<body>
	<img class="bg" src="images/feed_php/template.jpg" />
	
	<?php include "scripts/top.php"; ?>
	<img class="banner" src="images/t_add_subject_php/addsubject.jpg" />
	
	</div>
	
	<div id="main">
		
			<div id="otherwrap">
				<form action="#" method="get" onsubmit="return submitter(this,1);">
					<p id="notify" style="font-size:18px"></p>
					<div class="rowElem"><label>Subject : &nbsp;&nbsp;&nbsp;</label><input type="text" name="subject" /></div>
					<div class="rowElem"><label>Description: </label><br /><textarea rows="1" cols="100" name="desc">Any description here will aid the students in selecting the subject.</textarea></div>
				<div class="rowElem"><input type="submit" value="Add subject" /></div>
				</form>
				<form name="delete" action="#" method="get" onsubmit="return submitter(this, 2);">
				<ul>
						<?php
						$subs = explode('|',$row[6]);
						if($subs[0]!="") echo "	Current subject(s) :";
						else echo "No current subjects";
						foreach($subs as $sub)
						{
							if($sub=="") continue;
							if(($quer=mysql_query("SELECT * FROM subjects WHERE SID=".$sub)))
							{
								$d = mysql_fetch_row($quer);
								echo "<li><div class='rowElem'><input type='checkbox' name='".$d[0]."'>&nbsp;".$d[1]."</div></li>";
							}
						}

						if($subs[0]!="") echo"<div class='rowElem'><input type='submit' value='Delete'/></div>";
						?>
						</form>
				</ul> 
			
			</div>
			
	</div>
	
	<div id="processbox" style="visibility:hidden"></div>
	<img class="footer" src="images/feed_php/footer.png" />
		
		
</body>


</html>