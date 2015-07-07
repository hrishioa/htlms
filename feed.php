<?php include "scripts/header.php"; $max_records=15; ?>
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
		
	<img class="banner" src="images/feed_php/announcements.jpg" />
	
	<div id="main">
            
            <?php
                $subjects = explode("|",$row[6]); //Get the list of subjects
                
                if(isset($_GET['sid']) && in_array($_GET['sid'],$subjects))
                    $subjects = array($_GET['sid']);

                if($subjects[0]=="") 
                    die("<div id='feedwrap'><div id = 'feedright'><a href='#' class='feedtitle'>No subjects to display</a></div></div></div><img class='footer' src='images/feed_php/footer.png' /></body></html>"); //Provide standard error message for empty feed
                    
                
                $quer = "SELECT * FROM data WHERE ";
                if(isset($_GET['start_id']) && is_int($_GET['start_id'])) $quer = $quer." ID <= ".$_GET['start_id']." "; //add the starting location - to enable scrolling
                
//                foreach($subjects as $sub)
  //                  if($sub!="") $quer = $quer." ".($sub==$subjects[0]?"":"OR ")."SID=".$sub." "; //filter by only those subjects listed
    //            $quer = $quer." ORDER BY ID DESC ";     //sort descending by the id

                for($i=0;$i<count($subjects);$i++)
                    if($subjects[$i]!="") $quer = $quer." ".($i==0?"":"OR ")."SID=".$subjects[$i]." "; //filter by only those subjects listed
                $quer = $quer." ORDER BY ID DESC ";
				
                   //By this point, the query is ready to be sent into the server.
                if(isset($_GET['debug'])) echo $quer;                               //debug option
                
                $data = mysql_query($quer);
                
                if(mysql_num_rows($data)<=0)                     
                    die("<div id='feedwrap'><div id = 'feedright'><a href='#' class='feedtitle'>Sorry, there are no posts available for your subjects. You can add more from the menu at the top.</a></div></div></div><img class='footer' src='images/feed_php/footer.png' /></body></html>"); //Provide standard error message for empty feed
                
                for($drow=mysql_fetch_row($data),$c=0; $c++ <= $max_records && $drow; $drow = mysql_fetch_row($data)) //Display max number of records or all records, whichever comes first
                {
                    //display the records
                    if(isset($_GET['debug']))
                    {
                        echo "record ".$c."<br />";           //debug option
                        echo floatval(substr($drow[7],1))."  ";
                        echo date("d.m.y",floatval(substr($drow[7],1)))."  ";
                        echo time()."  ";
                    }
                    
                    echo "\n<div id='feedwrap'>";
                    
                    if($drow[7]=="" || !$drow[7])
                    {
                        echo "<div class='date month-01'>n</div>";
                    }
                    else
                    {
                        if(substr($drow[7],0,1)=="n") //if the timestamp is just the date of modifcation
                        {
                                echo "<div class='date month-".date("m",floatval(substr($drow[7],1)))."'>".date("d",floatval(substr($drow[7],1)))."</div>"; //get the month by parsing the date field from the second character
                        }
                        else
                        {
                            if(time() > floatval(substr($drow[7],1))) //the hw is overdue
                                    echo "<div class='date overduemonth-".date("m",floatval(substr($drow[7],1)))."'>".date("d",floatval(substr($drow[7],1)))."</div>";
                            else //there's still time or its today
                                    echo "<div class='date duemonth-".date("m",floatval(substr($drow[7],1)))."'>".date("d",floatval(substr($drow[7],1)))."</div>";
                        }
                    }
                    
                    echo "<div id='feedright'>";
                    echo "<a href='feedread.php?file=".$drow[5]."&id=".$drow[0]."' class='feedtitle'>".$drow[3]."</a><br />";  //title and link to feed reader
                    
                    $subrecord = mysql_fetch_row(mysql_query("SELECT * FROM subjects WHERE SID=".$drow[1]));
                    $subname = $subrecord[1]." by ".$subrecord[2];
                    echo "<a class='nounder' href='feed.php?sid=".$drow[1]."'><span class='subj'>".$subname."</span></a><br />";    //Subject name and link to subject specific feed
                    echo "<p class='feed'>";
                        echo $drow[4]."...";
                    if($drow[6]!="")
                    {
                        $attachments = explode('|',$drow[6]);
                        foreach($attachments as $attachment)
                        {
                            if($attachment=="") continue;
                            $ext = strtolower(substr($attachment, strpos($attachment,'.', strlen($attachment)-5), strlen($attachment)));
                            $allowedext = array(".doc",".docx",".xls",".xlsx",".ppt",".pptx",".pdf",".zip",".rar");
                            
                            echo "<p class='feedattach'><img class = 'attachment' src = 'images/feed_php/attachment.png' />";
                            echo "<a href='".$attachment."' target='_blank' class='textattach'>".substr(strrchr($attachment,'/'),1)."</a>";
                            if(in_array($ext,$allowedext))
                                echo " - <a class='textattach' href='http://docs.google.com/viewer?url=http://htlms.clanteam.com".substr($attachment,1)."' target='_blank'>Preview</a>";
                        }
                    }
                    echo "</p>";   //end feed content p                   
                    echo "</div>"; //end feedright
                    echo "</div>"; //end feedwrap
                    
                }
                
                if($drow) echo "<a href='feed.php?".(isset($_GET['sid'])?"sid=".$_GET['sid']."&":"").(isset($_GET['debug'])?"debug=".$_GET['debug']."&":"")."start_id=".$drow[0]."'>More...</a>"; //add a show more link at the end
            ?>
	</div>
	
	
	<img class="footer" src="images/feed_php/footer.png" />
		
		
</body>


</html>