<?php include "scripts/header.php"; ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  


<head>  

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>ACSI CLASS PORTAL</title>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="scripts/jquery-latest.js"></script>
	<script src="scripts/jquery-ui-min.js"></script>
	<link href="stylesheets/feed.css" rel="stylesheet" type="text/css" />
        <script src="scripts/multifile_compressed.js"></script>
	<script src="scripts/nav.js"></script>
	<script type ="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker();
	});
        
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

    function validate(form)
    {
	var e = form.elements;
        var notif = document.getElementById('notify');
	for(i=0;i<(form.elements.length-1);i++)
	    if(form.elements[i].value=="" && (form.elements[i].type=='text' || form.elements[i].type=='textarea'))
	    {
		if(form.elements[i].name=='date') 
		{
		    ct = new Date();
		    document.getElementById('datepicker').value='n'+(ct.getTime()/1000.0);
		}
		else 
		{
		    notif.innerHTML = "The "+form.elements[i].name+" field is blank.";
		    return false;
		}
	    }
	    var dtime = document.getElementById('datepicker').value;
		var ad = new Date(dtime);
	    if(dtime.charAt(0)!='d' && dtime.charAt(0)!='n')
			document.getElementById('datepicker').value = 'd'+(ad.getTime()/1000.0);
	return pass_data(form);
    }    

        function pass_data(form)
        {
            var el = document.createElement("iframe");
            el.setAttribute('id','process');
            var container = document.getElementById("processbox");
            container.appendChild(el);
	    var source = 'scripts/process_post.php?';
	    for(var i=0;i<((form.elements.length)-1);i++)
		if(form.elements[i].type!='button') source+=(i==0 ? "" : "&")+form.elements[i].name+"="+form.elements[i].value;
	    el.setAttribute('src',source);
	    return false;   
        }
	
	</script>
	
</head>  


<body>
	<img class="bg" src="images/feed_php/template.jpg" />
	
<?php include "scripts/top.php"; ?>	
		
		
	<img class="banner" src="images/post_php/post.jpg" />
	
	<div id="main">
		
			<div id="otherwrap">
				<form enctype="multipart/form-data" name="upload" method="post" action="#" onsubmit="return validate(this);">
				    <p id="notify" style="font-size:18px"></p>
					Title : &nbsp;&nbsp;<input type="text" name="title" size="100%" /><br />
                                Subject :<select name="SID">
                                <?php
                        		$subs = mysql_query("SELECT * FROM subjects WHERE UID=".$row[0]);
                                        while($row=mysql_fetch_row($subs))
                                        {
                                            echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                        } 
                                ?>
                                    </select>
					<br />
					Due Date (optional) : <input id="datepicker" type="text" name="date"/>
					<br />
					Content : <br />
					<textarea rows="12" cols="100" name="content">Enter the body of your announcement here.</textarea> 
					<br />
					Attachments : <br />
                                        <input id="my_file_element" type="file" name="file_1" />
                                        <div id="files_list"></div>
                                        <script>
                            		var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 10 );
                        		multi_selector.addElement( document.getElementById( 'my_file_element' ) );
                                	</script>
					<br />
					<?php 
					    if(mysql_num_rows($subs)<=0) echo "Sorry, but you cannot post unless you create a subject.";
					    else echo "<input type='submit' value='Post' />";
					?>
				</form>
			    <div id="processbox" style="visibility:hidden;"></div>
			</div>
	</div>
	<img class="footer" src="images/feed_php/footer.png" />
</body>
</html>