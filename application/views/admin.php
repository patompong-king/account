<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
	<link rel="stylesheet" href="style.css">
	<!-- Boxicons CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>
<style>
	/* Google Font Link */
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
	}

	.sidebar {
		position: fixed;
		left: 0;
		top: 0;
		height: 100%;
		width: 78px;
		background: #11101D;
		padding: 6px 14px;
		z-index: 99;
		transition: all 0.5s ease;
	}

	.sidebar.open {
		width: 250px;
	}

	.sidebar .logo-details {
		height: 60px;
		display: flex;
		align-items: center;
		position: relative;
	}

	.sidebar .logo-details .icon {
		opacity: 0;
		transition: all 0.5s ease;
	}

	.sidebar .logo-details .logo_name {
		color: #fff;
		font-size: 20px;
		font-weight: 600;
		opacity: 0;
		transition: all 0.5s ease;
	}

	.sidebar.open .logo-details .icon,
	.sidebar.open .logo-details .logo_name {
		opacity: 1;
	}

	.sidebar .logo-details #btn {
		position: absolute;
		top: 50%;
		right: 0;
		transform: translateY(-50%);
		font-size: 22px;
		transition: all 0.4s ease;
		font-size: 23px;
		text-align: center;
		cursor: pointer;
		transition: all 0.5s ease;
	}

	.sidebar.open .logo-details #btn {
		text-align: right;
	}

	.sidebar i {
		color: #fff;
		height: 60px;
		min-width: 50px;
		font-size: 28px;
		text-align: center;
		line-height: 60px;
	}

	.sidebar .nav-list {
		margin-top: 20px;
		height: 100%;
	}

	.sidebar li {
		position: relative;
		margin: 8px 0;
		list-style: none;
	}

	.sidebar li .tooltip {
		position: absolute;
		top: -20px;
		left: calc(100% + 15px);
		z-index: 3;
		background: #fff;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
		padding: 6px 12px;
		border-radius: 4px;
		font-size: 15px;
		font-weight: 400;
		opacity: 0;
		white-space: nowrap;
		pointer-events: none;
		transition: 0s;
	}

	.sidebar li:hover .tooltip {
		opacity: 1;
		pointer-events: auto;
		transition: all 0.4s ease;
		top: 50%;
		transform: translateY(-50%);
	}

	.sidebar.open li .tooltip {
		display: none;
	}

	.sidebar input {
		font-size: 15px;
		color: #FFF;
		font-weight: 400;
		outline: none;
		height: 50px;
		width: 100%;
		width: 50px;
		border: none;
		border-radius: 12px;
		transition: all 0.5s ease;
		background: #1d1b31;
	}

	.sidebar.open input {
		padding: 0 20px 0 50px;
		width: 100%;
	}

	.sidebar .bx-search {
		position: absolute;
		top: 50%;
		left: 0;
		transform: translateY(-50%);
		font-size: 22px;
		background: #1d1b31;
		color: #FFF;
	}

	.sidebar.open .bx-search:hover {
		background: #1d1b31;
		color: #FFF;
	}

	.sidebar .bx-search:hover {
		background: #FFF;
		color: #11101d;
	}

	.sidebar li a {
		display: flex;
		height: 100%;
		width: 100%;
		border-radius: 12px;
		align-items: center;
		text-decoration: none;
		transition: all 0.4s ease;
		background: #11101D;
	}

	.sidebar li a:hover {
		background: #FFF;
	}

	.sidebar li a .links_name {
		color: #fff;
		font-size: 15px;
		font-weight: 400;
		white-space: nowrap;
		opacity: 0;
		pointer-events: none;
		transition: 0.4s;
	}

	.sidebar.open li a .links_name {
		opacity: 1;
		pointer-events: auto;
	}

	.sidebar li a:hover .links_name,
	.sidebar li a:hover i {
		transition: all 0.5s ease;
		color: #11101D;
	}

	.sidebar li i {
		height: 50px;
		line-height: 50px;
		font-size: 18px;
		border-radius: 12px;
	}

	.sidebar li.profile {
		position: fixed;
		height: 60px;
		width: 78px;
		left: 0;
		bottom: -8px;
		padding: 10px 14px;
		background: #1d1b31;
		transition: all 0.5s ease;
		overflow: hidden;
	}

	.sidebar.open li.profile {
		width: 250px;
	}

	.sidebar li .profile-details {
		display: flex;
		align-items: center;
		flex-wrap: nowrap;
	}

	.sidebar li img {
		height: 45px;
		width: 45px;
		object-fit: cover;
		border-radius: 6px;
		margin-right: 10px;
	}

	.sidebar li.profile .name,
	.sidebar li.profile .job {
		font-size: 15px;
		font-weight: 400;
		color: #fff;
		white-space: nowrap;
	}

	.sidebar li.profile .job {
		font-size: 12px;
	}

	.sidebar .profile #log_out {
		position: absolute;
		top: 50%;
		right: 0;
		transform: translateY(-50%);
		background: #1d1b31;
		width: 100%;
		height: 60px;
		line-height: 60px;
		border-radius: 0px;
		transition: all 0.5s ease;
	}

	.sidebar.open .profile #log_out {
		width: 50px;
		background: none;
	}

	.home-section {
		position: relative;
		/* background: #E4E9F7; */
		min-height: 100vh;
		top: 0;
		left: 78px;
		width: calc(100% - 78px);
		transition: all 0.5s ease;
		z-index: 2;
	}

	.sidebar.open~.home-section {
		left: 250px;
		width: calc(100% - 250px);
	}

	.home-section .text {
		display: inline-block;
		color: #11101d;
		font-size: 25px;
		font-weight: 500;
		margin: 18px
	}

	@media (max-width: 420px) {
		.sidebar li .tooltip {
			display: none;
		}
	}

	body {
		position: relative;
	}

	#section1 {
		padding-top: 50px;
		padding-bottom: 50px;
		height: auto;
		/* color: #fff; */
		/* background-color: #673ab7; */
	}

	#section2 {
		padding-top: 50px;
		padding-bottom: 50px;
		height: auto;
		/* color: #fff; */
		/* background-color: #673ab7; */
	}

	#section3 {
		padding-top: 50px;
		padding-bottom: 50px;
		height: auto;
		/* color: #fff; */
		/* background-color: #ff9800; */
	}

	#section41 {
		padding-top: 50px;
		padding-bottom: 50px;
		height: auto;
		color: #fff;
		background-color: #00bcd4;
	}

	#section42 {
		padding-top: 50px;
		height: auto;
		color: #fff;
		background-color: #009688;
	}
