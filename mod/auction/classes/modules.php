<?php

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
class Modules {
    /**
     *
     * @var Modules
     */
    public static $inst = null;
    /**
     *
     * @var Database
     */
    public $i_database = null;
    /**
     *
     * @var Auction
     */
    public $i_auction = null;
    /**
     *
     * @var Config
     */
    public $i_config = null;
    /**
     *
     * @var User
     */
    public $i_user = null;
    
    private function __construct() {
        $this->i_database = Database::$inst;
        $this->i_config = Config::$inst;
        $this->i_auction = Auction::getInstance();
        $this->i_user = User::getInstance();
    }

    public function loadView($filename) {
        $file = "views/{$this->filter($filename)}.php";

        if (file_exists($file)) {
            include $file;
        }

        return false;
    }

    public static function filter($string) {
        $orig_string = $string;
        $string = strtolower($string);


        $keys = array("~", "*", "--", "'", "\\", "/", " ");

        foreach ($keys as $key) {
            $string = str_replace($key, "", $string);
        }

        if (strtolower($orig_string) != $string) {
            $words = array("drop", "shutdown", "http", "select", "update", "join", "insert", "delete");

            foreach ($words as $key) {
                $string = str_replace($key, "", $string);
            }

            return $string;
        }

        return $orig_string;
    }

    
    /**
     * 
     * @return Modules
     */
    public static function getInstance() {
        if(self::$inst == null){
            self::$inst = new Modules();
        }
        
        return self::$inst;
    }
}
}