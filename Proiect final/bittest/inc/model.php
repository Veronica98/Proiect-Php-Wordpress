<?php

class BitTestModel {
	
	private $input_uname;
	private $input_upass;
	private $input_uemail;
	private $db_conn;
	
	public function __construct($a,$b,$c,$d) {
		
		$this->input_uname = $a;
		$this->input_upass = $b;
		$this->input_uemail = $c;
		$this->db_conn = $d;
		
	}
	
	public function add_user($uname,$upass,$email){

		if(empty($uname) || empty($upass) || empty($email)){
			
			return false;
		}

		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			
			echo 'Nu ai introdus un email valid!';
			return false;
			
		}
		
		require_once(ABSPATH.'wp-admin/includes/user.php');
		
		wp_create_user($uname,$upass,$email);
		
	}
	
	public function get_users_data(){
		
		$options = array(
			'orderby' => 'ID',
			'order' => 'ASC',
		);
		
		$users = get_users($options);
		
		return $users;
		
	}
	
}
