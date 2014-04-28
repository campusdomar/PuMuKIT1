<?php
/**
 * MODULO SERIALTYPE ACTIONS. 
 * Modulo de administracion de las generos que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage serialtype
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */

class serialtypesActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/serialtypes
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/serialtype'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/serialtype');
  }

  /**
   * --  LIST -- /editar.php/serialtypes/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('serialtypes', 'list');
  }


  /**
   * --  CREATE -- /editar.php/serialtypes/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->serialtype = new SerialType();

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/serialtypes/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->serialtype = SerialTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->serialtype);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/serialtypes/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $serialtype = new SerialType();
    }
    else
    {
      $serialtype = SerialTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($serialtype);
    }

    $serialtype->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $serialtype->setCulture($lang);
      $serialtype->setName($this->getRequestParameter('name_'. $lang, ' '));
    }

    $serialtype->save();
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Metadatos del tipo de serie actualizados."));

    $this->getUser()->setAttribute('id', $serialtype->getId(), 'tv_admin/serialtype');

    return $this->renderComponent('serialtypes', 'list');
  }


  /**
   * --  DELETE -- /editar.php/serialtypes/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $serialtypes = SerialTypePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($serialtypes as $serialtype){
	$serialtype->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $serialtype = SerialTypePeer::retrieveByPk($this->getRequestParameter('id'));
      $serialtype->delete();
    }

    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Tipo de serie borrada."));
    return $this->renderComponent('serialtypes', 'list');
  }

  /**
   * --  COPY -- /editar.php/serialtypes/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $serialtype = SerialTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($serialtype);

    $serialtype2 = $serialtype->copy();
            
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $serialtype->setCulture($lang);
      $serialtype2->setCulture($lang);
      $serialtype2->setName($serialtype->getName());
    }
      
    $serialtype2->save();
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Tipo de serie clonada."));

    return $this->renderComponent('serialtypes', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/serialtypes/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/serialtype');
    }
    return $this->renderText('OK');
  }


  /**
   * --  DEFAULT -- /editar.php/serialtypes/default
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDefault()
  {
    $this->getResponse()->setContentType('text/javascript');
    $this->setLayout(false);
    $serialtype = SerialTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($serialtype);

    $serialtype->setDefaultSelect();
  }
}
