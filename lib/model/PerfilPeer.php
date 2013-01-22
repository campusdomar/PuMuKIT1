<?php

/**
 * Subclass for performing query and update operations on the 'perfil' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PerfilPeer extends BasePerfilPeer
{
  /**
   * Devuelve perfiles de codificacion en funcion del video. Ademas raw segun segundo parametro.
   * Perfiles <<Windows media encoder>>
   *   -Audio
   *   -Video 4:3
   *   -Video 16:9
   *
   * @access public
   * @return array
   */
  public static function doSelectForMm($path, $raw = true)
  {
    $movie = new ffmpeg_movie($path, false);
    $aux = array();
    if ($movie->getFrameHeight() == 0){
      $aux[] = 2;
    }else if(($movie->getFrameWidth()/$movie->getFrameHeight()) >1.7){
      $aux[] = 5;
    }else{
      $aux[] = 1;
    }

    if(strtoupper(substr($path, -4, 4)) == '.MOV'){
      $aux = array(11);
    }
    //si es ogg, ogv,flv mov devolver ffmpeg
    
    if($raw) {
      $aux[] = 7;
    }

    return PerfilPeer::retrieveByPks($aux);
  }


  /**
   * Devuelve perfiles auxiliares ffmpeg de codificacion en funcion del video. Ademas raw segun segundo parametro.
   * Perfiles <<Windows media encoder>>
   *   -Audio
   *   -Video 
   *
   * @access public
   * @return array
   */
  public static function doSelectForMmAux($path, $raw = true)
  {    
  }

  public static function doSelectToWizard($display = null)
  {
    $c = new Criteria();
    $c->add(PerfilPeer::WIZARD, true);

    if (!is_null($display)) {
      $c->add(PerfilPeer::DISPLAY, $display);
    }

    return PerfilPeer::doSelectWithI18n($c);
  }


}
