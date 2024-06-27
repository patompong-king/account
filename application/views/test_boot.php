<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="icon" href="http://172.28.1.23/bootstrap4/favicon.ico"> -->

	<title>Dashboard Template for Bootstrap</title>

	<!-- Bootstrap core CSS -->
	<link href="http://172.28.1.23/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="http://172.28.1.23/bootstrap4/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>
<style>
	.a {
		background-image: url("http://172.28.1.23/img/wallpaper (4).jfif");
		background-color: #cccccc;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	.b {
		background-image: url("http://172.28.1.23/img/wallpaper (5).jfif");
		background-color: #cccccc;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	.c {
		background-image: url("http://172.28.1.23/img/wallpaper (7).jfif");
		background-color: #cccccc;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	.d {
		background-image: url("http://172.28.1.23/img/wallpaper (8).jfif");
		background-color: #cccccc;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}

	.e {
		background-image: url("http://172.28.1.23/img/wallpaper (2).jfif");
		background-color: #cccccc;
		height: 100%;
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>

<body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?php echo $_SESSION['name'] ?></a>
		<!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="<?php echo site_url('Acc/'); ?>logout"><span data-feather="log-out"></span> Sign out</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar ">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" href="">
								<span data-feather="home"></span>
								home <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section1">
								<span data-feather="users"></span>
								User
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section2">
								<span data-feather="user-plus"></span>
								New User
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section3">
								<span data-feather="database"></span>
								Documents
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section4">
								<span data-feather="file"></span>
								section4
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section5">
								<span data-feather="bar-chart-2"></span>
								section5
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#section6">
								<span data-feather="layers"></span>
								section6
							</a>
						</li>
					</ul>

					<!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						<span>Saved reports</span>
						<a class="d-flex align-items-center text-muted" href="#">
							<span data-feather="plus-circle"></span>
						</a>
					</h6>
					<ul class="nav flex-column mb-2">
						<li class="nav-item">
							<a class="nav-link" href="#section6">
								<span data-feather="file-text"></span>
								Current month
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<span data-feather="file-text"></span>
								Last quarter
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<span data-feather="file-text"></span>
								Social engagement
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">
								<span data-feather="file-text"></span>
								Year-end sale
							</a>
						</li>
					</ul> -->
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

				<section class="home-section">
					<div class="row">
						<div class="col-sm-12">
							<?php echo $new_user_status; ?>
						</div>
					</div>
					<div id="section1" class="container" style="padding-bottom: 100px;" width="900" height="1000px">
						<h1 style="padding-top: 100px;">User</h1>
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-sm" id="" style="width: 100%;">
								<thead id="" class="thead-dark">
									<tr>
										<th style="width: 5%;text-align: center;">No.</th>
										<th style="width: 10%;text-align: center;">Emp. Code</th>
										<th style="width: 40%;text-align: center;" colspan="3">Name</th>
										<th style="width: 10%;text-align: center;">Role</th>
										<th style="width: 15%;text-align: center;">Username</th>
										<th style="width: 15%;text-align: center;">Password</th>
										<!-- <th style="width: 8%;text-align: center;">Status</th> -->
										<th></th>
									</tr>
								</thead>
								<tbody id="">
									<?php $i = 1;
									foreach ($user as $x) { ?>
										<tr>
											<form action="" method="post">
												<input type="hidden" name="id" id="id" value="<?php echo $x->id; ?>">
												<th style="text-align: center;"><?php echo $i; ?></th>
												<th><input type="text" name="emp_code" id="emp_code" class="form-control form-control-sm" value="<?php echo $x->emp_code; ?>"></th>
												<th style="width: 14%;"><input type="text" name="f_name" id="name" class="form-control form-control-sm" value="<?php echo $x->name; ?>"></th>
												<th style="width: 14%;"><input type="text" name="l_name" id="last_name" class="form-control form-control-sm" value="<?php echo $x->last_name; ?>"></th>
												<th style="width: 10%;"><input type="text" name="nickname" id="nickname" class="form-control form-control-sm" value="<?php echo $x->nickname; ?>"></th>
												<th><input type="text" name="role" id="role" class="form-control form-control-sm" value="<?php echo $x->role; ?>"></th>
												<th><input type="text" name="username" id="username" class="form-control form-control-sm" value="<?php echo $x->username; ?>"></th>
												<th>
													<!-- <input type="password" name="password" id="e_password<?php echo $i; ?>" class="form-control form-control-sm" value="<?php echo $x->password; ?>"> -->
													<div class="input-group">
														<input type="password" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)" type="password" name="password" id="e_password<?php echo $i; ?>" value="<?php echo $x->password; ?>">
														<div class="input-group-append">
															<span class="btn btn-sm btn-dark" onclick="Toggle_e(<?php echo $i; ?>)" id="s_<?php echo $i; ?>"><span data-feather="eye"></span></span>
														</div>
													</div>
												</th>
												<!-- <th><?php echo $x->status; ?></th> -->
												<td>
													<div class="btn-group mr-2" role="group" aria-label="First group">
														<button type="submit" class="btn btn-sm btn-success" name="btn" value="edit">save</button>
														<button type="submit" class="btn btn-sm btn-danger" name="btn" value="delete">delete</button>
													</div>
												</td>
											</form>
										</tr>
									<?php $i++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					<div id="section2" class="container" style="padding-bottom: 100px;" width="900" height="1000px">
						<h1 style="padding-top: 100px;">New User</h1>
						<div class="row">
							<div class="col-sm-12">
								<?php echo $new_user_status; ?>
							</div>
						</div>
						<form action="" method="post" id="new_user">
							<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-2">
											<label for="">Emp. Code</label>
											<input type="text" name="n_emp_code" id="n_emp_code" class="form-control" value="" />
										</div>
										<div class="col-sm-4">
											<label for="">First Name</label>
											<input type="hidden" name="id" value="<?php echo $x->id; ?>">
											<input type="text" name="n_f_name" id="n_first_name" class="form-control" value="" />
										</div>
										<div class="col-sm-4">
											<label for="">Last Name</label>
											<input type="text" name="n_l_name" id="n_last_name" class="form-control" value="" />
										</div>
										<div class="col-sm-2">
											<label for="">Nickname</label>
											<input type="text" name="n_nickname" id="n_nickname" class="form-control" value="" />
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<label for="">Role</label>
											<select name="" id="" class="form-control">
												<option value=""></option>
												<option value="President">President</option>
												<option value="GM">GM</option>
												<option value="Manager">Manager</option>
											</select>
										</div>
										<div class="col-sm-5">
											<label for="">Username</label>
											<input type="text" name="n_username" id="n_username" class="form-control" value="" />
										</div>
										<div class="col-sm-4">
											<label for="">Password</label>
											<input type="password" id="n_password" name="n_password" required class="form-control" value="" />
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3"></div>
										<div class="col-sm-5"></div>
										<div class="col-sm-4">
											<label for="">Confirm Password</label>
											<input type="password" id="n_con_password" name="n_con_password" required class="form-control" value="" />
											<input type="checkbox" onclick="Toggle()">
											<b>Show Password</b>
										</div>
									</div>
								</div>
							</div>
							<div class="row" style="padding-bottom: 150px;">
								<!-- <div class="col-sm-2"></div> -->
								<div class="col-sm-12" style="text-align: right;">
									<button type="submit" class="btn btn-success" name="btn" value="new_user">Confirm</button>
								</div>
								<!-- <div class="col-sm-2"></div> -->
						</form>
					</div>
					<div id="section3" class="container" style="padding-bottom: 100px;" width="900" height="1000px">
						<h1 style="padding-top: 100px;">section3</h1>
						<div class="table-responsive">
							<table class="table table-bordered table-sm" id="doc" name='doc'>
								<thead class="thead-dark">
									<tr>
										<th>ID</th>
										<th style="width: 25%;text-align: center;">Document Name</th>
										<th>Document Date</th>
										<th>Receipt</th>
										<th>Payment</th>
										<th>Create Date</th>
										<th></th>
									</tr>
								</thead>
								<?php foreach ($doc as $d) { ?>
									<tr>
										<th><?php echo $d->id; ?></th>
										<td><input class="form-control" id="d_name" name="d_name" placeholder="Role" type="text" value="<?php echo $d->name; ?>"></td>
										<td><?php echo $d->date; ?></th>
										<td><?php echo $d->Receipt; ?></td>
										<td><?php echo $d->Payment; ?></td>
										<td><?php echo $d->create_date; ?></td>
										<td style="text-align: center;">
											<div class="btn-group mr-2" role="group" aria-label="First group">
												<button type="submit" class="btn btn-default btn-sm" style="background-color: #00bcd4;" name="btn" value="doc_edit">list</button>

												<button type="submit" class="btn btn-success btn-sm" name="btn" value="doc_edit">save</button>

												<button type="submit" class="btn btn-danger btn-sm" name="btn" value="doc_delete">delete</button>
											</div>
										</td>
										<form action="" method="post" id="doc_id">
											<input type="hidden" name="date" value="<?php echo $d->date; ?>">
										</form>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<div id="section4" class="container" style="padding-bottom: 150px;" width="900" height="1000px">
						<h1 style="padding-top: 150px;">section4</h1>
						<div class="container">
							<div class="row">
								<div class="col-sm-6"></div>
								<div class="col-sm-6" style="text-align: right;">
									<form action="" method="post">
										<div class="input-group">
											<input type="date" name="date_1" class="form-control" value="<?php echo $date_1; ?>">
											<div class="input-group-prepend">
												<span class="input-group-text" id="">to</span>
											</div>
											<input type="date" name="date_2" class="form-control" value="<?php echo $date_2; ?>">
										</div>
										<button type="submit">set</button>
									</form>
								</div>
							</div>
							<div class="row ">
								<div class="table-responsive">
									<?php //print_r($petty); 
									?>
									<table>
										<thead>
											<tr>
												<th>#</th>
												<th>PettyCashID</th>
												<th>PettyCashCode</th>
												<th>PettyCashName</th>
												<th>PettyCashNameEng</th>
												<th>DocuNo</th>
												<th>ReceFlag</th>
												<th>PCPayID</th>
												<th>PCReceID</th>
												<th>Remark</th>
												<th>BrchID</th>
												<th>DocuDate</th>
												<th>ReceAmnt</th>
												<th>NetAmnt</th>
												<th>Remark1</th>
												<th>ResultAmnt</th>
												<th>DocuType</th>
												<th>TotaPay_cf</th>
											</tr>
											<!-- <tr>
												<th style="width: 10%;">Date</th>
												<th style="width: 50%;">Description</th>
												<th style="width: 10%;">Doc. Ref.</th>
												<th style="width: 7%;">Receipt</th>
												<th style="width: 7%;">Payment</th>
												<th style="width: 7%;">Balance</th>
												<th style="width: 20%;">REMARK</th>
											</tr> -->
										</thead>
										<tbody>
											<?php
											if (!empty($petty)) {
												$i = 1;
												$balance = 0; ?>
												<?php foreach ($petty as $x) {
												?>

													<tr>
														<th><?php echo $i; ?></th>
														<th><?php echo $x->PettyCashID; ?></th>
														<th><?php echo $x->PettyCashCode; ?></th>
														<th><?php echo $x->PettyCashName; ?></th>
														<th><?php echo $x->PettyCashNameEng; ?></th>
														<th><?php echo $x->DocuNo; ?></th>
														<th><?php echo $x->ReceFlag; ?></th>
														<th><?php echo $x->PCPayID; ?></th>
														<th><?php echo $x->PCReceID; ?></th>
														<th><?php echo $x->Remark; ?></th>
														<th><?php echo $x->BrchID; ?></th>
														<th><?php if ($x->DocuDate != '') {
																echo date('d/m/Y', strtotime($x->DocuDate));
															} ?></th>
														<th><?php echo $x->ReceAmnt; ?></th>
														<th><?php echo $x->NetAmnt; ?></th>
														<th><?php echo $x->Remark1; ?></th>
														<th><?php echo $x->ResultAmnt; ?></th>
														<th><?php echo $x->DocuType; ?></th>
														<th><?php echo $x->TotaPay_cf; ?></th>
													</tr>
												<?php $i++;
												} ?>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div id="section5" class="container" style="padding-bottom: 150px;" width="900" height="1000px">
						<h1 style="padding-top: 150px;">section5</h1>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>[PettyCashCode]</th>
									<th>[PettyCashID]</th>
									<th>[BrchID]</th>
									<th>[Remark]</th>
									<th>[PettyCashName]</th>
									<th>[PettyCashNameEng]</th>
									<th>[BeginAmnt]</th>
									<th>[AccID]</th>
								</tr>
								<?php foreach ($EMPettyCash as $x) { ?>
									<tr>
										<th><?php echo $x->PettyCashCode; ?></th>
										<th><?php echo $x->PettyCashID; ?></th>
										<th><?php echo $x->BrchID; ?></th>
										<th><?php echo $x->Remark; ?></th>
										<th><?php echo $x->PettyCashName; ?></th>
										<th><?php echo $x->PettyCashNameEng; ?></th>
										<th><?php echo $x->BeginAmnt; ?></th>
										<th><?php echo $x->AccID; ?></th>
									</tr>
								<?php } ?>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>[PCReceID]</th>
									<th>[ReceNo]</th>
									<th>[ReceDate]</th>
									<th>[Remark1]</th>
									<th>[Remark2]</th>
									<th>[ReceAmnt]</th>
									<th>[ReceFlag]</th>
									<th>[PettyCashID]</th>
									<th>[BrchID]</th>
									<th>[BeginAmnt]</th>
									<th>[PostID]</th>
									<th>[PostGL]</th>
								</tr>
								<?php foreach ($PCRece as $x) { ?>
									<tr>
										<th><?php echo $x->PCReceID; ?></th>
										<th><?php echo $x->ReceNo; ?></th>
										<th><?php echo $x->ReceDate; ?></th>
										<th><?php echo $x->Remark1; ?></th>
										<th><?php echo $x->Remark2; ?></th>
										<th><?php echo $x->ReceAmnt; ?></th>
										<th><?php echo $x->ReceFlag; ?></th>
										<th><?php echo $x->PettyCashID; ?></th>
										<th><?php echo $x->BrchID; ?></th>
										<th><?php echo $x->BeginAmnt; ?></th>
										<th><?php echo $x->PostID; ?></th>
										<th><?php echo $x->PostGL; ?></th>
									</tr>
								<?php } ?>
							</table>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>[PCPayID]</th>
									<th>[DocuNo]</th>
									<th>[DocuDate]</th>
									<th>[BrchID]</th>
									<th>[Remark1]</th>
									<th>[Remark2]</th>
									<th>[TotaPayAmnt]</th>
									<th>[PostGL]</th>
									<th>[PettyCashID]</th>
									<th>[BeginAmnt]</th>
									<th>[PostID]</th>
									<th>[VATGroupID]</th>
									<th>[VATRate]</th>
									<th>[VATType]</th>
									<th>[VATAmnt]</th>
									<th>[taxpayamnt]</th>
									<th>[TotaBaseAmnt]</th>
									<th>[NetAmnt]</th>
									<th>[EmpID]</th>
									<th>[approveno]</th>
									<th>[RefMMPayNo]</th>
									<th>[RefMMPayID]</th>
									<th>[SumPayInAmnt]</th>
								</tr>
								<?php foreach ($PCPayHD as $x) { ?>
									<tr>
										<th><?php echo $x->PCPayID; ?></th>
										<th><?php echo $x->DocuNo; ?></th>
										<th><?php echo $x->DocuDate; ?></th>
										<th><?php echo $x->BrchID; ?></th>
										<th><?php echo $x->Remark1; ?></th>
										<th><?php echo $x->Remark2; ?></th>
										<th><?php echo $x->TotaPayAmnt; ?></th>
										<th><?php echo $x->PostGL; ?></th>
										<th><?php echo $x->PettyCashID; ?></th>
										<th><?php echo $x->BeginAmnt; ?></th>
										<th><?php echo $x->PostID; ?></th>
										<th><?php echo $x->VATGroupID; ?></th>
										<th><?php echo $x->VATRate; ?></th>
										<th><?php echo $x->VATType; ?></th>
										<th><?php echo $x->VATAmnt; ?></th>
										<th><?php echo $x->taxpayamnt; ?></th>
										<th><?php echo $x->TotaBaseAmnt; ?></th>
										<th><?php echo $x->NetAmnt; ?></th>
										<th><?php echo $x->EmpID; ?></th>
										<th><?php echo $x->approveno; ?></th>
										<th><?php echo $x->RefMMPayNo; ?></th>
										<th><?php echo $x->RefMMPayID; ?></th>
										<th><?php echo $x->SumPayInAmnt; ?></th>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
					<div id="section6" class="container e" style="padding-bottom: 150px;background-color: orange;color: white;" width="900" height="1000px">
						<h1 style="padding-top: 150px;">section6</h1>
					</div>
				</section>
			</main>
		</div>
	</div>
	<?php //echo json_encode($x,JSON_NUMERIC_CHECK); 
	?>
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
		var ctx = document.getElementById("myChart");
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($x, JSON_NUMERIC_CHECK); ?>,
				datasets: [{
					data: <?php echo json_encode($TotaPayAmnt, JSON_NUMERIC_CHECK); ?>,
					lineTension: 0,
					backgroundColor: 'transparent',
					borderColor: '#007bff',
					borderWidth: 4,
					pointBackgroundColor: '#007bff'
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: false
						}
					}]
				},
				legend: {
					display: false,
				}
			}
		});
	</script>
	<script>
		$(document).ready(function() {
			$("#user").DataTable();
		});

		function test() {
			alert('test on load');
		}

		function Toggle_e(x) {
			var temp = document.getElementById("e_password" + x);
			if (temp.type === "password") {
				temp.type = "text";
			} else {
				temp.type = "password";
			}

		}

		function Toggle() {
			var temp = document.getElementById("n_password");
			if (temp.type === "password") {
				temp.type = "text";
			} else {
				temp.type = "password";
			}
			var temp2 = document.getElementById("n_con_password");
			if (temp2.type === "password") {
				temp2.type = "text";
			} else {
				temp2.type = "password";
			}
		}
		let sidebar = document.querySelector(".sidebar");
		let closeBtn = document.querySelector("#btn");
		let searchBtn = document.querySelector(".bx-search");

		closeBtn.addEventListener("click", () => {
			sidebar.classList.toggle("open");
			menuBtnChange(); //calling the function(optional)
		});

		searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
			sidebar.classList.toggle("open");
			menuBtnChange(); //calling the function(optional)
		});

		// following are the code to change sidebar button(optional)
		function menuBtnChange() {
			if (sidebar.classList.contains("open")) {
				closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
			} else {
				closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
			}
		}
	</script>
