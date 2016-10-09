<?php
class User_model extends CI_Model {
	public function checkToken($token,$time) {
		$this->db->select ( 'COUNT(USER_ID) as count, USER_ID as userId' );
		$this->db->from ( 'user_table' );
		$this->db->where ( 'TOKEN', $token );
		$this->db->where ( 'TOKEN_EXPIRY_TIME>=', $time );
		$query = $this->db->get ();
		
		$result = $query->result ();
		return $result[0];
	}
	public function profile($userId) {
		$this->db->select ( '`ID` as id, `USER_ID` as userId, `ROLE` as role, `NAME` as name , `EMAIL_ID` as emailId, `MOBILE` as mobile, `ADDRESS` as address, `GENDER` as gender, `STATE` as state, `SPONSOR_ID` as sponsorId, `SPONSOR_NAME` as sponsorName, `SPONSOR_EMAIL` as sponsorEmailId, `SPONSOR_MOBILE` as sponsorMobile,`COMMIT_STATUS` as commitStatus' );
		$this->db->from ( 'user_table' );
		$this->db->where ( 'USER_ID', $userId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	public function updateprofile($userId,$data) {
		$this->db->where('USER_ID', $userId);
		$this->db->update('user_table', $data);
		$this->db->trans_complete();
		if ($this->db->affected_rows() == '1')
		{
			return true;
		}else {
				
			return false;
		}
	}
	public function bankdetails($userId) {
		$this->db->select ( '`ID` as id, `USER_ID` as userId, `BANK_ACC_NO` as bankAccNo, `BANK_ACC_NAME` as bankAccName, `BANK_NAME` as bankName, `BRANCH_NAME` as branchName, `IFSC_CODE` as ifscCode, `IMPS_NO` as impsNo, `IMPS_MOBILE` as impsMobile' );
		$this->db->from ( 'user_bank_details' );
		$this->db->where ( 'USER_ID', $userId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	public function updatebankdetails($userId,$data) {
		$this->db->where('USER_ID', $userId);
		$this->db->update('user_bank_details', $data);
		$this->db->trans_complete();
		if ($this->db->affected_rows() == '1')
		{
			return true;
		}else {
	
			return false;
		}
	}
	public function usermessages($senderId) {
		$this->db->select ( '`ID` as id, `SENDER_ID` as senderId, `RECEIVER_ID` as receiverId, `SUBJECT` as subject, `MESSAGE` as message, `DATE` as date' );
		$this->db->from ( 'user_message_table' );
		$this->db->where ( 'SENDER_ID', $senderId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	public function updateusermessages($data) {
		$this->db->insert('user_message_table',$data);
		/* if ($this->db->affected_rows()>0)
		{
			return true;
		}else {
	
			return false;
		} */
	}
	public function adminmessages($senderId) {
		$this->db->select ( '`ID` as id, `SENDER_ID` as senderId, `RECEIVER_ID` as receiverId, `SUBJECT` as subject, `MESSAGE` as message, `DATE` as date' );
		$this->db->from ( 'adim_message_table' );
		$this->db->where ( 'SENDER_ID', $senderId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	public function updateadminmessages($data) {
		$this->db->insert('adim_message_table',$data);
	}
	public function updatepassword($userId,$data) {
		$this->db->where('USER_ID', $userId);
		$this->db->update('user_table', $data);
		$this->db->trans_complete();
		if ($this->db->affected_rows() == '1')
		{
			return true;
		}else {
	
			return false;
		}
	}
	public function checkUserPassword($userId,$oldPass) {
		$this->db->select ( 'COUNT(USER_ID) as count' );
		$this->db->from ( 'user_table' );
		$this->db->where ( 'USER_ID', $userId );
		$this->db->where ( 'PASSWORD', $oldPass );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result[0];
	}
	public function commit($userId) {
		$this->db->select ( 'COUNT(USER_ID) as count, `ID` as id, `USER_ID` as userId, `COMMIT_DATE` as commitDate, `MATURITY_DATE` as maturityData, `COMMIT_AMOUNT` as commitAmount, `MATURITY_AMOUNT` as maturityAmount, `PLAN` as plan' );
		$this->db->from ( 'commit_table' );
		$this->db->where ( 'USER_ID', $userId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result[0];
	}
}

?>
