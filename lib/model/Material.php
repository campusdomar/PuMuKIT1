<?php

/**
 * Material (class)
 *
 * Clase que representa una entrada en la
 * tabla 'material'. Si el material se encuentra
 * en el servidor el objeto esta relacionado con 
 * el, es decir si se borra uno se borra el otro.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Material extends BaseMaterial
{

  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return $this->getName();
  }


  /**
   * Acceso directo al MimeType del material
   *
   * @access public
   * @return string del mimeType 
   */
  public function getMimeType()
  {
    $this->getMatType()->getMimeType();
  }


  /**
   *  Modifica funcion url para poder obligar a que la url devuelta sea absoluta.
   *
   * @access public
   * @param boolean $absolute (default true) indica si la url devuesta es absoluta.
   * @return string url
   *
   **/
  public function getUrl($absolute = false)
  {
    $url = parent::getUrl();
    if (($absolute)&&(!strstr($url, 'http://'))) $url = sfConfig::get('app_info_link'). $url;
    
    return $url;
  }
}

/** Implementa comportamiento sortableFk segun mm_id */
sfPropelBehavior::add('Material', array('sortableFk' => array('f_key' => 'mm_id')));
