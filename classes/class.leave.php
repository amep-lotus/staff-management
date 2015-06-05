<?php

/**
 * Description of class
 *
 * @author tcrc
 */
class leave {

    public $db;
    public $leavetypes = array();
    public $table = 'leaves';

    function __construct($db) {
	$this->db = $db;
    }

    function get_leaves($_ids = array()) {
	
	$_in = '';
	
	// Convert array of IDs into a comma separated string format
	// Than we can use in the IN operator of SQL
	$first = true;
	foreach($_ids as $_id) {
	    if($first) {
		$first = false;
	    } else {
		$_in .= ",";
	    }
	    $_in .= $_id;
	}
	
	$condition = " user_id IN ($_in) ";
	
	if ($this->db->select($this->table, $condition, 0, 'user_id, leave_type_id', 'SUM', 'days', 'user_id, leave_type_id')) {
	    return $this->db->get_results();
	} else {
	    return false;
	}
    }

    function add($post = array()) {
	if (!utility::is_post()) {
	    return false;
	}
	$leavetype = array(
	    'name' => $post['leavetype'],
	    'type' => $post['type'],
	    'days' => $post['days']
		);
	return $this->db->insert($this->table, $leavetype);
    }
    
    

}
