<?php

session_start();


/**
 * Description of class
 *
 * @author tcrc
 */
class user {

    public $db;
    public $user = array();
    public $is_logged_in = false;
    public $table = 'users';

    function __construct($db) {
        $this->db = $db;
    }

    function login($username, $password, $remember_me = false) {
        if (trim($username) != '' && trim($password) != '') {
            $conditions = " "
					. "username = '$username' "
					. "&& password = '" . sha1($password) . "'";
            if ($this->db->select($this->table, $conditions)) {
                $this->user = $this->db->get_results();
                $this->is_logged_in = true;
                $_SESSION['id'] = $this->user[0]['id'];
				if($remember_me) {
					$rand_hash = sha1(time().microtime().rand().rand());
					$sql=""
							. "UPDATE `{$this->table}` "
							. "SET `hash` = '$rand_hash' "
							. "WHERE"
							. " `id` = {$_SESSION['id']}";
					if(mysql_query($sql)) {
						setcookie('remember_me', $rand_hash);
					}
					
				}
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function logout() {
        unset($_SESSION['id']);
        unset($this->user);
        $this->is_logged_in = false;
        return true;
    }

    function is_logged_in() {
        return $this->is_logged_in;
    }

    function get_name() {
        return $this->user['fname'] . ' ' . $this->user['lname'];
    }

    function get_email() {
        return $this->user['email'];
    }

    function register($post = array()) {
        if (!utility::is_post()) {
            return false;
        }
        $user = array();
        $user['fname'] = $post['fname'];
        $user['lname'] = $post['lname'];
        $user['email'] = $post['username'];
        $user['password'] = sha1($post['password']);

        return $this->db->insert($this->table, $user);
    }

	function is_valid_cookie($cookie = '') {
		if(empty($cookie)) {
			return false;
		}
		$conditions = " "
				. "hash = '$cookie' ";
		if ($this->db->select($this->table, $conditions)) {
			$this->user = $this->db->get_results();
			if(is_array($this->user[0]) && count($this->user[0])) {
				$_SESSION['id'] = $this->user[0]['id'];
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
