<?php

/**
 * MODULO ROLE ACTIONS. 
 * Modulo de administracion de las rols que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage role
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class rolesActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/roles
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/role'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/role');
  }


  /**
   * --  LIST -- /editar.php/roles/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('roles', 'list');
  }


  /**
   * --  CREATE -- /editar.php/roles/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->role = new Role();

    $this->role->setDisplay(false);    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/roles/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->role);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/roles/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $role = new Role();
    }
    else
    {
      $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($role);
    }

    $role->setDisplay($this->getRequestParameter('display', ' '));
    $role->setXml($this->getRequestParameter('xml', ' '));
    $role->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $role->setCulture($lang);
      $role->setName($this->getRequestParameter('name_'. $lang, ' '));
      $role->setText($this->getRequestParameter('text_'. $lang, ' '));
    }

    try{
      $role->save();
      $this->msg_alert = array('info', "Metadatos del rol actualizados.");
    }catch(Exception $e){
      $this->msg_alert = array('error', "Codigo de rol repetido.");
    }
      
    $this->getUser()->setAttribute('id', $role->getId(), 'tv_admin/role');

    return $this->renderComponent('roles', 'list');
  }

  /**
   * --  DELETE -- /editar.php/roles/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $roles = array_reverse(RolePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids'))));

      foreach($roles as $role){
	$role->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
      $role->delete();
    }

    $this->msg_alert = array('info', "Rol borrado.");
    return $this->renderComponent('roles', 'list');
  }

   /**
   * --  COPY -- /editar.php/roles/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($role);

    try
    {
      $role2 = new Role();
      
      $role2->setCod('change');
      $role2->setXml($role->getXml());
      $role2->setDisplay($role->getDisplay());
      
      $langs = sfConfig::get('app_lang_array', array('es'));
      foreach($langs as $lang){
	$role->setCulture($lang);
	$role2->setCulture($lang);
	$role2->setName($role->getName());
	$role2->setText($role->getText());
      }
      
      $this->msg_alert = array('info', "Rol copiado");
      $role2->save();
    }
    catch (Exception $e){
      $this->msg_alert = array('error', "Codigo del rol repetido");
    };


    return $this->renderComponent('roles', 'list');
  }

  /**
   * --  PREVIEW -- /editar.php/roles/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/role');
    }
    return $this->renderText('OK');
  }

  /**
   * --  UP -- /editar.php/roles/ip
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeUp()
  {
    $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($role);

    $role->moveUp();
    $role->save();

    return $this->renderComponent('roles', 'list');
  }

  /**
   * --  DOWN -- /editar.php/roles/down
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDown()
  {
    $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($role);

    $role->moveDown();
    $role->save();

    return $this->renderComponent('roles', 'list');
  }


  /**
   * --  TOP -- /editar.php/roles/top
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeTop()
  {
    $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($role);

    $role->moveToTop();
    $role->save();

    return $this->renderComponent('roles', 'list');
  }


  /**
   * --  BUTTON -- /editar.php/roles/button
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeBottom()
  {
    $role = RolePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($role);

    $role->moveToBottom();
    $role->save();

    return $this->renderComponent('roles', 'list');
  }
}
