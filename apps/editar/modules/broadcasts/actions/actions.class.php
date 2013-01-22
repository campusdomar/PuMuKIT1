<?php
/**
 * MODULO BROADCAST ACTIONS.  
 * Modulo de administracion de las difusions que estan asociadas a algun
 * objeto multimedia del catalogo. Esta relacion se realiza a traves del
 * un rol. Las tabla difusions almacena los cargos por lo que una difusion
 * con dos cargos diferentes tendra dos entrasa en la base de datos.
 *
 * @package    pumukit
 * @subpackage index
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class broadcastsActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/broadcasts
   * Muestra el modulo de administracion de las difusions, con la vista previa, formulario
   * de filtrado, listado de usuarios y acciones de nuevo...
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('distri_menu','active');
    if (!$this->getUser()->setAttribute('page', 'tv_admin/broadcast'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/broadcast');
  }



  /**
   * --  LIST -- /editar.php/broadcasts/list
   * Muestra la tabla que lista de forma paginada y filtrada las difusions. Renderiza el componente
   * list para que sea accesibe como ajax.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('broadcasts', 'list');
  }

  /**
   * --  CREATE -- /editar.php/broadcasts/create
   * Muesta el formulario de edicion de la difusion nueva.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->broadcast = new Broadcast();

    $this->broadcast->setBroadcastTypeId(1);    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/broadcasts/edit/id/?
   * Muesta el formulario de edicion de la difusion cuyo identificador se pada como paremetro.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->broadcast = BroadcastPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->broadcast);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/broadcasts/update
   * Actualiza el contenido de una difusion con el resultado del formulario de modificacion.
   * Si no existe difusion con id dado se crea uno nuevo y se realizan validacion de email en 
   * el servidor. 
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $broadcast = new Broadcast();
    }
    else
    {
      $broadcast = BroadcastPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($broadcast);
    }

    $broadcast->setName($this->getRequestParameter('name', ' '));
    $broadcast->setBroadcastTypeId($this->getRequestParameter('broadcast_type_id', ' '));
    $broadcast->setPasswd($this->getRequestParameter('passwd', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $broadcast->setCulture($lang);
      $broadcast->setDescription($this->getRequestParameter('description_'. $lang, ' '));
    }

    $broadcast->save();
    $this->msg_alert = array('info', "Metadatos de la difusion actualizados.");
    $this->getUser()->setAttribute('id', $broadcast->getId(), 'tv_admin/broadcast');

    return $this->renderComponent('broadcasts', 'list');
  }


  /**
   * --  DELETE -- /editar.php/broadcasts/delete
   * Borrar una difusion de la base de datos si el parametro id se introduce en la URL, se 
   * pueden borrar varios difusions si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $broadcasts = BroadcastPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($broadcasts as $broadcast){
	$broadcast->delete();
      }
      $this->msg_alert = array('info', "Difusiones borradas correctamente.");

    }elseif($this->hasRequestParameter('id')){
      $broadcast = BroadcastPeer::retrieveByPk($this->getRequestParameter('id'));
      $broadcast->delete();
      $this->msg_alert = array('info', "Difusion borrada correctamente.");
    }

    return $this->renderComponent('broadcasts', 'list');
  }


  /**
   * --  COPY -- /editar.php/broadcasts/copy
   * Crea un difusion con los mismos metadatos que otra original
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $broadcast = BroadcastPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($broadcast);

    $broadcast2 = $broadcast->copy();
            
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $broadcast->setCulture($lang);
      $broadcast2->setCulture($lang);
      $broadcast2->setDescription($broadcast->getDescription());
    }
      
    $broadcast2->save();
    $this->msg_alert = array('info', "Difusion clonada..");

    return $this->renderComponent('broadcasts', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/broadcasts/preview
   * Muestra la una perqueña vista previa de la difusion con infomacion de sus metadatos y de los 
   * objetos multimedia a los que pertenece.
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/broadcast');
    }
    return $this->renderText('OK');
  }


  /**
   * --  DEFAULT -- /editar.php/broadcasts/default
   * Modifica la difusion por defecto, sustituyendo la anterior, si la habia, por la que su id
   * se pasa como parametro. 
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDefault()
  {
    $this->getResponse()->setContentType('text/javascript');
    $this->setLayout(false);
    $broadcast = BroadcastPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($broadcast);

    $broadcast->setDefaultSelect();
  }
}
