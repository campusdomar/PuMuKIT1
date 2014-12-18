<?php
/**
 * MODULO GROUND ACTIONS. 
 * Modulo de administracion para las areas de conocimiento y sus tipos. Es decir 
 * las categorias con sus dominios
 *
 * @package    pumukit
 * @subpackage ground
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class groundsActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/grounds
   *
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/ground'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/ground');
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->types = GroundTypePeer::doSelect($c);
  }

  /**
   * --  CREATETYPE -- /editar.php/grounds/createtype
   *
   * Parametros por POST: nombre del tipo
   */
  public function executeCreatetype()
  {
    $type = new GroundType();
    $type->setName($this->getRequestParameter('name'));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $type->setCulture($lang);
      $type->setDescription(' ');
    }

    $type->save();

    $this->redirect('grounds/index');
  }

  /**
   * --  DELETETYPE -- /editar.php/grounds/deletetype/id/:id
   *
   * Parametros por URL: identificador del tipo
   *
   */
  public function executeDeletetype()
  {

    $type = GroundTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($type);

    $type->delete();

    $this->redirect('grounds/index');
  }

  /**
   * --  PREVIEWTYPE -- /editar.php/grounds/previewtype/id/:id
   *
   * Parametros por URL: identificador del tipo
   *
   */
  public function executePreviewtype()
  {
    $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/groundtype');
    return $this->renderText('OK');
  }

  /**
   * --  SHOWTYPE -- /editar.php/grounds/showtype/id/:id
   *
   * Parametros por URL: identificador del tipo
   *
   */
  public function executeShowtype()
  {
    $type = GroundTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($type);
    
    $type->setDisplay($this->getRequestParameter('value') === 'true');
    $type->save();

    return $this->renderText('OK');
  }

  /**
   * --  LIST -- /editar.php/grounds/list/id/:id
   *
   * Parametros por URL: identificador del tipo de area a listar
   *
   */
  public function executeList()
  {
    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('grounds', 'list');
  }

  /**
   * --  CREATE -- /editar.php/grounds/create/type/:id
   *
   * Parametros del URL: tipo de area
   *
   */
  Public function executeCreate()
  {
    $this->ground = new Ground();

    $this->ground->setGroundTypeId($this->getRequestParameter('type'), 1);

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/grounds/edit/id/:id
   *
   * Parametros del URL: id del area
   *
   */
  public function executeEdit()
  {
    $this->ground = GroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->ground);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }

  /**
   * --  UPDATE -- /editar.php/grounds/update
   *
   * Parametros por POST
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $ground = new Ground();
    }
    else
    {
      $ground = GroundPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($ground);
    }

    $ground->setCod($this->getRequestParameter('cod', ' '));
    $ground->setGroundTypeId($this->getRequestParameter('ground_type_id', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $ground->setCulture($lang);
      $ground->setName($this->getRequestParameter('name_'. $lang, ' '));
    }
    
    try{
      $ground->save();
    }catch (Exception $e) {
      $this->msg_alert = array('error', "Actualizacion erronea Codigo repetido.");
    }
    $this->getUser()->setAttribute('id', $ground->getId(), 'tv_admin/ground');

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('grounds', 'list');
  }

  /**
   * --  DELETE -- /editar.php/delete/id/:id o /editar.php/delete
   *
   * Parametrsos por URL: id del tipo o PORT json de array de ids
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $grounds = GroundPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($grounds as $ground){
	$ground->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $ground = GroundPeer::retrieveByPk($this->getRequestParameter('id'));
      $ground->delete();
    }

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('grounds', 'list');
  }

  /**
   * --  COPY -- /editar.php/grounds/copy/id/:id
   *
   * Parametros por URL: identificador
   *
   */
  public function executeCopy()
  {
    $ground = GroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($ground);

    $ground2 = $ground->copy();
    $ground2->setCod($ground2->getCod().'_2');    

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $ground->setCulture($lang);
      $ground2->setCulture($lang);
      $ground2->setName($ground->getName());
    }
      
    $ground2->save();
  

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('grounds', 'list');
  }

  /**
   * --  PREVIEW -- /editar.php/grounds/preview/id/:id
   *
   * Parametros por URL: identificador
   *
   */
  public function executePreview()
  {
    $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/ground');
    return $this->renderText('OK');
  }

  /**
   * --  SHOWRELATIONS -- /editar.php/showrelations/id/:id
   *
   * Parametros por URL: id del area
   *
   */
  public function executeShowrelations()
  {
    $ground = GroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($ground);
    
    $this->rel = $ground->getRelationsId();
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
  }

  /**
   * --  UPDATERELATION -- /editar.php/updaterelations
   *
   * Parametros por POST
   *
   */
  public function executeUpdaterelations()
  {
    $c = new Criteria();
    $c->add(RelationGroundPeer::ONE_ID, $this->getRequestParameter('id'));
    RelationGroundPeer::doDelete($c);

    $others = $this->getRequestParameter('relations');

    foreach($others as $k => $v){
      $rel = new RelationGround();
      $rel->setOneId($this->getRequestParameter('id'));
      $rel->setTwoId($k);
      $rel->save();
    }

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('grounds', 'list');    
  }



  /**
   * --  UPTYPE -- /editar.php/uptype/id/:id
   *
   * Parametros por URL: id del type
   *
   */
  public function executeUptype()
  {
    $type = GroundTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($type);

    $type->moveUp();
    $type->save();

    $this->redirect('grounds/index');
  }


  /**
   * --  DOWNTYPE -- /editar.php/downtype/id/:id
   *
   * Parametros por URL: id del type
   *
   */
  public function executeDowntype()
  {
    $type = GroundTypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($type);

    $type->moveDown();
    $type->save();

    $this->redirect('grounds/index');
    
  }
}


