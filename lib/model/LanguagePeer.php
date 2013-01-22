<?php

/**
 * LanguagePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'language'. Tabla que almacena los 
 * idiomas en los que se clasifican los archivos de 
 * video.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class LanguagePeer extends BaseLanguagePeer
{


  /**
   * Devuelve el Id del valor selecionado 
   * por defecto.
   * 
   * @access public
   * @return integer Id 
   */
  public static function getDefaultSelId()
  {
    return DefaultSelectBehavior::getDefaultSelectId(__CLASS__);
  }


  /**
   * Devuelve el valor selecionado por defecto.
   * 
   * @access public
   * @return class Language
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
}
