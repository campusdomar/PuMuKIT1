<?php
/**
 * MODULO MATTYPES ACTIONS. 
 * Modulo de administracion de los tipos de material que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage genre
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class mattypesActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/mattypes
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/mattype'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/mattype');
  }


  /**
   * --  LIST -- /editar.php/mattypes/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('mattypes', 'list');
  }



  /**
   * --  CREATE -- /editar.php/mattypes/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->mattype = new MatType();

    //$this->mattype->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->mattype->setType(' ');    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/mattypes/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->mattype = MatTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->mattype);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/mattypes/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $mattype = new MatType();
    }
    else
    {
      $mattype = MatTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($mattype);
    }

    $mattype->setType($this->getRequestParameter('type', ' '));
    $mattype->setMimeType($this->getRequestParameter('mimetype', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mattype->setCulture($lang);
      $mattype->setName($this->getRequestParameter('name_'. $lang, ' '));
    }
    try{
      $mattype->save();
      $this->msg_alert = array('info', "Metadatos del tipo de matial actualizados.");
      $this->getUser()->setAttribute('id', $mattype->getId(), 'tv_admin/mattype');
    }catch(Exception $e){
      $this->msg_alert = array('error', "Typo de material repetido.");
    }

    return $this->renderComponent('mattypes', 'list');
  }


  /**
   * --  DELETE -- /editar.php/mattypes/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $mattypes = MatTypePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($mattypes as $mattype){
	$mattype->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $mattype = MatTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $mattype->delete();
    }
    $this->msg_alert = array('info', "Tipo de material borrado.");
    return $this->renderComponent('mattypes', 'list');
  }


  /**
   * --  COPY -- /editar.php/mattypes/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $mattype = MatTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mattype);

    $mattype2 = $mattype->copy();
            
    $mattype2->setType('---');

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mattype->setCulture($lang);
      $mattype2->setCulture($lang);
      $mattype2->setName($mattype->getName());
    }
      
    try{
      $mattype2->save();
      $this->msg_alert = array('info', "Tipo de material clonado, modifique su extension");
    }catch(Exception $e){
      $this->msg_alert = array('error', "Tipo de material repetido.");
    }

    return $this->renderComponent('mattypes', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/mattypes/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/mattype');
    }
    return $this->renderText('OK');
  }



  /**
   * --  DEFAULT -- /editar.php/mattypes/default
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */ 
  public function executeDefault()
  {
    $this->getResponse()->setContentType('text/javascript');
    $this->setLayout(false);
    $mattype = MatTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($mattype);

    $mattype->setDefaultSelect();

  }
}
