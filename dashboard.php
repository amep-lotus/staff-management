<?php
require_once 'classes/class.utility.php';
utility::check_login_and_redirect();
// User will be redirected to login page before it reaches this section


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

        <title>List Departments</title>

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
                <a href="index.php?action=list_departments" class="btn btn-group-lg btn-danger">List Departments</a>
			</div>
			<br />
            <div>
                <a href="index.php?action=add_department" class="btn btn-group-lg btn-danger">Add Department</a>
			</div>
        </div> <!-- /container -->

		<div class="container">
			<div>
				
			</div>
		</div>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    </body>
</html>
