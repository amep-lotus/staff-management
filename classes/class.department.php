<?php

/**
 * Description of class
 *
 * @author tcrc
 */
class department {

    public $db;
    public $departments = array();
    public $table = 'departments';

    function __construct($db) {
	$this->db = $db;
    }

    function get_departments() {
	if ($this->db->select($this->table)) {
	    return $this->db->get_results();
	} else {
	    return false;
	}
    }

    /**
     * 
     * @return array of the key value paired departments
     *  Key being the primary key of the department table
     *  Value being the name of the department
     * @return boolean false, if no result found
     */
    function get_departments_list() {
	$_departments = $this->get_departments();
	if (is_array($_departments) && count($_departments)) {
	    $departments = array();
	    foreach ($_departments as $_department) {
		$departments[$_department['id']] = $_department['name'];
	    }
	    return $departments;
	} else {
	    return false;
	}
    }

    function add($post = array()) {
	if (!utility::is_post()) {
	    return false;
	}
	$department = array('name' => $post['department']);
	return $this->db->insert($this->table, $department);
    }

}
