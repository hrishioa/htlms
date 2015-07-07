<?php include "scripts/header.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  


<head>  

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>ACSI CLASS PORTAL</title>
	<link href="stylesheets/feed.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-latest.js"></script>
	<script src="scripts/nav.js"></script>

</head>  


<body>
	<img class="bg" src="images/feed_php/template.jpg" />
	
<?php include "scripts/top.php"; ?>
	
	<img class="banner" src="images/feedback_php/feedback.jpg" />
	
	<div id="main">
		
			<div id="otherwrap">
			
				<form name="problem" action="problem.php" method="get">
					
					Please tell us your problem : <br />
					<textarea rows="6" style="width:70%;"></textarea> 
					<br />
					Any suggestions ? <br />
					<textarea rows="6" style="width:70%;"></textarea>
					<br /><input type="submit" value="Thank you !" />
				</form>
				
			</div>
			
	</div>
	
	
	<img class="footer" src="images/feed_php/footer.png" />
		
		
</body>


</html>