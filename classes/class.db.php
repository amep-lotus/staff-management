<?php

class database {

    public $resource;
    public $num_rows = null;
    public $valid_resource = false;

    function __construct() {
        mysql_connect(HOSTNAME, USERNAME, PASSWORD);
        mysql_select_db(DATABASE);
        return $this;
    }

    function select($table = '', $conditions = '', $count = false) {
        $return = array();
        if (trim($table) != '') {
            if (trim($conditions) == '') {
                $conditions = ' 1 = 1';
            }
	    if($count) {
		$sql = "SELECT count(*) as count_rows FROM $table WHERE $conditions;";
	    } else {
		$sql = "SELECT * FROM $table WHERE $conditions;";
	    }
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
                //TODO return the affected number of rows
            } else {
                $this->set_number_of_results();
            }
            $this->valid_resource = true;
            return $this->valid_resource;
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

        $this->query($sql);

        return $this->valid_resource;
    }

    function get_results() {
        $result = array();
        while ($row = mysql_fetch_array($this->resource)) {
            $result[] = $row;
        }
        return $result;
    }

    function get_one_result() {
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
        $sql = "INSERT INTO $table ";
        $columns = array();
        $values = array();
		$_columns = '';
		$_values = '';
        $i = 0;
        foreach ($data as $k => $v) {
            $columns[$i] = $k;
            $values[$i] = $v;
            $i++;
        }

        $first = true;
        foreach ($columns as $k => $column) {
            if ($first) {
                $_columns .= "`{$column}`";
				$_values .= "'{$values[$k]}'";
                $first = false;
            } else {
                $_columns .= ", `{$column}`";
                $_values .= ", '{$values[$k]}'";
            }
        }
        $sql .= " ($_columns) VALUES ($_values) ;";
        return $sql;
    }

}