</style>

<body>
	<div class="sidebar">
		<div class="logo-details">
			<!-- <i class='bx bxl-c-plus-plus icon'></i> -->
			<div class="logo_name">Petty Cash</div>
			<i class='bx bx-menu' id="btn"></i>
		</div>
		<ul class="nav-list">
			<!-- <li>
				<i class='bx bx-search'></i>
				<input type="text" placeholder="Search...">
				<span class="tooltip">Search</span>
			</li> -->
			<!-- <li>
				<a href="#">
					<i class='bx bx-grid-alt'></i>
					<span class="links_name">Dashboard</span>
				</a>
				<span class="tooltip">Dashboard</span>
			</li> -->
			<li>
				<a href="#section1" style="height: 5%;">
					<i class='bx bx-user'></i>
					<span class="links_name">User</span>
				</a>
				<span class="tooltip">User</span>
			</li>
			<!-- <li>
				<a href="#">
					<i class='bx bx-pie-chart-alt-2'></i>
					<span class="links_name">Analytics</span>
				</a>
				<span class="tooltip">Analytics</span>
			</li> -->
			<li>
				<a href="#section3" style="height: 5%;">
					<i class='bx bx-folder'></i>
					<span class="links_name">File Manager</span>
				</a>
				<span class="tooltip">Document</span>
			</li>
			<li>
				<a href="#section4" style="height: 5%;">
					<i class='bx bx-chat'></i>
					<span class="links_name">Messages</span>
				</a>
				<span class="tooltip">Messages</span>
			</li>
			<!-- <li>
				<a href="#">
					<i class='bx bx-cart-alt'></i>
					<span class="links_name">Order</span>
				</a>
				<span class="tooltip">Order</span>
			</li> -->
			<!-- <li>
				<a href="#">
					<i class='bx bx-heart'></i>
					<span class="links_name">Saved</span>
				</a>
				<span class="tooltip">Saved</span>
			</li> -->
			<!-- <li>
				<a href="#">
					<i class='bx bx-cog'></i>
					<span class="links_name">Setting</span>
				</a>
				<span class="tooltip">Setting</span>
			</li> -->
			<li class="profile">
				<div class="profile-details">
					<a href="<?php echo site_url('Acc/'); ?>logout">
						<i class='bx bx-user'></i>
						<div class="name_job">
							<div class="name"><?php echo $_SESSION['name']; ?></div>
							<div class="job"><?php echo $_SESSION['role']; ?></div>
						</div>
				</div>
				<i class='bx bx-log-out' id="log_out"></i>
				</a>
			</li>
		</ul>
	</div>
	<section class="home-section">
		<div id="section1" class="container" style="padding-bottom: 100px;">
			<h1>User</h1>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-sm" id="" style="width: 100%;">
							<thead id="" class="thead-dark">
								<tr>
									<th style="width: 5%;text-align: center;">No.</th>
									<th style="width: 10%;text-align: center;">Emp. Code</th>
									<th style="width: 40%;text-align: center;" colspan="3">Name</th>
									<th style="width: 10%;text-align: center;">Role</th>
									<th style="width: 10%;text-align: center;">Username</th>
									<th style="width: 10%;text-align: center;">Password</th>
									<th style="text-align: center;">Status</th>
									<th></th>
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
											<th><input type="text" name="emp_code" id="emp_code" class="form-control" value="<?php echo $x->emp_code; ?>"></th>
											<th style="width: 15%;"><input type="text" name="name" id="name" class="form-control" value="<?php echo $x->name; ?>"></th>
											<th style="width: 15%;"><input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $x->last_name; ?>"></th>
											<th style="width: 10%;"><input type="text" name="nickname" id="nickname" class="form-control" value="<?php echo $x->nickname; ?>"></th>
											<th><input type="text" name="role" id="role" class="form-control" value="<?php echo $x->role; ?>"></th>
											<th><input type="text" name="username" id="username" class="form-control" value="<?php echo $x->username; ?>"></th>
											<th><input type="password" name="password" id="password" class="form-control" value="<?php echo $x->password; ?>"></th>
											<th><?php echo $x->status; ?></th>
											<td>
												<button type="submit" class="btn btn-success" name="btn" value="edit">save</button>
											</td>
											<td>
												<button type="submit" class="btn btn-danger" name="btn" value="delete">delete</button>
											</td>
										</form>
									</tr>
								<?php $i++;
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<form action="" method="post">
				<div class="row">
					<div class="col-sm-12">
						<b>
							<h1>New User</h1>
						</b>
						<div class="row">
							<div class="col-sm-2">
								<label for="">Emp. Code</label>
								<input type="text" name="n_emp_code" id="n_emp_code" class="form-control" value="" />
							</div>
							<div class="col-sm-4">
								<label for="">First Name</label>
								<input type="hidden" name="id" value="<?php echo $x->id; ?>">
								<input type="text" name="n_first_name" id="n_first_name" class="form-control" value="" />
							</div>
							<div class="col-sm-4">
								<label for="">Last Name</label>
								<input type="text" name="n_last_name" id="n_last_name" class="form-control" value="" />
							</div>
							<div class="col-sm-2">
								<label for="">Nickname</label>
								<input type="text" name="n_nickname" id="n_nickname" class="form-control" value="" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3">
								<label for="">Role</label>
								<select name="" id="" class="form-control" >
									<option value=""></option>
									<option value="President" >President</option>
									<option value="GM" >GM</option>
									<option value="Manager" >Manager</option>
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
		<div id="section3" class="container">
			<h1>Document</h1>
			<div class="table-responsive">
				<table class="table table-bordered table-sm" id="doc" name='doc'>
					<tr>
						<th>ID</th>
						<th style="width: 25%;text-align: center;">Document Name</th>
						<th>Document Date</th>
						<th>Create Date</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<?php foreach ($doc as $d) { ?>
						<tr>
							<th><?php echo $d->id; ?></th>
							<td><input class="form-control" id="d_name" name="d_name" placeholder="Role" type="text" value="<?php echo $d->name; ?>"></td>
							<td><?php echo $d->date; ?></th>
							<td><?php echo $d->create_date; ?></td>
							<td>
								<form action="" method="post">
									<input type="hidden" name="date" value="<?php echo $d->date; ?>">
									<button type="submit" class="btn btn-default" style="background-color: #00bcd4;" name="btn" value="doc_edit">list</button>
								</form>
							</td>
							<td>
								<button type="submit" class="btn btn-success" name="btn" value="doc_edit">save</button>
							</td>
							<td>
								<button type="submit" class="btn btn-danger" name="btn" value="doc_delete">delete</button>
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<div id="section4" class="container">
			<div class="table-responsive">
				<table class="table table-bordered table-sm h6">
					<tr>
						<th>No.</th>
						<!-- <th>PCPayID</th> -->
						<th>DocuDate</th>
						<!-- <th>BrchID</th> -->
						<th>Remark1</th>
						<th>DocuNo</th>
						<!-- <th>Remark2</th> -->
						<th>TotaPayAmnt</th>
						<!-- <th>PostGL</th> -->
						<!-- <th>PettyCashID</th> -->
						<th>BeginAmnt</th>
						<!-- <th>PostID</th> -->
						<!-- <th>VATGroupID</th> -->
						<!-- <th>VATType</th> -->
						<th>VATAmnt</th>
						<th>taxpayamnt</th>
						<th>TotaBaseAmnt</th>
						<th>NetAmnt</th>
						<!-- <th>EmpID</th> -->
						<!-- <th>approveno</th> -->
						<!-- <th>RefMMPayNo</th> -->
						<!-- <th>RefMMPayID</th> -->
						<th>SumPayInAmnt</th>
					</tr>
					<?php
					// print_r($test);
					$i = 1;
					$TotaPayAmnt = 0;
					$SumPayInAmnt = 0;
					$VATAmnt = 0;
					$taxpayamnt = 0;
					$TotaBaseAmnt = 0;
					$NetAmnt = 0;
					foreach ($test as $dc) {
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<!-- <td><?php //echo $dc->PCPayID; 
										?></td> -->
							<td><?php echo date('d/m/Y', strtotime($dc->DocuDate)); ?></td>
							<!-- <td><?php //echo $dc->BrchID; 
										?></td> -->
							<td><?php echo $dc->Remark1; ?></td>
							<!-- <td><?php //echo $dc->Remark2; 
										?></td> -->
							<td><?php echo $dc->DocuNo; ?></td>
							<td><?php echo number_format($dc->TotaPayAmnt, 2);
								$TotaPayAmnt += $dc->TotaPayAmnt; ?></td>
							<!-- <td><?php //echo $dc->PostGL; 
										?></td> -->
							<!-- <td><?php //echo $dc->PettyCashID; 
										?></td> -->
							<td><?php echo number_format($dc->BeginAmnt, 2); ?></td>
							<!-- <td><?php //echo $dc->PostID; 
										?></td> -->
							<!-- <td><?php //echo $dc->VATGroupID; 
										?></td> -->
							<!-- <td><?php //echo $dc->VATType; 
										?></td> -->
							<td><?php echo number_format($dc->VATAmnt, 2);
								$VATAmnt += $dc->VATAmnt; ?></td>
							<td><?php echo number_format($dc->taxpayamnt, 2);
								$taxpayamnt += $dc->taxpayamnt; ?></td>
							<td><?php echo number_format($dc->TotaBaseAmnt, 2);
								$TotaBaseAmnt += $dc->TotaBaseAmnt; ?></td>
							<td><?php echo number_format($dc->NetAmnt, 2);
								$NetAmnt += $dc->NetAmnt; ?></td>
							<!-- <td><?php //echo $dc->EmpID; 
										?></td> -->
							<!-- <td><?php //echo $dc->approveno; 
										?></td> -->
							<!-- <td><?php //echo $dc->RefMMPayNo; 
										?></td> -->
							<!-- <td><?php //echo $dc->RefMMPayID; 
										?></td> -->
							<td><?php echo number_format($dc->SumPayInAmnt, 2);
								$SumPayInAmnt += $dc->SumPayInAmnt; ?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					<tr>
						<td colspan="4"></td>
						<td><?php echo number_format($TotaPayAmnt, 2); ?></td>
						<td colspan=""></td>
						<td><?php echo number_format($VATAmnt, 2); ?></td>
						<td><?php echo number_format($taxpayamnt, 2); ?></td>
						<td><?php echo number_format($TotaBaseAmnt, 2); ?></td>
						<td><?php echo number_format($NetAmnt, 2); ?></td>
						<!-- <td colspan=""></td> -->
						<td><?php echo number_format($SumPayInAmnt, 2); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function() {
			$("#user").DataTable();
		});

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
