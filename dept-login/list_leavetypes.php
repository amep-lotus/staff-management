<?php

require_once 'classes/class.utility.php';
utility::check_login_and_redirect();

require_once 'config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.leavetype.php';

$db = new database;
$lt = new leavetype($db);

$leavetypes = $lt->get_leavetypes();
$leavetype_status = $lt->get_leavetype_status();

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
                    <h2 class="sub-header">Leave Types</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Sr. No</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            if (is_array($leavetypes) && count($leavetypes)) {
                                foreach ($leavetypes as $leavetype) {
                                    echo "<tr>";
                                    echo "<td>{$leavetype['id']}</td>";
                                    echo "<td>{$leavetype['name']}</td>";
                                    echo "<td>"
					. "<a href='#' class='btn btn-info'>{$leavetype_status[$leavetype['status']]}</a>"
					. "<br />"
					. "<br />"
					. "<a "
						. "href='index.php?action=delete_leavetype&id={$leavetype['id']}' "
						. "onclick='return confirm(\"Are you sure you want to delete this : {$leavetype['name']}?\")' "
						. "class='btn btn-danger'>Delete</a>"
					. "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                ?>
                                <tr><td colspan="2">No Leave Type found</td></tr>
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
