<?php

class BitTestView {

	public static function generate_view() {
		
		

	}
	
	public static function generate_add_user($users) {
		
			$output .='<h3>Add user</h3>';
			$output .= '<form>';
			$output .= 'Username: <input type="text" name="uname" placeholder="Ex: User123"><br><br>';
			$output .= 'Password: <input type="password" name="upass"><br><br>';
			$output .= 'Email: <input type="text" name="uemail" placeholder="Ex: abc@gmail.com"><br><br>';
			$output .= '<input type="submit" value="Add user">';
			$output .= '</form><hr>';
		
			$output .='<ul>';
		
			foreach($users as $user){
			
				$uid = $user->data->ID;
				$uname = $user->data->user_login;
				$uemail = $user->data->user_email;
				$output .="<li>".get_avatar( $uid, 32 )." - "."$uname"." - "."$uemail</li><br>";
			
			}
		
		
			$output .='</ul>';
		
		
			return $output;
		
		
	}

}

