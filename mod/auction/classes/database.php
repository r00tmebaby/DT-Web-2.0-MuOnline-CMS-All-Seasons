<?php


error_reporting(0);
class Database {

    /**
     *
     * @var Database
     */
    public static $inst = null;

    private function __construct(Array $database) {
        $connection = mssql_connect($database['dbhost'], $database['dbuser'], $database['dbpass']);

        if ($connection) {
            mssql_select_db($database['database'], $connection);
        } else {
            exit(phrase_invalid_sql_config);
        }
    }

    public function q($query, $fastOption = 0) {
        $execute = mssql_query($query);

        if ($execute) {
            if ($fastOption == 1) {
                return $this->nr($execute);
            } else if ($fastOption == 2) {
                return $this->fa($execute);
            }

            return $execute;
        } else {
            return $this->mm();
        }
    }

    public function nr($mssql_resource) {
        $execute = mssql_num_rows($mssql_resource);

        if ($execute) {
            return $execute;
        } else {
            return $this->mm();
        }
    }

    public function fa($mssql_resource) {
        $execute = mssql_fetch_array($mssql_resource);

        if ($execute) {
            return $execute;
        } else {
            return $this->mm();
        }
    }

    public function mm() {
        return mssql_get_last_message();
    }

    /**
     * 
     * @return Database
     */
    public static function getInstance(Array $database) {
        if (self::$inst == null) {
            self::$inst = new Database($database);
        }

        return self::$inst;
    }

}
