<?php
function checkUser(){
	$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
	mysql_select_db('kittenb1_users', $con);
	$result = mysql_query("SELECT * FROM login WHERE username='$_POST[username]'", $con);
	$num = mysql_num_rows($result);
	if($num == 0) {
		echo ('that username does not exist.');
	} else {
		while($row = mysql_fetch_array($result)){
			if($_POST['password'] == $row['password']){
				submitCookie();
			} else {
				echo 'incorrect password.\n';
				showLogin();
			}
		}
	}
	mysql_close($con);
}

function storeUser(){
	$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
	mysql_select_db('kittenb1_users', $con);
	$atPos = strpos($_POST['email'], '@');
	$dotPos = strpos($_POST['email'], '.');
	$apPos = strpos($_POST['username'], "'");
	$dollarPos = strpos($_POST["username"], "$");
	$quotePos = strpos($_POST["username"], '"');
	if($_POST['username'] == '' || $_POST['fname'] == '' || $_POST['lname'] == '' || $_POST['email'] == '' || $_POST['password1'] == '') {
		echo 'all fields are currently required. please try again.';
		showRegister();
	} else {
		if($apPos != false || $dollarPos != false || $quotePos != false) {
			echo 'usernames may not contain some of those characters. please try again.';
			showRegister();
		} else {
			if($atPos == false || $dotPos == false) {
				echo 'please supply a valid email address.';
				showRegister();
			} else {
				if($_POST['password1'] != $_POST['password2']){
					echo 'your passwords did not match. please try again.';
					showRegister();
				} else {
					$result = mysql_query("SELECT * FROM login WHERE username='$_POST[username]'", $con);
					$num = mysql_num_rows($result);
					if ($num != 0) {
						echo ('that username already exists.');
						showRegister();
					} else {
						$result = mysql_query("SELECT * FROM login WHERE email='$_POST[email]'", $con);
						$num = mysql_num_rows($result);
						if ($num != 0) {
							echo ('that email address is already registered.');
							showRegister();
						} else {
							$sql="INSERT INTO login (username, fname, lname, password, email)
							VALUES
							('$_POST[username]', '$_POST[fname]', '$_POST[lname]', '$_POST[password1]', '$_POST[email]')";
							if (!mysql_query($sql, $con)){
								die('Error: ' . mysql_error());
							}
							submitCookie();
						}
					}
				}
			}
		}
	}
	mysql_close($con);
}
function storePassword(){
	$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
	mysql_select_db('kittenb1_users', $con);
	$result = mysql_query("SELECT * FROM login WHERE username=$_COOKIE[username]", $con);
	while($row = mysql_fetch_array($result)){
		if($row['password'] != $_POST['oldpassword']){
			echo 'incorrect password. please try again.';
			showPassword();
		} else {
			if($_POST['newpassword1'] != $_POST['newpassword2']){
				echo 'your passwords did not match. please try again.';
				showPassword();
			} else {
				mysql_query("UPDATE login SET password='$_POST[newpassword1]' WHERE username='$_COOKIE[username]' AND password='$_POST[oldpassword]'");
				header('Location: index.php');
			}
		}
	}
	mysql_close($con);
}

function submitCookie(){
	$expire = time()+86400;
	setcookie('username', $_POST['username'], $expire, '/');
	header('Location: index.php');
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php if(isset($_COOKIE['username'])){ ?>
	<?php if($_GET['f'] == 'out'){ ?>
		<?php
		setcookie('username', '', time(), '/');
		header('Location: index.php');
		?>
	<?php } else if($_GET['f'] == 'pass'){ ?>
		<form action="index.php?f=change" method="post" class="mAuto mb20 bdrLtBrown bdrRound p10 w400 bgWhite">
			<p>username: <?= $_COOKIE['username']; ?></p>
			<input type="password" name="oldpassword" placeholder="old password" class="mb10 p5 wFull fs16"/>
			<input type="password" name="newpassword1" placeholder="new password" class="mb10 p5 wFull fs16"/>
			<input type="password" name="newpassword2" placeholder="re-enter new password" class="mb10 p5 wFull fs16"/>
			<fieldset class="line">
				<input type="submit" value="submit" class="unitR mb20 p5 fs16"/>
			</fieldset>
		</form>
	<?php } else if($_GET['f'] == 'change'){ ?>
		<?php storePassword(); ?>
	<?php } else { ?>
		<div class="mAuto mb20 bdrLtBrown bdrRound p10 w400 bgWhite">
			<p>welcome, <?= $_COOKIE['username']; ?></p>
			<p class="mb0">
				<a href="index.php?f=pass">change password</a>
				<span> | </span>
				<a href="index.php?f=out">sign out</a>
			</p>
		</div>
	<?php } ?>
<?php } else { ?>
	<?php if($_GET['f'] == 'add'){ ?>
		<?php storeUser(); ?>
	<?php } else if($_GET['f'] == 'reg'){ ?>
		<form action="index.php?f=add" method="post" class="mAuto mb20 bdrLtBrown bdrRound p10 w400 bgWhite">
			<input type="text" name="username" placeholder="username" class="mb10 p5 wFull fs16 bdrBox"/>
			<input type="password" name="password1" placeholder="password" class="mb10 p5 wFull fs16"/>
			<input type="password" name="password2" placeholder="re-enter password" class="mb10 p5 wFull fs16"/>
			<input type="text" name="fname" placeholder="first name" value="<?= $_POST['fname']; ?>" class="mb10 p5 wFull fs16 bdrBox"/>
			<input type="text" name="lname" placeholder="last name" value="<?= $_POST['lname']; ?>" class="mb10 p5 wFull fs16 bdrBox"/>
			<input type="text" name="email" placeholder="email" value="<?= $_POST['email']; ?>" class="mb10 p5 wFull fs16 bdrBox"/>
			<fieldset class="line">
				<input type="submit" value="submit" class="unitR mb20 p5 fs16"/>
			</fieldset>
			<p>have an account? <a href="index.php">sign in</a></p>
		</form>
	<?php } else if($_GET['f'] == 'check'){ ?>
		<?php checkUser(); ?>
	<?php } else { ?>
		<form id="loginForm" action="index.php?f=check" method="post" class="mAuto mb5 bdrLtBrown bdrRound p10 w400 bgWhite">
			<input type="text" name="username" placeholder="username" class="mb10 p5 wFull fs16 bdrBox"/>
			<input type="password" name="password" placeholder="password" class="mb10 p5 wFull fs16 bdrBox"/>
			<fieldset class="line">
				<input type="submit" value="submit" class="unitR mb20 p5 fs16"/>
			</fieldset>
			<p>need an account? <a href="index.php?f=reg">register</a></p>
		</form>
	<?php } ?>
<?php } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
