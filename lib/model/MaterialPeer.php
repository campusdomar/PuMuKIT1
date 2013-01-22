<?php

/**
 * MaterialPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'material'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MaterialPeer extends BaseMaterialPeer
{

  /**
   * Sobrecarga la funcion doDelete para borrar, si existe,
   * el archivo alojado en el servidor.
   *
   */
  public static function doDelete($values, $con = null)
  {
    if ($values instanceof Material){
      //strstr($values->getUrl(), '/uploads/material/') and unlink(sfConfig::get('sf_upload_dir').'/..'.$values->getUrl());
    }
    parent::doDelete($values, $con);
  }


  /**
   * Devuelve todos los materiales asociados al objeto
   * multimedia cuya id se pasa por parametro.
   *
   * @param integer $id id del objeto multimedia
   * @param string $culture cultura en la que se desea completar los materiales
   * @return ResulSet de objetos Material.
   */
  public static function getMaterialsFromMm($id, $culture)
  {
    $criteria = new Criteria();
    $criteria->add(MaterialPeer::MM_ID, $id);
    $criteria->addAscendingOrderByColumn(MaterialPeer::RANK);

    return MaterialPeer::doSelectWithI18n($criteria, $culture);
  }

}
