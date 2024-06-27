<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acc_sv extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database('sqlserver', TRUE);
	}
	public function test($date_1, $date_2)
	{
		$sql = "SELECT (EMPettyCash.PettyCashID) PettyCashID,
					ISNULL(EMPettyCash.PettyCashCode,' None') PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					(PCPayHD.DocuNo) DocuNo,
					('') ReceFlag,
					(PCPayHD.PCPayID) PCPayID,
					(0) PCReceID,
					('') Remark,
					(PCPayHD.BrchID) BrchID,
					(PCPayHD.DocuDate) DocuDate,
					(0) ReceAmnt,
					(PCPayHD.NetAmnt) NetAmnt,
					(PCPayHD.Remark1) Remark1,
					(0) ResultAmnt,
					(621) DocuType,
					(SELECT ISNULL(SUM(PCPayHDTemp.NetAmnt),0.00)
					FROM PCPayHD PCPayHDTemp
					WHERE (PCPayHDTemp.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHDTemp.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHDTemp.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')) TotaPay_cf
			FROM EMPettyCash INNER JOIN PCPayHD ON (EMPettyCash.PettyCashID = PCPayHD.PettyCashID)
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0))
			AND ((PCPayHD.BrchID = '1') OR ('1' = 0))
			AND (CONVERT(VARCHAR(8),PCPayHD.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')

			UNION

			SELECT (EMPettyCash.PettyCashID) PettyCashID,
					ISNULL(EMPettyCash.PettyCashCode,' None') PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					(PCRece.ReceNo) DocuNo,
					(PCRece.ReceFlag) ReceFlag,
					(0) PCPayID,
					(PCRece.PCReceID) PCReceID,
					(PCRece.Remark1) Remark,
					(PCRece.BrchID) BrchID,
					(PCRece.ReceDate) DocuDate,
					(PCRece.ReceAmnt) ReceAmnt,
					(0) NetAmnt,
					('') Remark1,
					(0) ResultAmnt,
					(620) DocuType,
					(SELECT ISNULL(SUM(PCPayHDTemp.NetAmnt),0.00)
					FROM PCPayHD PCPayHDTemp
					WHERE (PCPayHDTemp.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHDTemp.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHDTemp.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')) TotaPay_cf
			FROM EMPettyCash INNER JOIN PCRece ON (EMPettyCash.PettyCashID = PCRece.PettyCashID AND PCRece.ReceFlag = 1)
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0))
			AND ((PCRece.BrchID = '1') OR ('1' = 0))
			AND (CONVERT(VARCHAR(8),PCRece.ReceDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')

			UNION

			SELECT (EMPettyCash.PettyCashID) PettyCashID,
					(EMPettyCash.PettyCashCode) PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					('') DocuNo,
					('') ReceFlag,
					(0) PCPayID,
					(0) PCReceID,
					('') Remark,
					(0) BrchID,
					(NULL) DocuDate,
					(0) ReceAmnt,
					(0) NetAmnt,
					('') Remark1,
					((SELECT ISNULL(SUM(PCRece.ReceAmnt),0)
					FROM PCRece
					WHERE (PCRece.PettyCashID = EMPettyCash.PettyCashID)
					AND (PCRece.ReceFlag = '1')
					AND ((PCRece.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCRece.ReceDate,112) < '" . $date_1 . "'))
					-
					(SELECT ISNULL(SUM(PCPayHD.NetAmnt),0)
					FROM PCPayHD
					WHERE (PCPayHD.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHD.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHD.DocuDate,112) < '" . $date_1 . "'))) ResultAmnt,
					(0) DocuType,
					(0) TotaPay_cf
			FROM EMPettyCash
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0))
			";
		return $sql;
	}

	public function petty($date_1, $date_2)
	{
		$sv = $this->load->database('sqlserver', TRUE);
		$sql = "SELECT (EMPettyCash.PettyCashID) PettyCashID,
					ISNULL(EMPettyCash.PettyCashCode,' None') PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					(PCPayHD.DocuNo) DocuNo,
					('') ReceFlag,
					(PCPayHD.PCPayID) PCPayID,
					(0) PCReceID,
					('') Remark,
					(PCPayHD.BrchID) BrchID,
					(PCPayHD.DocuDate) DocuDate,
					(0) ReceAmnt,
					(PCPayHD.NetAmnt) NetAmnt,
					(PCPayHD.Remark1) Remark1,
					(0) ResultAmnt,
					(621) DocuType,
					(SELECT ISNULL(SUM(PCPayHDTemp.NetAmnt),0.00)
					FROM PCPayHD PCPayHDTemp
					WHERE (PCPayHDTemp.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHDTemp.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHDTemp.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')) TotaPay_cf
			FROM EMPettyCash INNER JOIN PCPayHD ON (EMPettyCash.PettyCashID = PCPayHD.PettyCashID)
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0))
			AND ((PCPayHD.BrchID = '1') OR ('1' = 0))
			AND (CONVERT(VARCHAR(8),PCPayHD.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')

			UNION

			SELECT (EMPettyCash.PettyCashID) PettyCashID,
					ISNULL(EMPettyCash.PettyCashCode,' None') PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					(PCRece.ReceNo) DocuNo,
					(PCRece.ReceFlag) ReceFlag,
					(0) PCPayID,
					(PCRece.PCReceID) PCReceID,
					(PCRece.Remark1) Remark,
					(PCRece.BrchID) BrchID,
					(PCRece.ReceDate) DocuDate,
					(PCRece.ReceAmnt) ReceAmnt,
					(0) NetAmnt,
					('') Remark1,
					(0) ResultAmnt,
					(620) DocuType,
					(SELECT ISNULL(SUM(PCPayHDTemp.NetAmnt),0.00)
					FROM PCPayHD PCPayHDTemp
					WHERE (PCPayHDTemp.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHDTemp.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHDTemp.DocuDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')) TotaPay_cf
			FROM EMPettyCash INNER JOIN PCRece ON (EMPettyCash.PettyCashID = PCRece.PettyCashID AND PCRece.ReceFlag = 1)
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0))
			AND ((PCRece.BrchID = '1') OR ('1' = 0))
			AND (CONVERT(VARCHAR(8),PCRece.ReceDate,112) BETWEEN '" . $date_1 . "' AND '" . $date_2 . "')

			UNION

			SELECT (EMPettyCash.PettyCashID) PettyCashID,
					(EMPettyCash.PettyCashCode) PettyCashCode,
					(EMPettyCash.PettyCashName) PettyCashName,
					(EMPettyCash.PettyCashNameEng) PettyCashNameEng,
					('') DocuNo,
					('') ReceFlag,
					(0) PCPayID,
					(0) PCReceID,
					('') Remark,
					(0) BrchID,
					(NULL) DocuDate,
					(0) ReceAmnt,
					(0) NetAmnt,
					('') Remark1,
					((SELECT ISNULL(SUM(PCRece.ReceAmnt),0)
					FROM PCRece
					WHERE (PCRece.PettyCashID = EMPettyCash.PettyCashID)
					AND (PCRece.ReceFlag = '1')
					AND ((PCRece.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCRece.ReceDate,112) < '" . $date_1 . "'))
					-
					(SELECT ISNULL(SUM(PCPayHD.NetAmnt),0)
					FROM PCPayHD
					WHERE (PCPayHD.PettyCashID = EMPettyCash.PettyCashID)
					AND ((PCPayHD.BrchID = '1') OR ('1' = 0))
					AND (CONVERT(VARCHAR(8),PCPayHD.DocuDate,112) < '" . $date_1 . "'))) ResultAmnt,
					(0) DocuType,
					(0) TotaPay_cf
			FROM EMPettyCash
			WHERE ((EMPettyCash.BrchID = '1') OR ('1' = 0)) ORDER BY DocuDate";
		$query = $sv->query($sql);
		return $query->result();
	}


	public function EMPettyCash()
	{
		$sv = $this->load->database('sqlserver', TRUE);
		$sql = "SELECT [PettyCashCode]
					,[PettyCashID]
					,[BrchID]
					,[Remark]
					,[PettyCashName]
					,[PettyCashNameEng]
					,[BeginAmnt]
					,[AccID]
				FROM [WINS_UNIVANCE_2021].[dbo].[EMPettyCash]";
		$query = $sv->query($sql);
		return $query->result();
	}

	public function PCRece()
	{
		$sv = $this->load->database('sqlserver', TRUE);
		$sql = "SELECT [PCReceID]
				,[ReceNo]
				,[ReceDate]
				,[Remark1]
				,[Remark2]
				,[ReceAmnt]
				,[ReceFlag]
				,[PettyCashID]
				,[BrchID]
				,[BeginAmnt]
				,[PostID]
				,[PostGL]
				FROM [WINS_UNIVANCE_2021].[dbo].[PCRece] WHERE YEAR([ReceDate]) = '2021' ";
		$query = $sv->query($sql);
		return $query->result();
	}

	public function PCPayHD()
	{
		$sv = $this->load->database('sqlserver', TRUE);
		$sql = "SELECT [PCPayID]
					,[DocuNo]
					,[DocuDate]
					,[BrchID]
					,[Remark1]
					,[Remark2]
					,[TotaPayAmnt]
					,[PostGL]
					,[PettyCashID]
					,[BeginAmnt]
					,[PostID]
					,[VATGroupID]
					,[VATRate]
					,[VATType]
					,[VATAmnt]
					,[taxpayamnt]
					,[TotaBaseAmnt]
					,[NetAmnt]
					,[EmpID]
					,[approveno]
					,[RefMMPayNo]
					,[RefMMPayID]
					,[SumPayInAmnt]
				FROM [WINS_UNIVANCE_2021].[dbo].[PCPayHD] WHERE YEAR([DocuDate]) = '2021' ";
		$query = $sv->query($sql);
		return $query->result();
	}
}
