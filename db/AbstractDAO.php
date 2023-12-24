<?php
require_once 'Db.php';
class AbstractDAO
{
    protected $_connection = null;

    public function __construct()
    {
        $db = Db::getInstance();
        $this->_connection = $db->getConnection();
    }
}
?>