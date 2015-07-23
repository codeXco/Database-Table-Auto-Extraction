<?php require_once('config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Database Table Auto Extraction - Table Data</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#data').DataTable();
} );
</script>
<link href="css/datatable.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table id="data" class="display" cellspacing="0" width="100%">
<?php
if(isset($_GET['table']) && in_array($_GET['table'], $phpCore->getAllDbTables())) {
$tablename = $_GET['table'];

echo '<thead><tr>';
	foreach($phpCore->getColumnName($tablename) as $column) {
		echo '<th>'.$column.'</th>';
	}
echo '</tr></thead>';

echo '<tfoot><tr>';
	foreach($phpCore->getColumnName($tablename) as $column) {
		echo '<th>'.$column.'</th>';
	}
echo '</tr></tfoot><tbody>';

	foreach($phpCore->getTableData($tablename) as $data) {
		echo '<tr>';
		foreach($phpCore->getColumnName($tablename) as $column) {
			echo '<td>'.$data[$column].'</td>';
		}
		echo '</tr>';
	}
	echo '</tbody>';
}
else {
	echo 'No Tables Selected Go <a href="index.php">Back</a>';	
}
?>
</table>
</body>
</html>
