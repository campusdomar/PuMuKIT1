<?php

define("USER", "pumukit");
define("PASSWORD", "PUMUKIT");


function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
 } 

function showLogin() {
  header('WWW-Authenticate: Basic realm="Demo System"');
  header('HTTP/1.0 401 Unauthorized');
  echo "Usted no tiene permisos para ingresar.\n";
  exit;
  }


//echo '<br />Bienvenido a Webserver.php<br />';
$username = $_SERVER['PHP_AUTH_USER'];
$userpass = $_SERVER['PHP_AUTH_PW'];
if (!isset($username)) {
  showLogin();
 } else {
  if ($username == USER && $userpass == PASSWORD ) {
    header('HTTP/1.0 200 OK');
    header('Content-Type: text/html');
    
    if(isset($_POST['ruta'])) {

      set_time_limit(0);
      ini_set('memory_set','-1');
      echo "\n (webserver.php) ".stripslashes($_POST['ruta']);
    
      var_dump("ANTES");

      //cambiamos path del php
      $tempDir = '/tmp/'.sha1(time().rand())."/";
      @mkdir($tempDir, 0777, true);
    
      $dcurrent = getcwd();
      chdir($tempDir);
      
      exec(stripslashes($_POST['ruta']), $salida);
      
      //devolvemos el path inicial
      chdir($dcurrent);
      
      var_dump("DESPUES");
      var_dump($salida);
      
      file_put_contents('./log/log_trans.log', stripslashes($_POST['ruta']) .
			"\n" . implode("\n", $salida) . "\n\n\n", FILE_APPEND);
      
      echo implode("\n", $salida);
    } else {

      echo "Welcome to Transco PuMuKIT \n";
    }

    //borramos ficheros temporales creados

    rrmdir ($tempDir);
  } else {
    showLogin();
  }
 }
