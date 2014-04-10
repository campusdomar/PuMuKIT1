<?php

/**
 * Subclass for representing a row from the 'cpu' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Cpu extends BaseCpu
{
  /**
   *
   *
   */  
  public function isActive($cmd = "time /T")
  {
    $ch = curl_init('http://'.$this->getIp().'/webserver.php'); 
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic ". base64_encode($this->getUser().':'.$this->getPassword())));
    curl_setopt ($ch, CURLOPT_POST, 1); 
    curl_setopt ($ch, CURLOPT_POSTFIELDS, "ruta= " . $cmd); 
    curl_setopt ($ch, CURLOPT_TIMEOUT, 1);
    
    
    $var = curl_exec($ch); 
    $error = curl_error($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //echo $var;

    if ($status == 200) return true;
    else{
      if ($this->getNumber() > 0){
        $this->setMin(0);
        $this->setNumber(0);
        $this->save();
      }
      return false;
    }
    return true;
  }


  /**
   *
   *
   *
   */
  public function getNumUsed()
  {
    $c = new Criteria();
    $c->addJoin(CpuPeer::ID, TranscodingPeer::CPU_ID);
    $c->add(CpuPeer::ID, $this->getId());
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_EJECUTANDOSE);
    
    return TranscodingPeer::doCount($c);
  }

}



