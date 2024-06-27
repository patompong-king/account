<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User <?php echo $_SESSION['name']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-default" style="background-color: #D1B780;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('Acc/') . $page; ?>"><b>HOME</b></a>
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>user"> <b> <?php echo $_SESSION['name']; ?></b></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>logout"><span class="glyphicon glyphicon-log-in"></span> <b>Sign out</b></a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 card">
				<div class="row login_box">
					<div class="col-md-12 col-xs-12" align="center">
						<div class="line">
							<h3>Profile</h3>
						</div>
						<!-- <div class="outter"><img src="http://lorempixel.com/output/people-q-c-100-100-1.jpg" class="image-circle" /></div> -->
						<h1><?php echo $_SESSION['name']; ?></h1>
						<span><?php echo $_SESSION['role']; ?></span>
					</div>

					<div class="col-md-12 col-xs-12 login_control">
						<?php foreach ($user as $x) { ?>
							<div class="row">
								<div class="col-sm-2">
									<label for="">Emp. Code</label>
									<input type="text" name="emp_code" id="emp_code" class="form-control" value="<?php echo $x->emp_code; ?>" />
								</div>
								<div class="col-sm-4">
									<label for="">First Name</label>
									<input type="hidden" name="id" value="<?php echo $x->id; ?>">
									<input type="text" name="name" id="name" class="form-control" value="<?php echo $x->name; ?>" />
								</div>
								<div class="col-sm-4">
									<label for="">Last Name</label>
									<input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $x->last_name; ?>" />
								</div>
								<div class="col-sm-2">
									<label for="">Nickname</label>
									<input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $x->nickname; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label for="">Role</label>
									<select name="" id="" class="form-control">
										<option value=""></option>
										<option value="President" <?php if ($x->role == 'President') {
																		echo 'selected';
																	} ?>>President</option>
										<option value="GM" <?php if ($x->role == 'GM') {
																echo 'selected';
															} ?>>GM</option>
										<option value="Manager" <?php if ($x->role == 'Manager') {
																	echo 'selected';
																} ?>>Manager</option>
									</select>
								</div>
								<div class="col-sm-5">
									<label for="">Username</label>
									<input type="text" name="username" id="username" class="form-control" value="<?php echo $x->username; ?>" />
								</div>
								<div class="col-sm-4">
									<label for="">Password</label>
									<input type="password" id="password" name="password" required class="form-control" value="<?php echo $x->password; ?>" />
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-5"></div>
								<div class="col-sm-4">
									<label for="">Confirm Password</label>
									<input type="password" id="con_password" name="con_password" required class="form-control" value="" />
									<input type="checkbox" onclick="Toggle()">
									<b>Show Password</b>
								</div>
							</div>
						<?php } ?>
						<div align="center" style="padding-top: 15px;">
							<button class="btn btn-primary">Save</button>
						</div>

					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
</body>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
	feather.replace()
</script>
<script>
	function Toggle() {
		var temp = document.getElementById("password");
		if (temp.type === "password") {
			temp.type = "text";
		} else {
			temp.type = "password";
		}
		var temp2 = document.getElementById("con_password");
		if (temp2.type === "password") {
			temp2.type = "text";
		} else {
			temp2.type = "password";
		}
	}
</script>

</html>
