<?php 

abstract class BaseAnnounce
{
  protected $name;

  abstract public function announceMm(Mm $mm);
  abstract public function announceSerial(Serial $mm);
  abstract public function getName();


  public function __install(){
    $aux = new AnnounceChannel();
    $aux->setName($this->getName());
    $aux->setBroadcastYypeId(1);
    $aux->save();
  }


}