<?php

require_once '../config.php';
require_once '../classes/class.db.php';
require_once '../classes/class.user.php';
$db = new database();
$user = new user($db);
$user->logout();

header("Location:login.php");
