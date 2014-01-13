<?php

/**
 * Subclass for performing query and update operations on the 'pic_mm' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicMmPeer extends BasePicMmPeer
{
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
    if ($values instanceof PicMm){
      $pic = $values->getPic();
      if (($pic->countPicPersons() + $pic->countPicSerials() + $pic->countPicMms()) == 1)
	$pic->noCascadeDelete();
    }
   
    elseif($values instanceof Criteria){
      $mm_pics = PicMmPeer::doSelect($values);
      foreach($mm_pics as $mm_pic){
	$pic = $mm_pic->getPic();
	if ($pic) {
	  if (($pic->countPicPersons() + $pic->countPicSerials() + $pic->countPicMms()) == 1)
	    $pic->noCascadeDelete();
	}
      }
    }
    

    parent::doDelete($values, $con);
  }

}
