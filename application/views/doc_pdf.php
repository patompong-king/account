<!DOCTYPE html>
<html lang="en">

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
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<style type="text/css">
	@media print {
		#hid {
			display: none;
			/* ซ่อน  */
		}
	}

	.sign {
		text-align: center;
		/* width: 200px; */
	}
	table {
		float: right;
	}
	th {
		font-size: 12px;
	}
	td {
		font-size: 10px;
	}
</style>

<body>
	<div class="container" id="doc_pdf">
		<div class="row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2"><button id="hid" onclick="window.print();" class="btn btn-primary" style="width: 100%;"> Print </button></div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="font-size: 24px;text-align: center;">UNIVANCE (Thailand) Co.,Ltd</div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="font-size: 24px;text-align: center;">Details of Petty Cash (Cash advance)</div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="font-size: 24px;text-align: center;">In <?php echo date('F y', strtotime($doc_name)); ?></div>
		</div>
		<div class="row">
			<div class="col-sm-12" style="font-size: 14px;">
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
							<?php $i++;
							} ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php if (empty($week)) { ?>
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
						</table>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<?php if (!empty($md)) { ?>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<table class="" style="width: <?php echo count($md)*20; ?>%;">
						<tr>
							<?php foreach ($md as $x) { ?>
								<td class="sign"><img src="http://172.28.1.23/ACC/sign/<?php echo $x->sign; ?>.png" alt="" style="width: 90px;height: 50px;"></td>
							<?php } ?>
						</tr>
						<tr>
							<?php foreach ($md as $x) { ?>
								<th class="sign"><?php echo date('d/m/Y' ,strtotime($x->date)); ?></th>
							<?php } ?>
						</tr>
					</table>
				</div>
			</div>
		<?php } ?>
		
		<?php if (!empty($m)) { ?>
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<table class="" style="width: <?php echo count($m)*20; ?>%;">
						<tr>
							<?php foreach ($m as $x) { ?>
								<td class="sign"><img src="http://172.28.1.23/ACC/sign/<?php echo $x->sign; ?>.png" alt="" style="width: 90px;height: 50px;"></td>
							<?php } ?>
						</tr>
						<tr>
							<?php foreach ($m as $x) { ?>
								<th class="sign"><?php echo date('d/m/Y' ,strtotime($x->date)); ?></th>
							<?php } ?>
						</tr>
					</table>
				</div>
			</div>
		<?php } ?>
	</div>
</body>

</html>
