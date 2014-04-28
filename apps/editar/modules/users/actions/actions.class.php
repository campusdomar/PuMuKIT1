<?php
/**
 * MODULO USERS ACTIONS. 
 * Modulo de configuracion de los usuarios que tienen acceso a la aplicacion de administracion.
 * Permite la creacion, edicion y eliminacion de los usuarios. 
 * Compone, en el menu, el unico elemento de la seccion de configuracion.  
 *
 * @package    pumukit
 * @subpackage users
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 */

class usersActions extends sfActions
{
 
  /**
   * --  INDEX -- /editar.php/users
   * Muestra el modulo de users, con su listado paginado de usuarios, el formulario de filtrado,
   * acciones rapidas y botons de nuevo.
   *
   * Accion por defecto en la aplicacion. Acceso privado. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/user'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/user');
  }

 
  /**
   * --  LIST -- /editar.php/users/list
   * Muestra la tabla que lista de forma paginada y filtrada los usuarios del sistema. Las variables de paginacion
   * y de filtrado estan almacenadas en la session si no se modifican. La tabla se genera a traves del componente list. 
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('users', 'list');
  }


  /**
   * --  CREATE -- /editar.php/users/create
   * Muesta el formulario de edicion del usuario nuevo.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->user = new User();
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/users/edit/id/?
   * Muesta el formulario de edicion del usuario cuyo identificador se pada como paremetro.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL.
   *
   */
  public function executeEdit()
  {
    $this->setLayout(false); 
    $this->user = UserPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->user);
  }


  /**
   * --  UPDATE -- /editar.php/users/update
   * Actualiza el contenido de un usuario con el resultado del formulario de modificacion.
   * Si no existe usuario con id dado se crea uno nuevo y se realizan validacion de email en 
   * el servidor. Solo los usuarios con permisos de root pueden modificar a los usuarios
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $user = new User();
    }
    else
    {
      $user = UserPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($user);
    }

    $user->setName($this->getRequestParameter('name', ' '));
    if ((strlen($this->getRequestParameter('passwd', '')) != 0)&&($this->getRequestParameter('passwd', '______') != '______'))
      $user->setPasswd($this->getRequestParameter('passwd', ' '));
    $user->setLogin($this->getRequestParameter('login', ' '));
    $user->setEmail($this->getRequestParameter('email', ''));
    if($this->getUser()->getAttribute('user_type_id', 1) == 0){
      $user->setUserTypeId($this->getRequestParameter('user_type_id', 1)); //SOLO SI EN ADMIN
    }
    $user->setRoot($this->getRequestParameter('root', false));
    
    
    //mirar aki si es superusuario
    if(
       (($user->getEmail() == '')||(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $user->getEmail()))) &&
       ($user->getLogin() !== '') &&
       ($user->getPasswd() !== '')
       ) {
      $message = sprintf($this->getContext()->getI18N()->__("Usuario\"%s\"modificado OK."), $user->getName());
      $this->msg_alert = array('info', $message);
      $user->save();
    }else{
      $message = sprintf($this->getContext()->getI18N()->__("Usuario\"%s\" No Guardado por validar el correo electronico"), $user->getName());
      $this->msg_alert = array('error', $message);
    }

    return $this->renderComponent('users', 'list');
  }


  /**
   * --  DELETE -- /editar.php/users/delete/id/? o /editar.php/users/delete
   * Borrar un usuario de la base de datos si el parametro id se introduce en la URL, se 
   * pueden borrar varios usuarios si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $users = UserPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($users as $user){
	$user->delete();
      }

      $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Usuarios borrados."));

    }elseif($this->hasRequestParameter('id')){
      $user = UserPeer::retrieveByPk($this->getRequestParameter('id'));
      $user->delete();
      $message = sprintf($this->getContext()->getI18N()->__("Usuario \"%s\" borrado OK."), $user->getName());
      $this->msg_alert = array('info', $message);
    }

    return $this->renderComponent('users', 'list');
  }


  /**
   * --  INDEX -- /editar.php/users/preview/id/?
   * Devuelve codigo XHTML que muestra informacion sobre el usuario. Utilizado para la creacion de vitas previas.
   * Tambien se utiliza para actualizar la id del usuario seleccionado en la sesion.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL.
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/user');
    }
    return $this->renderText('OK');
  }

}
