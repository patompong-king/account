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
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>Main"><b>HOME</b></a>
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>user"><b><?php echo $_SESSION['name']; ?></b></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>logout"><span class="glyphicon glyphicon-log-in"></span> <b>Sign out</b></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="http://172.28.1.23/it/Attach_input.php" target="_blank">
						<span class="glyphicon glyphicon-cog"></span> <b>แจ้งปัญหา</b>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container">
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
		<?php $date = $year . '-' . date('m', strtotime($date)); ?>
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-5">
				<form action="<?php echo site_url('Acc/Main'); ?>" method="post">
					<div class="input-group">
						<input type="month" class="form-control" name="date" value="<?php echo date('Y-m', strtotime($date)); ?>">
						<!-- <input type="date" class="form-control"  value=""> -->
						<div class="input-group-btn">
							<button class="btn btn-default" style="background-color: #D1B780;color: #464239;" type="submit" name="btn" value="create"><b>CREATE</b></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-1">
			</div>
			<div class="col-sm-2">
				<form action="" method="post" id="year">
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #D1B780;color: #464239;"><b>Year<b></span>
						<select name="year" id="year_in" class="form-control">
							<?php
							$y = date('Y');
							for ($i = 0; $i <= 10; $i++) {

							?>
								<option value="<?php echo $y; ?>" <?php if ($year == $y) {
																		echo 'selected';
																	} ?>><?php echo $y; ?></option>
							<?php $y -= 1;
							}
							?>
						</select>
					</div>
				</form>
			</div>
		</div>
		<br>
		<div class="row">

			<div class="col-sm-12" id="docs">
				<table class="table table-bordered" id="doc" name='doc'>
					<thead>
						<tr style="background-color: #D1B780;color: #464239;">
							<th style="width: 5%;text-align: center;">No.</th>
							<th style="text-align: center;">Month</th>
							<th style="width: 7%;text-align: center;">Balance</th>
							<th style="width: 7%;text-align: center;">Week 1</th>
							<th style="width: 7%;text-align: center;">Week 2</th>
							<th style="width: 7%;text-align: center;">Week 3</th>
							<th style="width: 7%;text-align: center;">Week 4</th>
							<th style="width: 7%;text-align: center;">Week 5</th>
							<th style="width: 5%;text-align: center;">Edit</th>
							<th style="width: 5%;text-align: center;">Log</th>
							<th style="width: 12%;"></th>
							<th style="width: 5%;"></th>
						</tr>
					</thead>
					<tbody id="doc">
						<?php $i = 1;
						$q = 0;
						foreach ($doc as $x) {
							$dis[$q] = ''; ?>
							<tr style="background-color: #F4EBD0;color: #464239;">
								<form action="<?php echo site_url('Acc/'); ?>Details" method="post" id="ent_<?php echo $i; ?>">
									<th>
										<center><?php echo $i; ?></center>
									</th>
									<td><?php echo $x->name; ?>
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-t', strtotime($x->name)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
									</td>
								</form>
								<?php
								$qty_1 = $x->qty_1*1000;
								$qty_2 = $x->qty_2*500;
								$qty_3 = $x->qty_3*100;
								$qty_4 = $x->qty_4*50;
								$qty_5 = $x->qty_5*20;
								$qty_6 = $x->qty_6*10;
								$qty_7 = $x->qty_7*5;
								$qty_8 = $x->qty_8*2;
								$qty_9 = $x->qty_9*1;
								$qty_10 = $x->qty_10*0.5;
								$qty = $qty_1+$qty_2+$qty_3+$qty_4+$qty_5+$qty_6+$qty_7+$qty_8+$qty_9+$qty_10;
								?>
								<td><?php echo number_format($qty, 2); ?></td>
								<th style="font-size: 12px;text-align: center;">
									<?php
									$ver1 = '';
									$des = '';
									$y = 'id_' . $x->id;
									$date1 = '';
									if (!empty($status_p[$y][0])) {
										foreach ($status_p[$y][0] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver1 = $s->Verified;
												$date1 = $s->date;
											}
										}
									}
									?>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status_m[$y][0])) {
										foreach ($status_m[$y][0] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver1 = $s->Verified;
												if ($date1 != '' && $date1 < $s->date) {
													$date1 = $s->date;
												} else {
													$date1 = $s->date;
												}
											}
										}
									}
									?>
									<form action="<?php echo site_url('Acc/'); ?>pdf" method="post" target="_blank">
										<?php if ($ver1 != '') { ?><button type="submit" class="btn btn-sm btn-primary"><?php echo $ver1; ?></button><?php } ?>
										<input type="hidden" name="week" value="1">
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-t', strtotime($x->name)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
								</th>
								<th style="font-size: 12px;text-align: center;">
									<?php
									$y = 'id_' . $x->id;
									$ver2 = '';
									$date2 = '';
									if (!empty($status_p[$y][1])) {
										foreach ($status_p[$y][1] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver2 = $s->Verified;
												$date2 = $s->date;
											}
										}
									}
									?>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status_m[$y][1])) {
										foreach ($status_m[$y][1] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver2 = $s->Verified;
												if ($date2 != '' && $date2 < $s->date) {
													$date2 = $s->date;
												} else {
													$date2 = $s->date;
												}
											}
										}
									}
									?>
									<form action="<?php echo site_url('Acc/'); ?>pdf" method="post" target="_blank">
										<?php if ($ver2 != '') { ?><button type="submit" class="btn btn-sm btn-primary"><?php echo $ver2; ?></button><?php } ?>
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="week" value="2">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-d', strtotime($date2)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
									</form>
								</th>
								<th style="font-size: 12px;text-align: center;">
									<?php
									$y = 'id_' . $x->id;
									$ver3 = '';
									$date3 = '';
									if (!empty($status_p[$y][2])) {
										foreach ($status_p[$y][2] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver3 = $s->Verified;
												$date3 = $s->date;
											}
										}
									}
									?>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status_m[$y][2])) {
										foreach ($status_m[$y][2] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver3 = $s->Verified;
												if ($date3 != '' && $date3 < $s->date) {
													$date3 = $s->date;
												} else {
													$date3 = $s->date;
												}
											}
										}
									}
									?>
									<form action="<?php echo site_url('Acc/'); ?>pdf" method="post" target="_blank">
										<?php if ($ver3 != '') { ?><button type="submit" class="btn btn-sm btn-primary"><?php echo $ver3; ?></button><?php } ?>
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="week" value="3">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-d', strtotime($date3)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
									</form>
								</th>
								<th style="font-size: 12px;text-align: center;">
									<?php
									$y = 'id_' . $x->id;
									$ver4 = '';
									$date4 = '';
									if (!empty($status_p[$y][3])) {
										foreach ($status_p[$y][3] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver4 = $s->Verified;
												$date4 = $s->date;
											}
										}
									}
									?>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status_m[$y][3])) {
										foreach ($status_m[$y][3] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver4 = $s->Verified;
												if ($date4 != '' && $date4 < $s->date) {
													$date4 = $s->date;
												} else {
													$date4 = $s->date;
												}
											}
										}
									}
									?>
									<form action="<?php echo site_url('Acc/'); ?>pdf" method="post" target="_blank">
										<?php if ($ver4 != '') { ?><button type="submit" class="btn btn-sm btn-primary"><?php echo $ver4; ?></button><?php } ?>
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="week" value="4">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-d', strtotime($date4)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
									</form>
								</th>
								<th style="font-size: 12px;text-align: center;">
									<?php
									$y = 'id_' . $x->id;
									$ver5 = '';
									$date5 = '';
									if (!empty($status_p[$y][4])) {
										foreach ($status_p[$y][4] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver5 = $s->Verified;
												$date5 = $s->date;
											}
										}
									}
									?>
									<?php
									$y = 'id_' . $x->id;
									if (!empty($status_m[$y][4])) {
										foreach ($status_m[$y][4] as $s) {
											// echo '<b data-toggle="tooltip" data-placement="right" title="'.date('d/m/Y H:i:s',strtotime($s->date)).'">'.$s->Verified.'</b>';
											if ($s->Verified != '') {
												$dis[$q] = $s->Verified;
												$ver5 = $s->Verified;
												if ($date5 != '' && $date5 < $s->date) {
													$date5 = $s->date;
												} else {
													$date5 = $s->date;
												}
											}
										}
									}
									?>
									<form action="<?php echo site_url('Acc/'); ?>pdf" method="post" target="_blank">
										<?php if ($ver5 != '') { ?><button type="submit" class="btn btn-sm btn-primary"><?php echo $ver5; ?></button><?php } ?>
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<input type="hidden" name="week" value="5">
										<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
										<input type="hidden" name="date_2" value="<?php echo date('Y-m-d', strtotime($date5)); ?>">
										<input type="hidden" name="name" value="<?php echo $x->name; ?>">
									</form>
								</th>
								<td>
									<button class="btn btn-default" style="background-color: #D1B780;color: #464239;" type="submit" onclick="enter('ent_<?php echo $i; ?>')"><b>ENTER</b></button>
								</td>
								<td>
									<form action="<?php echo site_url('Acc/'); ?>Log" method="post">
										<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
										<button class="btn btn-default" style="background-color: #D1B780;color: #464239;" type="submit"><b>Click!</b></button>
									</form>
								</td>
								<form action="<?php echo site_url('Acc/'); ?>Main" method="post" id="del_<?php echo $i; ?>">
									<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
									<input type="hidden" name="name" id="name_<?php echo $i; ?>" value="<?php echo $x->name; ?>">
									<input type="hidden" name="btn" value="del">
								</form>
								<form target="_blank" action="<?php echo site_url('Acc/'); ?>Document" method="post" id="excel_<?php echo $i; ?>">
									<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
									<input type="hidden" name="name" id="name_<?php echo $i; ?>" value="<?php echo $x->name; ?>">
									<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
									<input type="hidden" name="date_2" value="<?php echo date('Y-m-t', strtotime($x->name)); ?>">
								</form>
								<form target="_blank" action="<?php echo site_url('Acc/'); ?>pdf" method="post" id="pdf_<?php echo $i; ?>">
									<input type="hidden" name="doc_id" value="<?php echo $x->id; ?>">
									<input type="hidden" name="name" id="name_<?php echo $i; ?>" value="<?php echo $x->name; ?>">
									<input type="hidden" name="date_1" value="<?php echo date('Y-m-d', strtotime($x->name)); ?>">
									<input type="hidden" name="date_2" value="<?php echo date('Y-m-t', strtotime($x->name)); ?>">
								</form>
								<td>
									<div class="btn-group" role="group" aria-label="Basic example">
										<button class="btn btn-secondary" style="background-color: #D1B780;color: #464239;" type="submit" onclick="doc('excel_<?php echo $i; ?>')"><b>excel</b></button>
										<button class="btn btn-secondary" style="background-color: #D1B780;color: #464239;" type="submit" onclick="doc('pdf_<?php echo $i; ?>')"><b>pdf</b></button>
									</div>
								</td>
								<th>
									<button <?php if ($dis[$q] != '') {
												echo 'disabled';
											} ?> class="btn btn-default" style="background-color: #D1B780;color: #464239;" type="submit" name="btn" value="del" onclick="del('del_<?php echo $i; ?>','<?php echo $x->name; ?>')"><b>DELETE</b></button>
								</th>
							</tr>
						<?php $i++;
							$q;
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

	$('#year').change(function() {
		$("#year").submit();
		// alert('Year');
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

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>

</html>
