<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/dev/config.inc.php');
$session_name = session_name("getP");
ini_set('session.cookie_domain', '.'.BASE_DOMAIN);
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'].'/dev/session'););
session_start();

    if(empty($_SESSION['id']) || $_SESSION['role'] == 'member'){
         //header("Location: #/home");
    }
    
    
  
    
    $my_user_id = $_SESSION['my_id'];

	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$c = new Clients('member', BASE_DOMAIN, '' );
	$s = new Stories('member', BASE_DOMAIN, '' );
	$h = new Helpers();

    $roler = $_SESSION['role'];
?>

<h1>My Profile</h1>


<?php require_once($_SERVER['DOCUMENT_ROOT']."/dev/actions/profile_edit.php"); ?>



Update Email:<br />

<?php require_once($_SERVER['DOCUMENT_ROOT']."/dev/actions/user_email_update.php"); ?>

<hr>
<?php if($roler == 'member'){ ?>



<?php
//$follows = $c->getMyClients($my_user_id);
/*
foreach($follows as $f){
    echo "<b><a href=\"/dev/#/client_detail/".$f['client_id']."\" >".$f['title']."</a></b><br />";
}
*/

//$blocks = $c->getMyBlocks($my_user_id);
/*
foreach($blocks as $b){
    echo "<b><a href=\"/dev/#/client_detail/".$b['blocked_id']."\" >".$b['title']."</a></b><br />";
}
*/
?>





    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
   <script>
 $("#block_all").click(function () {

                 var contexter = $('#block_all').val(); 
                 var object_id = $('#block_id_data').val();
                
                 
             
		         if(contexter == 'Block'){

		            var dataString = "object_id=0&creator_id=<?php echo $my_user_id; ?>&context=status&data=1&module=users_to_blocks&mode=add&object_type=all";
		    
		            $.ajax({
                        type: "POST",
                        url: "actions/block.php",
                        data: dataString,
                        success: function() {
                           
                             $('#block_all').attr('value', 'Un-Block');
                             $('#block_all').text('Un-Block');
                        }
                    });
		            
		        } else {
		            
		            var dataString = "object_id=0&creator_id=<?php echo $my_user_id; ?>&context=status&data=0&module=users_to_blocks&mode=other&object_type=all";
		          
		            $.ajax({
                        type: "POST",
                        url: "actions/block.php",
                        data: dataString,
                        success: function() {
                             $('#block_all').attr('value', 'Block');
                             $('#block_all').text('Block');
                        }
                    });
		             
		             
		        }     
	                  
                      
                      
           });
           
</script>




<hr>
<?php } ?>



<br />


