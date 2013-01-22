<?php

/**
 * Subclass for representing a row from the 'serial_hash' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SerialHash extends BaseSerialHash
{
  public function getUrl($absolute = false, $preview = false) {
    //Hack
    $old = sfConfig::get('sf_no_script_name');
    sfConfig::set('sf_no_script_name', true);
    $controller = sfContext::getInstance()->getController();
    $route = array('module'=> 'serial', 'action' => 'index', 'hash' => $this->getHash());
    if ($preview) {
      $route['preview'] = 'true';
    }
    $url = $controller->genUrl($route, $absolute);
    sfConfig::set('sf_no_script_name', $old);
    return $url;
  }
}
