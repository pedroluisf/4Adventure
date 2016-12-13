<?php

require_once("Config.php");

/**
 * <p>Handles mysql manipulation.</p>
 * @version 2
 * @author pedro
 */
class Db {

    private $_host;
    private $_port;
    private $_dbName;
    private $_dbUser;
    private $_dbPwd;
    private $_dbResult;
    private $_dbLastId;
    private $_conn;
    private $_execTime;
    private $_info;
    private $_affectedRows;
    private $_error_msg;
    private $_error_no;

    /**
     * <p>
     * Creates a new instance of Db. If the parameters are given, the connection is made
     * using those. If not, the Config.php vars are used.
     * </p>
     * @param String $host The mysql server.
     * @param String $port The mysql server port.
     * @param String $dbName The name of the schema.
     * @param String $dbUser The mysql username to use.
     * @param String $dbPwd The mysql password to use.
     */
    function __construct($host=null, $port=null, $dbName=null, $dbUser=null, $dbPwd=null) {
        $this->_host = ($host == null) ? MYSQL_HOST : $host;
        $this->_port = ($port == null) ? MYSQL_PORT : $port;
        $this->_dbName = ($dbName == null) ? MYSQL_DB : $dbName;
        $this->_dbUser = ($dbUser == null) ? MYSQL_USER : $dbUser;
        $this->_dbPwd = ($dbPwd == null) ? MYSQL_PWD : $dbPwd;
    }

    /**
     * Connects to a mysql database.
     */
    private function dbConnect() {
        try {
            if (!$this->_conn = mysql_connect($this->_host . ":" . $this->_port, $this->_dbUser, $this->_dbPwd))
                throw new Exception("Can't connect to server.");

            if (!mysql_select_db($this->_dbName, $this->_conn))
                throw new Exception("Can't select database.");
        } catch (Exception $e) {
            $this->exception($e);
        }
    }

    /**
     * Closes connection to the mysql database.
     */
    private function closeDbConnect() {
        try {
            if (!mysql_close($this->_conn))
                throw new Exception("Can't close connection.");
        } catch (Exception $e) {
            $this->exception($e);
        }
    }

    /**
     * Manages exceptions by sending a message to the page.
     * @param Exception $e Exception thrown.
     */
    private function exception($e) {
        die("Error Code: " . $e->getCode() . ";<br>File: " . $e->getFile() . ";<br>Line: " . $e->getLine() . ";<br>Message: " . $e->getMessage());
    }

    /**
     * Executes a query according to given params.
     * One may pass a simple query to be executed: SELECT * FROM table1,
     * or pass a query with placeholders, that will be replaced, by the values
     * in the params array: INSERT INTO table1(field1, field2) VALUES ('%s', '%d').
     * @param String $sql The query to be executed.
     * @param Array $params An array containing the params for the query.
     * @return ResultSet Returns a mysql resultset on success, FALSE on failure.
     */
    function dbQuery($sql, $params=null) {
        $this->dbConnect();
        try {
            $sql = $this->prepareSql($sql, $params);
            $sql = $this->empty2null($sql);
            //die($sql);
            $before = microtime();
            $this->_dbResult = mysql_query($sql);
            $after = microtime();

            if (!$this->_dbResult)
                throw new Exception(mysql_error(), mysql_errno());

            $this->_execTime = $after - $before;
            $this->_info = mysql_info($this->_conn);
            $this->_affectedRows = mysql_affected_rows($this->_conn);
            $this->_dbLastId = mysql_insert_id($this->_conn);
        } catch (Exception $e) {
            $this->_error_msg = mysql_error();
            $this->_error_no = mysql_errno();
        }

        $this->closeDbConnect();
        return $this->_dbResult;
    }

    /**
     * Prepares the sql statement with the given parameters.
     * @param String $sql The sql statement to be executed.
     * @param Array $params The values to use on the query.
     * @return String The string with the parameters in place.
     */
    function prepareSql($sql, $params=null) {
        if (is_array($params)) {
            foreach ($params as $key => $val) {
                if (is_numeric($val)) {
                    $params[$key] = $val;
                } else {
                    if (!empty($val)) {
                        $params[$key] = mysql_real_escape_string($val);
                    } else {
                        $params[$key] = 'NULL';
                    }
                }
            }
            return vsprintf($sql, $params);
        }

        return $sql;
    }

