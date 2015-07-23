# Database-Table-Auto-Extraction
Automatically extract table data into a datatable

Simply extract the files to a folder and open config.php

Edit the config file:
````
return array(
	'host' => 'localhost',
	'port' => '3306',
	'user' => 'root',
	'pass' => 'cracked',
	'dbname' => 'webcodexcms'
);

````

Navigate to your folder to view the index.php

You should see a list of tables as links.

Click the Table you wish to view and it will open up output.php with your data in a nicely formatted table.
