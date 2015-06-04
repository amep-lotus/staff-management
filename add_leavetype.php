<?php
require_once 'classes/class.utility.php';
utility::check_login_and_redirect();

require_once 'config.php';
require_once 'classes/class.db.php';
require_once 'classes/class.leavetype.php';

$db = new database;
$lt = new leavetype($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	utility::pr($_POST);
	if($lt->add($_POST)) {
		header("Location:index.php?action=list_leavetypes");
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

        <title>Add Leave Type</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <!--<link href="signin.css" rel="stylesheet">-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">
            <div>
                <a href="logout.php" class="btn btn-group-lg btn-danger">Logout</a>
			</div>
        </div> <!-- /container -->
		<br />
        <div class="container">
            <div>
                <a href="index.php?action=dashboard" class="btn btn-group-lg btn-danger">Back to Dashboard</a>
			</div>
			<br />
        </div> <!-- /container -->

		<div class="container">
			<form action="" method="POST">
				<table class="table table-hover table-responsive table-striped">
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="leavetype" value="" placeholder="Enter Leave Type" />
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

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    </body>
</html>
