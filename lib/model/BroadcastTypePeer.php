<?php

/**
 * BroadcatTypePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'broadcast_type'. Tabla que almacena 
 * los tipos de difusiones en los que se clasifican los 
 * difusiones de los objetos multimedia existentes.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class BroadcastTypePeer extends BaseBroadcastTypePeer
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
   * @return class BroadcastType
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
}
