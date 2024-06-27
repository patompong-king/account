<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Details of Petty Cash (Cash advance) Doc.</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</head>

<body>
	<nav class="navbar navbar-default" style="background-color: #D1B780;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>DocumentList"><b>HOME</b></a>
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>user"><b><?php echo $_SESSION['name']; ?></b></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>logout"><span class="glyphicon glyphicon-log-in"></span> <b>Sign out</b></a></li>
			</ul>
		</div>
	</nav>
	<?php
	// print_r($status['id_5'][0]);
	?>
	<div class="container" style="margin-top:50px">
		<div class="row">
			<div class="col-sm-12">
				<h1>
					<center><b>UNIVANCE (Thailand) Co.,Ltd</b></center>
				</h1>
				<h1>
					<center><b>Details of Petty Cash (Cash advance)</b></center>
				</h1>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-5"></div>
			<div class="col-sm-2">
				<form action="" method="post" id="year">
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #D1B780;color: #464239;"><b>Year<b></span>
						<select name="year" id="year_in" class="form-control">
							<?php
							$y = date('Y');
							for ($i = 0; $i <= 10; $i++) {

							?>
								<option value="<?php echo $y; ?>" <?php if($year == $y){ echo 'selected'; } ?> ><?php echo $y; ?></option>
							<?php $y -= 1;
							}
							?>
						</select>
					</div>
				</form>
			</div>
			<div class="col-sm-5"></div>
		</div>
		<div class="row">

			<div class="col-sm-12" id="docs">
				<table class="table table-bordered" id="doc" name='doc'>
					<thead>
						<tr style="background-color: #D1B780;color: #464239;">
							<th style="width: 7%;text-align: center;">No.</th>
							<th style="text-align: center;">Name</th>
							<!-- <th style="width: 7%;">Status</th> -->
							<!-- <th style="width: 15%;text-align: center;">Document Log</th> -->
							<th style="width: 7%;">Week 1</th>
							<th style="width: 7%;">Week 2</th>
							<th style="width: 7%;">Week 3</th>
							<th style="width: 7%;">Week 4</th>
							<th style="width: 7%;">Week 5</th>
							<th style="width: 7%;"></th>
						</tr>
					</thead>
					<tbody id="doc">
						<?php $i = 1;
						foreach ($doc as $x) { ?>
							<tr style="background-color: #FFFDD0;">
								<th>
									<center><?php echo $i; ?></center><input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
								</th>
								<td><?php echo $x->name; ?><input type="hidden" name="doc_name" value="<?php echo $x->name; ?>"></td>
								<!-- <td <?php if ($x->president == 'Verified' || $x->manager == 'Verified') { ?> style="color: #00B71E;" <?php } else { ?> style="color: #F20000;" <?php } ?>>
									<?php if ($_SESSION['role'] == 'president') {  ?>
										<?php echo $x->president; ?>
									<?php } ?>
									<?php if ($_SESSION['role'] == 'manager') {  ?>
										<?php echo $x->manager; ?>
									<?php } ?>
								</td> -->
								<!-- <td style="text-align: center;">
									<form action="<?php echo site_url('Acc/'); ?>doc_log_status" method="post">
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<button class="btn btn-default" style="width: 100%;background-color: #D1B780;color: #464239;" type="submit"><b>Click!</b></button>
									</form>
								</td> -->
								<td>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status[$y][0])) {
										foreach ($status[$y][0] as $s) {
											echo $s->Verified;
										}
									}
									?>
								</td>
								<td>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status[$y][1])) {
										foreach ($status[$y][1] as $s) {
											echo $s->Verified;
										}
									}
									?>
								</td>
								<td>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status[$y][2])) {
										foreach ($status[$y][2] as $s) {
											echo $s->Verified;
										}
									}
									?>
								</td>
								<td>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status[$y][3])) {
										foreach ($status[$y][3] as $s) {
											echo $s->Verified;
										}
									}
									?>
								</td>
								<td>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status[$y][4])) {
										foreach ($status[$y][4] as $s) {
											echo $s->Verified;
										}
									}
									?>
								</td>
								<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
								<input type="hidden" name="doc_name" id="name_<?php echo $i; ?>" value="<?php echo $x->name; ?>">
								<input type="hidden" name="btn" value="del">

								<form action="<?php echo site_url('Acc/'); ?>DocumentCheck" method="post" id="excel_<?php echo $i; ?>">
									<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
									<input type="hidden" name="doc_name" id="name_<?php echo $i; ?>" value="<?php echo $x->name; ?>">
									<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
									<input type="hidden" name="date_2" value="<?php echo date('Y-m-t', strtotime($x->name)); ?>">
								</form>

								<td>
									<div class="btn-group">
										<button class="btn btn-default" style="background-color: #D1B780;color: #464239;" type="submit" onclick="doc('excel_<?php echo $i; ?>')"><b>Document</b></button>
									</div>
								</td>
							</tr>
						<?php $i++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br>
	<footer class="container-fluid text-center" style="background-color: #D1B780;color: #464239;padding-top: 10px;text-align: right;">
		<p style="font-size: 10px;">Last Login: <?php echo $_SESSION['last_login']; ?></p>
	</footer>
</body>
<script>
	$(document).ready(function() {
		$("#doc").DataTable();
	});


	function doc(id) {
		document.getElementById(id).submit();
	}

	$('#year').change(function() {
			$("#year").submit();
		// alert('Year');
	});
</script>

</html>
