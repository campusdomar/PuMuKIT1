<?php

/**
 * Subclass for performing query and update operations on the 'pic_serial' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicSerialPeer extends BasePicSerialPeer
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
    if ($values instanceof PicSerial){
      $pic = $values->getPic();
      if (($pic->countPicPersons() + $pic->countPicSerials() + $pic->countPicMms()) == 1)
	$pic->delete();
    }
    parent::doDelete($values, $con);
  }

}