</body>

</html>

<!-- <table class="table table-bordered table-sm h6">
	<tr>
		<th>No.</th> -->
<!-- <th>PCPayID</th> -->
<!-- <th>DocuDate</th> -->
<!-- <th>BrchID</th> -->
<!-- <th>Remark1</th>
		<th>DocuNo</th> -->
<!-- <th>Remark2</th> -->
<!-- <th></th> -->
<!-- <th>TotaPayAmnt</th> -->
<!-- <th>PostGL</th> -->
<!-- <th>PettyCashID</th> -->
<!-- <th>BeginAmnt</th> -->
<!-- <th>PostID</th> -->
<!-- <th>VATGroupID</th> -->
<!-- <th>VATType</th> -->
<!-- <th>VATAmnt</th>
		<th>taxpayamnt</th>
		<th>TotaBaseAmnt</th>
		<th>NetAmnt</th> -->
<!-- <th>EmpID</th> -->
<!-- <th>approveno</th> -->
<!-- <th>RefMMPayNo</th> -->
<!-- <th>RefMMPayID</th> -->
<!-- <th>SumPayInAmnt</th>
	</tr> -->
<?php
// print_r($test);
// $i = 1;
// $TotaPayAmnt = 0;
// $SumPayInAmnt = 0;
// $VATAmnt = 0;
// $taxpayamnt = 0;
// $TotaBaseAmnt = 0;
// $NetAmnt = 0;
// $q = 0;
// foreach ($test as $dc) {
?>
<tr>
	<!-- <td><?php echo $i; ?></td> -->
	<!-- <td><?php //echo $dc->PCPayID; 
				?></td> -->
	<!-- <td><?php echo date('d/m/Y', strtotime($dc->DocuDate)); ?></td> -->
	<!-- <td><?php //echo $dc->BrchID; 
				?></td> -->
	<!-- <td><?php echo $dc->Remark1; ?></td> -->
	<!-- <td><?php //echo $dc->Remark2; 
				?></td> -->
	<!-- <td><?php echo $dc->DocuNo; ?></td>
			<td><?php echo $dc->TotaPayAmnt + $dc->VATAmnt - $dc->taxpayamnt;
				$q += $dc->TotaPayAmnt + $dc->VATAmnt - $dc->taxpayamnt; ?></td>
			<td><?php echo number_format($dc->TotaPayAmnt, 2);
				$TotaPayAmnt += $dc->TotaPayAmnt; ?></td> -->
	<!-- <td><?php //echo $dc->PostGL; 
				?></td> -->
	<!-- <td><?php //echo $dc->PettyCashID; 
				?></td> -->
	<!-- <td><?php echo number_format($dc->BeginAmnt, 2); ?></td> -->
	<!-- <td><?php //echo $dc->PostID; 
				?></td> -->
	<!-- <td><?php //echo $dc->VATGroupID; 
				?></td> -->
	<!-- <td><?php //echo $dc->VATType; 
				?></td> -->
	<!-- <td><?php echo number_format($dc->VATAmnt, 2);
				$VATAmnt += $dc->VATAmnt; ?></td>
			<td><?php echo number_format($dc->taxpayamnt, 2);
				$taxpayamnt += $dc->taxpayamnt; ?></td>
			<td><?php echo number_format($dc->TotaBaseAmnt, 2);
				$TotaBaseAmnt += $dc->TotaBaseAmnt; ?></td>
			<td><?php echo number_format($dc->NetAmnt, 2);
				$NetAmnt += $dc->NetAmnt; ?></td> -->
	<!-- <td><?php //echo $dc->EmpID; 
				?></td> -->
	<!-- <td><?php //echo $dc->approveno; 
				?></td> -->
	<!-- <td><?php //echo $dc->RefMMPayNo; 
				?></td> -->
	<!-- <td><?php //echo $dc->RefMMPayID; 
				?></td> -->
	<!-- <td><?php echo number_format($dc->SumPayInAmnt, 2);
				$SumPayInAmnt += $dc->SumPayInAmnt; ?></td>
		</tr> -->
	<?php
	// $i++;
	// }
	?>
	<!-- <tr>
		<td colspan="4"></td>
		<td><?php echo number_format($TotaPayAmnt, 2); ?></td>
		<td colspan=""><?php echo number_format($q, 2); ?></td>
		<td><?php echo number_format($VATAmnt, 2); ?></td>
		<td><?php echo number_format($taxpayamnt, 2); ?></td>
		<td><?php echo number_format($TotaBaseAmnt, 2); ?></td>
		<td><?php echo number_format($NetAmnt, 2); ?></td> -->
	<!-- <td colspan=""></td> -->
	<!-- <td><?php echo number_format($SumPayInAmnt, 2); ?></td>
	</tr>
</table> -->
