<?php


class Users  {

        private $role; //user, administrator
	    private $provider;  //domain of site registering data
	    // Store password options so that rehash & hash can share them:
	    const HASH = PASSWORD_DEFAULT;
	       const COST = 14;
		   // Internal data storage about the user:
		      public $user_data;
		  	
function __construct($role, $provider)
	{
		
		//Sanitize
		$this->role = sanitize($role);
		$this->provider = sanitize($provider);
		// Read data from the database, storing it into $data such as:
		//  $data->passwordHash  and  $data->username
		$this->user_data = new stdClass();
		$this->user_data->passwordHash = 'uZsWqIbG+LN2cg29T6KpMDmjP|+Aax1tioDPSJRdxemetyeqV4LZdYLIxY~v';
	}

/*

begin classs implementation for users
this class will handle synching of user accounts and user information

*/
	
	    public function register($email, $password, $first, $last) {
			$db = Database::obtain();
			
			//does user exist already? if not then proceed
            $sql="SELECT `email` FROM `users` WHERE `email`='".$db->escape($email)."'";
			//$2y$14$EnPssFpPTu4iRU51cOfitON3NXypZ/.RKV/gBIMECMgyuDwQTDl6i in users.password for test@test.com
			
            $result = $db->query_first($sql);
            if(empty($result)){
            	//save reg
				$data['created'] = "NOW()";
				$data['modified'] = "NOW()";
				$data['first'] = $first;
				$data['last'] = $last;
				$data['password'] = $this->setPassword($password);
				$data['email'] = $email;
				$data['user_type_id'] = '4';
				$db->insert("users", $data);
				$uid = mysql_insert_id();
				//$_SESSION['uid'] = $uid;
				//$_SESSION['email'] = $email;
				//$_SESSION['first'] = $first;
				//$_SESSION['last'] = $last;
				//$_SESSION['role'] = "Customer";
				//$_SESSION['active'] = 0;
				//print_r($_SESSION);
				
				
				$this->mailme('register', $email, $uid, '');
				echo "Please check your email to verify your account";
				die();
				
				//header("Location: http://afxcreates.com/review/fsi_beta/?view=confirm");
				
            } else {
            	echo "You already Registered";
            }
	        // Store the data from $data back into the database
            
 		    
	    }
		
	    public function save($data) {
	        // Store the data from $data back into the database
            $db = Database::obtain();
 		    //$data = strip_tags($data);
 		    $data['created'] = "NOW()";
			$data['modified'] = "NOW()";
			
			echo "<br /><br />";
		    //print_r($data);
            $db->insert("users", $data);
	    }
		
		public function delete($uid){
			$db = Database::obtain();
			$sql = "DELETE FROM users WHERE id='".$db->escape($uid)."'";

	        $db->query($sql);
			
		}

	    // Allow for changing a new password:
	    public function setPassword($password) {
			//echo "setPassword: ".$password."<br /><br />";
			return $this->user_data->passwordHash = password_hash($password, self::HASH, ['cost' => self::COST]);
	        
			
	    }

	    // Logic for logging a user in:
	    public function login($email, $password) {
			
            $db = Database::obtain();
            $sql="SELECT `first`, `last`, `password`, `email`, `id`, `user_type_id`, `active`, `avatar` FROM `users` WHERE `email`='".$db->escape($email)."' AND active = 1";
			//echo $sql;
            $result = $db->query_first($sql);
			
			if(!empty($result)){
				
				$db_password = $result['password'];
				$db_email = $result['email'];
				$db_first = $result['first'];
				$db_last = $result['last'];
				$db_role = $result['user_type_id'];
				$db_id = $result['id'];
				$db_active = $result['active'];
				$db_avatar = $result['avatar'];
			
				$my_role = $this->get_user_role($db_role);
				
				
				    if(password_verify($password, $db_password)){
						$_SESSION['uid'] = $db_id;
						$_SESSION['email'] = $db_email;
						$_SESSION['first'] = $db_first;
						$_SESSION['last'] = $db_last;
						$_SESSION['role'] = $my_role;
						$_SESSION['active'] = $db_active;
						$_SESSION['avatar'] = $db_avatar;
					
						//print_r($_SESSION);
						return true;
				    } else {
						echo "Invalid Password<br /><br />";
						die();
							
				    }
			} else {
				"Sorry, your account is not activated.";
			}
			
			
			
						 /*
			if (password_verify($password, self::HASH)) {
			    echo 'Submitted Password is valid! '.$password.'<br /><br />';
			} else {
			    echo 'Submitted Invalid password.'.$password.'<br /><br />';
			}
			*/
			
						 /*  MAYBE FOR UPDATING PASSWORD USE THIS
	        if (password_verify($password, $this->user_data->passwordHash)) {
	            // Success - Now see if their password needs rehashed
				echo 'Submitted Password is valid! '.$password.'<br /><br />';
	            if (password_needs_rehash($this->user_data->passwordHash, self::HASH, ['cost' => self::COST])) {
	                // We need to rehash the password, and save it.  Just call setPassword
	                
	            }
               
				return true; // Or do what you need to mark the user as logged in.
	        }
						 */
            //$data['password'] = $this->setPassword($password);
			//$data['email'] = $email;
			//print_r($this->user_data);
            //$this->save($data);
			
			//hash the password, run hash in db to see if they match "is_valid"
			
	        return false;
	    }
		
