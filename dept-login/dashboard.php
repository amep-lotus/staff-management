<?php
require_once '../classes/class.utility.php';
utility::check_login_and_redirect();
// User will be redirected to login page before it reaches this section

require_once '../config.php';
require_once '../classes/class.db.php';
require_once '../classes/class.leavetype.php';
require_once '../classes/class.leave.php';
require_once '../classes/class.user.php';
$db = new database();
$user = new user($db);
$lt = new leavetype($db);
$leave = new leave($db);

// Get users for the department of the admin
$users = $user->get_staff($user->get_department_id());
$staff_types = $user->get_staff_types();

// Get all leave types available
$leavetypes = $lt->get_leavetypes();

// User IDs only
$_ids = array();

// Initialize blank arrays for users(permanent and contractual)
$perm = array();
$cont = array();

// Initialize blank arrays for leavetypes(permanent and contractual)
$perm_lt = array();
$cont_lt = array();

// Sort users into separate categories
if (is_array($users) && count($users)) {
    foreach ($users as $user) {
	$_ids[] = $user['id'];
	if ($user['staff_type'] == 1) {
	    $perm[] = $user;
	} else {
	    $cont[] = $user;
	}
    }
}

// Sort leavetypes into separate categories
if (is_array($leavetypes) && count($leavetypes)) {
    foreach ($leavetypes as $leavetype) {
	if ($leavetype['type'] == 1) {
	    $perm_lt[] = $leavetype;
	} else {
	    $cont_lt[] = $leavetype;
	}
    }
}
//utility::pr($_ids);
$leaves = $leave->get_leaves($_ids);
//utility::pr($leaves);

//utility::pr($perm); utility::pr($cont); utility::pr($perm_lt); utility::pr($cont_lt); die;
?>
<?php
include_once 'nav.php';
?>

<div class="container-fluid">
    <div class="row">
	<?php
	include_once 'sidebar.php';
	?>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	    <h2 class="sub-header">Welcome to Leave Management</h2>
	    <table class="table table-striped">
		<tr>
		    <td>Name</td>
		    <td>Type</td>
		    <?php
		    foreach ($perm_lt as $_perm_lt) {
			echo "<td>{$_perm_lt['name']}</td>";
		    }
		    ?>
		</tr>
		<?php
		foreach($perm as $_perm) {
		    echo "<td>{$_perm['name']}</td>";
		    echo "<td>{$staff_types[$_perm['staff_type']]}</td>";
		    foreach ($perm_lt as $_perm_lt) {
			echo "<td>{$_perm_lt['name']}</td>";
		    }
		}
		?>
	    </table>
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
