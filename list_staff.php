<?php
require_once 'classes/class.utility.php';
utility::check_login_and_redirect();

require_once 'config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.user.php';
require_once 'classes/class.department.php';

$db = new database;
$user = new user($db);
$dept = new department($db);

$staff = $user->get_staff();

$departments = $dept->get_departments_list();

$staff_type = $user->get_staff_types();
$status = $user->get_staff_status();


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dashboard </title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/dashboard.css" rel="stylesheet">

    </head>

    <body>

        <?php
        include_once 'nav.php';
        ?>

        <div class="container-fluid">
            <div class="row">
                <?php
                include_once 'sidebar.php';
                ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="sub-header">Staff</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Staff Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
			    //utility::pr($staff_type);
			    //utility::pr($departments);
                            if (is_array($staff) && count($staff)) {
                                foreach ($staff as $_staff) {
                                    echo "<tr>";
					echo "<td>{$_staff['name']}</td>";
					echo "<td>{$departments[$_staff['department_id']]}</td>";
					echo "<td>{$staff_type[$_staff['staff_type']]}</td>";
					echo "<td>{$status[$_staff['status']]}</td>";
					echo "<td><a class='btn btn-info' href='index.php?action=edit_staff&id={$_staff['id']}'> Edit</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                ?>
                                <tr><td colspan="4">No Staff found</td></tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
