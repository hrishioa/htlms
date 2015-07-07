	<?php
	echo "<div id='header'>";
	echo "<ul class='topnav'>";
		
	echo "<li>";
	echo	"<a href='feed.php' >".$row[3]." - Home</a>";
	echo 	"<ul class='subnav'>";
    if($row[1]=='t') echo "<li><a href='post.php'>Post</a></li>";
	echo	"<li><a href='".$row[1]."_"."add_subject.php'>My Subjects</a></li>";
	echo 	"<li><a href='feedback.php'>Feedback</a></li>";
//	echo	"<li><a href='settings.html'>Settings</a></li>";
	echo	"<li><a href='http://htlms.clanteam.com?new=yes'>Logout</a></li>";
	echo 	"</ul></li></ul><div id = 'pos_logo'> <a href='http://htlms.clanteam.com'><img class='logo' src='images/feed_php/logo.png' /></a></div>";
	?>