<?php
/**
 * MODULO MATERIALS ACTIONS. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los materiales de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage materials
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class materialsActions extends sfActions
{
  /**
   * --  LIST -- /editar.php/materials/list
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeList()
  {
    return $this->renderComponent('materials', 'list');
  }

  /**
   * --  CREATE -- /editar.php/materials/create
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeCreate()
  {
    $this->material = new Material();

    $this->material->setMmId($this->getRequestParameter('mm'));
    $this->material->setMatTypeId(MatTypePeer::getDefaultSelId());
    
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->default_sel = 'file';
    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/materials/edit
   *
   * Parametros por URL: Identificador del material
   *
   */
  public function executeEdit()
  {
    $this->material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->material);
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->default_sel = 'url';
  }


  /**
   * --  DELETE -- /editar.php/materials/delete
   *
   * Parametros por URL: Identificador del material
   *
   */
  public function executeDelete()
  {
    $material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($material);
    $material->delete();
    
    return $this->renderComponent('materials', 'list');
  }


  /**
   * --  UPDATE -- /editar.php/materials/update
   *
   * Parametros por POST
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $material = new Material();
    }
    else
    {
      $material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($material);
    }
    $material->setMmId($this->getRequestParameter('mm', 0));
    $material->setDisplay($this->getRequestParameter('display', 0));
    $material->setMatTypeId($this->getRequestParameter('mat_type_id', 0));
    if ($material->isNew()) $material->setUrl($this->getRequestParameter('url', 0));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $material->setCulture($lang);
      $material->setName($this->getRequestParameter('name_' . $lang, ' '));
    }
    
    $material->save();

    return $this->renderComponent('materials', 'list'); 
  }


  /**
   * --  UPLOAD -- /editar.php/materials/upload
   *
   * Parametros por POST
   *
   */
  public function executeUpload()
  {
    if (!$this->getRequestParameter('id'))
    {
      $material = new Material();
    }
    else
    {
      $material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($material);
    }
    $material->setMmId($this->getRequestParameter('mm', 0));
    $material->setDisplay($this->getRequestParameter('display', 0));
    $material->setMatTypeId($this->getRequestParameter('mat_type_id', 0));


    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $material->setCulture($lang);
      $material->setName($this->getRequestParameter('name_' . $lang, ' '));
    }


    if($this->getRequestParameter('file_type', 'url') == 'url'){
      if ($material->isNew()) $material->setUrl($this->getRequestParameter('url', 0));
      $material->save();

      $this->msg_info = 'Nueva material modificado.';
    }elseif($this->getRequestParameter('file_type', 'url') == 'file'){
      $currentDir = 'Video/' . $material->getMmId();      
      $absCurrentDir = sfConfig::get('sf_upload_dir').'/material/' . $currentDir;
      $fileName = $this->sanitizeFile($this->getRequest()->getFileName('file'));
      $this->getRequest()->moveFile('file', $absCurrentDir . '/' . $fileName);
      
      $material->setUrl('/uploads/material/' . $currentDir . '/' .  $fileName);
      $material->save();

      $this->msg_info = 'Nueva material subido e insertado.';
    }

    $this->mm = $material->getMmId();
  }

  /**
   * --  UP -- /editar.php/materials/up
   *
   * Parametros por URL: Identificador del material
   *
   */
  public function executeUp()
  {
    $material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($material);

    $material->moveUp();
    $material->save();

    return $this->renderComponent('materials', 'list');
  }

  /**
   * --  DOWN -- /editar.php/materials/down
   *
   * Parametros por URL: Identificador del material
   *
   */
  public function executeDown()
  {
    $material = MaterialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($material);

    $material->moveDown();
    $material->save();

    return $this->renderComponent('materials', 'list');
  }


  /*
   *
   */
  protected function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  protected function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}
