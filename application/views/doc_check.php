<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Petty Cash Doc.</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>

<body>
	<nav class="navbar navbar-default" style="background-color: #D1B780;color: #464239;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>DocumentList"><b>HOME</b></a>
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>user"><b><?php echo $_SESSION['name']; ?></b></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>DocumentList"><span class="glyphicon glyphicon-log-in"></span> <b>EXIT</b></a></li>
			</ul>
		</div>
	</nav>
	<a id="dlink" style="display:none;"></a>
	<div style="text-align: right;">
		<!-- <button type="submit" class="btn btn-success" onclick="tableToExcel('doc', '<?php echo date('F y', strtotime($doc_name)); ?>', 'Details of Petty Cash (Cash advance) In <?php echo date('F y', strtotime($doc_name)); ?>')">Export to Excel</button> -->
	</div>
	<div class="container-fluid" id="doc">
		<div class="row">
			<div class="col-sm-12">
				<table class="table">
					<tr>
						<td colspan="11">
							<h1>
								<center><b>UNIVANCE (Thailand) Co.,Ltd</b></center>
							</h1>
						</td>
					</tr>
					<tr>
						<td colspan="11">
							<h1>
								<center><b>Details of Petty Cash (Cash advance)</b></center>
							</h1>
						</td>
					</tr>
					<tr>
						<td colspan="11">
							<h1>
								<?php foreach ($doc as $x) { ?>
									<center><b>In <?php echo date('F y', strtotime($x->name)); ?></b></center>
								
								<?php } ?>

							</h1>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
			<table class="table table-bordered">
					<thead>
						<tr>
							<th style="width: 10%;">Date</th>
							<th style="width: 50%;">Description</th>
							<th style="width: 10%;">Doc. Ref.</th>
							<th style="width: 7%;">Receipt</th>
							<th style="width: 7%;">Payment</th>
							<th style="width: 7%;">Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($petty)) {
							$i = 1;
							$w_balance = 0; ?>
							<?php foreach ($petty as $x) {
							?>
								<tr>
									<td><?php if ($x->DocuDate != '') {
											echo date('d/m/Y', strtotime($x->DocuDate));
										} ?>
									</td>
									<td><?php if ($x->Remark != '') {
											echo $x->Remark;
										}
										if ($x->Remark1 != '') {
											echo $x->Remark1;
										} ?>
									</td>
									<td><?php echo $x->DocuNo; ?></td>
									<td id="Receipt">
										<?php
										if ($x->ResultAmnt != 0) {
											$w_balance += $x->ResultAmnt;
											echo number_format($x->ResultAmnt, 2);
										} else {
											if ($x->ReceAmnt > 0) {
												$w_balance += $x->ReceAmnt;
												echo number_format($x->ReceAmnt, 2);
											}
										} ?>
									</td>
									<td id="Payment">
										<?php
										$w_balance = $w_balance - $x->NetAmnt;
										if ($x->NetAmnt > 0) {
											echo number_format($x->NetAmnt, 2);
										}  ?>
									</td>
									<td id="w_balance"><?php echo number_format($w_balance, 2);
														$wins_balance = $w_balance; ?></td>

								</tr>
							<?php $i++; $balance = $wins_balance;
							} ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php if (!empty($cash_in_hand)) { ?>
					<table class="table table-bordered">
						<tr>
							<th colspan="6">Cash in hand</th>
						</tr>
						<tr>
							<th style="width: 20%;" colspan="2">List</th>
							<th style="width: 20%;">Total</th>
							<th style="width: 20%;">QTY.</th>
							<th style="width: 20%;">Amount (Baht)</th>
							<th style="width: 20%;">Sum Amount (Baht)</th>
						</tr>
						<?php $balance_cash = 0;
						foreach ($cash_in_hand as $x) { ?>
							<tr>
								<td colspan="2"><?php echo $x->name; ?></td>
								<td><?php echo $x->value; ?></td>
								<td><?php echo $x->qty; ?></td>
								<td><?php echo number_format($x->qty * $x->value, 2);
									$balance_cash += $x->qty * $x->value; ?></td>
								<td><?php echo number_format($balance_cash, 2); ?></td>
							</tr>
						<?php } ?>
								<tr>
									<th colspan="2"></th>
									<th colspan="3" style="text-align: right;">Cash in hand Balance</th>
									<th><?php echo number_format($balance_cash, 2); ?></th>
								</tr>
								<tr>
								<th colspan="2"></th>
								<th colspan="3" style="text-align: right;">WINS SPEED Balance</th>
								<th><?php echo number_format($wins_balance, 2); ?></th>
								</tr>
								<tr>
								<th colspan="2"></th>
								<th colspan="3" style="text-align: right;">DIF</th>
									<th <?php if ($balance_cash == $wins_balance) {
														echo 'style="color: green;"';
													} else {
														echo 'style="color: red;"';
													} ?>><?php echo number_format($balance_cash - $wins_balance, 2); ?></th>
								</tr>
						<!-- <tr>
							<th colspan="5" rowspan="2"></th>
							<th style="text-align: center;"><?php echo $_SESSION['name']; ?></th>
						</tr>
						<tr>
							<th>
								<?php if ($_SESSION['role'] == 'president') { ?>
									<form action="" method="post">
										<input type="hidden" name="role" value="<?php echo $_SESSION['role']; ?>">
										<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
										<input type="hidden" name="doc_name" value="<?php echo $doc_name; ?>">
										<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
										<div class="input-group">
											<select name="status" required class="form-control">
												<option value=""></option>
												<option value="Verified" <?php if ($president_status == 'Verified') {
																				echo 'selected';
																			} ?>>Verified</option>
												<option value="Recheck" <?php if ($president_status == 'Recheck') {
																			echo 'selected';
																		} ?>>Recheck</option>
											</select>
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit" name="btn" value="save" style="background-color: #D1B780;color: #464239;"><b>save</b></button>
											</div>
										</div>
									</form>
								<?php } ?>
								<?php if ($_SESSION['role'] == 'manager') { ?>
									<form action="" method="post">
										<input type="hidden" name="role" value="<?php echo $_SESSION['role']; ?>">
										<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
										<input type="hidden" name="doc_name" value="<?php echo $doc_name; ?>">
										<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
										<div class="input-group">
											<select name="status" required class="form-control">
												<option value=""></option>
												<option value="Verified" <?php if ($manager_status == 'Verified') {
																				echo 'selected';
																			} ?>>Verified</option>
												<option value="Recheck" <?php if ($manager_status == 'Recheck') {
																			echo 'selected';
																		} ?>>Recheck</option>
											</select>
											<div class="input-group-btn">
												<button class="btn btn-default" type="submit" name="btn" value="save" style="background-color: #D1B780;color: #464239;"><b>save</b></button>
											</div>
										</div>
									</form>
								<?php } ?>
							</th>
						</tr> -->
					</table>
					<br>

				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?php if (!empty($forecast)) { ?>
					<?php $f_balance = $wins_balance; ?>
					<table class="table table-bordered">
						<tr>
							<th style="width: 5%;">Forecast</th>
							<th colspan="5" style="width: 50%;">Description</th>
							<th style="width: 15%;">Due Date</th>
							<th style="width: 10%;">Receipt</th>
							<th style="width: 10%;">Payment</th>
							<th style="width: 10%;">Balance</th>
							<th style="width: 15%;">REMARK</th>
						</tr>
						<tr>
							<th></th>
							<th colspan="8"><b>B/F</b></th>
								<td><?php echo number_format($wins_balance, 2); ?></td>
						</tr>
						<?php $i = 1;
						foreach ($forecast as $x) { ?>
							<tr>
								<th><?php echo $i; ?></th>
								<td colspan="5"><?php echo $x->description; ?></td>
								<td><?php echo date('d M y', strtotime($x->due_date)); ?></td>
								<td><?php echo number_format($x->Receipt, 2); ?></td>
								<td><?php echo number_format($x->Payment, 2); ?></td>
								<td><?php $f_balance = ($x->Receipt + $f_balance) - $x->Payment;
									echo number_format($f_balance, 2); ?></td>
								<td><?php echo $x->REMARK; ?></td>
							</tr>
						<?php $i++; } ?>
						<tr>
					</table>
				<?php } ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-8">
				<table class="table table-bordered">
					<tr>
						<th style="text-align: center;"><b><?php echo strtoupper($_SESSION['role']); ?></b></th>
						<th style="text-align: center;"><b>Week1</b></th>
						<th style="text-align: center;"><b>Week2</b></th>
						<th style="text-align: center;"><b>Week3</b></th>
						<th style="text-align: center;"><b>Week4</b></th>
						<th style="text-align: center;"><b>Week5</b></th>
					</tr>
					<form action="" method="post">
						<input type="hidden" name="role" value="<?php echo $_SESSION['role']; ?>">
						<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
						<input type="hidden" name="doc_name" value="<?php echo $doc_name; ?>">
						<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
						<tr>
							<th style="text-align: center;"><b><?php echo $_SESSION['name']; ?></b></th>
							<th>
								<!-- <input type="hidden" name="week1" value="1"> -->
								<?php 
									if (empty($w1)) { ?>
									<?php if ($col != 1 && $col > 1) { ?>
										Out of time
									<?php } else if ($col < 1) { ?>

									<?php } else { ?>
										<select name="status_w1" <?php echo $col1; ?> class="form-control">
											<option value=""><?php if ($col1 != '') {
																	echo 'Out of time';
																} ?></option>
											<option value="OK">OK</option>
										</select>
									<?php } ?>
								<?php } else {
									foreach ($w1 as $ss) {
										echo $ss->Verified;
									}
								} 
								?>
							</th>
							<th>
								<!-- <input type="hidden" name="week2" value="2"> -->
								<?php if (empty($w2)) { ?>
									<?php if ($col != 2 && $col > 2) { ?>
										Out of time
									<?php } else if ($col < 2) { ?>

									<?php } else { ?>
										<select name="status_w2" <?php echo $col2; ?> class="form-control">
											<option value=""><?php if ($col2 != '') {
																	echo 'Out of time';
																} ?></option>
											<option value="OK">OK</option>
										</select>
									<?php } ?>
								<?php } else {
									foreach ($w2 as $ss) {
										echo $ss->Verified;
									}
								} ?>
							</th>
							<th>
								<!-- <input type="hidden" name="week3" value="3"> -->
								<?php if (empty($w3)) { ?>
									<?php if ($col != 3 && $col > 3) { ?>
										Out of time
									<?php } else if ($col < 3) { ?>

									<?php } else { ?>
										<select name="status_w3" <?php echo $col3; ?> class="form-control">
											<option value=""><?php if ($col3 != '') {
																	echo 'Out of time';
																} ?></option>
											<option value="OK">OK</option>
										</select>
									<?php } ?>
								<?php } else {
									foreach ($w3 as $ss) {
										echo $ss->Verified;
									}
								} ?>
							</th>
							<th>
								<!-- <input type="hidden" name="week4" value="4"> -->
								<?php if (empty($w4)) { ?>
									<?php if ($col != 4 && $col > 4) { ?>
										Out of time
									<?php } else if ($col < 4) { ?>

									<?php } else { ?>
										<select name="status_w4" <?php echo $col4; ?> class="form-control">
											<option value=""><?php if ($col4 != '') {
																	echo 'Out of time';
																} ?></option>
											<option value="OK">OK</option>
										</select>
									<?php } ?>
								<?php } else {
									foreach ($w4 as $ss) {
										echo $ss->Verified;
									}
								} ?>
							</th>
							<th>
								<!-- <input type="hidden" name="week5" value="5"> -->
								<?php if (empty($w5)) { ?>
									<?php if ($col != 5 && $col > 5) { ?>
										Out of time
									<?php } else if ($col < 5) { ?>

									<?php } else { ?>
										<select name="status_w5" <?php echo $col5; ?> class="form-control">
											<option value=""><?php if ($col5 != '') {
																	echo 'Out of time';
																} ?></option>
											<option value="OK">OK</option>
										</select>
									<?php } ?>
								<?php } else {
									foreach ($w5 as $ss) {
										echo $ss->Verified;
									}
								} ?>
							</th>
						</tr>
						<tr>
							<th colspan="5"></th>
							<th>
								<button class="btn btn-default" type="submit" name="btn" value="save" style="background-color: #D1B780;color: #464239;width: 100%;"><b>save</b></button>
							</th>
						</tr>
					</form>
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
	var tableToExcel = (function() {
		var uri = 'data:application/vnd.ms-excel;base64,',
			template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
			base64 = function(s) {
				return window.btoa(unescape(encodeURIComponent(s)))
			},
			format = function(s, c) {
				return s.replace(/{(\w+)}/g, function(m, p) {
					return c[p];
				})
			}
		return function(table, name, filename) {
			if (!table.nodeType) table = document.getElementById(table)
			var ctx = {
				worksheet: name || 'Worksheet',
				table: table.innerHTML
			}

			document.getElementById("dlink").href = uri + base64(format(template, ctx));
			document.getElementById("dlink").download = filename;
			document.getElementById("dlink").click();

		}
	})()
</script>

</html>
