<?php
abstract class Model_Base
{
    protected $db;
    protected $table;
    private $dataResult;
    public function __construct($select = false)
    {
        // объект бд коннекта
        global $dbObject;
        $this->db = $dbObject;
        // имя таблицы
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        $tableName = strtolower($arrExp[1]);
        $this->table = $tableName;
        // обработка запроса, если нужно
        //$sql = $this->_getSelect($select);
        $sql = $select;
        if ($sql) $this->_getResult($sql);
    }
    public static function connect()
    {
        $host = '127.0.0.1';
        $db = 'qa';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return $pdo = new PDO($dsn, $user, $pass, $opt);
    }
    // выполнение запроса к базе данных
    private function _getResult($sql)
    {
        try {
            $db = $this->db;
            $stmt = $db->query($sql);
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $this->dataResult;
    }
    // составление запроса к базе данных
    private function _getSelect($select)
    {
        if (is_array($select)) {
            $allQuery = array_keys($select);
            foreach ($allQuery as $key => $val) {
                $allQuery[$key] = strtoupper($val);
            }
            /*
            такой способ работает не во всех версиях php
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val);
            });*/
            $querySql = "";
            if (in_array("WHERE", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "WHERE") {
                        $querySql .= " WHERE " . $val;
                    }
                }
            }
            if (in_array("GROUP", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "GROUP") {
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }
            if (in_array("ORDER", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "ORDER") {
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }
            if (in_array("LIMIT", $allQuery)) {
                foreach ($select as $key => $val) {
                    if (strtoupper($key) == "LIMIT") {
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }
            return $querySql;
        }
        return false;
    }
    // получить имя таблицы
    public function getTableName()
    {
        return $this->table;
    }
    public static function printr($in, $name = '')
    {
        echo '<pre>';
        echo 'Testing ' . $name . ' ';
        print_r($in);
        echo '</pre>';
    }
    // получить все записи
    function getAllRows()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) return false;
        return $this->dataResult;
    }
    // получить одну запись
    function getOneRow()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }
    // извлечь из базы данных одну запись
    function fetchOne()
    {
        if (!isset($this->dataResult) or empty($this->dataResult)) return false;
        foreach ($this->dataResult[0] as $key => $val) {
            $this->$key = $val;
        }
        return true;
    }
    // получить запись по id
    function getRowById($id)
    {
        try {
            $db = $this->db;
            $stmt = $db->query("SELECT * from $this->table WHERE id = $id");
            $row = $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }
    function getAllRowById($var, $id_user)
    {
        try {
            $db = $this->db;
            $stmt = $db->query("SELECT * from $this->table WHERE $var = $id_user");
            $row = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $row;
    }
}
