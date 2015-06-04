<?php
require_once 'classes/class.utility.php';
utility::check_login_and_redirect();

require_once 'config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.department.php';

$db = new database;
$dept = new department($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    utility::pr($_POST);
    if ($dept->add($_POST)) {
	header("Location:index.php?action=list_departments");
    }
}
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
                    <h2 class="sub-header">Add Department</h2>
                    <form action="" method="POST">
			<table class="table table-hover table-responsive table-striped">
			    <tr>
				<td>Name</td>
				<td>
				    <input type="text" name="department" value="" placeholder="Enter Department name" />
				</td>
			    </tr>
			    <tr>
				<td>&nbsp;</td>
				<td>
				    <input type="submit" value="Submit" class="btn btn-primary" />
				</td>
			    </tr>
			</table>
		    </form>
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
