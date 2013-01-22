<?php
/**
 * MODULO PICS COMPONENTS. 
 * Modulo de administracion de las lugares donde se graban los 
 * objetos multimedia.
 *
 * @package    pumukit
 * @subpackage pics
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class picsComponents extends sfComponents
{
  /**
   * Executes list component
   *
   */
  public function executeList()
  {
    if (isset($this->mm)){
      $this->object_id = $this->mm;
      $this->pics = PicPeer::getPicsFromMm($this->object_id);
      $this->que = 'mm';
    }elseif (isset($this->serial)){
      $this->object_id = $this->serial;
      $this->pics = PicPeer::getPicsFromSerial($this->object_id);
      $this->que = 'serial';
    }elseif (isset($this->channel)){
      $this->object_id = $this->channel;
      $this->pics = PicPeer::getPicsFromChannel($this->object_id);
      $this->que = 'channel';
    }elseif ($this->hasRequestParameter('mm')){
      $this->object_id = $this->getRequestParameter('mm');
      $this->pics = PicPeer::getPicsFromMm($this->object_id);
      $this->que = 'mm';
    }elseif ($this->hasRequestParameter('serial')){
      $this->object_id = $this->getRequestParameter('serial');
      $this->pics = PicPeer::getPicsFromSerial($this->object_id);
      $this->que = 'serial';
    }elseif ($this->hasRequestParameter('channel')){
      $this->object_id = $this->getRequestParameter('channel');
      $this->pics = PicPeer::getPicsFromChannel($this->object_id);
      $this->que = 'channel';
    }else{
      $this->pics = array();
      $this->object_id = 0;
      $this->que = 'nada';
    }
  }
}
