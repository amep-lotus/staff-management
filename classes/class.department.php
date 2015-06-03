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
	
	

	function add($post = array()) {
		if (!utility::is_post()) {
			return false;
		}
		$department = array('name' => $post['department']);
		return $this->db->insert($this->table, $department);
	}

}
