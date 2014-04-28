<?php
/**
 * MODULO PLACE ACTIONS. 
 * Modulo de administracion de las lugares donde se graban los 
 * objetos multimedia.
 *
 * @package    pumukit
 * @subpackage precincts
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class placesActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/places
   *
   * Sin parametros
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');

    $this->getUser()->setAttribute('sort', 'name', 'tv_admin/place');
    $this->getUser()->setAttribute('type', 'asc', 'tv_admin/place');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/place'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/place');

    if (!$this->getUser()->hasAttribute('page', 'tv_admin/precinct'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/precinct');
  }


  /**
   * --  LIST -- /editar.php/places/list
   *
   * Sin parametros
   *
   */
  public function executeList()
  {
    return $this->renderComponent('places', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/places/preview
   *
   * Parametros: identificador del lugar.
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/place');
    }
    return $this->renderComponent('places', 'preview');
  }


  /**
   * --  Create -- /editar.php/places/create
   *
   * Sin parametros
   *
   */
  public function executeCreate()
  {
    $this->place = new Place();

    /*De donde se accede places o video ?*/
    $this->url = 'places/update';
    $this->update = 'list_places';


    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  Edit -- /editar.php/places/edit
   *
   * Parametros: identificador del lugar.
   *
   */
  public function executeEdit()
  {
    $this->place = PlacePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->place);

    /*De donde se accede places o video ?*/
    $this->url = 'places/update';
    $this->update = 'list_places';

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/places/update
   *
   * Parametros por POST.
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $place = new Place();
    }
    else
    {
      $place = PlacePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($place);
    }

    $place->setCoorgeo($this->getRequestParameter('coorgeo', ' '));
    $place->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $place->setCulture($lang);
      $place->setName($this->getRequestParameter('name_'. $lang, ' '));
      $place->setAddress($this->getRequestParameter('address_'. $lang, ' '));
    }
    $place->save();

    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Metadatos del lugar actualizados."));
    $this->getUser()->setAttribute('id', $place->getId(), 'tv_admin/place');

    return $this->renderComponent('places', 'list');
  }


  /**
   * --  DELETE -- /editar.php/places/delete
   *
   * Parametros por URL: Identificador del lugar 
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $places = PlacePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($places as $place){
	$place->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $place = PlacePeer::retrieveByPk($this->getRequestParameter('id'));
      $place->delete();
    }

    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Lugares borrados correctamente."));
    return $this->renderComponent('places', 'list');
  }


  /**
   * --  COPY -- /editar.php/places/copy
   *
   * Parametros por URL: Identificador del lugar 
   *
   */
  public function executeCopy()
  {
    $place = PlacePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($place);

    $place2 = $place->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $place->setCulture($lang);
      $place2->setCulture($lang);
      $place2->setName($place->getName());
      $place2->setAddress($place->getAddress());
    }

    $place2->save();

    return $this->renderComponent('places', 'list');
  }


  /**
   * --  SELECTPRECINTS -- /editar.php/places/selectprecincts
   *
   * Parametros por URL: Identificador del lugar 
   *
   */
  public function executeSelectprecincts()
  {
    $this->place = PlacePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->place);
  }
}
