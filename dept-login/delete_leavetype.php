<?php

require_once 'classes/class.utility.php';
utility::check_login_and_redirect();

require_once 'config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.leavetype.php';

$db = new database;
$lt = new leavetype($db);

$leavetypes = $lt->delete_leavetypes($_GET['id']);


