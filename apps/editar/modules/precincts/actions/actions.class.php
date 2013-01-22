<?php
/**
 * MODULO PRECINCTS ACTIONS. 
 * Pseudomodulo con las acciones de recintos llamadas desde el modulo
 * de lugares.
 *
 * @package    pumukit
 * @subpackage precincts
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class precinctsActions extends sfActions
{
  /**
   * --   LIST -- /editar.php/precincts/list/place/?
   *
   * Parametro por Url: identificador del lugar cuyos recintos se listan.
   *
   */
  public function executeList()
  {
    $this->getUser()->setAttribute('id', $this->getRequestParameter('place', null), 'tv_admin/place');
    $this->getUser()->setAttribute('place', $this->getRequestParameter('place'));

    return $this->renderComponent('precincts', 'list');
  }

  /**
   * --  PREVIEW -- /editar.php/precincts/preview/id/?
   *
   * Parametros: identificador del recinto a previsualizar.
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
      {
	$this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/precinct');
      }
    return $this->renderComponent('precincts', 'preview');
  }

  /**
   * --  CREATE -- /editar.php/precincts/create/place/?
   *
   * Parametro por Url: identificador del lugar cuyos recintos se listan.
   *
   */
  public function executeCreate()
  {
    $this->precinct = new Precinct();
    $this->precinct->setPlaceId($this->getUser()->getAttribute('place', 1));
    $this->precinct->save();

    /*De donde se accede precincts o video ?*/
    $this->url = 'precincts/update';
    $this->update = 'list_precincts';


    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/precincts/edit/id/?
   *
   * Parametros: identificador del recinto a editar.
   *
   */
  public function executeEdit()
  {
    $this->precinct = PrecinctPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->precinct);

    /*De donde se accede precincts o video ?*/
    $this->url = 'precincts/update';
    $this->update = 'list_precincts';

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }

  /**
   * --  UPDATE -- /editar.php/precincts/update
   *
   * Parametros por POST.
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $precinct = new Precinct();
    }
    else
    {
      $precinct = PrecinctPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($precinct);
    }

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $precinct->setCulture($lang);
      $precinct->setName($this->getRequestParameter('name_'. $lang, ' '));
      $precinct->setEquipment($this->getRequestParameter('equipment_'. $lang, ' '));
      $precinct->setComment($this->getRequestParameter('comment_'. $lang, ' '));
    }
    $precinct->save();

    $this->msg_alert = array('info', "Metadatos del recinto actualizados.");
    $this->getUser()->setAttribute('id', $precinct->getId(), 'tv_admin/precinct');

    return $this->renderComponent('precincts', 'list');
  }

  /**
   * --  DELETE -- /editar.php/precincts
   *
   * Parametros: identificador del recinto a eliminar.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $precincts = PrecinctPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($precincts as $precinct){
	$precinct->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $precinct = PrecinctPeer::retrieveByPk($this->getRequestParameter('id'));
      $precinct->delete();
    }

    $this->msg_alert = array('info', "Recinto borrado.");
    return $this->renderComponent('precincts', 'list');
  }

  /**
   * --  COPY -- /editar.php/precincts/copy/id/?
   *
   * Parametros: identificador del recinto a copiar.
   *
   */
  public function executeCopy()
  {
    $precinct = PrecinctPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($precinct);

    $precinct2 = $precinct->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $precinct->setCulture($lang);
      $precinct2->setCulture($lang);
      $precinct2->setName($precinct->getName());
      $precinct2->setEquipment($precinct->getEquipment());
      $precinct2->setComment($precinct->getComment());
    }

    $precinct2->save();

    return $this->renderComponent('precincts', 'list');
  }

  /**
   * --  DEFAULT -- /editar.php/precincts/default/id/?
   *
   * Parametro por Url: identificador del lugar por defectp
   */
  public function executeDefault()
  {
    $precinct = PrecinctPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($precinct);

    $precinct->setDefaultSelect();

    return $this->renderText('OK');
  }
}
