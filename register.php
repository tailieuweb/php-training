<?php 
session_start();

include('functions.php') 
?>

<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="public/css/styles.css">
	<link rel="stylesheet/less" type="text/css" href="public/css/style.less" />
    <script  type="text/javascript" src="public/js/less.min.js"></script>
</head>
<body>
<div class="header">
	<h2>Register</h2>
</div>
<form method="post" action="register.php">
	<?php echo display_error(); ?>	
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>" placeholder="ex:user111">
    </div>
    <div class="input-group">
		<label>Full Name</label>
		<input type="text" name="fullname" value="<?php echo $fullname; ?>"  placeholder="ex:Nguyen Van A">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>"  placeholder="ex:nguyenvana@gmail.com">
	</div>
	<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="user" name="user">User</option>
			</select>
		</div>
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>

	<div class="input-group">
        <label>images</label>
        <input type="file"  name="image_profile" class="form-control">
    </div>
		<button type="submit" class="btn" name="register_btn">Register</button>
	</div>
	<p>
		Already a member? <a class="btn_register" href="login.php">Sign in</a>
	</p>
</form>
</body>
</html>