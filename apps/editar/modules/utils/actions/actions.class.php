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

}
