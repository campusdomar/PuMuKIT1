<?php

/**
 * BroadcatPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'broadcast'. Tabla que almacena las difusiones, 
 * que proporcionan los distintos niveles de seguridad que 
 * pueden tener el contenido de los diferentes objetos 
 * multimedia existentes.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */
class BroadcastPeer extends BaseBroadcastPeer
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
   * @return class Broadcast
   */
  public static function getDefaultSel()
  {
    return sfPropelActAsSortableBehavior::getDefaultSelect(__CLASS__);
  }
}