		public function logout(){
			
			unset($_SESSION);
			session_destroy();
			header("Location: http://afxcreates.com/review/fsi_beta");
			die();
			
		}
        #get the master id referenced by active session oauth_uid
        public function addUser($data){
           $db = Database::obtain();
           
           $data['created'] = "NOW()";// it knows to convert NULL and NOW() from a string
           $data['modified'] = "NOW()";
		   print_r($data);
           $sql="SELECT `email` FROM `users` WHERE `email`='".$db->escape($data['email'])."'";
		//$2y$14$EnPssFpPTu4iRU51cOfitON3NXypZ/.RKV/gBIMECMgyuDwQTDl6i in users.password for test@test.com
		
           $result = $db->query_first($sql);
           if(empty($result)){
		   
	           $db->insert("users", $data);
			   $uid = mysql_insert_id();
			   $this->mailme('system_admin', $data['email'], $uid, $data['hasher']);
			      //echo "Please check your email to verify your account";
			   die();
		   } else {
			   echo "User already exists with this email address.";
		   }
      }
	  
	  
     
      public function reset_password($data){
         $db = Database::obtain();
         $data['modified'] = "NOW()";
	     //email really exists and is not a TRICK woo ha ha 
         $sql="SELECT `email` FROM `users` WHERE `email`='".$db->escape($data['email'])."'";	
         $result = $db->query_first($sql);
		 
		 //print_r($data);
		 $data['password'] = $this->setPassword($data['pwd_reset_code']);
		 //could get result[id] and update on id. 
         if(!empty($result)){  
			 //update the users table with new token so it can be changed. 
             if($db->update("users", $data, "email='".$db->escape($data['email'])."'")){
	  		   $this->mailme('reset_password', $data['email'], '', $data['pwd_reset_code']);
	  		   die();
             } 
		  
	   } else {
		   echo "Unable to locate email address, please re-register or contact support.";
	   }
    }
	
	
	public function update_password($data, $my_id){
       
		$db = Database::obtain();
		//echo "update_password for ".$my_id.": ";
		//print_r($data);
		
        if($db->update("users", $data, "id='".$my_id."'")){
		   return true;
        }
		return false;
	}
	
	
    #update a report field
    public function update_setting($data, $my_id){
       $db = Database::obtain();
       //echo "update settings ".$my_id." <br /><br /> and then some data ";
	   //print_r($data);
      /* if(!empty($data['password'])){
		 echo "classy setting password";
       	$data['password'] = $this->setPassword($data['pwd_reset_code']);
       }
		  */
       $db->update("users", $data, "id='".$db->escape($my_id)."'");
	
       
      
    }
  
    #update a report field
    public function updateUserField($uid, $info, $field_name){
       $db = Database::obtain();
       
       $data[$field_name] = $info;
       //$db->update("reports", $data, $master_id);
       $db->update("users", $data, "id='".$uid."'");
    }
	
	
	
	  
	public function deleteUser($uid){
		$db = Database::obtain();
		$sql = "DELETE FROM users WHERE id='".$db->escape($uid)."'";
         // echo $sql;
        $db->query($sql);
		
	}
	
		
	    // Logic for logging a user in:
	    public function my_avatar($uid) {
			
            $db = Database::obtain();
            $sql="SELECT `avatar` FROM `users` WHERE `id`='".$db->escape($uid)."'";
            $result = $db->query_first($sql);
			
			$db_avatar = $result['avatar'];
			if(empty($db_avatar)){
				$db_avatar = "generic.png";
			}
			return $db_avatar;
			
			
		}
		
        public function confirm_email($uid){
           $db = Database::obtain();
           $data['active'] = 1;
           //$db->update("profiles", $data, $master_id);
           if($db->update("users", $data, "id='".$uid."'")){
			   return true;
           }
		   return false;
		   
        }
		
		
		//   REQUIRED   
        #boolean to see if user exists reference by master_id
	public function get_user_exists($user){
    
              // get the already existing instance of the $db object
             $db = Database::obtain();

             $sql="SELECT `id` FROM `users` WHERE `id`='".$db->escape($user)."'";
             $row = $db->query_first($sql);
             // if user exists
             if(!empty($row['id']))
                  return true;
              else
                  return false;
       }


