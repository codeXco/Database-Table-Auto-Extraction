<?php require_once('config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Database Table Auto Extraction - Table Select</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
<?php 
echo 'Database Name:&nbsp;'.DB_NAME.'<br /><br />';
echo 'Available Tables:&nbsp;&nbsp;'; 
foreach($phpCore->getAllDbTables() as $tablenameHeader) {
	echo '<br /><a href="output.php?table='.$tablenameHeader.'">'.ucfirst($tablenameHeader).'</a>';
}
?>

</body>
</html>
