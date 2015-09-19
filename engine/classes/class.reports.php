<?php


class Reports {

    public $id;
	public $provider;

    function __construct($id,$provider)
	{
		
		//Sanitize
		$this->id = sanitize($id);
		$this->provider = sanitize($provider);
	}

        
        #get the master id referenced by active session oauth_uid
        public function addReport($data){
           $db = Database::obtain();
           
           
           $data['created'] = "NOW()";// it knows to convert NULL and NOW() from a string
           $data['modified'] = "NOW()";
           $db->insert("reports", $data);
      }

        #update a report field
        public function updateReportField($uid, $info, $field_name){
           $db = Database::obtain();
           
           $data[$field_name] = $info;
           //$db->update("reports", $data, $master_id);
           $db->update("reports", $data, "id='".$uid."'");
        }

       #get report for a master id
       public function getReport($uid){
		   
          $db = Database::obtain();
          $sql = "select * from reports where id = '".$uid."' ";
          $r = $db->fetch_array($sql);
          return $r;

      }
	  
      #get report for a master id
      public function get_report($uid){
	   
          $db = Database::obtain();
         $sql = "select * from reports where id = '".$uid."' ";
		 echo $sql;
         $r = $db->fetch_array($sql);
		 //print_r($r);
         return $r;

     }
	  


     public function search_counter($keyword, $mode){
        $db = Database::obtain();
	    //mode is field, yaeh, thats called not writing code that self documents. 
	  
	  if($mode === 'client_id'){
		  $field = 'client_id';
		  $sql = "select * from reports where ".$field. " = '".$keyword."'";
	  } elseif ($mode === 'location'){
	  	  $field = 'location';
		  $sql = "select * from reports where ".$field. " LIKE '%".$keyword."%'";
	  }  elseif ($mode === 'year'){
	  	  $field = 'created';
		  $sql = "SELECT * FROM reports WHERE ".$field." BETWEEN '".$keyword."-01-01 00:00:00' AND '".$keyword."-12-25 23:59:59' ";
		  
	  } else {
	  	  $field = 'name';
		  $sql = "select * from reports where ".$field. " LIKE '%".$keyword."%'";
	  }
     
        $r = $db->fetch_array($sql);
	  //return json_encode($r);
        return count($r);

    }
 
      
       public function search($keyword, $mode, $start, $range){
		   //see search_counter above if you change this, counter needs adjusted, ugly OO design I know. 
          $db = Database::obtain();

		  
		  if($mode === 'client_id'){
			  $field = 'client_id';
			  $sql = "select * from reports where ".$field. " = '".$keyword."' LIMIT ".$start.", ".$range;
		  } elseif ($mode === 'location'){
		  	  $field = 'location';
			  $sql = "select * from reports where ".$field. " LIKE '%".$keyword."%'  LIMIT ".$start.", ".$range;
		  }  elseif ($mode === 'year'){
		  	  $field = 'created';
			  $sql = "SELECT * FROM reports WHERE ".$field." BETWEEN '".$keyword."-01-01 00:00:00' AND '".$keyword."-12-25 23:59:59' LIMIT ".$start.", ".$range;
			  
		  } else {
		  	  $field = 'name';
			  $sql = "select * from reports where ".$field. " LIKE '%".$keyword."%'  LIMIT ".$start.", ".$range;
		  }
          //echo $sql;
          $r = $db->fetch_array($sql);
		  //return json_encode($r);
          return $r;

      }


	  public function get_reports($start, $range){
	         $db = Database::obtain();
	         $sql = "select * from reports WHERE active = 1 ORDER BY created DESC LIMIT ".$start.", ".$range;
			 //echo $sql;
	         $info = $db->fetch_array($sql);
	         return $info;
	    }
		
  	  public function count_reports(){
  	         $db = Database::obtain();
  	         $sql = "select * from reports WHERE active = 1 ORDER BY created DESC";
  	         $info = $db->fetch_array($sql);
  	         return count($info);
  	    }
		
		
        #get my places by master_id
         public function get_my_reports($uid){
            $db = Database::obtain();
            $sql = "select * from reports where client_id = '".$uid."' ";
            $r = $db->fetch_array($sql);

            return $r;


        }
		
		public function delete($uid){
			$db = Database::obtain();
			$sql = "DELETE FROM reports WHERE id='".$db->escape($uid)."'";
            //echo $sql;
	        $db->query($sql);
			
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
