<?php


class Booter {
	//I am an master application class all classes that are part of a action, model or template inherit me.  
	//I hold nifty helper functions as well that other classes may need to function more effeciently. and not waste coding time. 
	
    public $id;
	public $provider;

    function __construct($id,$provider)
	{
		
		//Sanitize
		$this->id = sanitize($id);
		$this->provider = sanitize($provider);
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
    
	
	
	
	
	
	
	
	
	
	
	
	
	
}//ends class


?>
