<?php 
define('BASEPATH', false);
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

$dbfile = "../application/config/database.php";
$dbfile2 = "../application/config/" . ENVIRONMENT . "/database.php";

if( is_file( $dbfile2 ) ) {
	include_once( $dbfile2 );
} else {
	include_once( $dbfile );
}

$db_config = $db[$active_group];

$dbconn = new mysqli();
$dbconn->connect($db_config['hostname'], $db_config['username'], $db_config['password']);
$dbconn->select_db( $db_config['database'] );

if( @$_GET['step'] == '1' ) { 

	if( @$_POST['setup_tables'] ) { 
		$tables = file_get_contents('create_tables.sql');
		$tables_arr = explode(";", $tables);

		foreach( $tables_arr as $sql ) {
			if( trim( $sql ) ) {
				$dbconn->query( trim( $sql ) );
			}
		}

		$tables = file_get_contents('default_settings.sql');
		$tables_arr = explode(";", $tables);

		foreach( $tables_arr as $sql ) {
			if( trim( $sql ) ) {
				$dbconn->query( trim( $sql ) );
			}
		}
	}

}
if( @$_GET['step'] == '2' ) { 
	if( @$_POST['admin_password'] ) { 
		$new_password = sha1(@$_POST['admin_password']);
		$dbconn->query( "UPDATE `user_accounts` SET `password` = '{$new_password}' WHERE `user_accounts`.`id` = 2;" );
		header("location: install.php?step=3");
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>SMB Payroll System Setup</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

h3 {
	color: #444;
	background-color: transparent;
	font-size: 13px;
	font-weight: bold;
	text-transform: uppercase;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
	text-decoration: underline;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1>SMB Payroll System Setup</h1>
<?php if( !@$_GET['step'] ) { ?>
		<p>You are about to install SMB Payroll System.</p>
		<p><strong>Database Settings</strong><br />
		<strong>DB Host:</strong> <?php echo $db_config['hostname']; ?><br />
		<strong>DB User:</strong> <?php echo $db_config['username']; ?><br />
		<strong>DB Pass:</strong> <?php echo $db_config['password']; ?><br />
		<strong>DB Name:</strong> <?php echo $db_config['database']; ?></p>
		<p>
			<a href="install.php?step=1">Proceed to Step 1: Create tables & set default settings</a>
		</p>
<?php } ?>
<?php if( @$_GET['step']=="1" ) { ?>

	<h3>Step 1: Create tables & set default settings</h3>

<?php if( @$_POST['setup_tables'] ) { ?>
	<p>Successfully created tables...<br/>
	Successfully set default settings...</p>
	<p>
			<a href="install.php?step=2">Proceed to Step 2: Change `admin` password</a>
		</p>
<?php } else { ?>
	<form method="post">
		<p>
You are about to setup tables and default settings. Press `PROCEED` button to continue...<br><br>
			<input type="hidden" name="setup_tables" value="1">
		<input type="submit" value="Proceed"></p>
	</form>
<?php } ?>
<?php } ?>
<?php if( @$_GET['step']=="2" ) { ?>
	<h3>Step 2: Change `admin` password</h3>
	<p>You are about to change the password of username: <u><strong>admin</strong></u>. <strong>Default Password: <em>admin</em></strong></p>
	<form method="post">
		<p>
New Admin Password:<br>
			<input type="text" name="admin_password" value="">
		<input type="submit" value="Submit"></p>
	</form>
<?php } ?>
<?php if( @$_GET['step']=="3" ) { ?>
	<p>`admin` password changed!</p>
	<p>All Done! You may now login to Payroll System!</p>
	<p style="color:red;"><strong><em>NOTE: Be sure to delete `install` folder to be able to use the system.</em></strong></p>
		<p>
			<a href="/account/login">Login to Payroll System</a>
		</p>
<?php } ?>
	</div>
</body>
</html>