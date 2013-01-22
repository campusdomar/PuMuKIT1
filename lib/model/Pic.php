<?php

/**
 * Pic (class)
 *
 * Clase que representa una entrada en la
 * tabla 'pic'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 0.45
 *
 * @package Pumukit-lib.model
 */
class Pic extends BasePic
{
  
  /**
   * Modifica funcion url para poder obligar a que la url devuelta sea absoluta.
   *
   * @access public
   * @param boolean $absolute indica tipo de url (por defecto relativa)
   * @return string url
   **/
  public function getUrl($absolute = false)
  {
    $url = parent::getUrl();
    if (($absolute)&&(!strstr($url, 'http://'))) $url = sfConfig::get('app_info_link'). $url;
    
    return $url;
  }  


  public function getFile(){
    $url = parent::getUrl();
    return sfConfig::get('sf_web_dir') . $url;
  }


  
  /**
   * Method perform a DELETE on the database avoiding on cascade, given a Pic.
   *
   * @param      mixed $values Criteria or Pic object or primary key or array of primary keys
   *              which is used to create the DELETE statement
   * @param      Connection $con the connection to use
   * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
   *				if supported by native driver or if emulated using Propel.
   * @throws     PropelException Any exceptions caught during processing will be
   *		 rethrown wrapped into a PropelException.
   */
  public function noCascadeDelete()
  {
    //elimina la imagen    
    strstr($this->getUrl(), '/uploads/pic/') and unlink(sfConfig::get('sf_upload_dir').'/..'.$this->getUrl());
    
    $con = Propel::getConnection(PicPeer::DATABASE_NAME);
    
    $criteria = $this->buildPkeyCriteria();
    
    $criteria->setDbName(PicPeer::DATABASE_NAME);
    
    $affectedRows = 0; // initialize var to track total num of affected rows
    
    try {
      $con->begin();
      $affectedRows += BasePeer::doDelete($criteria, $con);
      $con->commit();
      return $affectedRows;
    } catch (PropelException $e) {
      $con->rollback();
      throw $e;
    }
  }

}
