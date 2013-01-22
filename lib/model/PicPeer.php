<?php

/**
 * PicPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'pic'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicPeer extends BasePicPeer
{

  /**
   * Devuleve la lista de imagenes de una serie
   *
   * @access public
   * @param integer $id id de la serie
   * @return Resulset of Pic
   */
  public static function getPicsFromSerial($id)
  {
    $criteria = new Criteria();
    $criteria->addJoin(PicPeer::ID, PicSerialPeer::PIC_ID);
    $criteria->add(PicSerialPeer::OTHER_ID, $id);
    $criteria->addAscendingOrderByColumn(PicSerialPeer::RANK);

    return PicPeer::doSelect($criteria);
  }


  /**
   * Devuleve la lista de imagenes de una serie
   *
   * @access public
   * @param integer $id id de la serie
   * @return Resulset of Pic
   */
  public static function getPicsFromMm($id)
  {
    $criteria = new Criteria();
    $criteria->addJoin(PicPeer::ID, PicMmPeer::PIC_ID);
    $criteria->add(PicMmPeer::OTHER_ID, $id);
    $criteria->addAscendingOrderByColumn(PicMmPeer::RANK);

    return PicPeer::doSelect($criteria);
  }


  /**
   * Sobrecarga la funcion doDelete para borrar, si existe,
   * el archivo alojado en el servidor.
   *
   * @param      mixed $values Criteria or Material object or primary key or array of primary keys
   *              which is used to create the DELETE statement
   * @param      Connection $con the connection to use
   */
  public static function doDelete($values, $con = null)
  {
    if ($values instanceof Pic){
      strstr($values->getUrl(), '/uploads/pic/') and unlink(sfConfig::get('sf_upload_dir').'/..'.$values->getUrl());
    }
    parent::doDelete($values, $con);
  }

}
