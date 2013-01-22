<?php

/**
 * NoticePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'notice'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class NoticePeer extends BaseNoticePeer
{

  /**
   * Devuelve la lista de noticias publicas ordenadas por fecha.
   *
   *
   * @access public
   * @param string $culture Cultura de las noticias
   * @param integer $num numero de noticias
   * @return Resulset of Notices
   */
  public static function doListWithI18n($culture, $num = 0)
  {
    $c = new Criteria();
    $c->add(NoticePeer::WORKING, false);
    $c->addDescendingOrderByColumn(NoticePeer::DATE);
    if ($num!=0) $c->setLimit($num);
    return parent::doSelectWithI18n($c, $culture);
  }
  
}