       //   REQUIRED   
   	public function get_roles(){

                $db = Database::obtain();
                $sql="SELECT `id`, `name` FROM `user_types`";
             
               // $result = $db->query($sql);
   			// print_r($result);
			 
   			 $result = $db->fetch_array($sql);
                if(!empty($result))
                     return $result;
                 else
                     return 'unknown';
          }
	   


       
    //   REQUIRED   
	public function get_user_roles($user_type_id){

             $db = Database::obtain();
             $sql="SELECT * FROM `users` where `user_type_id` = '".$user_type_id."'";
             
            // $result = $db->query($sql);
			// print_r($result);
			 
			 $result = $db->fetch_array($sql);
             if(!empty($result))
                  return $result;
              else
                  return 'unknown';
       }
	   
       //   REQUIRED   
   	public function get_user_role($user_type_id){

                $db = Database::obtain();

                $sql="SELECT `name` FROM `user_types` where `id` = ".$user_type_id;
 
                  $row = $db->query_first($sql);
           
                if(!empty($row['name']))
                     return $row['name'];
                 else
                     return 'unknown';
          }
       
       

	       #insert email address for future contact
       public function addEmail($email){
           $db = Database::obtain();
		   $email = strip_tags($email);
		   
           $data['email'] = $email;
		   $data['date_added'] = "NOW()";
		  
           $db->insert("emails", $data);
      }
	
	
	 #likeUser, sends friend request to db. 
       public function likeUser($requester_id, $user_id){
           $db = Database::obtain();
		   
		   
           $data['requester_id'] = $requester_id;
		   $data['user_id'] = $user_id;
		   $data['status'] = 0;
		   $data['date_added'] = "NOW()";
		  
           $db->insert("users_to_friends", $data);
      }
	  
	  
	 	     
     public function getUserInfo($user_id){
          $db = Database::obtain();
          $sql = "select * from users where users.id = '".$user_id."' ";
          $user_info = $db->fetch_array($sql);
          return $user_info;
     }
     
    
    public function getUserIdFromEmail($email){
          $db = Database::obtain();
          $sql = "select id from users where users.email = '".$email."'  ";
          $user_info = $db->fetch_array($sql);
          return $user_info;
     }

       
  
  public function get_users($start, $range){
         $db = Database::obtain();
         $sql = "select * from users WHERE active = 1  ORDER BY created DESC  LIMIT ".$start.", ".$range;
		 
         $info = $db->fetch_array($sql);
         return $info;
    }
	
    public function users_count(){
           $db = Database::obtain();
           $sql = "select * from users WHERE active = 1  ORDER BY created DESC";
		 
           $info = $db->fetch_array($sql);
           return count($info);
      }
  
	  
	  public function getRegisterations(){
          $db = Database::obtain();
          $sql = "select * from users";
          $info = $db->fetch_array($sql);
          return $info;
     }



    	public function myObject($object_id, $context, $model, $user_id){
           //model is like a module, context is object_type like stories, clients, object_id as in client_id, story_id
           // get the already existing instance of the $db object
          $db = Database::obtain();

          $sql="SELECT `id` FROM ".$model." WHERE ".$context."='".$db->escape($user_id)."' AND id = '".$object_id."' ";
          $row = $db->query_first($sql);
          // if user exists
          if(!empty($row['id']))
               return true;
           else
               return false;
    }
    
    	  //****** updateObject() *************************
  # Desc: updates an object with context is table column name and object_id the id of the row to be updated
   # Param: int object id, int creator_id, text data, text context, text module
   # returns: void 
   public function updateObject($object_id, $creator_id, $data, $context, $module){
  
  //going to need to parse the data array and make dynamic update sql statement.  
  
    
   
       $db = Database::obtain();
       $data = $db->escape($data);
       $data = sanitize($data);
       $module = $db->escape($module);
       $module = sanitize($module);
       $context = $db->escape($context);
       $context = sanitize($context);
       $object_id = $db->escape($object_id);
       $object_id = sanitize($object_id);
       
        $sql = "UPDATE ".$module." SET `".$context."` = '".$data."' WHERE `id`='".$db->escape($object_id)."'";
        
        $db->query($sql);
       //$db->update($this->model_name, $data, "id='".$story_id."'");
   } 
	
    


