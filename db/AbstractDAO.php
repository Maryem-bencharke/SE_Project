<?php
require_once  'db.php';
class AbstractDAO
{
    protected $_connection = null;

    public function __construct()
    {
        $db = Db::getInstance();
        $this->_connection = $db->getConnection();
    }
    public function getConnection(){
        return $this->_connection;
    }

}
?>