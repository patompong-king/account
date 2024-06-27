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
<?php
?>

<body>
	<a id="dlink" style="display:none;"></a>
	<?php ?>
		<div style="text-align: right;">
			<button type="submit" class="btn btn-success" onclick="tableToExcel('doc', '<?php echo date('F y', strtotime($doc_name)); ?>', 'Details of Petty Cash (Cash advance) In <?php echo date('F y', strtotime($doc_name)); ?>')">Export to Excel</button>
		</div>
	<?php ?>
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
								<center><b>In <?php echo date('F y', strtotime($doc_name)); ?></b></center>
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
							<th style="width: 50%;" colspan="6">Description</th>
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
									<td colspan="6"><?php if ($x->Remark != '') {
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
							<?php $i++;
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
							<th colspan="2">List</th>
							<th>Total</th>
							<th>QTY.</th>
							<th>Amount (Baht)</th>
							<th>Sum Amount (Baht)</th>
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
							<th></th>
							<th colspan="3" style="text-align: right;">Cash in hand Balance</th>
							<th <?php if ($balance_cash == $wins_balance) {
									echo 'style="color: #00B71E;"';
								} else {
									echo 'style="color: #FF0000;"';
								} ?>><?php echo number_format($balance_cash, 2); ?></th>
							<th rowspan="2" <?php if ($balance_cash == $wins_balance) {
												echo 'style="color: #00B71E;"';
											} else {
												echo 'style="color: #FF0000;"';
											} ?>><?php echo number_format($wins_balance - $balance_cash, 2); ?></th>
						</tr>
						<tr>
							<th></th>
							<th colspan="3" style="text-align: right;" <?php if ($balance_cash == $wins_balance) {
																			echo 'style="color: #00B71E;"';
																		} else {
																			echo 'style="color: #FF0000;"';
																		} ?>>Balance</th>
							<th <?php if ($balance_cash == $wins_balance) {
									echo 'style="color: #00B71E;"';
								} else {
									echo 'style="color: #FF0000;"';
								} ?>><?php echo number_format($wins_balance, 2); ?></th>
						</tr>
					</table>
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
	</div>
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
