
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acc_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	public function login($user,$psw)
	{
		$sql = "SELECT * FROM `user` WHERE `username` = '".$user."' AND `password` = '".$psw."' ";
		$sql2 = "INSERT INTO `log`(`user`, `step`) VALUES ('".$user."','login')";
		$query = $this->db->query($sql);
		$this->db->query($sql2);
		return $query->result();
	}
	public function login_log($user,$date)
	{
		$sql = "UPDATE `user` SET `last_login` = '".$date."' ,`status` = 'On line' WHERE `username` = '".$user."' ";
		if($this->db->query($sql)){
			return 'success';
		}else{
			return 'unsuccess';
		}
	}
	public function logout($user)
	{
		$sql = "UPDATE `user` SET `status` = 'Off line' WHERE `username` = '".$user."' ";
		if($this->db->query($sql)){
			return 'success';
		}else{
			return 'unsuccess';
		}
	}

// log
	public function get_log_login($user)
	{
		$sql = "SELECT * FROM `log` WHERE `step` = 'login' AND `user` = '".$user."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_read_doc_log($doc_id)
	{
		$sql = "SELECT * FROM `log` WHERE `step` = 'read_doc' AND `doc_id`= '".$doc_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_check_doc_log($doc_id)
	{
		$sql = "SELECT * FROM `log` WHERE `step` = 'check_doc' AND `doc_id`= '".$doc_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function edit_doc_log($doc_id,$user)
	{
		$sql = "INSERT INTO `log`(`doc_id`, `user`, `step`) VALUES ('".$doc_id."','".$user."','edit_doc')";
		$this->db->query($sql);
	}
	public function read_doc_log($doc_id,$user)
	{
		$sql = "INSERT INTO `log`(`doc_id`, `user`, `step`) VALUES ('".$doc_id."','".$user."','read_doc')";
		$this->db->query($sql);
	}
	public function get_edit_doc_log($doc_id)
	{
		$sql = "SELECT a.*,b.name,b.username FROM `log` a LEFT JOIN `user` b ON a.user = b.username WHERE a.`step` = 'edit_doc' AND a.`doc_id`= '".$doc_id."' ORDER BY a.`id` DESC LIMIT 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_create_doc_log()
	{
		$sql = "SELECT * FROM `log` WHERE `step` = 'create_doc' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function user_sign($code)
	{
		$sql = "SELECT * FROM `user` WHERE `emp_code` = '".$code."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
// end log
// admin
	public function set_user($emp_code,$name,$last_name,$nickname,$username,$password,$role)
	{
		$sql = 'INSERT INTO `user`(`emp_code`, `name`, `last_name`, `nickname`, `username`, `password`, `role`) VALUES ("'.$emp_code.'","'.$name.'","'.$last_name.'","'.$nickname.'","'.$username.'","'.$password.'","'.$role.'")';
		if($this->db->query($sql)){
			return 'success';
		}else{
			return 'unsuccess';
		}
	}
	public function get_user()
	{
		$sql = "select * from `user` where `username` != 'admin' order by `username`";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function doc()
	{
		$sql = "SELECT a.*,SUM(b.Receipt) as Receipt,SUM(b.Payment) as Payment,c.Balance FROM `doc` a LEFT JOIN `details_of_petty_cash` b ON a.id = b.doc_id LEFT JOIN `bf` c ON a.id = c.doc_id GROUP BY a.id ORDER BY a.`date` DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
// end admin
	public function create_doc($date,$name)
	{
		$date = date('Y-m-d',strtotime($date));
		$sql = "INSERT INTO `doc`(`id`, `date`, `name`) VALUES (NULL,'".$date."','".$name."')";
		if($this->db->query($sql)){
			return 'success';
		}else{
			return 'unsuccess';
		}
	}

	public function get_doc($year)
	{
		if(empty($year)){
			$year = date('Y');
		}
		$sql = "SELECT a.*
		,d.qty as qty_1
		,e.qty as qty_2
		,f.qty as qty_3
		,g.qty as qty_4
		,h.qty as qty_5
		,i.qty as qty_6
		,j.qty as qty_7
		,k.qty as qty_8
		,l.qty as qty_9
		,m.qty as qty_10 
		FROM `doc` a 
		LEFT JOIN `bf` c ON a.id = c.doc_id 
		LEFT JOIN `cash_in_hand` d ON a.id = d.doc_id AND d.cash_id = '1' 
		LEFT JOIN `cash_in_hand` e ON a.id = e.doc_id AND e.cash_id = '2' 
		LEFT JOIN `cash_in_hand` f ON a.id = f.doc_id AND f.cash_id = '3' 
		LEFT JOIN `cash_in_hand` g ON a.id = g.doc_id AND g.cash_id = '4' 
		LEFT JOIN `cash_in_hand` h ON a.id = h.doc_id AND h.cash_id = '5' 
		LEFT JOIN `cash_in_hand` i ON a.id = i.doc_id AND i.cash_id = '6' 
		LEFT JOIN `cash_in_hand` j ON a.id = j.doc_id AND j.cash_id = '7' 
		LEFT JOIN `cash_in_hand` k ON a.id = k.doc_id AND k.cash_id = '8' 
		LEFT JOIN `cash_in_hand` l ON a.id = l.doc_id AND l.cash_id = '9' 
		LEFT JOIN `cash_in_hand` m ON a.id = m.doc_id AND m.cash_id = '10' 
		WHERE YEAR(a.`date`) = '".$year."' GROUP BY a.id ORDER BY a.`date` DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_doc_by_id($doc_id)
	{
		$sql = "SELECT * FROM `doc` WHERE `id` = '".$doc_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_doc_log($doc_id,$step)
	{
		$sql = "SELECT c.name,a.user,b.name,a.step,a.timestamp FROM `log` a LEFT JOIN `user` b ON a.user = b.username LEFT JOIN `doc` c ON c.id = a.doc_id WHERE a.`doc_id` = '".$doc_id."' AND a.`step` = '".$step."' ORDER BY a.timestamp DESC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function check_doc($name)
	{
		$sql = "SELECT * FROM `doc` WHERE `name` = '".$name."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function doc_status($doc_id,$user,$role,$Verified,$week)
	{
		$sql = "INSERT INTO `doc_status`(`doc_id`, `user`, `role`, `Verified`, `week`) VALUES ('".$doc_id."','".$user."','".$role."','".$Verified."','".$week."') ";
		if($this->db->query($sql)){
			return 'doc_status';
		}else{
			return 'doc_status';
		}
		return $sql;
	}
	public function get_doc_status($doc_id,$user,$week)
	{
		$sql = "SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '".$week."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function pdf_sign($doc_id,$user)
	{
		$sql = "(SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '1' LIMIT 1) ";
		$sql .= "UNION ";
		$sql .= "(SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '2' LIMIT 1) ";
		$sql .= "UNION ";
		$sql .= "(SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '3' LIMIT 1) ";
		$sql .= "UNION ";
		$sql .= "(SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '4' LIMIT 1) ";
		$sql .= "UNION ";
		$sql .= "(SELECT a.*,b.sign FROM `doc_status` a  LEFT JOIN `user` b ON a.user = b.emp_code WHERE a.`doc_id` = '".$doc_id."' AND a.`user` = '".$user."' AND a.`week` = '5' LIMIT 1)  ORDER BY `date` ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function del_doc($doc_id)
	{
		$sql = "DELETE FROM `doc` WHERE `id` = '".$doc_id."';";
		$sql2 = "DELETE FROM `bf` WHERE `doc_id` = '".$doc_id."';";
		$sql3 = "DELETE FROM `cash_in_hand` WHERE `doc_id` = '".$doc_id."';";
		$sql4 = "DELETE FROM `details_of_petty_cash` WHERE `doc_id` = '".$doc_id."';";
		$sql5 = "DELETE FROM `doc_status` WHERE `doc_id` = '".$doc_id."';";
		if($this->db->query($sql4)){
			$this->db->query($sql3);
			$this->db->query($sql2);
			$this->db->query($sql5);
			$this->db->query($sql);
			return 'success';
		}else{
			return 'unsuccess';
		}
		// return $sql;
	}
	public function Details_of_Petty_Cash($doc_id)
	{
		$sql = "SELECT * FROM `details_of_petty_cash` WHERE `doc_id` = '".$doc_id."' ORDER BY Date,doc_ref";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function edit_Details_of_Petty_Cash($doc_id,$ca_id,$date,$desc,$doc_ref,$receipt,$payment,$remark)
	{
		$sql = 'UPDATE `details_of_petty_cash` SET ';
		$sql .= '`Date`="'.$date.'",';
		$sql .= '`Description`="'.$desc.'",';
		$sql .= '`Doc_Ref`="'.$doc_ref.'",';
		$sql .= '`Receipt`="'.$receipt.'",';
		$sql .= '`Payment`="'.$payment.'",';
		$sql .= '`REMARK`="'.$remark.'" ';
		$sql .= 'WHERE `id` = "'.$ca_id.'" ';
		$sql .= 'AND `doc_id` = "'.$doc_id.'"';
		if($this->db->query($sql)){
			return 'details_of_petty_cash';
		}else{
			return 'details_of_petty_cash';
		}
	}
	public function del_Details_of_Petty_Cash($doc_id,$ca_id)
	{
		$sql = "DELETE FROM `details_of_petty_cash` WHERE `id` = '".$ca_id."' AND `doc_id` = '".$doc_id."'";
		if($this->db->query($sql)){
			return 'details_of_petty_cash';
		}else{
			return 'details_of_petty_cash';
		}
	}
	public function bf($doc_id)
	{
		$sql = "SELECT * FROM `bf` WHERE `doc_id` = '".$doc_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function edit_bf($doc_id,$bf_id,$date,$receipt,$balance,$remark)
	{
		$sql = "UPDATE `bf` SET 
		`Date`='".$date."',
		`Receipt`='".$receipt."',
		`Balance`='".$balance."',
		`REMARK`='".$remark."' 
		WHERE `id` = '".$bf_id."' 
		AND `doc_id` = '".$doc_id."'";
		if($this->db->query($sql)){
			return 'bf';
		}else{
			return 'bf';
		}
	}
	public function del_bf($bf_id,$doc_id)
	{
		$sql = "DELETE FROM `bf` WHERE `id` = '".$bf_id."' AND `doc_id` = '".$doc_id."'";
		if($this->db->query($sql)){
			return 'bf';
		}else{
			return 'bf';
		}
	}
	public function set_bf($doc_id,$date,$desc,$balance,$remark)
	{
		$sql = "INSERT INTO `bf`(`id`, `doc_id`, `Date`, `Description`, `Balance`, `REMARK`) VALUES (NULL,'".$doc_id."','".$date."', '".$desc."', ".$balance.",'".$remark."')";
		if($this->db->query($sql)){
			return 'bf';
		}else{
			return 'bf';
		}
	}

	public function set_ca($doc_id,$date,$desc,$doc_ref,$receipt,$payment,$remark)
	{
		$sql = 'INSERT INTO `details_of_petty_cash`(`id`, `doc_id`, `Date`, `Description`, `Doc_Ref`, `Receipt`, `Payment`, `REMARK`) 
		VALUES 
		(NULL,"'.$doc_id.'","'.$date.'", "'.$desc.'","'.$doc_ref.'", "'.$receipt.'", "'.$payment.'","'.$remark.'")';
		if($this->db->query($sql)){
			return 'details_of_petty_cash';
		}else{
			return 'details_of_petty_cash';
		}
	}
	public function get_ca($doc_id,$date,$desc,$doc_ref,$receipt,$payment,$remark)
	{
		$sql = 'SELECT * FROM `details_of_petty_cash` WHERE `doc_id` = "'.$doc_id.'" AND `Date` = "'.$date.'" AND  `Description` = "'.$desc.'" AND `Doc_Ref` = "'.$doc_ref.'" AND `Receipt` = "'.$receipt.'" AND `Payment` = "'.$payment.'" AND `REMARK` = "'.$remark.'" ';
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function cash()
	{
		$sql = "SELECT * FROM `cash` ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function cash_in_hand($doc_id)
	{
		$sql = "SELECT a.*,b.name,b.value FROM `cash_in_hand` a LEFT JOIN cash b ON a.cash_id = b.id WHERE a.`doc_id` = '".$doc_id."' ORDER BY b.id ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_cash_in_hand($doc_id,$cash_id)
	{
		$sql = "SELECT `id`, `doc_id`, `cash_id`, `qty`, `last_update` FROM `cash_in_hand` WHERE `doc_id` = '".$doc_id."' AND `cash_id` = '".$cash_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function set_cash_in_hand($doc_id)
	{
		$sql = "INSERT INTO `cash_in_hand`(`doc_id`, `cash_id`, `qty`) VALUES 
		('".$doc_id."','1','0'),('".$doc_id."','2','0'),('".$doc_id."','3','0'),('".$doc_id."','4','0'),('".$doc_id."','5','0'),('".$doc_id."','6','0'),('".$doc_id."','7','0'),('".$doc_id."','8','0'),('".$doc_id."','9','0'),('".$doc_id."','10','0')";
		if($this->db->query($sql)){
			return 'cash_in_hand';
		}else{
			return 'cash_in_hand';
		}
	}

	public function update_cash_in_hand($doc_id,$cash_id,$qty)
	{
		$sql = "UPDATE `cash_in_hand` SET `qty` = '".$qty."' WHERE `doc_id` = '".$doc_id."' AND `cash_id` = '".$cash_id."' ";
		if($this->db->query($sql)){
			return 'cash_in_hand';
		}else{
			return 'cash_in_hand';
		}
	}

	public function cal_balance($month,$year)
	{
		$sql = 'SELECT a.`doc_id`,SUM(a.`Receipt`) as `Receipt`,sum(`Payment`) as `Payment` ,b.`balance` FROM `details_of_petty_cash` a
		LEFT JOIN `bf` b ON a.`doc_id` = b.`doc_id`
		WHERE MONTH(b.Date) = '.$month.' AND YEAR(b.Date) = '.$year.'; ';
		$query = $this->db->query($sql);
		if(!empty($query)){
			return $query->result();
		}else{
			return '0';
		}
		
	}

	public function set_forecast($doc_id,$desc,$due_date,$receipt,$payment,$remark)
	{
		$sql = 'INSERT INTO `forecast`(`doc_id`, `description`, `due_date`, `Receipt`, `Payment`, `REMARK`) VALUES ("'.$doc_id.'","'.$desc.'","'.$due_date.'","'.$receipt.'","'.$payment.'","'.$remark.'")';
		if($this->db->query($sql)){
			return 'Forecast';
		}else{
			return 'Forecast';
		}
	}

	public function get_forecast($doc_id)
	{
		$sql = "SELECT `id`, `doc_id`, `description`, `due_date`, `Receipt`, `Payment`, `REMARK`, `create` FROM `forecast` WHERE `doc_id` = '".$doc_id."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function del_forecast($doc_id,$f_id)
	{
		$sql = "DELETE FROM `forecast` WHERE `id` = '".$f_id."' AND `doc_id` = '".$doc_id."' ";
		if($this->db->query($sql)){
			return 'Forecast';
		}else{
			return 'Forecast';
		}
	}
	public function check_forecast($doc_id,$f_desc, $f_due_date, $f_receipt, $f_payment, $f_remark)
	{
		$sql = 'SELECT `id`, `doc_id`, `description`, `due_date`, `Receipt`, `Payment`, `REMARK`, `create` FROM `forecast` WHERE `doc_id` = "'.$doc_id.'" AND `description` = "'.$f_desc.'" AND `due_date` = "'.$f_due_date.'" AND `Receipt` = "'.$f_receipt.'" AND `Payment` = "'.$f_payment.'" AND `REMARK` = "'.$f_remark.'" ';
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function user($user)
	{
		$sql = "select * from user where `username` = '".$user."' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	// for sql server
	
}

/* End of file ModelName.php */
