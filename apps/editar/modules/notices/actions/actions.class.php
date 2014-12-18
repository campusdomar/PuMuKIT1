<?php
/**
 * MODULO NOTICES ACTIONS. 
 * Modulo de configuracion de los noticias y eventos que aparecen en el portal web.
 *
 * @package    pumukit
 * @subpackage notices
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 **/

class noticesActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/notices
   * Muestra el modulo de administracion de las noticias, con la vista previa, formulario
   * de fultrado, listado de noticias y acciones de nuevo...
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('template_menu','active'); 
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/notice'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/notice');
  }



  /**
   * --  LIST -- /editar.php/notices/list
   * Muestra la tabla que lista de forma paginada y filtrada las noticias. Renderiza el componente
   * list para que sea accesibe como ajax.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('notices', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/notices/preview
   * Muestra la una perqueña vista previa de la noticia
   *
   * Accion asincrona. Acceso privado. Paremetros id de la noticia
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/notice');
    }
    return $this->renderComponent('notices', 'preview');
  }


  /**
   * --  CREATE -- /editar.php/notices/create
   * Muesta el formulario de edicion de la noticia nueva.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->notice = new Notice();
    $this->notice->setDate('today');  //dejar esto a mysql

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/notices/edit
   * Muesta el formulario de edicion de una noticia.
   *
   * Accion asincrona. Acceso privado. Parametros identificador de la noticia
   *
   */
  public function executeEdit()
  {
    $this->setLayout(false); 
    $this->notice = NoticePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->notice);

    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  /**
   * --  UPDATE -- /editar.php/notices/update
   * Actualiza el contenido de una noticia con el resultado del formulario de modificacion.
   * Si no existe noticia con id dado se crea uno nuevo y se realizan validacion de email en 
   * el servidor. 
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $notice = new Notice();
    }
    else
    {
      $notice = NoticePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($notice);
    }

    if ($this->hasRequestParameter('date'))
    {
      list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('date'), $this->getUser()->getCulture());
      $notice->setDate("$y-$m-$d");
    }
    $notice->setWorking($this->getRequestParameter('working', 0));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $notice->setCulture($lang);
      $notice->setText($this->getRequestParameter('text_' . $lang, ' '));
    }

    $notice->save();
    $this->msg_alert = array('info', "Noticia almacenada correctamene en la base de datos.");

    $this->getUser()->setAttribute('id', $notice->getId(), 'tv_admin/notice');

    return $this->renderComponent('notices', 'list');
  }



  /**
   * --  DELETE -- /editar.php/notices/delete
   * Borrar una noticia de la base de datos si el parametro id se introduce en la URL, se 
   * pueden borrar varios noticias si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $notices = NoticePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($notices as $notice){
	$notice->delete();
      }
      $this->msg_alert = array('info', "Noticias borradas.");

    }elseif($this->hasRequestParameter('id')){
      $notice = NoticePeer::retrieveByPk($this->getRequestParameter('id'));
      $notice->delete();
      $this->msg_alert = array('info', "Noticia borrada.");
    }

    $this->getUser()->setAttribute('id', null, 'tv_admin/notice'); //delete mejor

    return $this->renderComponent('notices', 'list');
  }


  /**
   * --  COPY -- /editar.php/notices/copy
   * Crea un noticia con los mismos metadatos que otra original.
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la noticia a copiar
   *
   */
  public function executeCopy()
  {
    $notice = NoticePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($notice);

    $notice2 = $notice->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $notice->setCulture($lang);
      $notice2->setCulture($lang);
      $notice2->setText( $notice->getText() );
    }

    $notice2->save();
    $this->msg_alert = array('info', "Noticia clonada.");
    return $this->renderComponent('notices', 'list');
  }



  /**
   * --  WORKING -- /editar.php/notices/working
   * Alterna la propiedad de ocultado de una o varias noticias en funcion de los valores recividos,
   * pueden modificar varias noticias si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeWorking()
  {
    if($this->hasRequestParameter('ids')){
      $notices = NoticePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($notices as $notice){
	$notice->setWorking(!$notice->getWorking());
	$notice->save();
      }
      $this->msg_alert = array('info', "Noticias ocultadas/desocultadas correctamente.");

    }elseif($this->hasRequestParameter('id')){
      $notice = NoticePeer::retrieveByPk($this->getRequestParameter('id'));
      $notice->setWorking(!$notice->getWorking());
      $notice->save();
      $this->msg_alert = array('info', "Noticia ocultada/desocultada correctamente.");
    }

    return $this->renderComponent('notices', 'list');
  }
}