     //****** updateContext() *************************
	  # Desc: 
      # Param: 
      # returns: void 
      public function updateContext($user_id, $creator_id, $data, $context){
	  
	      if (!$user_id || !$creator_id || !isset($data)) {
		      $message = "Stories->updateContext() missing args";
			  Logger::logError($message); 
              throw new Exception($message);
          }  
	   //print_r($data);
	      
          $db = Database::obtain();
          $data = $db->escape($data);
          $data = sanitize($data);
          $creator_id = $db->escape($creator_id);
          $creator_id = sanitize($creator_id);
          $context = $db->escape($context);
          $context = sanitize($context);
          $user_id = $db->escape($user_id);
          $user_id = sanitize($user_id);
          
         
           $sql = "UPDATE `users` SET `".$context."` = '".$data."' WHERE `id`='".$db->escape($user_id)."'";
           $db->query($sql);
          
      } 
	  	
	  public function mailme($mode, $email, $uid, $token){
	  	
		
	    $url = 'https://api.sendgrid.com/';
	    $user = 'fsi_dev';
	    $pass = 'Druid019!'; 
		
	    if($mode === 'system_admin'){
	    	
		    $params = array(
		         'api_user' => $user,
		         'api_key' => $pass,
		         'to' => $email,
		         'subject' => 'confirm email',
		         'html' => 'Your password is '.$token.'  Reset your password upon email confirmation. Please confirm your email address, http://www.afxcreates.com/review/fsi_beta/?view=confirm&id='.$uid ,
		         'text' => 'Please confirm your email address, http://www.afxcreates.com/review/fsi_beta/?view=confirm&id='.$uid ,
		         'from' => 'no-reply@fsi.com',
		      );
			
	    } elseif($mode === 'reset_password') {
		    $params = array(
		         'api_user' => $user,
		         'api_key' => $pass,
		         'to' => $email,
		         'subject' => 'confirm email',
		         'html' => 'Your new password is '.$token.' Reset it to a more secure password by logging in and going to your settings.  http://www.afxcreates.com/review/fsi_beta/' ,
		         'text' => 'Your new password is '.$token.' Reset it to a more secure password by logging in and going to your settings.  http://www.afxcreates.com/review/fsi_beta/' ,
		         'from' => 'no-reply@fsi.com',
		      );
			
	    } else {
	    	
		    $params = array(
		         'api_user' => $user,
		         'api_key' => $pass,
		         'to' => $email,
		         'subject' => 'confirm email',
		         'html' => 'Please confirm your email address, http://www.afxcreates.com/review/fsi_beta/?view=confirm&id='.$uid ,
		         'text' => 'Please confirm your email address, http://www.afxcreates.com/review/fsi_beta/?view=confirm&id='.$uid ,
		         'from' => 'no-reply@fsi.com',
		      );
	    }
	   

	    $request = $url.'api/mail.send.json';

	    // Generate curl request
	    $session = curl_init($request);

	    // Tell curl to use HTTP POST
	    curl_setopt ($session, CURLOPT_POST, true);

	    // Tell curl that this is the body of the POST
	    curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

	    // Tell curl not to return headers, but do return the response
	    curl_setopt($session, CURLOPT_HEADER, false);
	    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	    // obtain response
	    $response = curl_exec($session);
	    curl_close($session);

	    // print everything out
	    //print_r($response);
		
		
	  }
	  
	  
  
	  
	  
	public function uploader($file, $temp_file, $upload_dir)	{
		/*
	
            $this->request->data['submittedfile'] = [
               'name' => 'conference_schedule.pdf',
               'type' => 'application/pdf',
               'tmp_name' => 'C:/WINDOWS/TEMP/php1EE.tmp',
               'error' => 0, // On Windows this can be a string.
               'size' => 41737,
            ];
	
		*/
	   
		//$upload_dir = $_SERVER['DOCUMENT_ROOT']."/review/fsi_beta/reports/";
		//$target_dir = getcwd() . "/reports/";
	    $base_path = getcwd();
	    //$upload_dir = "/reports/";
		//$target_dir = $base_path.$upload_dir;
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/review/fsi_beta".$upload_dir;
		//echo $target_dir;
		$target_file = $target_dir . basename($file);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
	    
			$check = getimagesize($temp_file);
		    $uploadOk = 1;

		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    //$this->Flash->error(__('Report file already exists.'));
		    $uploadOk = 0;
		}
		// Check file size
		if ($temp_file > 500000) {
		    //$this->Flash->error(__('File size violation. Please, try again.'));
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
			//$this->Flash->error(__('Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed. Please, try again.'));
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    //$this->Flash->error(__('Error. Please, try again.'));
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($temp_file, $target_file)) {
				
				return true;
		    } else {
		        
		    }
		}

	}
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  

     
     

	
}//ends class


?>