<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

<!-- Bootstrap core CSS -->
<link href="http://172.28.1.23/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="http://172.28.1.23/bootstrap4/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>
<style>
	.gold {
		background-color: #D1B780;
		color: #464239;
	}
</style>
<body>
	<div class="container">
		<div class="row" style="padding-top: 5%;">
			<div class="col-sm-12">
				<h1>
					<center><b>UNIVANCE (Thailand) Co.,Ltd</b></center>
				</h1>
				<h1>
					<center><b>Details of Petty Cash (Cash advance)</b></center>
				</h1>
			</div>
		</div>
		<div class="row" style="padding-top: 5%;">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<ul class="list-group">
					<form action="<?php echo site_url('Acc/'); ?>login" method="post">
						<li class="list-group-item" style="background-color: #D1B780;color: #464239;">
							<?php
							if (!empty($status)) {
								echo "<center><b style='color: red;'>!! ไม่พบข้อมูล !!</b></center>";
							}
							?>
						</li>
						<li class="list-group-item">
							<div class="input-group">
								<span class="input-group-addon" style="background-color: #D1B780;color: #464239;"><i class="glyphicon glyphicon-user"></i></span>
								<input id="username" name="username" required type="text" class="form-control" placeholder="Username">
							</div>
						</li>
						<li class="list-group-item">
							<div class="input-group">
								<span class="input-group-addon" style="background-color: #D1B780;color: #464239;"><i class="glyphicon glyphicon-lock"></i></span>
								<!-- <input id="password" name="password" required type="password" class="form-control" placeholder="Password"> -->
								<div class="input-group">
														<input type="password" required placeholder="Password" class="form-control" aria-label="Amount (to the nearest dollar)" type="password" name="password" id="password" value="">
														<div class="input-group-append">
															<span class="btn btn-sm gold" onclick="Toggle()" id="s"><span data-feather="eye"></span></span>
														</div>
													</div>
							</div>
						</li>
						<li class="list-group-item" style="text-align: center;">
							<button type="submit" class="btn btn-default" style="background-color: #D1B780;color: #464239;"><span data-feather="log-in"></span> Sign in</button>
						</li>
						<li class="list-group-item" style="background-color: #D1B780;color: #464239;">
							<!-- <b>Login</b> -->
						</li>
					</form>
				</ul>
			</div>
			<div class="col-md-4"></div>
		</div>

	</div>
</body>

	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script>
		window.jQuery || document.write('<script src="http://172.28.1.23/bootstrap4/assets/js/vendor/jquery-slim.min.js"><\/script>')
	</script>
	<script src="http://172.28.1.23/bootstrap4/assets/js/vendor/popper.min.js"></script>
	<script src="http://172.28.1.23/bootstrap4/dist/js/bootstrap.min.js"></script>

	<!-- Icons -->
	<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
	<script>
		feather.replace()
	</script>

	<!-- Graphs -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<script>
	function Toggle() {
			var temp = document.getElementById("password");
			if (temp.type === "password") {
				temp.type = "text";
			} else {
				temp.type = "password";
			}

		}

	$(document).ready(function() {
		$("#doc").DataTable();
	});

	function enter(id) {
		document.getElementById(id).submit();
	}

	function doc(id) {
		document.getElementById(id).submit();
	}

	function del(id, name) {
		if (confirm('Delete Document ' + name)) {
			document.getElementById(id).submit();
		}
	}
</script>

</html>
