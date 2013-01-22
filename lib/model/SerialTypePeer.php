<?php

/**
 * SerialTypePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'serial_type'. Tabla que almacena los canales 
 * en los que se clasifican las series de objetos multimedia 
 * existentes.
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */
class SerialTypePeer extends BaseSerialTypePeer
{

  /**
   * Devuelve el id del serial_type que esta activado por defecto.
   * 
   * @access public
   * @return int id
   */
  public static function getDefaultSelId()
  {
    return DefaultSelectBehavior::getDefaultSelectId(__CLASS__);
  }

  /**
   * Devuelve el objeto serial_type que esta activado por defecto.
   * 
   * @access public
   * @return class SerialType
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
}
