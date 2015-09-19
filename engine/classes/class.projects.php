<?php


class Projects extends Booter {

    public $id;
	public $provider;

    function __construct($id,$provider)
	{
		
		//Sanitize
		$this->id = sanitize($id);
		$this->provider = sanitize($provider);
	}

        
        #get the master id referenced by active session oauth_uid
        public function addProject($data){
           $db = Database::obtain();
           $data['created'] = "NOW()";// it knows to convert NULL and NOW() from a string
           $data['modified'] = "NOW()";
           $db->insert("projects", $data);
      }
	  
      #get the master id referenced by active session oauth_uid
      public function addCategory($data){
         $db = Database::obtain();
         $data['created'] = "NOW()";// it knows to convert NULL and NOW() from a string
         $data['modified'] = "NOW()";
         $db->insert("project_categories", $data);
    }

        #update a project field
        public function updateProjectField($uid, $info, $field_name){
           $db = Database::obtain();
           $data[$field_name] = $info;
           $db->update("projects", $data, "id='".$uid."'");
        }
		
		
        #update a project field
        public function updateCategoryField($uid, $info, $field_name){
           $db = Database::obtain();           
           $data[$field_name] = $info;
           $db->update("project_categories", $data, "id='".$uid."'");
        }

       #get project for a master id
       public function getProject($master_id){
          $db = Database::obtain();
          $sql = "select * from projects where master_id = '".$master_id."' ";
          $r = $db->fetch_array($sql);           
          return $r;
      }
	
      #get my likes by master_id
       public function getLikes($master_id){
          $db = Database::obtain();
          $sql = "select * from likes where master_id = '".$master_id."' ";
          $r = $db->fetch_array($sql);
          return $r;
      }

      #get my places by master_id
       public function getPlaces($master_id){
          $db = Database::obtain();
          $sql = "select * from places where master_id = '".$master_id."' ";
          $r = $db->fetch_array($sql);
          return $r;
      }


	  public function get_projects(){
	         $db = Database::obtain();
	         $sql = "select * from projects WHERE active=1 ORDER BY created DESC";
	         $info = $db->fetch_array($sql);
	         return $info;
	    }
		
  	  public function get_project($name){
  	         $db = Database::obtain();
  	         $sql = "select * from projects p, project_categories pc WHERE p.active=1 AND p.project_category_id = pc.id AND pc.name = '".$name."' ";
			 $info = $db->fetch_array($sql);
  	         return $info;
  	    }
		
		
  	  public function get_categories(){
  	         $db = Database::obtain();
  	         $sql = "select * from project_categories";
  	         $info = $db->fetch_array($sql);
  	         return $info;
  	    }
		

        public function get_category_name($uid){
	   
           $db = Database::obtain();
           $sql = "select name from project_categories where id = '".$uid."' ";
  		   $r = $db->query_first($sql);
           return $r;

       }
	   

       public function get_category_icon($uid){
   
          $db = Database::obtain();
          $sql = "select icon from project_categories where id = '".$uid."' ";
 		  $r = $db->query_first($sql);
          return $r;

      }
	  
		

       public function get_my_projects($uid){
            $db = Database::obtain();
            $sql = "select * from projects where client_id = '".$uid."' ";
            $r = $db->fetch_array($sql);
            return $r;
        }
		
		public function delete($uid){
			$db = Database::obtain();
			$sql = "DELETE FROM projects WHERE id='".$db->escape($uid)."'";
	        $db->query($sql);
			
		}
		
		public function deleteProject($uid){
			$db = Database::obtain();
			$sql = "DELETE FROM projects WHERE id='".$db->escape($uid)."'";
	        $db->query($sql);
			
		}
		
		public function deleteCategory($uid){
			$db = Database::obtain();
			$sql = "DELETE FROM project_categories WHERE id='".$db->escape($uid)."'";
	        $db->query($sql);
			
		}
		

		public function uploader($file, $temp_file, $upload_dir) {
		
		    $base_path = getcwd();
			$target_dir = $_SERVER['DOCUMENT_ROOT']."/review/fsi_beta".$upload_dir;
			$target_file = $target_dir . basename($file);
			$uploadOk = 1;
			
            //if file exists delete it since it's being overwritten or changed
			if(file_exists($target_file)){
				unlink($target_file);
			}
			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
		    
				$check = getimagesize($temp_file);
			    $uploadOk = 1;
	
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    $uploadOk = 0;
			}
			// Check file size
			if ($temp_file > 500000) {
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
			    $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
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
