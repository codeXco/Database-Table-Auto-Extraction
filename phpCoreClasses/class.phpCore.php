<?php
/**

PHP Core
WebCodeX

PDO Database Interaction Class

*/

class phpCore {
	
	private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;
    private $error;
	private $stmt;
 
 	// Creates a PDO instance representing a connection to a database
	// See http://php.net/manual/en/pdo.construct.php For more info
    public function __construct() {
        // The Data Source Name, or DSN, contains the information required to connect to the database.
		// See http://php.net/manual/en/pdo.construct.php For more info
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // A key=>value array of driver-specific connection options
		// See http://php.net/manual/en/pdo.construct.php For more info
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_EMULATE_PREPARES => false
        );
        // Try and create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Represents an error raised by PDO
		// See http://php.net/manual/en/exception.getmessage.php & http://php.net/manual/en/class.pdoexception.php For more info
        catch(PDOException $e){
			// Gets the Exception message
            $this->error = $e->getMessage();
        }
    }

	// Dump an SQL prepared command / Useful for debugging
	// See http://php.net/manual/en/pdostatement.debugdumpparams.php For more info
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}	
	
	// Binds a value to a parameter / Auto Check Type Of Value
	// See http://php.net/manual/en/pdostatement.bindvalue.php For more info
	public function bind($param, $value, $type = null){
    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
	}


	// Executes a prepared statement
	// See http://php.net/manual/en/pdostatement.execute.php For more info
	public function execute(){
		return $this->stmt->execute();
	}
	
	// Returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement executed by the corresponding PDOStatement object.
	// See http://php.net/manual/en/pdostatement.rowcount.php For more info
	public function rowCount(){
    	return $this->stmt->rowCount();
	}
	
	// Returns the ID of the last inserted row, or the last value from a sequence object, depending on the underlying driver. For example, PDO_PGSQL requires you to specify the name of a sequence object for the name parameter.
	// See http://php.net/manual/en/pdo.lastinsertid.php For more info
	public function lastInsertId(){
    	return $this->dbh->lastInsertId();
	}
	
	// Turns off autocommit mode. While autocommit mode is turned off, changes made to the database via the PDO object instance are not committed until you end the transaction by calling PDO::commit(). Calling PDO::rollBack() will roll back all changes to the database and return the connection to autocommit mode.
	// See http://php.net/manual/en/pdo.begintransaction.php For more info
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	// Commits a transaction, returning the database connection to autocommit mode until the next call to PDO::beginTransaction() starts a new transaction.
	// See http://php.net/manual/en/pdo.commit.php For more info
	public function endTransaction(){
    	return $this->dbh->commit();
	}
	
	// Rolls back the current transaction, as initiated by PDO::beginTransaction(). A PDOException will be thrown if no transaction is active.
	// See http://php.net/manual/en/pdo.rollback.php For more info
	public function cancelTransaction(){
    	return $this->dbh->rollBack();
	}
	
	// Prepares a statement for execution and returns a statement object
	// See http://php.net/manual/en/pdo.prepare.php For more info
	public function queryIt($query){
		$this->stmt = $this->dbh->prepare($query);
	}
	
	// Executes an SQL statement, returning a result set as a PDOStatement object
	// See http://php.net/manual/en/pdo.query.php For more info
	public function query($query) {
		$result = $this->dbh->query($query);
		return $result;
	}
	
	// Returns an array containing all of the result set rows
	// See http://php.net/manual/en/pdostatement.fetchall.php For more info
	public function resultset(){
    	$this->execute();
    	return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	// Fetches a row from a result set associated with a PDOStatement object. The fetch_style parameter determines how PDO returns the row.
	// PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set
	// See http://php.net/manual/en/pdostatement.fetch.php For more info
	public function single(){
    	$this->execute();
    	return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	// Returns a single column from the next row of a result set or FALSE if there are no more rows
	// See http://php.net/manual/en/pdostatement.fetchcolumn.php For more info
	public function getColumn() {
		return $this->stmt->fetchColumn();	
	}
	
	// Frees up the connection to the server so that other SQL statements may be issued
	// See http://php.net/manual/en/pdostatement.closecursor.php For more info
	public function close() {
		return $this->stmt->closeCursor();
	}
	
	
	
	
	
	/**
	
	Start Database Table Auto Extraction Functions
	
	*/
	
	
	
	
	// Get all tables on DB
	public function getAllDbTables() {			 
		$result = $this->query("SHOW TABLES");
		while ($row = $result->fetchAll(PDO::FETCH_COLUMN)) {
			return $row;
		}		
	}
	
	// Get column names for $table
	public function getColumnName($table){
    	$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table";
		try {
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':table', $table, PDO::PARAM_STR);
			$stmt->execute();
			$output = array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$output[] = $row['COLUMN_NAME'];                
			}
			return $output; 
		}

		catch(PDOException $pe) {
			trigger_error('Could not connect to MySQL database. ' . $pe->getMessage() , E_USER_ERROR);
		}
	}
	
	private function tableWhitelist() {
		$result = $this->query("SHOW TABLES");
		while ($tables = $result->fetchAll(PDO::FETCH_COLUMN)) {
			return $tables;
		}		
	}
	
	public function getTableData($tablename) {
		$error = 'No Table with that name Exists';
		if(in_array($tablename,$this->tableWhitelist())) {
			$sql = "SELECT * FROM $tablename";
			$this->queryIt($sql);
			return $this->resultset();
		}
		else {
			return 	$error;
		}
	}
	
	

}
