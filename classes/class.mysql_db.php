<?php

class mysql_db extends database {

    public $resource;
    public $num_rows = null;
    public $valid_resource = false;

    function __construct() {
        mysql_connect(HOSTNAME, USERNAME, PASSWORD);
        mysql_select_db(DATABASE);
        return $this;
    }

    function select($table = '', $conditions = '') {
        $return = array();
        if (trim($table) != '') {
            if (trim($conditions) == '') {
                $conditions = ' 1 = 1';
            }
            $sql = "SELECT * FROM $table WHERE $conditions;";
            $this->query($sql);
            if ($this->valid_resource && ($this->num_rows > 0)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        return $return;
    }

    function query($sql = '', $type = 'select') {
        if (trim($sql) != '') {
            $this->resource = mysql_query($sql);
            if (!$this->resource) {
                return false;
            }
            if ($type == 'insert') {
                return $this->resource;
            } else {
                $this->set_number_of_results();
            }
        } else {
            return false;
        }
    }

    function update() {
        
    }

    function delete($id = 0) {
        if ($id && is_numeric($id)) {
            
        }
    }

    function insert($table = '', $data = array()) {
        if (trim($table) == '' || !is_array($data) || count($data) == 0) {
            return false;
        }

        $sql = $this->create_insert_sql($table, $data);

        $this->query($sql, 'insert');

        return $this->valid_resource;
    }

    function get_results() {
        if ($this->num_rows == 1) {
            return $this->get_one_result();
        }
        $result = array();
        while ($row = $this->get_one_result()) {
            $result[] = $row;
        }
        return $result;
    }

    private function get_one_result() {
        return mysql_fetch_array($this->resource);
    }

    function get_number_of_results() {
        return $this->num_rows;
    }

    function get_db_instance() {
        return $this;
    }

    function set_number_of_results() {
        $this->num_rows = mysql_num_rows($this->resource);
    }

    private function create_insert_sql($table = '', $data = array()) {
        $sql = "INSERT INTO `$table` (";
        $columns = '';
        $values = '';
        $i = 0;
        foreach ($data as $k => $v) {
            if ($i == 0) {
                $columns .= "`$k`";
                $values .= "'$v'";
            } else {
                $columns .= ", `$k`";
                $values .= ", '$v'";
            }
            $i++;
        }

        $sql .= "$columns) VALUES ($values) ;";

        return $sql;
    }

}
