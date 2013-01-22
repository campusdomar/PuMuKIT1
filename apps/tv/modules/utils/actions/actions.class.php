<?php
/**
 * MODULO UTILS ACTION. 
 * Este modulo contiene una serie de utilidades como son la generacion
 * de la hoja de estilos en funcion de la configuracion del usuario, acciones
 * para cambio de cultura de la pagina mostrada, y acciones de autentificacion. 
 *
 *
 * @package    pumukit
 * @subpackage utils
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot es)
 * @version    1.0
 */
class utilsActions extends sfActions
{
  /**
   * Crea hoja de estilos en cascada en funcion del contenido de la base de datos
   *  - Sin layout
   *
   */
  public function executeCss()
  {
    $this->getResponse()->setContentType('text/css');
    $this->setLayout(false);
    $this->layout = TemplatePeer::get('layout', 'css');
    $this->style  = TemplatePeer::get('style',  'css');
  }

  /**
   * Modifica la cultura de la pagina mostrada en en navegador, para ello se realizan dos tareas:
   *  - Cambio de la cultura en las variables de session.
   *  - Modifica la url si contiene referencia a la cultura ejemplo de uvigo.tv/es/index.html se pasaria a uvigo.tv/gl/index.html
   *
   */
  public function executeCulture()
  {
    $referer = $this->getContext()->getActionStack()->getSize() == 1 ? $this->getRequest()->getReferer() : $this->getRequest()->getUri();
    $referer = str_replace('/'.$this->getUser()->getCulture(), '/'.$this->getRequestParameter('culture'), $referer);
    $this->getUser()->setCulture($this->getRequestParameter('culture')); 
    $this->redirect($referer);
  }


  /**
   * Autentifica al usuario otorgandole las credenciales oportunas
   *
   */
  public function executeLogin()
  {
    $user = UserPeer::isUser($this->getRequestParameter('login',''), $this->getRequestParameter('passwd',''));
    if ($user){
      $this->getUser()->setAuthenticated(true);
      $this->getUser()->addCredential('pri'); 
    }
    $this->redirect($this->getRequest()->getReferer());
  }


  /**
   * Desautentifica al usuario
   *
   */
  public function executeLogout()
  {
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->removeCredential('pri');
    $this->redirect('index/index');
  }


  /**
   * Reinderiza el tamplate solicitado
   *
   */
  public function executeTemplate()
  {
    $this->template = TemplatePeer::get($this->getRequestParameter('temp'), $this->getUser()->getCulture());
    $this->forward404Unless($this->template);
  }
}
