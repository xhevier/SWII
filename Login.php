<?php
Class Login extends CI_Model {

    public function validateUser() {
        $this->db->where('LOGIN_NAME', $this->input->post('username'));
        $this->db->where('LOGIN_PASSWORD', md5($this->input->post('password')));
        $q = $this->db->get('POJ_T_USER_LOGIN');

        if ($q->num_rows() == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getUserPermisson(){
        $sql = 'SELECT LOGIN_ID, LOGIN_PERMISSON 
                  FROM POJ_T_USER_LOGIN 
                 WHERE LOGIN_NAME="'.$this->input->post('username').'"';
        $query = $this->db->query($sql);

        if ($query->num_rows() == 1){
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	public function validateChangePassword(){
		$sql = 'SELECT USER_PIN, USER_EMAIL, LOGIN_NAME 
				  FROM POJ_T_USER LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID=POJ_T_USER_LOGIN.LOGIN_ID
				 WHERE USER_EMAIL = "'.$this->input->post('lostEmail').'"
				   AND LOGIN_NAME = "'.$this->input->post('lostUsername').'"
				   AND MID(USER_PIN, 2, 1)="'.$this->input->post('lostFirstNumber').'"
				   AND MID(USER_PIN, 6, 1)="'.$this->input->post('lostSecondNumber').'"
				   ';
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 1){
            return $query->row();
        } else {
            return FALSE;
        }
	}
	
	public function getUserID(){
		$sql = 'SELECT LOGIN_ID 
				  FROM POJ_T_USER_LOGIN
				 WHERE LOGIN_NAME = "'.$this->input->post('lostUsername').'"
		';
		$query = $this->db->query($sql);
		if ($query->num_rows() == 1){
            return $query->row();
        } else {
            return FALSE;
        }
	}
	
	public function setNewPassword($userID,$password){
		$sql = 'UPDATE POJ_T_USER_LOGIN
				   SET LOGIN_PASSWORD = "'.$password.'"
				 WHERE LOGIN_ID = '.$userID->LOGIN_ID;
		$this->db->query($sql);
	}
}