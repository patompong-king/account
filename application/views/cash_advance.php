<!DOCTYPE html>
<html lang="en">
<?php $balance = 0; $wins_balance = 0; ?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Details of Petty Cash (Cash advance)</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<style>
	input {
		position: relative;
		width: 150px;
		height: 20px;
		color: white;
	}

	input:before {
		position: absolute;
		top: 3px;
		left: 3px;
		content: attr(data-date);
		display: inline-block;
		color: black;
	}

	input::-webkit-datetime-edit,
	input::-webkit-inner-spin-button,
	input::-webkit-clear-button {
		display: none;
	}

	input::-webkit-calendar-picker-indicator {
		position: absolute;
		top: 3px;
		right: 0;
		color: black;
		opacity: 1;
	}
</style>

<body>
	<nav class="navbar navbar-default" style="background-color: #D1B780;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>Main"><b>HOME</b></a>
				<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>user"><b><?php echo $_SESSION['name']; ?></b></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>Main"><span class="glyphicon glyphicon-log-in"></span> <b>EXIT</b></a></li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h1>
					<center><b>UNIVANCE (Thailand) Co.,Ltd</b></center>
				</h1>
				<h1>
					<center><b>Details of Petty Cash (Cash advance)</b></center>
				</h1>
				<h1>
					<center><b>In <?php echo date('F y', strtotime($date)); ?></b></center>
				</h1><br>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
						<li <?php if ($status == 'wins_speed') {
								echo 'class="active"';
							} ?>><a data-toggle="tab" href="#menu4"><b>WINS SPEED</b></a></li>
					<li <?php if ($status == 'cash_in_hand') {
							echo 'class="active"';
						} ?>><a data-toggle="tab" href="#menu2"><b>Cash in hand</b></a></li>
					<li <?php if ($status == 'Forecast') {
							echo 'class="active"';
						} ?>><a data-toggle="tab" href="#menu3"><b>Forecast</b></a></li>
				</ul>
				<div class="tab-content">

					<div id="home" class="tab-pane fade <?php if ($status == 'bf') {
															echo 'in active';
														} ?>">

						<?php if (empty($bf1)) { ?>
							<table class="table table-bordered">
								<tr style="background-color: #D1B780;color: #464239;">
									<th colspan="7">B/F</th>
								</tr>
								<tr style="background-color: #D1B780;color: #464239;">
									<th style="width: 15%;">Date</th>
									<th>Description</th>
									<th style="width: 10%;">Doc. Ref.</th>
									<th style="width: 10%;">Receipt</th>
									<th style="width: 10%;">Balance</th>
									<th style="width: 15%;">REMARK</th>
									<th style="width: 5%;"></th>
								</tr>
								<tr style="background-color: #F4EBD0;color: #464239;">
									<form action="<?php echo site_url('Acc/'); ?>Details" method="post">
										<td><input type="date" class="form-control input-sm" name="date" data-date="" data-date-format="DD MMM YYYY" value="<?php echo date('Y-m-d', strtotime($date)); ?>"></td>
										<td><input type="text" class="form-control input-sm" pattern="^[a-zA-Z0-9/']+$" name="desc" id="" value="B/F"></td>
										<td><input type="text" class="form-control input-sm" name="doc_ref" id=""></td>
										<td><input type="number" class="form-control input-sm" step="0.01" name="receipt" id=""></td>
										<td><input type="number" class="form-control input-sm" step="0.01" name="balance" id="" value="<?php echo $old_balance; ?>"></td>
										<td><input type="text" class="form-control input-sm" name="remark" id=""></td>
										<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
										<td><button type="submit" class="btn btn-defalut" style="background-color: #D1B780;color: #464239;" name="save" value="bf">Save</button></td>
									</form>
								</tr>
							</table>
						<?php } ?>
						<br>
						<table class="table table-bordered">
							<thead>
								<tr style="background-color: #D1B780;color: #464239;">
									<th colspan="9">B/F</th>
								</tr>
								<tr style="background-color: #D1B780;color: #464239;">
									<th style="width: 10%;">Date</th>
									<th style="width: 45%;">Description</th>
									<th style="width: 10%;">Doc. Ref.</th>
									<th style="width: 7%;">Receipt</th>
									<th style="width: 7%;">Payment</th>
									<th style="width: 7%;">Balance</th>
									<th style="width: 20%;">REMARK</th>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($bf1 as $x) { ?>
									<tr style="background-color: #F4EBD0;color: #464239;">
										<form action="<?php echo site_url('Acc/'); ?>Details" method="post">
											<td><input type="date" class="form-control input-sm" name="date" data-date="" data-date-format="DD MMM YYYY" value="<?php echo date('Y-m-d', strtotime($x->Date)); ?>"></td>
											<td><?php echo $x->Description; ?></td>
											<td></td>
											<td><input type="number" class="form-control input-sm" step="0.01" name="receipt" id="" value="<?php echo $x->Receipt; ?>"></td>
											<td></td>
											<td>
												<input type="number" class="form-control input-sm" step="0.01" name="balance" id="" value="<?php echo $x->Balance; ?>">
												<?php $balance = $x->Balance; ?>
											</td>
											<td><?php echo $x->REMARK; ?></td>
											<input type="hidden" name="bf_id" value="<?php echo $x->id; ?>">
											<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
											<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
											<th><button type="submit" class="btn btn-success" style="background-color: #D1B780;color: #464239;" name="save" value="bf_edit">Save</button></th>
											<th><button type="submit" class="btn btn-danger" style="background-color: #D1B780;color: #464239;" name="save" value="bf_del">Delete</button></th>
										</form>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div id="menu1" class="tab-pane fade <?php if ($status == 'details_of_petty_cash') {
																echo 'in active';
															} ?>">
						<table class="table table-bordered">
							<tr style="background-color: #D1B780;color: #464239;">
								<th colspan="7">Details of Petty Cash (Cash advance)</th>
							</tr>
							<tr style="background-color: #D1B780;color: #464239;">
								<th style="width: 15%;">Date</th>
								<th>Description</th>
								<th style="width: 10%;">Doc. Ref.</th>
								<th style="width: 10%;">Receipt</th>
								<th style="width: 10%;">Payment</th>
								<!-- <th>Balance</th> -->
								<th style="width: 15%;">REMARK</th>
								<th style="width: 5%;"></th>
							</tr>
							<tr style="background-color: #F4EBD0;color: #464239;">
								<form action="<?php echo site_url('Acc/'); ?>Details" method="post" id="in_ca">
									<td><input type="date" class="form-control input-sm" name="date" data-date="" data-date-format="DD MMMM YYYY" value="<?php echo date('Y-m-d', strtotime($date)); ?>"></td>
									<td><input type="text" pattern="^[a-zA-Z0-9/']+$" class="form-control input-sm" name="desc" id="desc" value="<?php echo $desc; ?>"></td>
									<td><input type="text" class="form-control input-sm" name="doc_ref" id=""></td>
									<td><input type="number" class="form-control input-sm" step="0.01" name="receipt" id=""></td>
									<td><input type="number" class="form-control input-sm" step="0.01" name="payment" id=""></td>
									<!-- <td></td> -->
									<td><input type="text" class="form-control input-sm" name="remark" id=""></td>
									<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
									<input type="hidden" name="save" value="ca">
								</form>
								<td><button type="submit" class="btn btn-success" style="background-color: #D1B780;color: #464239;" onclick="check()" name="save" value="ca">Save</button></td>

							</tr>
						</table>
						<br>

						<table class="table table-bordered" id="cash">
							<thead>
								<tr style="background-color: #D1B780;color: #464239;">
									<th style="width: 10%;">Date</th>
									<th style="width: 45%;">Description</th>
									<th style="width: 13%;">Doc. Ref.</th>
									<th style="width: 7%;">Receipt</th>
									<th style="width: 7%;">Payment</th>
									<th style="width: 7%;">Balance</th>
									<th style="width: 20%;">REMARK</th>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody id="cash">
								<?php foreach ($bf as $x) { ?>
									<tr style="background-color: #F4EBD0;color: #464239;">
										<td><?php echo date('d M y', strtotime($x->Date)); ?></td>
										<td><?php echo $x->Description; ?></td>
										<td></td>
										<td></td>
										<td></td>
										<td><?php echo number_format($x->Balance, 2);
											$balance = $x->Balance; ?></td>
										<td><?php echo $x->REMARK; ?></td>
										<td colspan="2"></td>
									</tr>
								<?php } ?>
								<?php foreach ($cash as $x) { ?>
									<tr style="background-color: #F4EBD0;color: #464239;">
										<form action="<?php echo site_url('Acc/'); ?>Details" method="post">
											<td><input type="date" class="form-control input-sm" name="date" data-date="" data-date-format="DD MMM YYYY" value="<?php echo date('Y-m-d', strtotime($x->Date)); ?>"></td>
											<td><input type="text" name="desc" class="form-control input-sm" id="" value="<?php echo $x->Description; ?>"></td>
											<td><input type="text" name="doc_ref" class="form-control input-sm" id="" value="<?php echo $x->Doc_Ref; ?>"></td>
											<td><?php $Receipt = $x->Receipt; ?>
												<input type="number" class="form-control input-sm" step="0.01" name="receipt" value="<?php echo $x->Receipt; ?>">
											</td>
											<td><?php $Payment = $x->Payment; ?>
												<input type="number" class="form-control input-sm" step="0.01" name="payment" value="<?php echo $x->Payment; ?>">
											</td>
											<td>
												<?php
												$balance = $balance + $Receipt - $Payment;
												echo number_format($balance, 2);
												?>
											</td>
											<input type="hidden" name="ca_id" value="<?php echo $x->id; ?>">
											<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
											<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
											<td><input type="text" name="remark" class="form-control input-sm" id="" value="<?php echo $x->REMARK; ?>"></td>
											<th><button type="submit" class="btn btn-success" style="background-color: #D1B780;color: #464239;" name="save" value="ca_edit">Save</button></th>
											<th><button type="submit" class="btn btn-danger" style="background-color: #D1B780;color: #464239;" name="save" value="ca_del">Delete</button></th>
										</form>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>


					<div id="menu4" class="tab-pane fade <?php if ($status == 'wins_speed') {
																echo 'in active';
															} ?>">
						<?php //echo $date_1.' - '.$date_2; ?>									
						<table class="table table-bordered" id="winsspeed">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 50%;">Description</th>
									<th style="width: 10%;">Doc. Ref.</th>
									<th style="width: 7%;">Receipt</th>
									<th style="width: 7%;">Payment</th>
									<th style="width: 7%;">Balance</th>
									<th style="width: 20%;">REMARK</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($petty)) {
										$i = 1;
										$w_balance = 0; ?>
									<?php foreach ($petty as $x) {
									?>
										<tr>
											<th><?php if ($x->DocuDate != '') {
													echo date('d/m/Y', strtotime($x->DocuDate));
												} ?>
											</th>
											<th><?php if ($x->Remark != '') {
													echo $x->Remark;
												}
												if ($x->Remark1 != '') {
													echo $x->Remark1;
												} ?>
											</th>
											<th><?php echo $x->DocuNo; ?></th>
											<th id="Receipt">
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
											</th>
											<th id="Payment">
												<?php
												$w_balance = $w_balance - $x->NetAmnt;
												if ($x->NetAmnt > 0) {
													echo number_format($x->NetAmnt, 2);
												}  ?>
											</th>
											<th id="w_balance"><?php echo number_format($w_balance, 2); $wins_balance = $w_balance; ?></th>
											<th></th>
										</tr>
									<?php $i++;
										} ?>
								<?php } ?>
								<tr>
									<th>
										<td colspan="2"></td>
										<th colspan="2">WINS SPEED BALANCE</th>
										<th><?php echo number_format($wins_balance, 2); ?></th>
									</th>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="menu2" class="tab-pane fade <?php if ($status == 'cash_in_hand') {
																echo 'in active';
															} ?>">
						<?php if (empty($cash_in_hand)) { ?>
							<form action="<?php echo site_url('Acc/'); ?>Details" method="post">
								<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
								<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
								<center><button class="btn btn-default" style="background-color: #D1B780;color: #464239;" name="save" value="hand"><b>CREATE</b></button></center>
							</form>
						<?php } ?>
						<?php if (!empty($cash_in_hand)) { ?>
							<table class="table table-bordered" id="hand">
								<tr>
									<th colspan="4">Cash in hand</th>
									<th style="text-align: center;">
										<button type="submit" class="btn btn-default" style="background-color: #D1B780;color: #464239;" onclick="save_cash()" <?php if (empty($cash_in_hand)) {
																																									echo 'disabled';
																																								} ?>>Save</button>
									</th>
								</tr>
								<tr style="background-color: #D1B780;color: #464239;">
									<th>List</th>
									<th>Total</th>
									<th>QTY.</th>
									<th>Amount (Baht)</th>
									<th>Sum Amount (Baht)</th>
								</tr>
								<form action="<?php echo site_url('Acc/'); ?>Details" method="post" id="cash_in_hand">
									<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
									<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
									<input type="hidden" name="save" value="cash_in_hand">
									<?php $balance_cash = 0;
									foreach ($cash_in_hand as $x) { ?>
										<tr style="background-color: #F4EBD0;color: #464239;">
											<td><?php echo $x->name; ?></td>
											<td style="width: 15%;"><?php echo $x->value; ?></td>
											<input type="hidden" name="cash_in_hand_id[]" value="<?php echo $x->id; ?>">
											<input type="hidden" name="cash_id[]" value="<?php echo $x->cash_id; ?>">
											<td style="width: 15%;"><input type="number" name="qty[]" class="form-control input-sm" value="<?php echo $x->qty; ?>"></td>
											<td style="width: 15%;"><?php echo number_format($x->qty * $x->value, 2);
																	$balance_cash += $x->qty * $x->value; ?></td>
											<td style="width: 15%;"><?php echo number_format($balance_cash, 2); ?></td>
										</tr>
									<?php } ?>
								</form>
								<tr style="background-color: #F4EBD0;color: #464239;">
									<th colspan="2"></th>
									<th colspan="2" style="text-align: right;">Cash in hand Balance</th>
									<th><?php echo number_format($balance_cash, 2); ?></th>
								</tr>
								<tr style="background-color: #F4EBD0;color: #464239;">
								<th colspan="2"></th>
								<th colspan="2" style="text-align: right;">WINS SPEED Balance</th>
								<th><?php echo number_format($wins_balance, 2); ?></th>
								</tr>
								<tr style="background-color: #F4EBD0;color: #464239;">
								<th colspan="2"></th>
								<th colspan="2" style="text-align: right;">DIF</th>
									<th <?php if ($balance_cash == $wins_balance) {
														echo 'style="color: green;"';
													} else {
														echo 'style="color: red;"';
													} ?>><?php echo number_format($balance_cash - $wins_balance, 2); ?></th>
								</tr>
							</table>
						<?php } ?>
					</div>

					<div id="menu3" class="tab-pane fade <?php if ($status == 'Forecast') {
																echo 'in active';
															} ?>">

						<table class="table table-bordered">
							<tr style="background-color: #D1B780;color: #464239;">
								<th colspan="7">Forecast</th>
							</tr>
							<tr style="background-color: #D1B780;color: #464239;">
								<th>Description</th>
								<th style="width: 15%;">Due Date</th>
								<th style="width: 10%;">Receipt</th>
								<th style="width: 10%;">Payment</th>
								<th style="width: 10%;">Balance</th>
								<th style="width: 15%;">REMARK</th>
								<th style="width: 5%;"></th>
							</tr>
							<tr style="background-color: #F4EBD0;color: #464239;">
								<form action="<?php echo site_url('Acc/'); ?>Details" method="post" id="Forecast">
									<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
									<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
									<input type="hidden" name="date" value="<?php echo $date; ?>">
									<input type="hidden" name="save" value="Forecast">
									<td><input type="text" pattern="^[a-zA-Z0-9/']+$" class="form-control input-sm" name="f_desc" id="f_desc" value="<?php echo $desc; ?>"></td>
									<td><input type="date" class="form-control input-sm" name="due_date" data-date="" data-date-format="DD MMM YYYY" value="<?php echo date('Y-m-d', strtotime($due_date)); ?>"></td>
									<td><input type="number" class="form-control input-sm" step="0.01" name="f_receipt" id=""></td>
									<td><input type="number" class="form-control input-sm" step="0.01" name="f_payment" id=""></td>
									<td><?php echo number_format($wins_balance, 2); ?></td>
									<td><input type="text" class="form-control input-sm" name="f_remark" id=""></td>
								</form>
								<td><button type="submit" class="btn btn-defalut" style="background-color: #D1B780;color: #464239;" onclick="check_f()">Save</button></td>

							</tr>
						</table>
						<br>
						<?php $f_balance = $wins_balance; ?>
						<?php if (!empty($forecast)) { ?>
							<table class="table table-bordered">
								<tr style="background-color: #D1B780;color: #464239;">
									<th style="width: 5%;">Forecast</th>
									<th>Description</th>
									<th style="width: 15%;">Due Date</th>
									<th style="width: 10%;">Receipt</th>
									<th style="width: 10%;">Payment</th>
									<th style="width: 10%;">Balance</th>
									<th style="width: 15%;">REMARK</th>
									<th></th>
								</tr>
								<?php $i = 1;
								foreach ($forecast as $x) { ?>
									<tr style="background-color: #F4EBD0;color: #464239;">
										<th><?php echo $i; ?></th>
										<td><?php echo $x->description; ?></td>
										<td><?php echo date('d M Y', strtotime($x->due_date)); ?></td>
										<td><?php echo number_format($x->Receipt, 2); ?></td>
										<td><?php echo number_format($x->Payment, 2); ?></td>
										<td><?php $f_balance = ($x->Receipt + $f_balance) - $x->Payment;
											echo number_format($f_balance, 2); ?></td>
										<td><?php echo $x->REMARK; ?></td>
										<td>
											<form action="<?php echo site_url('Acc/'); ?>Details" method="post">
												<input type="hidden" name="save" value="del_Forecast">
												<input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">
												<input type="hidden" name="name" value="<?php echo $doc_name; ?>">
												<input type="hidden" name="date" value="<?php echo $date; ?>">
												<button type="submit" class="btn btn-danger" style="background-color: #D1B780;color: #464239;" name="f_id" value="<?php echo $x->id; ?>">Delete</button>
											</form>
										</td>
									</tr>
								<?php $i++;
								} ?>
							</table>
						<?php } ?>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered" id="cash">
					<thead>
						<tr>
							<th style="width: 10%;">Date</th>
							<th style="width: 50%;">Description</th>
							<th style="width: 10%;">Doc. Ref.</th>
							<th style="width: 7%;">Receipt</th>
							<th style="width: 7%;">Payment</th>
							<th style="width: 7%;">Balance</th>
							<th style="width: 20%;">REMARK</th>
						</tr>
					</thead>
					<tbody id="cash">
						<?php foreach ($bf as $x) { ?>
						<tr>
							<td><?php echo date('d M y', strtotime($x->Date)); ?></td>
							<td><?php echo $x->Description; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?php echo $x->Balance;
								$balance = $x->Balance; ?></td>
							<td><?php echo $x->REMARK; ?></td>
						</tr>
						<?php } ?>
						<?php foreach ($cash as $x) { ?>
						<tr>
							<td><?php echo date('d M y', strtotime($x->Date)); ?></td>
							<td><?php echo $x->Description; ?></td>
							<td><?php echo $x->Doc_Ref; ?></td>
							<td><?php echo $x->Receipt;
								$Receipt = $x->Receipt; ?></td>
							<td><?php echo $x->Payment;
								$Payment = $x->Payment; ?></td>
							<td>
								<?php
								$balance = $balance + $Receipt - $Payment;
								echo $balance;
								?>
							</td>
							<td><?php echo $x->REMARK; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> -->
	<br>
	<footer class="container-fluid text-center" style="background-color: #D1B780;color: #464239;padding-top: 10px;text-align: right;">
		<p style="font-size: 10px;">Last update by: <?php foreach ($log as $x) {
														echo $x->username . ' ' . $x->name . ' Date: ' . $x->timestamp;
													} ?></p>
	</footer>
</body>
<script>
	$("input").on("change", function() {
		this.setAttribute(
			"data-date",
			moment(this.value, "YYYY-MM-DD")
			.format(this.getAttribute("data-date-format"))
		)
	}).trigger("change")

	function save_cash() {
		document.getElementById('cash_in_hand').submit();
	}
</script>
<script type="text/javascript">
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
		return function(table, name) {
			if (!table.nodeType) table = document.getElementById(table)
			var ctx = {
				worksheet: name || 'Worksheet',
				table: table.innerHTML,
			}
			window.location.href = uri + base64(format(template, ctx))
		}
	})()

	function check() {
		var ch = document.getElementById('desc').value;

		x = check_character(ch);
		if (x == true) {
			document.getElementById('in_ca').submit();
		} else {
			alert('ห้ามใช้เครื่องหมาย " " ')
		}
	}

	function check_f() {
		var ch = document.getElementById('f_desc').value;

		x = check_character(ch);
		if (x == true) {
			document.getElementById('Forecast').submit();
		} else {
			alert('ห้ามใช้เครื่องหมาย " " ')
		}
	}

	function check_character(ch) {
		var len, digit;
		var x = true;
		if (ch == " ") {
			len = 0;
		} else {
			len = ch.length;
		}
		for (var i = 0; i < len; i++) {
			digit = ch.charAt(i)
			// alert(digit)
			if (digit == '"') {
				// 	alert('ห้ามใช้ " ')
				x = false;
			}
		}
		return x;
	}
</script>

</html>
