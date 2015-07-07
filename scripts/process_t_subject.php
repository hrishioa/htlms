<?php include("header.php");
	if(isset($_GET['subject']))
	{
		$sname = addslashes($_GET['subject']);
		$sdesc = addslashes($_GET['desc']);
		
		if($row[1]!='t') die("<script type='text/javascript'>window.parent.status_update('You are not authorized to carry out this operation. Access Denied.',0);</script>");
		mysql_query("INSERT INTO subjects (name, descr, teacher, UID) VALUES ('".$sname."', '".$sdesc."', '".$row[3]."', ".$row[0]."); ") or die("<script type='text/javascript'>window.parent.status_update('Error #HT3. Please report to admin',0);</script>");
		$r = mysql_fetch_row(mysql_query("SELECT * FROM subjects ORDER BY SID DESC"));
		$subs = ($row[6]!="" ? ($row[6]."|") : "").$r[0];
		mysql_query("UPDATE login SET subjects='".$subs."' WHERE UID=".$row[0]) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>");
		echo "<script type='text/javascript'>window.parent.status_update('Subject successfully Added',1);</script>";
	}
	else
	{
		$s = explode('|',$row[6]);
		foreach($s as $sid)
			if(isset($_GET[$sid]))
				if($_GET[$sid]=="on")
				{					
					mysql_query("DELETE FROM htlms_clanteam_db.subjects WHERE subjects.SID=".$sid) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>"); //delete subejct record
	
					$data_ofsub = mysql_query("SELECT * FROM data WHERE SID=".$sid) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>");
					while(($dat = mysql_fetch_row($data_ofsub)))
					{
						unlink($dat[5]) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>");	//delete the text file
						$aments = explode('|',$dat[6]);
						foreach($aments as $ament)	if($ament!="") unlink($ament) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>");
					}
						
					
					mysql_query("DELETE FROM data WHERE SID=".$sid) or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>"); //delete the subject's data records	
					$edit_users = mysql_query("SELECT * FROM login WHERE subjects LIKE '%".$sid."%'") or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>");

					while(($us=mysql_fetch_row($edit_users)))
					{
						$ussubs = explode('|',$us[6]);
						$newsubs="";
						foreach($ussubs as $s) 
						{
							if($ussubs=="") continue;
							if($s!=$sid) $newsubs = $newsubs.($s==$ussubs[0]?"":"|").$s;
						}
						mysql_query("UPDATE login SET subjects = '".$newsubs."' WHERE subjects = '".$us[6]."'") or die("<script type='text/javascript'>window.parent.status_update('Error #HT5. Please report to admin',0);</script>"); 
					}
				}
		echo "<script type='text/javascript'>window.parent.status_update('Done.',1);</script>";
	}
?>