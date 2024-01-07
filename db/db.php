<?php class Db
{
    private static $_instance;

    private $_connection = null;
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'hospital';

    public function __construct()
    {
        try {
            $this->_connection = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password); 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getConnection()
    {
        return $this->_connection;
    }
}


?>