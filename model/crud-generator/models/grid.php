<?php

/**
 * @author  The-Di-Lab
 * @email   thedilab@gmail.com
 * @website http://www.the-di-lab.com
 **/
class Grid
{
    /*************** PROPERTY **********/
    private $config;

    private $dbh = null;

    private $sth = null;

    /*************** PUBLIC METHODS **********/
    public function __construct()
    {
        include ROOT . '/config/setting.php';
        $this->config = $config;
    }

    public function delete($table, $pk, $id)
    {
        return $this->_delete($table, array($pk => $id));
    }

    public function create($table, $data)
    {
        return $this->_insert($table, $data);
    }

    public function update($table, $pk, $data)
    {
        $condition = array($pk => $data[$pk]);
        unset($data[$pk]);
        return $this->_update($table, $data, $condition);
    }

    public function getRow($table, $conditions)
    {
        $this->_connect();
        $sql = "SELECT * FROM " . $table . ' WHERE ' . $this->_buildConditionEqual($conditions);
        $result = $this->_mysqlQuery($sql);
        return $this->_resultToArray($result);
    }

    public function getData($table, $order = null, $page = null, $perPage = null, $condition = null)
    {
        $this->_connect();
        $sql = "SELECT * FROM " . $table;


        if (null != $condition) {
            $sql .= ' WHERE ';
            $sql .= $this->_buildConditionLike($condition);
        }

        if (null != $order) {
            $sql .= $this->_buildOrder($order);
        }

        if (null != $page && $perPage != null) {
            $sql .= $this->_buildLimit($page, $perPage);
        }

        $result = $this->_mysqlQuery($sql);
        return $this->_resultToArray($result);
    }

    public function getColumns($table)
    {
        $this->_connect();
        $sql = "SHOW COLUMNS FROM " . $table;
        $result = $this->_mysqlQuery($sql);
        return $this->_resultToArray($result);
    }

    public function getTotal($table, $condition = null)
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $table;

        if (null != $condition) {
            $sql .= ' WHERE ';
            $sql .= $this->_buildConditionLike($condition);
        }

        $result = $this->_mysqlQuery($sql);
        return $this->_resultToArray($result);
    }

    /*************** PRIVATE METHODS **********/
    private function _query($query)
    {
        if ($this->_connect()) {
            $result = $this->_mysqlQuery($query);
            return $this->_resultToArray($result);
        }
        return false;
    }

    private function _connect()
    {
        $host = $this->config['DB']['host'];
        $db = $this->config['DB']['database'];
        $user = $this->config['DB']['database-username'];
        $pwd = $this->config['DB']['database-password'];

        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return true;
    }

    private function _resultToArray($result)
    {
        $return = array();

        $this->sth->setFetchMode(PDO::FETCH_ASSOC);

        while ($row = $this->sth->fetch()) {
            $return [] = $row;
        }

        return $return;
    }

    private function _mysqlQuery($sql)
    {
        $this->_connect();

        $this->sth = $this->dbh->query($sql);
    }

    private function _delete($table, $condition)
    {
        $this->_connect();

        $sql = 'DELETE FROM ' . $table;
        $sql .= ' WHERE 1=1 AND ';
        foreach ($condition as $key => $cond) {
            $sql .= $key . ' = ' . $this->_sanitise($cond) . ' AND';
        }
        $sql = substr($sql, 0, strlen($sql) - 3);

        return $this->dbh->exec($sql);
    }

    private function _insert($table, $data)
    {
        $this->_connect();

        $values = array_values($data);
        $keys = array_keys($data);

        try {
            $sth = $this->dbh->prepare("INSERT INTO $table (" . implode(',', $keys) . ") values (" . implode(',', array_fill(0, count($keys), '?')) . ")");
            $sth->execute($values);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return true;
    }

    private function _update($table, $data, $condition)
    {
        $this->_connect();

        $values = array_values($data);
        $keys = array_keys($data);
        $setKeys = array_map(function ($n) {
            return $n . '=?';
        }, $keys);

        try {
            $sql = "UPDATE $table SET " . implode(',', $setKeys) . " WHERE " . current(array_keys($condition)) . "=?";
            $sth = $this->dbh->prepare($sql);
            $values[] = current($condition);
            $sth->execute($values);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return true;
    }

    private function _sanitise($string)
    {
        return $string;
    }

    /*
     * get database fields
     */
    private function _getTableAttr()
    {
        $table = $this->config['App']['table'];
        $sql = "SHOW COLUMNS FROM $table";
        $result = $this->_mysqlQuery($sql);
        return $this->_resultToArray($result);
    }

    /*
      * it builds conditions in sql query for both function above.
      */
    private function _buildConditionEqual($conditions)
    {
        $condition = ' 1=1 ';
        if (is_array($conditions)) {
            foreach ($conditions as $field => $value) {
                $condition .= ' AND ' . $this->_sanitise($field) . ' = ' . $this->_sanitise($value);
            }
        }
        return $condition;
    }

    /*
      * it builds conditions in sql query for both function above.
      */
    private function _buildConditionLike($conditions)
    {
        $condition = ' 1=1 ';
        if (is_array($conditions)) {
            foreach ($conditions as $field => $value) {
                $condition .= ' AND ' . $this->_sanitise($field) . ' LIKE \'%' . $this->_sanitise($value) . '%\'';
            }
        }
        return $condition;
    }

    /*
     * it builds "order by" in sql query for both function above.
     */
    private function _buildOrder($order)
    {
        $orderBy = '';
        if (is_array($order)) {
            foreach ($order as $field => $seq) {
                if (in_array(strtoupper($seq), array('DESC', 'ASC'))) {
                    $orderBy = ' ORDER BY ' . $this->_sanitise($field) . ' ' . $this->_sanitise($seq);
                    break;
                }
            }
        }
        return $orderBy;
    }

    /*
     * it builds "limit" in sql query.
     */
    private function _buildLimit($page, $perPage)
    {
        $lmt = '';

        if (is_int($page) && is_int($perPage) && $perPage > 0 && $page > 0) {
            $lmt = ' LIMIT ' . ($page - 1) * $perPage . ',' . $perPage;
        }
        return $lmt;
    }
}

?>