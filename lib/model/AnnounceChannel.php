<?php

/**
 * Subclass for representing a row from the 'announce_channel' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AnnounceChannel extends BaseAnnounceChannel
{
  public function announceMm(Mm $mm){
    $aux = AnnounceChannelMmPeer::retrieveByPK($this->getId(), $mm->getId());
    if(is_null($aux)){
      $aux = new AnnounceChannelMm();
      $aux->setMm($mm);
      $aux->setAnnounceChannel($this);
      $aux->setStatusId(3);
      $aux->save();
    }

    $class_name = $this->getName() . "Announce";
    $class = new $class_name;
    $class->announceMm($mm);
    

    $log = date("c") . " - Objeto Multimedia ". $mm->getId() . ": " .$this->getId() . "[" . $this->getName() . "]";
    file_put_contents(sfConfig::get('sf_log_dir') . '/announces.log', $log . " \n", FILE_APPEND);    
  }

  public function announceSerial(Serial $serial){
    $aux = AnnounceChannelSerialPeer::retrieveByPK($this->getId(), $serial->getId());
    if(is_null($aux)){
      $aux = new AnnounceChannelSerial();
      $aux->setSerial($serial);
      $aux->setAnnounceChannel($this);
      $aux->setStatusId(3);
      $aux->save();
    }

    $class_name = $this->getName() . "Announce";
    $class = new $class_name;
    $class->announceSerial($serial);
    

    $log = date("c") . " - Serie ". $serial->getId() . ": " .$this->getId() . "[" . $this->getName() . "]";
    file_put_contents(sfConfig::get('sf_log_dir') . '/announces.log', $log . " \n", FILE_APPEND);    
  }
}

