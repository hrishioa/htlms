<?php include("header.php");
	if($row[1]!='t') die("<script type='text/javascript'>window.parent.status_update('You are not authorized to carry out this operation. Access Denied.',0);</script>");
	//UPLOAD PART----------------------------------------
    // Configuration - Your Options
	$uploads="";
	$upload_path = '../data/'; // The place the files will be uploaded to (currently a 'files' directory).
	$write_path = '../data/';
	for($i=0;;$i++)
	{
		if(!isset($_GET['file_'.$i])) break;
		$file = $_GET['file_'.$i];
		if($file=="") continue;

	
		$allowed_filetypes = array('.jpg','.gif','.bmp','.png','.doc','.pdf','.txt','.ppt','.pptx','.docx','.xls','.xlsx'); // These will be the types of file that will pass the validation.
/*		$max_filesize = (1024*1024*15); // Maximum filesize in BYTES (currently 0.5MB).
*/		

		$filename = substr(strrchr('/',$file),1);
		$ext = strrchr('.',$file); // Get the extension from the filename.
		// Check if the filetype is allowed, if not DIE and inform the user.
		if(!in_array(strtolower($ext),$allowed_filetypes))
		    die("<script type='text/javascript'>window.parent.status_update('Unsupported Extension ',0);</script>");
/* 
		// Now check the filesize, if it is too large then DIE and inform the user.
		if($file['size'] > $max_filesize)
		die('The file you attempted to upload is too large.');
*/ 
		// Check if we can upload to the specified path, if not DIE and inform the user.
		if(!is_writable($upload_path))
		    die("<script type='text/javascript'>window.parent.status_update('Error Code #HT6',0);</script>");
 
		// Upload the file to your specified path.
		if(!move_uploaded_file($file,$upload_path.$filename))
		    die("<script type='text/javascript'>window.parent.status_update('Upload failed',0);</script>");
		if($uploads=="") $uploads=$upload_path.$filename;
		else $uploads=$uploads."|".$upload_path.$filename;
	}
	
	$lastd = mysql_fetch_row(mysql_query("SELECT * FROM data ORDER BY ID DESC"));
	$write_filename=$lastd[0]+1;
	include("db.php");
	$handle = fopen($write_path.$write_filename,'w') or die("<script type='text/javascript'>window.parent.status_update('Error Code #HT7',0);</script>");

	fwrite($handle,$_GET['content']);
	fclose($handle);
	
	mysql_query("INSERT INTO data (SID,UID,title,descr,file,attachment,dtime) VALUES (".addslashes($_GET['SID']).",".$row[0].",'".addslashes($_GET['title'])."','".substr(addslashes($_GET['content']),0,100)."','".$write_path.$write_filename."','".$uploads."', '".$_GET['date']."');") or die("<script type='text/javascript'>window.parent.status_update('Database update failed',0);</script>");
	echo "<script type='text/javascript'>window.parent.status_update('Posted.',1);</script>";
?>