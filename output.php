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
