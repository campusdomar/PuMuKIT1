<?php

/**
 * LinkPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'link'. Tabla que se utiliza
 * para relacionar Videos con Personas con Rols(N:M)
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class LinkPeer extends BaseLinkPeer
{
  /**
   *
   *
   *
   */
  public static function getLinksFromMm($id, $culture)
  {
    $criteria = new Criteria();
    $criteria->add(LinkPeer::MM_ID, $id);
    $criteria->addAscendingOrderByColumn(LinkPeer::RANK);

    return LinkPeer::doSelectWithI18n($criteria, $culture);
  }

}
