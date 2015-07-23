# Database-Table-Auto-Extraction
Automatically extract table data into a datatable

Simply extract the files to a folder and open config.php

Edit these lines ONLY:
define( 'DB_HOST', 'localhost' ); // Set the database host (usually localhost)
define( 'DB_USER', '' ); // Set the Database Username (The one you use to connect)
define( 'DB_PASS', '' ); // Set the Database Password
define( 'DB_NAME', '' ); // Set the Database Name (The database your using)

Navigate to your folder to view the index.php

You should see a list of tables as links.

Click the Table you wish to view and it will open up output.php with your data in a nicely formatted table.