    /**
     * Gets the row from a mysql resultset.
     * @param Resultset $results The mysql resultset from which to extract the row.
     * @param String $returnType The type of return expected. (array, assoc, object <default>).
     * @return Object An object representing the extracted row.
     */
    function dbGetRow($results = null, $returnType = null) {
        switch ($returnType) {
            case "array": {
                    if ($results == null) {
                        if ($this->_dbResult != null) {
                            return mysql_fetch_row($this->_dbResult);
                        }
                    } else {
                        return mysql_fetch_row($results);
                    }
                    break;
                }
            case "assoc": {
                    if ($results == null) {
                        if ($this->_dbResult != null) {
                            return mysql_fetch_assoc($this->_dbResult);
                        }
                    } else {
                        return mysql_fetch_assoc($results);
                    }
                    break;
                }
            case "object":
            default: {
                    if ($results == null) {
                        if ($this->_dbResult != null) {
                            $obj = mysql_fetch_object($this->_dbResult);
                            return $this->stripObjectSlashes($obj);
                        }
                    } else {
                        $obj = mysql_fetch_object($results);
                        return $this->stripObjectSlashes($obj);
                    }
                    break;
                }
        }

        return false;
    }

    /**
     * Number of rows in the mysql resultset.
     * @param Resultset $results The mysql resultset.
     * @return int Then number of rows in the mysql resultset.
     */
    function nRows($results=null) {
        if ($results == null) {
            if ($this->_dbResult != null)
                return mysql_num_rows($this->_dbResult);
        } else
            return mysql_num_rows($results);

        return 0;
    }

    /**
     * Gets the last record generated key.
     * @return int The record key.
     */
    function dbLastId() {
        return $this->_dbLastId;
    }

    /**
     * Gets some info about the query performance.
     * @return String String with info about query performance.
     */
    function getInfo() {
        if ($this->_affectedRows == 1) {
            return $this->_affectedRows . " record in: " . $this->_execTime . "s";
        } else {
            return $this->_affectedRows . " records in: " . $this->_execTime . "s";
        }
    }

    /**
     * Gets last query execution time.
     * @return String Last query execution time.
     */
    function getExecTime() {
        return $this->_execTime . "s";
    }

    /**
     * Gets last query affected rows.
     * @return int The number of affected rows.
     */
    function getAffRows() {
        return $this->_affectedRows;
    }

    /**
     * Get's error message from mysql.
     * @return String The error message from mysql.
     */
    function getErrorMsg() {
        return $this->_error_msg;
    }

    /**
     * Get's error number from mysql.
     * @return String The error number from mysql.
     */
    function getErrorNo() {
        return $this->_error_no;
    }

    /**
     * Starts a transaction if not already in transaction.
     */
    public function startTransaction() {
        if ($this->_conn != null && !$this->inTransaction) {
            $this->query('START TRANSACTION');
            $this->inTransaction = true;
        }
    }

    /**
     * Ends the current transaction. Must be in transaction to take effect.
     * @param String $action If true transaction is commited, else transaction is rolled back.
     */
    public function endTransaction($commit) {
        if ($this->_conn != null && $this->inTransaction) {
            $sql = $commit ? 'COMMIT' : 'ROLLBACK';
            $this->query($sql);
            $this->inTransaction = false;
        }
    }

    /**
     * Removes slashes (\) from objects strings.
     * @param Object $obj The object from which we wish to remove the slashes.
     * @return An object without the slashes.
     */
    function stripObjectSlashes($obj) {
        if ($obj) {
            $arr = get_object_vars($obj);

            if (is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $obj->$key = stripslashes($value);
                }
            }
        }
        return $obj;
    }

    private function empty2null($str) {
        return str_replace("'NULL'", "NULL", $str);
    }

}

?>