<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document Status</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #D1B780;">
		<div class="container-fluid">
			<div class="navbar-header">
				<?php if ($_SESSION['role'] == '') { ?>
					<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>Main">
					<?php } else { ?>
						<a class="navbar-brand" href="<?php echo site_url('Acc/'); ?>DocumentList">
						<?php } ?>
						<b>HOME <?php echo $_SESSION['name']; ?></b>
						</a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo site_url('Acc/'); ?>Main"><span class="glyphicon glyphicon-log-in"></span> <b>EXIT</b></a></li>
			</ul>
		</div>
	</nav>
	<div class="container" style="margin-top:70px">
		<div class="row">
			<ul class="list-group">
				<?php $i = 1;
				foreach ($doc as $x) {  ?>
					<li class="list-group-item"><h4><b>UNIVANCE (Thailand) Co.,Ltd Details of Petty Cash (Cash advance) In <?php echo $x->name; ?></b></h4></li>
					<li class="list-group-item"><h5><b>Create Date :<?php echo date('d M Y' ,strtotime($x->create_date)); ?></b></h5></li>
				<?php } ?>
			</ul>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<?php if (!empty($read_doc)) { ?>
					<center>
						<h4>Read Document</h4>
					</center>
					<table class="table table-bordered" style="width: 100%;">
						<tr style="background-color: #D1B780;">
							<th style="text-align: center;">No.</th>
							<th style="text-align: center;" colspan="2">User</th>
							<th style="text-align: center;">Date Time</th>
						</tr>
						<?php $i = 1;
						foreach ($read_doc as $x) { ?>
							<tr style="background-color: #F4EBD0;color: #464239;">
								<th style="text-align: center;"><?php echo $i; ?></th>
								<th><?php echo $x->user; ?></th>
								<th><?php echo $x->name; ?></th>
								<th><?php echo date('d M Y H:i:s', strtotime($x->timestamp)); ?></th>
							</tr>
						<?php $i++;
						} ?>
					</table>
				<?php } ?>
			</div>
			<div class="col-sm-6">
				<?php if (!empty($edit_doc)) { ?>
					<center>
						<h4>Edit Document</h4>
					</center>
					<table class="table table-bordered" style="width: 100%;">
						<tr style="background-color: #D1B780;">
							<th style="text-align: center;">No.</th>
							<th style="text-align: center;" colspan="2">User</th>
							<th style="text-align: center;">Date Time</th>
						</tr>
						<?php $i = 1;
						foreach ($edit_doc as $x) { ?>
							<tr style="background-color: #F4EBD0;color: #464239;">
								<th style="text-align: center;"><?php echo $i; ?></th>
								<th><?php echo $x->user; ?></th>
								<th><?php echo $x->name; ?></th>
								<th><?php echo date('d M Y H:i:s', strtotime($x->timestamp)); ?></th>
							</tr>
						<?php $i++;
						} ?>
					</table>
				<?php } ?>
			</div>
		</div>
	</div>
	<br>
	<footer class="container-fluid text-center" style="background-color: #D1B780;color: #464239;padding-top: 10px;text-align: right;">
		<p style="font-size: 10px;">Last Login: <?php echo $_SESSION['last_login']; ?></p>
	</footer>
</body>

</html>
