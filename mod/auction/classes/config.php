<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
class Config {
    /**
     *
     * @var Config
     */
    public static $inst = null;
    public $auction;
    public $web;

    private function __construct(Array $auction, Array $web) {
        foreach ($auction as $key => $value) {
            $this->auction[$key] = $value;
        }

        foreach ($web as $key => $value) {
            $this->web[$key] = $value;
        }
    }

    public function getAuctionConfig($key = null) {
        if ($key == null) {
            return $this->auction;
        }

        return $this->auction[$key];
    }

    public function getWebConfig($key = null) {
        if ($key == null) {
            return $this->web;
        }

        return $this->web[$key];
    }

    /**
     * 
     * @return Config
     */
    public static function getInstance(Array $auction, Array $web) {
        if (self::$inst == null) {
            self::$inst = new Config($auction, $web);
        }

        return self::$inst;
    }
}
}