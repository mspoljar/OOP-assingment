<?php
//klasa za konekciju s bazom podataka
class DB extends PDO
{
    private static $instance;

    public function __construct($db)
    {
        $dsn = 'mysql:host=' . $db['server'] . 
        ';dbname=' . $db['base'] . ';charset=utf8';
        parent::__construct($dsn,$db['user'],$db['password']);

        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance=new self(APP::config('db'));
        }
        return self::$instance;
    }

}