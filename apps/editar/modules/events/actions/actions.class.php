<?php
/**
 * MODULO EVENTS ACTIONS. 
 * Modulo de configuracion de los noticias y eventos que aparecen en el portal web.
 *
 * @package    pumukit
 * @subpackage events
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 **/

class eventsActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/events
   * Muestra el modulo de administracion de las noticias, con la vista previa, formulario
   * de fultrado, listado de noticias y acciones de nuevo...
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('tv_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/event'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/event');      
    if (!$this->getUser()->hasAttribute('mes', 'tv_admin/event'))
      $this->getUser()->setAttribute(date('m'), 1, 'tv_admin/event');      
    if (!$this->getUser()->hasAttribute('ano', 'tv_admin/event'))
      $this->getUser()->setAttribute(date('Y'), 1, 'tv_admin/event');      

    if($this->hasRequestParameter("cal")){
      $this->div_url = '?cal=cal';
      $this->div = "calendar";
    }else{
      $this->div_url = '';
      $this->div = "array";
    }
  }



  /**
   * --  LIST -- /editar.php/events/list
   * Muestra la tabla que lista de forma paginada y filtrada las noticias. Renderiza el componente
   * list para que sea accesibe como ajax.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    if($this->hasRequestParameter("cal")){
      return $this->renderComponent('events', 'calendar');
    }else{
      return $this->renderComponent('events', 'array');
    }
  }


  /**
   * --  PREVIEW -- /editar.php/events/preview
   * Muestra la una perqueña vista previa de la noticia
   *
   * Accion asincrona. Acceso privado. Paremetros id de la noticia
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/event');
    }
    return $this->renderComponent('events', 'preview');
  }


  /**
   * --  CREATE -- /editar.php/events/create
   * Muesta el formulario de edicion de la noticia nueva.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->event = new Event();
    $this->event->setDate('today');  //dejar esto a mysql

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    if($this->hasRequestParameter("cal")){
      $this->div = '?cal=cal';
    }else{
      $this->div = '';
    }

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/events/edit
   * Muesta el formulario de edicion de una noticia.
   *
   * Accion asincrona. Acceso privado. Parametros identificador de la noticia
   *
   */
  public function executeEdit()
  {
    $this->setLayout(false); 
    $this->event = EventPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->event);

    if($this->hasRequestParameter("cal")){
      $this->div = '?cal=cal';
    }else{
      $this->div = '';
    }

    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  /**
   * --  UPDATE -- /editar.php/events/update
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
      $event = new Event();
    }
    else
    {
      $event = EventPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($event);
    }

    if ($this->hasRequestParameter('date'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('date'), $this->getUser()->getCulture());
      $event->setDate($timestamp);

    }

    $event->setDisplay($this->getRequestParameter('display', 0));
    $event->setName($this->getRequestParameter('name', 0));
    $event->setPlace($this->getRequestParameter('place', 0));
    $event->setDuration($this->getRequestParameter('duration', 0));
    $event->setDirectId($this->getRequestParameter('direct_id', 0));



    $event->save();
    //$this->msg_alert = array('info', "Evento almacenada correctamene en la base de datos.");

    $this->getUser()->setAttribute('id', $event->getId(), 'tv_admin/event');

    if($this->hasRequestParameter("cal")){
      return $this->renderComponent('events', 'calendar');
    }else{
      return $this->renderComponent('events', 'array');
    }
  }



  /**
   * --  DELETE -- /editar.php/events/delete
   * Borrar una noticia de la base de datos si el parametro id se introduce en la URL, se 
   * pueden borrar varios noticias si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $events = EventPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($events as $event){
	$event->delete();
      }
      //$this->msg_alert = array('info', "Noticias borradas.");

    }elseif($this->hasRequestParameter('id')){
      $event = EventPeer::retrieveByPk($this->getRequestParameter('id'));
      $event->delete();
      //$this->msg_alert = array('info', "Noticia borrada.");
    }

    $this->getUser()->setAttribute('id', null, 'tv_admin/event'); //delete mejor

    if($this->hasRequestParameter("cal")){
      return $this->renderComponent('events', 'calendar');
    }else{
      return $this->renderComponent('events', 'array');
    }
  }



  /**
   * --  WORKING -- /editar.php/events/working
   *
   */
  public function executeCreateseveral()
  {
    $this->event = new Event();
    $this->event->setDate('today');  //dejar esto a mysql

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    if($this->hasRequestParameter("cal")){
      $this->div = '?cal=cal';
    }else{
      $this->div = '';
    }

    $this->setTemplate('edit');
  }



  /**
   * --  WORKING -- /editar.php/events/working
   *
   */
  public function executeUpdateseveral()
  {

    list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('from'), $this->getUser()->getCulture());
    $from = mktime(0,0,0,$m,$d,$y);

    list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('to'), $this->getUser()->getCulture());
    $to = mktime(0,0,0,$m,$d,$y);
    
    //CALCULAR H
    if(preg_match('/^\d{2}:\d{2}$/', $this->getRequestParameter('hour'))){
      $aux = explode(':', $this->getRequestParameter('hour'));
      $h = (intval($aux[0])*60 +intval($aux[1]))*60;
      
      foreach(range($from, $to, 86400) as $d){
	if((!$this->hasRequestParameter("weekend"))&&(in_array(date('N', $d), array(6,7)))) continue;

	$event = new Event();      
	$event->setDate($d + $h);
	$event->setDisplay($this->getRequestParameter('display', 0));
	$event->setName($this->getRequestParameter('name', 0));
	$event->setPlace($this->getRequestParameter('place', 0));
	$event->setDuration($this->getRequestParameter('duration', 0));
	$event->setDirectId($this->getRequestParameter('direct_id', 0));
	
	$event->save();
      }
      //$this->msg_alert = array('info', "Aventos creados.");
    }else{
      //$this->msg_alert = array('error', "Error en formato de la hora.");
    }


    if($this->hasRequestParameter("cal")){
      return $this->renderComponent('events', 'calendar');
    }else{
      return $this->renderComponent('events', 'array');
    }
  }


  /**
   * --  WORKING -- /editar.php/events/working
   *
   *
   */
  public function executeWorking()
  {
    if($this->hasRequestParameterking('ids')){
      $events = EventPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($events as $event){
	$event->setDisplay(!$event->getDisplay());
	$event->save();
      }
      //$this->msg_alert = array('info', "Noticias ocultadas/desocultadas correctamente.");

    }elseif($this->hasRequestParameter('id')){
      $event = EventPeer::retrieveByPk($this->getRequestParameter('id'));
      $event->setDisplay(!$event->getDisplay());
      $event->save();
      //$this->msg_alert = array('info', "Noticia ocultada/desocultada correctamente.");
    }

    if($this->hasRequestParameter("cal")){
      return $this->renderComponent('events', 'calendar');
    }else{
      return $this->renderComponent('events', 'array');
    }
  }
}
