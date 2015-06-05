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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //utility::pr($_POST); die;
    // Set default user type to Staff
    $type = 3;
    
    // If No department admin exists, then set this user as department admin
    if(!$user->department_admin_exists($_POST['department_id'])) {
	$type = 2;
    }
    
    // Get user data from form
    $_data = array(
	'name' => $_POST['name'],
	'department_id' => $_POST['department_id'],
	'gender' => $_POST['gender'],
	'dob' => $_POST['dob'],
	'doj' => $_POST['doj'],
	'description' => $_POST['description'],
	'type' => $type
    );
    
    // If staff type is set as department admin
    //	    Then no need to check if is_admin checkbox is checked
    //	    This user will be enforced department admin
    //
    // If staff is set as normal staff user 
    // Then check if is_admin checkbox is checked
    //	    If checked, then force this user as department admin
    //	    If not checked, then keep this user as staff
    
    if($type == 2) {
	
	// If username password has been provided, use them
	// If not provided, then use NAME as username and password
	if(
		isset($_POST['username']) 
		&& trim($_POST['username']) != ''
		&& isset($_POST['password']) != ''
		&& trim($_POST['password']) != ''
		) {
	    $_data['username'] = $_POST['username'];
	    $_data['password'] = $_POST['password'];
	} else {
	    $_data['username'] = $_POST['name'];
	    $_data['password'] = $_POST['name'];
	}
    } else if($type == 3) {
	if(
		isset($_POST['is_admin']) 
		&& trim($_POST['is_admin']) != '' 
		&& is_numeric($_POST['is_admin'])
		&& ($_POST['is_admin'] == 1)
		) {
	    $type = 2;
	    // If username password has been provided, use them
	    // If not provided, then use NAME as username and password
	    if(
		    isset($_POST['username']) 
		    && trim($_POST['username']) != ''
		    && isset($_POST['password']) != ''
		    && trim($_POST['password']) != ''
		    ) {
		$_data['username'] = $_POST['username'];
		$_data['password'] = $_POST['password'];
	    } else {
		$_data['username'] = $_POST['name'];
		$_data['password'] = $_POST['name'];
	    }

	}
    }
    //utility::pr($_data); die;
    $_data['type'] = $type;
    // Remove any existing user, if any, to Staff user, if new user is set to be admin
    if($type == 2) {
	$user->remove_existing_department_admin($_POST['department_id']);
    }
    if ($user->update($_data, "id={$_GET['id']}")) {
	if($type == 2) {
	    header("Location:index.php?action=list_department_admins");
	} else if($type == 3) {
	    header("Location:index.php?action=list_staff");
	}
    }
}

$departments = $dept->get_departments();
$_user = $user->get_user_details($_GET['id']);
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
		    <?php
		    //utility::pr($_user);
		    ?>
                    <h2 class="sub-header">Add Staff</h2>
                    <form action="" method="POST">
			<table class="table table-hover table-responsive table-striped">
			    <tr>
				<td>Name</td>
				<td>
				    <input type="text" name="name" value="<?=$_user[0]['name']?>" placeholder="Staff Name" />
				</td>
			    </tr>
			    <tr>
				<td>Department</td>
				<td>
				    <select name="department_id">
					<?php
					if (is_array($departments) && count($departments)) {
					    foreach ($departments as $department) {
						if($department['id'] == $_user[0]['department_id']) {
						    echo "<option selected='selected' value='{$department['id']}'>{$department['name']}</option>";
						} else {
						    echo "<option value='{$department['id']}'>{$department['name']}</option>";
						}
					    }
					}
					?>
				    </select>
				</td>
			    </tr>
			    <tr>
				<td>Gender</td>
				<td>
				    <input 
					type="radio" 
					name="gender" 
					<?php
					    if($_user[0]['gender'] == 1) {
						echo ' checked="checked" ';
					    }
					?>
					value="1" /> Male
				    <br />
				    <input 
					type="radio" 
					name="gender" 
					<?php
					    if($_user[0]['gender'] == 2) {
						echo ' checked="checked" ';
					    }
					?>
					value="2" /> Female
				</td>
			    </tr>
			    <tr>
				<td>DOB</td>
				<td>
				    <input type="text" name="dob" value="<?=$_user[0]['dob']?>" placeholder="Date of Birth" />
				</td>
			    </tr>
			    <tr>
				<td>DOJ</td>
				<td>
				    <input type="text" name="doj" value="<?=$_user[0]['doj']?>" placeholder="Date of Joining" />
				</td>
			    </tr>
			    <tr>
				<td>Description</td>
				<td>
				    <textarea name="description" placeholder="Description"><?=$_user[0]['description']?></textarea>
				</td>
			    </tr>
			    <tr>
				<td>Is Department Admin?</td>
				<td>
				    <input 
					type="checkbox" 
					name="is_admin" 
					<?php
					if($_user[0]['type'] == 2) {
					    echo ' checked="checked" ';
					}
					?>
					id="is_admin" 
					value="1" />
				</td>
			    </tr>
			    <tr id="username_holder" style="display: none;">
				<td>Username</td>
				<td>
				    <input type="text" name="username" value="<?=$_user[0]['username']?>" placeholder="Admin Username" />
				</td>
			    </tr>
			    <tr id="password_holder" style="display: none;">
				<td>Password</td>
				<td>
				    <input type="text" name="password" value="" placeholder="Admin Password" />
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

	<script>
	    $(document).ready( function () {
		$('#is_admin').change( function () {
		    if($(this).is(':checked')) {
			$('#username_holder,#password_holder').show();
		    } else {
			$('#username_holder,#password_holder').hide();
		    }
		});
	    });
	    <?php
	    if($_user[0]['type'] == 2) {
		echo "$('#username_holder,#password_holder').show();";
	    }
	    ?>
	</script>

    </body>
</html>
