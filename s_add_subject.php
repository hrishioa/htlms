<?php include "scripts/header.php"; 
	$mysubjects=explode('|',($row[6]));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>ACSI CLASS PORTAL</title>
	<link href="stylesheets/feed.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/autosuggest.css" />        
	<script src="scripts/jquery-latest.js"></script>
	<script src="scripts/nav.js"></script>
        <script type="text/javascript" src="scripts/autosuggest2.js"></script>
        <script type="text/javascript" src="scripts/suggestions2.js"></script>               
        <script type="text/javascript">
            state=[<?php
	$subs = mysql_query("SELECT * FROM subjects");
        $no_subject=1;
	while($subrow=mysql_fetch_row($subs))
	{
		$not_added=1;
		foreach($mysubjects as $subject)
			if($subject==$subrow[0]) $not_added=0;
		if($not_added==1) 
		{
			if($no_subject==0) echo ",";
                        else $no_subject=0;
                        echo "'".$subrow[1]."'";
		}
	}
?>];
            window.onload = function () {
                var oTextbox = new AutoSuggestControl(document.getElementById("txt1"), new StateSuggestions(state));        
            }
    
    function status_update(msg,status)
    {
	alert(msg);
	if(status==1)
	{
		window.location.reload();
		//reload code goes here
	}
	document.getElementById('processbox').removeChild(document.getElementById('process'));
	document.forms['subjectform'].reset;
    }

    function pass_data(form,del)
    {
	if(del==0)
        {
            var f = form.elements;
            var el = document.createElement("iframe");
            el.setAttribute('id','process');
            var container = document.getElementById("processbox");
            container.appendChild(el);
            el.setAttribute('src','scripts/process_subject.php?sub='+f['txt1'].value);
            return false;
        }
        else
        {
            var el = document.createElement("iframe");
            el.setAttribute('id','process');
            var container = document.getElementById("processbox");
            container.appendChild(el);
            el.setAttribute('src','scripts/process_subject.php?sub='+form+'&del=1');
            return false;   
        }
    }
    </script>

</head>  


<body>
	<img class="bg" src="images/feed_php/template.jpg" />
	
	<?php include "scripts/top.php"; ?>
	
	<img class="banner" src="images/addsubject.jpg" />
	
	<div id="main">
		
			<div id="otherwrap">
				Enter then id of the subject you want to add. (Note: If the subject is hidden, it will not show up in the suggestions list)
                                <form name="subadd" action="#" method="get" onsubmit="return pass_data(this,0);">
                                    <input type="text" id="txt1" autocomplete="off" />
                                    <input type="submit" value="Add" />
                                </form>
                                <br />
                                <hr />
<?php                           
				if(!$mysubjects) echo "No current subjects";
                                else 
                                {
                                    
                                    echo "Current subject(s) :";
                                    echo "<ul>";
                                
                                   foreach($mysubjects as $subject)
                                   {
                                        $quer=mysql_query("SELECT * FROM subjects WHERE SID=".$subject);
                                        if($quer)
                                        {
                                            $r = mysql_fetch_row($quer);
                                            echo "<li><form name='delete' action='#' method='get' onsubmit='return pass_data(".$r[0].",1)'>".$r[1]." - ".$r[4]."&nbsp <input type='submit' value='Delete' /></form></li>";
                                        }
                                    }
                                }
?>
				</ul> 
			</div>		
	</div>
        <div id="processbox" style="visibility:hidden;"></div>
        <img class="footer" src="images/feed_php/footer.png" />	
    </body>
</html>