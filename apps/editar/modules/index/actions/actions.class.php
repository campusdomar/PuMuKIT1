<?php
/**
 * MODULO INDEX. 
 * Modulo de acceso a la aplicacion de edicion. Muestra un formulario
 * de acceso validando el nombre de usuario y su password. Ademas contiene los layouts
 * de error.
 *
 * @package    pumukit
 * @subpackage index
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class indexActions extends sfActions
{

  private $defaultAction = "serials/index"; //'dashboard/index'
  
  /**
   * --  INDEX -- /editar.php
   * Si el usuario esta autentificado lo redirecciono a la accion por defecto (serial/index)
   * sino muestra el formulario de registro. Modifico el formulario de registro para que acceda a 
   * la accion solicitada tras registrarse y a la accion por defecto en caso de no solicitar ninguna.
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: indexlayout
   *
   */
  public function executeIndex()
  {
    if ($this->getUser()->isAuthenticated()){
      return $this->redirect($this->defaultAction);
    }
    
    $this->url = $this->getRequestParameter('url');
  }


  /**
   * --  LOGIN -- /editar.php/index/login
   * Si el formulario de registro es correcto redireciona a la acion por defecto
   *
   * Accion asincriona. Acceso publico .Parametros (strings) login y passwd.
   */
  public function executeLogin()
  {
    $user = UserPeer::isUser($this->getRequestParameter('login',''), $this->getRequestParameter('passwd',''));
    if ($user){
      if ($user->getRoot() == 0) return 'Fail';
      $this->getUser()->setAuthenticated(true);
      $this->getUser()->addCredential('admin');
      $this->getUser()->setAttribute('login', $user->getName() );
      $this->getUser()->setAttribute('user_id', $user->getId() );
      $this->getUser()->setAttribute('user_type_id', $user->getUserTypeId());
      $this->getUser()->setAttribute('email', $user->getEmail() );
      $this->url = $this->getRequestParameter('url', $this->defaultAction);
      return 'Success';
    }
    
    return 'Fail';
  }


  /**
   * --  LOGOUT -- /editar.php/index/logout
   * Accion que realiza el Logout.
   */
  public function executeLogout(){
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->removeCredential('admin');
    return $this->redirect('index', 'index');
  }


  /**
   * --  LOGIN404 -- /editar.php/index/login404
   * Accion por defecto al no estar registrado.
   */
  public function executeLogin404(){
    $this->setLayout(false);
  }


  /**
   * --  ERROR404 -- /editar.php/index/error404
   * Accion por defecto cuando se producce un error
   */
  public function executeError404(){
    $this->setLayout(false);
  }
}
