
<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Acc extends CI_Controller
{

	public function __construct()
	{
		session_start();
		parent::__construct();

		// load base_url
		$this->load->helper('url');
		$this->load->model('Acc_model');
		$this->load->model('Acc_sv');
	}

	public function index()
	{
		header('location: ' . site_url('Acc/login'));
	}

	public function login()
	{
		session_destroy();
		$user = $this->input->post('username');
		$psw = $this->input->post('password');
		$data['status'] = '';
		if ($user != '' && $psw != '') {
			$data['user'] = $this->Acc_model->login($user, $psw);
			foreach ($data['user'] as $u) {
				$username = $u->username;
				$password = $u->password;
			}
			if (!empty($data['user']) && $psw == $password) {
				$date = date('Y-m-d H:i:s');
				$this->Acc_model->login_log($username, $date);

				foreach ($data['user'] as $x) {
					session_start();
					$_SESSION['name'] = $x->name . ' ' . $x->last_name;
					$_SESSION['role'] = $x->role;
					$_SESSION['username'] = $x->username;
					$_SESSION['last_login'] = $x->last_login;
					$_SESSION['status'] = $x->status;
				}
				if ($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'President' || $_SESSION['role'] == 'GM') {
					header('location: ' . site_url('Acc/DocumentList'));
				} else if ($_SESSION['role'] == 'admin') {
					header('location: ' . site_url('Acc/admin'));
				} else {
					header('location: ' . site_url('Acc/Main'));
				}
			} else {
				// echo "<script>alert('ไม่พบข้อมูล');</script>";
				$data['status'] = 'ไม่พบข้อมูล';
				// header('location: ' . site_url('Acc/login'));
			}
		}
		$this->load->view('login', $data);
	}
	public function logout()
	{
		session_start();

		$this->Acc_model->logout($_SESSION['username']);


		// Unset all of the session variables.
		$_SESSION = array();

		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(
				session_name(),
				'',
				time() - 42000,
				$params["path"],
				$params["domain"],
				$params["secure"],
				$params["httponly"]
			);
		}

		// Finally, destroy the session.
		session_destroy();

		header('location: ' . site_url('Acc/login'));
	}
	public function Admin()
	{
		// print_r($_POST);

		$btn = $this->input->post('btn');
		$month = $this->input->post('doc_month');
		if (empty($month)) {
			$month = date('Y-m');
		}
		$data['month'] = $month;
		if ($btn == 'new') {
			$emp_code = $this->input->post('emp_code');
			$f_name = $this->input->post('f_name');
			$l_name = $this->input->post('l_name');
			$nickname = $this->input->post('nickname');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$role = $this->input->post('role');
			$user = $this->Acc_model->get_log_login($username);

			if (empty($user)) {
				if ($emp_code != '' || $f_name != '' || $username != '' || $password != '') {
					$this->Acc_model->set_user($emp_code, $f_name, $l_name, $nickname, $username, $password, $role);
				}
			}
		}
		$data['new_user_status'] = '';
		if($btn == 'new_user'){

			$emp_code = $this->input->post('n_emp_code');
			$f_name = $this->input->post('n_f_name');
			$l_name = $this->input->post('n_l_name');
			$nickname = $this->input->post('n_nickname');
			$username = $this->input->post('n_username');
			$password = $this->input->post('n_password');
			$con_password = $this->input->post('n_con_password');
			$role = $this->input->post('role');
			if($password != $con_password){
				$data['new_user_status'] = '<div class="alert alert-danger" role="alert">
				This is a danger alert—check it out!
			  </div>';
			}else{
				$data['new_user_status'] = '<div class="alert alert-success" role="alert">
				This is a success alert—check it out!
			  </div>';
			}

		}
		$date_1 = $this->input->post('date_1');
		if(empty($date_1)){
			$date_1 = date('Y-m-d' ,strtotime('first day of this month'));
		}
		$date_2 = $this->input->post('date_2');
		if(empty($date_2)){
			$date_2 = date('Y-m-d');
		}
		$data['date_1'] = $date_1;
		$data['date_2'] = $date_2;
		// if($date_1 == ''){ $date_1 = date('Y-m-d'); }
		// if($date_2 == ''){ $date_2 = date('Y-m-d'); }
		$data['user'] = $this->Acc_model->get_user();
		$data['doc'] = $this->Acc_model->doc();
		$data['test'] = $this->Acc_sv->test($date_1,$date_2);
		$data['test_sum'] = '';
		$data['petty'] = $this->Acc_sv->petty($date_1,$date_2);
		$data['EMPettyCash'] = $this->Acc_sv->EMPettyCash();
		$data['PCRece'] = $this->Acc_sv->PCRece();
		$data['PCPayHD'] = $this->Acc_sv->PCPayHD();
		// $this->load->view('admin', $data);
		$this->load->view('test_boot', $data);
	}

	public function DocumentList()
	{
		// print_r($_SESSION);
		$year = $this->input->post('year');
		$data['doc'] = $this->Acc_model->get_doc($year);
		$doc = $this->Acc_model->get_doc($year);
		foreach ($doc as $x) {
			$data['status']['id_' . $x->id][0] = $this->Acc_model->get_doc_status($x->id, $_SESSION['username'], '1');
			$data['status']['id_' . $x->id][1] = $this->Acc_model->get_doc_status($x->id, $_SESSION['username'], '2');
			$data['status']['id_' . $x->id][2] = $this->Acc_model->get_doc_status($x->id, $_SESSION['username'], '3');
			$data['status']['id_' . $x->id][3] = $this->Acc_model->get_doc_status($x->id, $_SESSION['username'], '4');
			$data['status']['id_' . $x->id][4] = $this->Acc_model->get_doc_status($x->id, $_SESSION['username'], '5');
		}
		// print_r($data['status']['id_5'][0]);
		// print_r($data['status']['id_5'][1]);
		// print_r($data['status']['id_5'][2]);
		// print_r($data['status']['id_5'][3]);
		// print_r($data['status']['id_5'][4]);
		$data['year'] = $year;
		$this->load->view('doc_list', $data);
	}

	public function DocumentCheck()
	{
		// print_r($_POST);
		// print_r($_SESSION);
		$date_1 = $this->input->post('date_1');
		if(empty($date_1)){
			$date_1 = date('Y-m-d' ,strtotime('first day of this month'));
		}
		$date_2 = $this->input->post('date_2');
		if(empty($date_2)){
			$date_2 = date('Y-m-d');
		}
		$data['date_1'] = $date_1;
		$data['date_2'] = $date_2;
		$x1 = '';
		$x2 = '';
		$x3 = '';
		$x4 = '';
		$x5 = '';
		$data['doc_id'] = $this->input->post('doc_id');
		$data['doc_name'] = $this->input->post('doc_name');
		$role = $this->input->post('role');
		$btn = $this->input->post('btn');
		// echo $data['doc_id'].'<br>';

		$this->Acc_model->read_doc_log($data['doc_id'], $_SESSION['username']);
		if ($btn != '' && $btn == 'save') {
			$doc_id = $data['doc_id'];
			$w1 = $this->input->post('status_w1');
			$w2 = $this->input->post('status_w2');
			$w3 = $this->input->post('status_w3');
			$w4 = $this->input->post('status_w4');
			$w5 = $this->input->post('status_w5');
			$user = $this->input->post('username');
			if (!empty($w1)) {
				$s = $this->Acc_model->get_doc_status($doc_id, $user, '1');
				if (empty($s)) {
					$x1 = $this->Acc_model->doc_status($doc_id, $user, $role, $w1, '1');
				}
			}
			if (!empty($w2)) {
				$s = $this->Acc_model->get_doc_status($doc_id, $user, '2');
				if (empty($s)) {
					$x2 = $this->Acc_model->doc_status($doc_id, $user, $role, $w2, '2');
				}
			}
			if (!empty($w3)) {
				$s = $this->Acc_model->get_doc_status($doc_id, $user, '3');
				if (empty($s)) {
					$x3 = $this->Acc_model->doc_status($doc_id, $user, $role, $w3, '3');
				}
			}
			if (!empty($w4)) {
				$s = $this->Acc_model->get_doc_status($doc_id, $user, '4');
				if (empty($s)) {
					$x4 = $this->Acc_model->doc_status($doc_id, $user, $role, $w4, '4');
				}
			}
			if (!empty($w5)) {
				$s = $this->Acc_model->get_doc_status($doc_id, $user, '5');
				if (empty($s)) {
					$x5 = $this->Acc_model->doc_status($doc_id, $user, $role, $w5, '5');
				}
			}
			// echo '<br>'.$a.'<br><br>';
			// print_r($_POST);
			// echo '<br>';

		}
		$date = date('Y-m-d');
		$col = weekOfMonth(strtotime($date));
		$col = date('Y-m') . '-0' . $col;
		// echo $col.'<br>';
		$w1 = date('Y-m', strtotime($data['doc_name'])) . '-01';
		$w2 = date('Y-m', strtotime($data['doc_name'])) . '-02';
		$w3 = date('Y-m', strtotime($data['doc_name'])) . '-03';
		$w4 = date('Y-m', strtotime($data['doc_name'])) . '-04';
		$w5 = date('Y-m', strtotime($data['doc_name'])) . '-05';
		// echo $w1.'<br>';
		// echo $w2.'<br>';
		// echo $w3.'<br>';
		// echo $w4.'<br>';
		// echo $w5.'<br>';
		if ($col == $w1) {
			$data['col1'] = '';
		} else {
			$data['col1'] = 'disabled';
		}
		if ($col == $w2) {
			$data['col2'] = '';
		} else {
			$data['col2'] = 'disabled';
		}
		if ($col == $w3) {
			$data['col3'] = '';
		} else {
			$data['col3'] = 'disabled';
		}
		if ($col == $w4) {
			$data['col4'] = '';
		} else {
			$data['col4'] = 'disabled';
		}
		if ($col == $w5) {
			$data['col5'] = '';
		} else {
			$data['col5'] = 'disabled';
		}
		$data['col'] = weekOfMonth(strtotime($date));

		$data['w1'] = $this->Acc_model->get_doc_status($data['doc_id'], $_SESSION['username'], '1');
		$data['w2'] = $this->Acc_model->get_doc_status($data['doc_id'], $_SESSION['username'], '2');
		$data['w3'] = $this->Acc_model->get_doc_status($data['doc_id'], $_SESSION['username'], '3');
		$data['w4'] = $this->Acc_model->get_doc_status($data['doc_id'], $_SESSION['username'], '4');
		$data['w5'] = $this->Acc_model->get_doc_status($data['doc_id'], $_SESSION['username'], '5');

		$data['petty'] = $this->Acc_sv->petty($date_1,$date_2);
		$data['doc'] = $this->Acc_model->get_doc_by_id($data['doc_id']);
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);
		$btn = '';
		$data['forecast'] = $this->Acc_model->get_forecast($data['doc_id']);
		$this->load->view('doc_check', $data);
	}

	public function Main()
	{
		// $y = date('Y');
		// echo $y.'<br>';
		// for($i=0;$i<=10;$i++){
		// 	echo $y -= 1;
		// 	echo '<br>';
		// }


		$btn = '';
		$btn = $this->input->post('btn');
		$date = $this->input->post('date');
		$year = $this->input->post('year');
		if (empty($date)) {
			$date = date('Y-m');
		}
		$name = date('M Y', strtotime($date));
		$doc = $this->Acc_model->check_doc($name);
		if (empty($doc)) {
			if (!empty($btn) && $btn == 'create') {
				$data['status'] = $this->Acc_model->create_doc($date, $name);
			}
		}
		if ($btn == 'del') {
			$doc_id = $this->input->post('doc_id');
			$data['status'] = $this->Acc_model->del_doc($doc_id);
		}


		$doc = $this->Acc_model->get_doc($year);
		foreach ($doc as $x) {
			$data['status_p']['id_' . $x->id][0] = $this->Acc_model->get_doc_status($x->id, 'T00882', '1');
			$data['status_p']['id_' . $x->id][1] = $this->Acc_model->get_doc_status($x->id, 'T00882', '2');
			$data['status_p']['id_' . $x->id][2] = $this->Acc_model->get_doc_status($x->id, 'T00882', '3');
			$data['status_p']['id_' . $x->id][3] = $this->Acc_model->get_doc_status($x->id, 'T00882', '4');
			$data['status_p']['id_' . $x->id][4] = $this->Acc_model->get_doc_status($x->id, 'T00882', '5');

			$data['status_m']['id_' . $x->id][0] = $this->Acc_model->get_doc_status($x->id, 'T00443', '1');
			$data['status_m']['id_' . $x->id][1] = $this->Acc_model->get_doc_status($x->id, 'T00443', '2');
			$data['status_m']['id_' . $x->id][2] = $this->Acc_model->get_doc_status($x->id, 'T00443', '3');
			$data['status_m']['id_' . $x->id][3] = $this->Acc_model->get_doc_status($x->id, 'T00443', '4');
			$data['status_m']['id_' . $x->id][4] = $this->Acc_model->get_doc_status($x->id, 'T00443', '5');
		}

		$data['doc'] = $this->Acc_model->get_doc($year);
		$data['date'] = $date;
		$data['year'] = $year;
		$this->load->view('petty_cash', $data);
	}

	public function Details()
	{
		// print_r($_POST);
		$date_1 = $this->input->post('date_1');
		$data['date_1'] = $date_1;
		$date_2 = $this->input->post('date_2');
		$data['date_2'] = $date_2;
		$data['doc_id'] = $this->input->post('doc_id');
		$data['doc_name'] = $this->input->post('name');
		$data['status'] = 'wins_speed';
		$data['due_date'] = '';
		$save = $this->input->post('save');
		$payment = $this->input->post('payment');
		$receipt = $this->input->post('receipt');
		$balance = $this->input->post('balance');
		$doc_ref = $this->input->post('doc_ref');
		$remark = $this->input->post('remark');

		$desc = $this->input->post('desc');
		$data['desc'] = $desc;

		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d', strtotime($data['doc_name']));
		}
		$bf = $this->Acc_model->bf($data['doc_id']);
		if (!empty($bf)) {
			foreach ($bf as $x) {
				$bf_doc_id = $x->doc_id;
			}
		} else {
			$bf_doc_id = '';
		}
		if ($save == 'bf') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			if ($bf_doc_id == '') {
				if (!empty($balance)) {
					$data['status'] = $this->Acc_model->set_bf($data['doc_id'], $date, $desc, $balance, $remark);
				}
				$data['status'] = 'bf';
			}
			$data['status'] = 'bf';
		}
		$ca = $this->Acc_model->get_ca($data['doc_id'], $date, $desc, $doc_ref, $receipt, $payment, $remark);

		$ca_in = $data['doc_id'] . $date . $desc . $doc_ref;
		// echo $ca_data.'<br>'.$ca_in;

		if (!empty($ca)) {
			foreach ($ca as $x) {
				$ca_data = $x->doc_id . $x->Date . $x->Description . $x->Doc_Ref;
			}
		} else {
			$ca_data = '';
		}
		if ($save == 'ca') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			if ($ca_data != $ca_in) {
				if ($payment + $receipt > 0) {
					$data['status'] = $this->Acc_model->set_ca($data['doc_id'], $date, $desc, $doc_ref, $receipt, $payment, $remark);
				}
				$data['status'] = 'details_of_petty_cash';
			}
			$data['status'] = 'details_of_petty_cash';
		}

		if ($save == 'bf_edit') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$bf_id = $this->input->post('bf_id');
			$date = $this->input->post('date');
			$receipt = $this->input->post('receipt');
			$balance = $this->input->post('balance');
			$remark = $this->input->post('remark');
			$this->Acc_model->edit_bf($data['doc_id'], $bf_id, $date, $receipt, $balance, $remark);
			$data['status'] = 'bf';
		}
		if ($save == 'bf_del') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$bf_id = $this->input->post('bf_id');
			$this->Acc_model->del_bf($bf_id, $data['doc_id']);
			$data['status'] = 'bf';
		}
		if ($save == 'ca_edit') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$ca_id = $this->input->post('ca_id');
			$date = $this->input->post('date');
			$desc = $this->input->post('desc');
			$doc_ref = $this->input->post('doc_ref');
			$receipt = $this->input->post('receipt');
			$payment = $this->input->post('payment');
			$remark = $this->input->post('remark');
			$this->Acc_model->edit_Details_of_Petty_Cash($data['doc_id'], $ca_id, $date, $desc, $doc_ref, $receipt, $payment, $remark);
			$data['status'] = 'details_of_petty_cash';
		}
		if ($save == 'ca_del') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$ca_id = $this->input->post('ca_id');
			$this->Acc_model->del_Details_of_Petty_Cash($data['doc_id'], $ca_id);
			$data['status'] = 'details_of_petty_cash';
		}
		$cashs = $this->Acc_model->cash_in_hand($data['doc_id']);
		if (empty($cashs)) {
			if ($save == 'hand') {
				$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
				$data['status'] = $this->Acc_model->set_cash_in_hand($data['doc_id']);
			}
		}

		if ($save == 'cash_in_hand') {
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$cash_in_hand_id = $this->input->post('cash_in_hand_id');
			$qty = $this->input->post('qty');
			$cash_id = $this->input->post('cash_id');
			$data['doc_name'] = $this->input->post('name');
			$i = 0;
			foreach ($cash_in_hand_id as $x) {
				// echo $data['doc_id'].' '.$cash_id[$i].' '.$qty[$i].'<br>';
				$data['status'] = $this->Acc_model->update_cash_in_hand($data['doc_id'], $cash_id[$i], $qty[$i]);
				$i++;
			}
			$data['status'] = 'cash_in_hand';
		}

		if ($save == 'Forecast') {
			// print_r($_POST);
			$this->Acc_model->edit_doc_log($data['doc_id'], $_SESSION['username']);
			$f_desc = $this->input->post('f_desc');
			$f_due_date = $this->input->post('due_date');
			$f_receipt = $this->input->post('f_receipt');
			$f_payment = $this->input->post('f_payment');
			$f_remark = $this->input->post('f_remark');
			$data['due_date'] = $f_due_date;

			$forecast = $this->Acc_model->check_forecast($data['doc_id'], $f_desc, $f_due_date, $f_receipt, $f_payment, $f_remark);

			if (!empty($forecast)) {
				$data['status'] = 'Forecast';
			} else {
				$this->Acc_model->set_forecast($data['doc_id'], $f_desc, $f_due_date, $f_receipt, $f_payment, $f_remark);
			}
			$data['status'] = 'Forecast';
		}
		if ($save == 'del_Forecast') {
			$f_id = $this->input->post('f_id');
			$this->Acc_model->del_forecast($data['doc_id'], $f_id);
			$data['status'] = 'Forecast';
		}
		$data['cashs'] = $this->Acc_model->cash();

		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);
		$_POST['save'] = '';

		$x = date('m', strtotime($date));
		$y = date('Y', strtotime($date));

		if ($x > 1) {
			$x = $x - 1;
		} else if ($x <= 1) {
			$x = $x + 11;
			$y -= 1;
		}
		$data_old_balance = $this->Acc_model->cal_balance($x, $y);
		if ($data_old_balance != 0) {
			foreach ($data_old_balance as $x) {
				$old_balance = $x->Receipt + $x->balance - $x->Payment;
			}
		} else {
			$old_balance = '';
		}

		$_POST = '';
		$data['old_balance'] = $old_balance;

		$data['date'] = $date;
		if ($data['due_date'] == '') {
			$data['due_date'] = $date;
		}
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['bf1'] = $this->Acc_model->bf($data['doc_id']);
		$data['forecast'] = $this->Acc_model->get_forecast($data['doc_id']);
		$data['desc'] = '';
		$data['log'] = $this->Acc_model->get_edit_doc_log($data['doc_id']);
		

		$data['petty'] = $this->Acc_sv->petty($date_1,$date_2);
		// $data['xs'] = $this->Acc_sv-> x($date_1, $date_2);
		// print_r($data['xs']);
		$this->load->view('cash_advance', $data);
	}

	public function Document()
	{
		$data['doc_id'] = $this->input->post('doc_id');
		$data['doc_name'] = $this->input->post('name');

		$data['date_1'] = $this->input->post('date_1');
		$data['date_2'] = $this->input->post('date_2');

		$data['forecast'] = $this->Acc_model->get_forecast($data['doc_id']);
		$data['doc'] = $this->Acc_model->get_doc_by_id($data['doc_id']);
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);
		$data['petty'] = $this->Acc_sv->petty($data['date_1'],$data['date_2']);
		$this->Acc_model->read_doc_log($data['doc_id'], $_SESSION['username']);

		$this->load->view('doc', $data);
	}


	public function pdf()
	{
		$data['doc_id'] = $this->input->post('doc_id');
		$data['doc_name'] = $this->input->post('name');
		$data['week'] = $this->input->post('week');

		$data['date_1'] = $this->input->post('date_1');
		$data['date_2'] = $this->input->post('date_2');

		$data['forecast'] = $this->Acc_model->get_forecast($data['doc_id']);
		$data['doc'] = $this->Acc_model->get_doc_by_id($data['doc_id']);
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);
		$this->Acc_model->read_doc_log($data['doc_id'], $_SESSION['username']);
		$data['petty'] = $this->Acc_sv->petty($data['date_1'],$data['date_2']);

		$data['md'] = $this->Acc_model->pdf_sign($data['doc_id'],'T00882');
		$data['m'] = $this->Acc_model->pdf_sign($data['doc_id'],'T00443');
		$this->load->view('doc_pdf', $data);
	}

	public function Log()
	{
		$data['doc_id'] = $this->input->post('doc_id');
		// $data['doc_id'] = '5';
		$data['doc'] = $this->Acc_model->get_doc_by_id($data['doc_id']);
		$data['read_doc'] = $this->Acc_model->get_doc_log($data['doc_id'], 'read_doc');
		$data['edit_doc'] = $this->Acc_model->get_doc_log($data['doc_id'], 'edit_doc');
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);


		$this->load->view('doc_status', $data);
	}
	// test

	public function test()
	{

		// print_r($_POST);
		$data['doc_id'] = $this->input->post('doc_id');
		$data['doc_name'] = $this->input->post('name');
		$data['status'] = 'bf';
		$save = $this->input->post('save');
		$payment = $this->input->post('payment');
		$receipt = $this->input->post('receipt');
		$balance = $this->input->post('balance');
		$doc_ref = $this->input->post('doc_ref');
		$remark = $this->input->post('remark');

		$desc = $this->input->post('desc');
		$data['desc'] = $desc;

		$date = $this->input->post('date');
		if (empty($date)) {
			$date = date('Y-m-d', strtotime($data['doc_name']));
		}
		$bf = $this->Acc_model->bf($data['doc_id']);
		if (!empty($bf)) {
			foreach ($bf as $x) {
				$bf_doc_id = $x->doc_id;
			}
		} else {
			$bf_doc_id = '';
		}
		if ($save == 'bf') {
			if ($bf_doc_id == '') {
				if (!empty($balance)) {
					$data['status'] = $this->Acc_model->set_bf($data['doc_id'], $date, $desc, $balance, $remark);
				}
				$data['status'] = 'bf';
			}
			$data['status'] = 'bf';
		}
		$ca = $this->Acc_model->get_ca($data['doc_id'], $date, $desc, $doc_ref, $receipt, $payment, $remark);

		$ca_in = $data['doc_id'] . $date . $desc . $doc_ref;
		// echo $ca_data.'<br>'.$ca_in;

		if (!empty($ca)) {
			foreach ($ca as $x) {
				$ca_data = $x->doc_id . $x->Date . $x->Description . $x->Doc_Ref;
			}
		} else {
			$ca_data = '';
		}
		if ($save == 'ca') {
			if ($ca_data != $ca_in) {
				if ($payment + $receipt > 0) {
					$data['status'] = $this->Acc_model->set_ca($data['doc_id'], $date, $desc, $doc_ref, $receipt, $payment, $remark);
				}
				$data['status'] = 'details_of_petty_cash';
			}
			$data['status'] = 'details_of_petty_cash';
		}

		if ($save == 'bf_edit') {
			$bf_id = $this->input->post('bf_id');
			$date = $this->input->post('date');
			$receipt = $this->input->post('receipt');
			$balance = $this->input->post('balance');
			$remark = $this->input->post('remark');
			$this->Acc_model->edit_bf($data['doc_id'], $bf_id, $date, $receipt, $balance, $remark);
			$data['status'] = 'bf';
		}
		if ($save == 'bf_del') {
			$bf_id = $this->input->post('bf_id');
			$this->Acc_model->del_bf($bf_id, $data['doc_id']);
			$data['status'] = 'bf';
		}
		if ($save == 'ca_edit') {
			$ca_id = $this->input->post('ca_id');
			$date = $this->input->post('date');
			$desc = $this->input->post('desc');
			$doc_ref = $this->input->post('doc_ref');
			$receipt = $this->input->post('receipt');
			$payment = $this->input->post('payment');
			$remark = $this->input->post('remark');
			$this->Acc_model->edit_Details_of_Petty_Cash($data['doc_id'], $ca_id, $date, $desc, $doc_ref, $receipt, $payment, $remark);
			$data['status'] = 'details_of_petty_cash';
		}
		if ($save == 'ca_del') {
			$ca_id = $this->input->post('ca_id');
			$this->Acc_model->del_Details_of_Petty_Cash($data['doc_id'], $ca_id);
			$data['status'] = 'details_of_petty_cash';
		}
		$cashs = $this->Acc_model->cash_in_hand($data['doc_id']);
		if (empty($cashs)) {
			if ($save == 'hand') {
				$data['status'] = $this->Acc_model->set_cash_in_hand($data['doc_id']);
			}
		}

		if ($save == 'cash_in_hand') {
			$cash_in_hand_id = $this->input->post('cash_in_hand_id');
			$qty = $this->input->post('qty');
			$cash_id = $this->input->post('cash_id');
			$data['doc_name'] = $this->input->post('name');
			$i = 0;
			foreach ($cash_in_hand_id as $x) {
				// echo $data['doc_id'].' '.$cash_id[$i].' '.$qty[$i].'<br>';
				$data['status'] = $this->Acc_model->update_cash_in_hand($data['doc_id'], $cash_id[$i], $qty[$i]);
				$i++;
			}
			$data['status'] = 'cash_in_hand';
		}
		$data['cashs'] = $this->Acc_model->cash();

		$data['cash_in_hand'] = $this->Acc_model->cash_in_hand($data['doc_id']);
		$_POST['save'] = '';
		$data['date'] = $date;
		$data['cash'] = $this->Acc_model->Details_of_Petty_Cash($data['doc_id']);
		$data['bf'] = $this->Acc_model->bf($data['doc_id']);
		$data['bf1'] = $this->Acc_model->bf($data['doc_id']);
		$data['desc'] = '';
		$this->load->view('webpage', $data);
		$this->load->view('profile', $data);
		$this->load->view('blog', $data);
		$this->load->view('social', $data);
	}

	public function sv()
	{
		$data['test'] = $this->Acc_model->test();
		print_r($data['test']);
		$this->load->view('blog', $data);
	}

	public function user()
	{
		if ($_SESSION['role'] == 'Manager' || $_SESSION['role'] == 'President' || $_SESSION['role'] == 'GM') {
			$data['page'] = 'DocumentList';
		} else if ($_SESSION['role'] == 'admin') {
			$data['page'] = 'admin';
		} else {
			$data['page'] = 'Main';
		}

		$user = $_SESSION['username'];
		$data['user'] = $this->Acc_model->user($user);
		$this->load->view('user', $data);
	}
}



function weekOfMonth($date)
{
	//Get the first day of the month.
	$firstOfMonth = strtotime(date("Y-m-01", $date));
	// echo date('W-m-y',$firstOfMonth).'<br>';
	//Apply above formula.
	return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date)
{
	$weekOfYear = intval(date("W", $date));
	// echo $weekOfYear.'<br>';
	if (date('n', $date) == "1" && $weekOfYear > 51) {
		// It's the last week of the previos year.
		return 0;
	} else if (date('n', $date) == "12" && $weekOfYear == 1) {
		// It's the first week of the next year.
		return 53;
	} else {
		// It's a "normal" week.
		return $weekOfYear;
	}
}
/* End of file Controllername.php */
