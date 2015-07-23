<?php
session_name('phpCore'); // Session Name
session_start(); // Start Named Session

// Autoload the classes in the phpCoreClasses Folder
spl_autoload_register(function ($class) {
	require_once 'phpCoreClasses/class.'. $class .'.php';
});

// Instantiate the class
$phpCore = new phpCore();

$pagearray = array('tablelist','output');

include_once('header.php');

if(isset($_GET['table']) && !empty($_GET['table']) && in_array($_GET['table'], $phpCore->getAllDbTables())) {
	include_once('output.php');
}
else {
	include_once('tablelist.php');
}

include_once('footer.php');
?>
