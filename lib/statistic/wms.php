<?php

/**
 * wms (class)
 *
 * Clase que porcesa los log de Windows Media Server para actualizar las estadisticas
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 0.1
 *
 * @package Pumukit-lib-statistics
 */


class wms{

  var $NUM = array();

  static function test()
  {
    echo "START\n";
    
    $path = '/mnt/statistics/53_wms';
    $logs = sfFinder::type('file')->in($path);
    foreach($logs as $log){
      $lines = file($log);
      
      foreach($lines as $line_num => $line){
	//Comentario
	if(substr($line, 0, 1) == "#") continue;
	
	$info = explode(" ", $line);
	if(substr($info[4], -4, 1) != '.'){
	  echo substr($info[4], -4, 1), '  -  ', $info[4], "\n";
	}else{
	  if(is_int($num[$info[4]])){
	    echo "SI\n";
	    $NUM[$info[4]]++;
	  }else{
	    $NUM[$info[4]] = 1;
	  }

	}

      }
      
    }

    var_dump($NUM);
  }
  

}

