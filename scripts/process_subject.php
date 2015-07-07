<?php include("header.php");
        if(isset($_GET['del']))
        {
            //delete area
            $subjects=explode('|',$row[6]);
            $newsubjects="";
            foreach($subjects as $subject)
            {
                if($subject!=$_GET['sub']) $newsubjects=$newsubjects.($newsubjects==""?"":"|").$subject;
            }
            
            mysql_query("UPDATE login SET subjects='".addslashes($newsubjects)."' WHERE UID=".$_SESSION['uid']) or die("<script type='text/javascript'>window.parent.status_update('Subject could not be added. Error Code #HT3',0);</script>");
            
            echo "<script type='text/javascript'>window.parent.status_update('Subject Deleted.',1);</script>";
        }
        else
        {
            if(!isset($_GET['sub'])) die("<script type='text/javascript'>window.parent.status_update('Please enter a subject',0);</script>");
            $que = mysql_query("SELECT * FROM subjects WHERE name='".$_GET['sub']."'");
            if(mysql_num_rows($que)<=0) die("<script type='text/javascript'>window.parent.status_update('Subject does not Exist',0);</script>");
            $su = mysql_fetch_row($que);
            $subid = $su[0];
            
            echo "<html><body>Adding Subject...";
           $subjects=$row[6];
	
            if(!$subjects) $subjects=$subid;
            else $subjects=$subjects."|".$subid;
            mysql_query("UPDATE login SET subjects='".addslashes($subjects)."' WHERE UID=".$_SESSION['uid']) or die("<script type='text/javascript'>window.parent.status_update('Subject could not be added. Error Code #HT3',0);</script>");
	
            echo "<script type='text/javascript'>window.parent.status_update('Subject Added.',1);</script>";
        }
?>