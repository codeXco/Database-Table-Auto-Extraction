<?php
session_name('phpCore'); // Session Name
session_start(); // Start Named Session

define( 'DB_HOST', 'localhost' ); // Set the database host (usually localhost)
define( 'DB_USER', 'root' ); // Set the Database Username (The one you use to connect)
define( 'DB_PASS', '' ); // Set the Database Password
define( 'DB_NAME', '' ); // Set the Database Name (The database your using)

// The site root
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Autoload the classes in the phpCoreClasses Folder
spl_autoload_register(function ($class) {
	require_once 'phpCoreClasses/class.'. $class .'.php';
});

// Instantiate the class
$phpCore = new phpCore();
