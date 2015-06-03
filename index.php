<?php

if (isset($_GET['action']) && (trim($_GET['action']) != '' || $_GET['action'] == 'login')) {
	header("Location:login.php");
}

switch($_GET['action']) {
	case 'dashboard':
		header("Location:dashboard.php");
		break;
	case 'logout':
		header("Location:logout.php");
		break;
	case 'list_departments':
		header("Location:list_departments.php");
		break;
	case 'add_department':
		header("Location:add_department.php");
		break;
	default:
		header("Location:logout.php");
}
