<?php
/*
Controller name: User
Controller description: All api of user.
*/

class JSON_API_User_Controller {
	
	public function get_userinfo(){	  
		global $json_api;
		
		if (!$json_api->query->user_id) {
			$json_api->error("You must include 'user_id' var in your request. ");
		}
		
		$user = get_userdata($json_api->query->user_id);
		
		preg_match('|src="(.+?)"|', get_avatar( $user->ID, 32 ), $avatar);		
		
		return array(
			"id" => $user->ID,
			//"username" => $user->user_login,
			"nicename" => $user->user_nicename,
			//"email" => $user->user_email,
			"url" => $user->user_url,
			"displayname" => $user->display_name,
			"firstname" => $user->user_firstname,
			"lastname" => $user->last_name,
			"nickname" => $user->nickname,
			"avatar" => $avatar[1]
		);	
	}
	/*
	http://localhost/api/user/register/?username=john&email=john@domain.com&nonce=68a6bf8f1b&display_name=John&notify=both
	Bao mat theo nonce:
	Cách đơn giản và linh động nhất là các bạn sử dụng hàm wp_create_nonce($action) để tạo nonce và dùng hàm wp_verify_nonce($nonce, $action) để xác nhận.
	$action o day dung la: $nonce_id = $json_api->get_nonce_id('user', 'register');
	*/
	public function register(){
		global $json_api;	  
		if (!get_option('users_can_register')) {
            $json_api->error("User registration is disabled. Please enable it in Settings > Gereral.");            
        }
		
		if (!$json_api->query->username) {
			$json_api->error("You must include 'username' var in your request. ");
		}
		else {
			$username = sanitize_user( $json_api->query->username );
		}	
 
		if (!$json_api->query->email) {
			$json_api->error("You must include 'email' var in your request. ");
		}
		else {
			$email = sanitize_email( $json_api->query->email );
		}

		if (!$json_api->query->nonce) {
			$json_api->error("You must include 'nonce' var in your request. Use the 'get_nonce' Core API method. ");
		}
		else $nonce =  sanitize_text_field( $json_api->query->nonce ) ;
 
		if (!$json_api->query->display_name) {
			$json_api->error("You must include 'display_name' var in your request. ");
		}
		else {
			$display_name = sanitize_text_field( $json_api->query->display_name );
		}

		$user_pass = sanitize_text_field( $_REQUEST['user_pass'] );

		if ($json_api->query->seconds){ 
			$seconds = (int) $json_api->query->seconds;
		}
		else {
			$seconds = 1209600;//14 days
		}

		//Add usernames we don't want used
		$invalid_usernames = array( 'admin' );

		//Do username validation
		$nonce_id = $json_api->get_nonce_id('user', 'register');

		if( !wp_verify_nonce($json_api->query->nonce, $nonce_id) ) {
			$json_api->error("Invalid access, unverifiable 'nonce' value. Use the 'get_nonce' Core API method. ");
        }
        else {
        	if ( !validate_username( $username ) || in_array( $username, $invalid_usernames ) ) {
        		$json_api->error("Username is invalid.");  
        	}
        	elseif ( username_exists( $username ) ) {
        		$json_api->error("Username already exists.");
           }
           else{
           	   if ( !is_email( $email ) ) {
           	   	   $json_api->error("E-mail address is invalid.");
           	   }
           	   elseif (email_exists($email)) {
           	   	   $json_api->error("E-mail address is already in use.");
           	   }
           	   else {
					//Everything has been validated, proceed with creating the user
					//Create the user
					if( !isset($_REQUEST['user_pass']) ) {
						 $user_pass = wp_generate_password();
						 $_REQUEST['user_pass'] = $user_pass;
					}
	
					$_REQUEST['user_login'] = $username;
					$_REQUEST['user_email'] = $email;
					
					$allowed_params = array('user_login', 'user_email', 'user_pass', 'display_name', 'user_nicename', 'user_url', 'nickname', 'first_name',
										 'last_name', 'description', 'rich_editing', 'user_registered', 'role', 'jabber', 'aim', 'yim',
										 'comment_shortcuts', 'admin_color', 'use_ssl', 'show_admin_bar_front'
								   );
					
					foreach($_REQUEST as $field => $value){						
						if( in_array($field, $allowed_params) ){ 
							$user[$field] = trim(sanitize_text_field($value));
						}
					}
					$user['role'] = get_option('default_role');
					$user_id = wp_insert_user( $user );
					
					/*Send e-mail to admin and new user - 
					You could create your own e-mail instead of using this function*/
					
					if( isset($_REQUEST['user_pass']) && $_REQUEST['notify']=='no') {
						$notify = '';	
					}elseif($_REQUEST['notify']!='no') {
						$notify = $_REQUEST['notify'];
					}
					
					if($user_id) {
						wp_new_user_notification( $user_id, '', $notify);
					}
			   }
		   	} 
		}

		return array( 
		  "user_id" => $user_id	
		  ); 
	}
	
	
	
}
?>