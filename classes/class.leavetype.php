<?php

/**
 * Description of class
 *
 * @author tcrc
 */
class leavetype {

    public $db;
    public $leavetypes = array();
    public $table = 'leave_types';

    function __construct($db) {
	$this->db = $db;
    }

    function get_leavetypes() {
	if ($this->db->select($this->table)) {
	    return $this->db->get_results();
	} else {
	    return false;
	}
    }

    function add($post = array()) {
	if (!utility::is_post()) {
	    return false;
	}
	$leavetype = array('name' => $post['leavetype']);
	return $this->db->insert($this->table, $leavetype);
    }
    
    function get_leavetype_status() {
	return array(1 => 'Active', 2 => 'Inactive');
    }

}
