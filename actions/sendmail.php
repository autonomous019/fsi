<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/dev/config.inc.php');
$session_name = session_name("getP");
ini_set('session.cookie_domain', '.cutruncut.com');
//ini_set('session.save_path', $_SERVER['DOCUMENT_ROOT'].'/dev/session'););
session_start();

$story_id = $_REQUEST['story_id'];
$from = $_REQUEST['from'];
$url = $_REQUEST['url'];
$message = $_REQUEST['message'];
$sender_id = $_REQUEST['sender_id'];
$creator_id = $_REQUEST['creator_id'];
$to_email = $_REQUEST['email'];

if(isset($_REQUEST['mode'])){
    $mode = $_REQUEST['mode'];
} else {
    $mode = 'default';
}

    if(empty($_SESSION['my_id'])){
         $_SESSION['my_id'] = $_SESSION['id'];
    }
    $_SESSION['email'] = $from;
    
    $my_user_id = $_SESSION['my_id'];

	$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
    $db->connect();
	$s = new Stories('member', BASE_DOMAIN, '' );
	
    
    $sl = $s->getStoryCreator($story_id);

    foreach($sl as $s){
    
            $to_email = $s['email'];
            $first_name = $s['first_name'];
            $creator_id = $s['master_id'];    

        }
        
if($mode == 'share'){

    $to_email = $_REQUEST['email']; 
    // echo "Share ".$to_email . "<br />"; 
}


//send to db
$se = new Stories('member', BASE_DOMAIN, '' );
$se->sendEmail($to_email, $from, $message, $story_id, $sender_id, $creator_id, $from);
if($mode != 'share'){
    $se->updateClaim($story_id, '1', $sender_id);
}
//register as claimer in interest



$mail = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSendmail(); // telling the class to use SendMail transport

$body = "<body style=\"margin: 10px;\">
<div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
<div align=\"center\"><img src=\"http://www.getpublicized.com/pg/img/p-story.png\"  style=\"height: 90px; width: 90px\"></div><br>
<br>
".$first_name." &nbsp;Interest Email<br>
<br>

<br>
this person is interested in this story: 
<a href=\"".$url."\" >client story</a>
<br />
Message:<br />
<blockquote>".$message."</blockquote>
</div>
</body>
";

$body = eregi_replace("[\]",'',$body);

$mail->AddReplyTo($from,"");

$mail->SetFrom($from, 'Get-P User');

$address = $to_email;
$mail->AddAddress($address, "");

$mail->Subject    = "GetP - Interest Indicated";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/dev/img/p-story.png");      // attachment
//$mail->AddAttachment($_SERVER['DOCUMENT_ROOT']."/dev/vendors/phpmailer/examples/images/phpmailer_mini.gif"); // attachment
/*
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "<br /><br /><h5>Message sent!, still building redirecter hit the back button</h5>";
}
*/

 $url = 'http://sendgrid.com/';
 $user = 'gpcrew';
 $pass = 'maryjane23'; 

$json_string = array(

  'category' => $story_id
);

//https://sendgrid.com/api/stats.get.xml?api_user=gpcrew&api_key=maryjane23&days=2   XML
//https://sendgrid.com/api/stats.get.json?api_user=gpcrew&api_key=maryjane23&days=2   JSON

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => $to_email,
      'subject' => 'GetP- Interest Notice',
      'html' => $body,
      'x-smtpapi' => json_encode($json_string),
      'text' => 'tblah blah blah',
      'from' => $from,
   );

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
// print_r($response);

//header("Location: /dev/index.php#/story_detail/".$story_id);




?>
