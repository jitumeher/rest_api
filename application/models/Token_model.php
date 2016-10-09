<?php
class Token_model extends CI_Model {
	public function tokenGenerate($userId,$password,$token,$time) {
		$data=array('TOKEN'=>$token,'TOKEN_EXPIRY_TIME'=>$time);
		$this->db->where('USER_ID', $userId);
		$this->db->where('PASSWORD', $password);
		$this->db->update('user_table', $data);
		$this->db->trans_complete();
		if ($this->db->affected_rows() == '1')
		{
			return true;
		}else {
			
			return false;
		}
	}
}

?>
