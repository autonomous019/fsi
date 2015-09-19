<?php

define("ROOT_DIR", __dir__ . DIRECTORY_SEPARATOR);

function sendGridLoader($string)
{
  if(preg_match("/SendGrid/", $string))
  {
    $file = str_replace('\\', '/', "/dev/vendors/sendgrid/SendGrid/Smtp.php");
    require_once $_SERVER['DOCUMENT_ROOT'] . $file;
  }
}

spl_autoload_register("sendGridLoader");