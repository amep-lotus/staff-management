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
	    $perm[$user['id']] = $user;
	} else {
	    $cont[$user['id']] = $user;
	}
    }
}

// Sort leavetypes into separate categories
if (is_array($leavetypes) && count($leavetypes)) {
    foreach ($leavetypes as $leavetype) {
	if ($leavetype['type'] == 1) {
	    $perm_lt[$leavetype['id']] = $leavetype;
	} else {
	    $cont_lt[$leavetype['id']] = $leavetype;
	}
    }
}
//utility::pr($_ids);
$leaves = $leave->get_leaves($_ids);

//utility::pr($perm); utility::pr($cont); utility::pr($perm_lt); utility::pr($cont_lt); 
//utility::pr($leaves); die;
?>
<?php
include_once 'nav.php';
?>

<div class="container-fluid">
    <div class="row">
	<?php
	include_once 'sidebar.php';
	?>

	<form action="" method="POST">
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<h2 class="sub-header">Welcome to Leave Management</h2>
		<?php
		//utility::pr($leaves);
		//utility::pr($perm_lt);
		?>
		<h3 class="sub-header">Permanent Staff</h3>
		<table class="table table-striped table-bordered">
		    <tr>
			<td>&nbsp;</td>
			<td>Name</td>
			<td>Type</td>
			<?php
			foreach ($perm_lt as $_perm_lt) {
			    echo "<td>{$_perm_lt['name']}</td>";
			}
			?>
		    </tr>
		    <?php
		    foreach ($perm as $_perm) {
			echo "<td>"
			. "<input type='radio' rel='{$_perm['staff_type']}' name='user_id' value='{$_perm['id']}' />"
			. "</td>";
			echo "<td>{$_perm['name']}</td>";
			echo "<td>{$staff_types[$_perm['staff_type']]}</td>";
			foreach ($perm_lt as $_perm_lt) {
			    $leaves_sum = 0;
			    foreach ($leaves as $_leave) {
				if (
					($_perm['id'] == $_leave['user_id']) && ($_perm_lt['id'] == $_leave['leave_type_id'])
				) {
				    $leaves_sum += $_leave['days'];
				}
			    }
			    echo "<td>{$leaves_sum}</td>";
			}
		    }
		    ?>
		</table>
		<h3 class="sub-header">Contractual Staff</h3>
		<table class="table table-striped table-bordered">
		    <tr>
			<td>&nbsp;</td>
			<td>Name</td>
			<td>Type</td>
			<?php
			foreach ($cont_lt as $_cont_lt) {
			    echo "<td>{$_cont_lt['name']}</td>";
			}
			?>
		    </tr>
		    <?php
		    foreach ($cont as $_cont) {
			echo "<td>"
			. "<input type='radio' rel='{$_cont['staff_type']}' name='user_id' value='{$_cont['id']}' />"
			. "</td>";
			echo "<td>{$_cont['name']}</td>";
			echo "<td>{$staff_types[$_cont['staff_type']]}</td>";
			foreach ($cont_lt as $_cont_lt) {
			    $leaves_sum = 0;
			    foreach ($leaves as $_leave) {
				if (
					($_cont['id'] == $_leave['user_id']) && ($_cont_lt['id'] == $_leave['leave_type_id'])
				) {
				    $leaves_sum += $_leave['days'];
				}
			    }
			    echo "<td>{$leaves_sum}</td>";
			}
		    }
		    ?>
		</table>
	    </div>
	    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<table class="table table-condensed table-bordered">
		    <tr>
			<td>Leave Type</td>
			<td>
			    <select id="_permanent_lt">
				<?php
				foreach ($perm_lt as $_perm_lt) {
				    echo "<option value=\"{$_perm_lt['id']}\">{$_perm_lt['name']}</option>";
				}
				?>
			    </select>
			    <select id="_contractual_lt">
				<?php
				foreach ($cont_lt as $_cont_lt) {
				    echo "<option value=\"{$_cont_lt['id']}\">{$_cont_lt['name']}</option>";
				}
				?>
			    </select>
			</td>
		    </tr>
		    <tr>
			<td>Date Picker</td>
			<td><input type="text" name="from_to" id="from" /></td>
		    </tr>
		    <tr>
			<td>Single Day</td>
			<td><input type="checkbox" name="single" value="1" id="single" /></td>
		    </tr>
		    <tr>
			<td>Half Day</td>
			<td><input type="checkbox" name="half" value="1" id="half" /></td>
		    </tr>
		    <tr>
			<td>Remarks</td>
			<td>
			    <textarea name="remarks"></textarea>
			</td>
		    </tr>
		    <tr>
			<td>&nbsp;</td>
			<td>
			    <input type="submit" name="Save" value="Save" class="btn btn-info" />
			</td>
		    </tr>
		</table>
	    </div>

	</form>
    </div>
</div>
<?php
require_once 'footer.php';
?>
<script>
    $(document).ready(function () {
        $('#from').daterangepicker();
        $('#single').click(function () {
            if ($(this).is(':checked')) {
                $('#from').daterangepicker({
                    dateLimit: {days: 0}
                });
            } else {
		$('#from').daterangepicker();
	    }
        });
    });
</script>
</body>
</html>
