<?php
/**
 * MODULO VIRTUAL GROUND ACTIONS. 
 *
 * @package    pumukit
 * @subpackage virtualground
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class virtualgroundsActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/grounds
   *
   *
   */
  public function executeIndex()
  {
    sfConfig::set('template_menu','active'); 

    if (!$this->getUser()->hasAttribute('page', 'tv_admin/ground'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/ground');
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(VirtualGroundPeer::RANK);

    $this->vgrounds = VirtualGroundPeer::doSelect($c);
    $this->default_ground_type = WidgetConstantPeer::get(10);
  }

  /**
   * --  CREATE -- /editar.php/virtualgrounds/create
   *
   * Parametros por POST: nombre del tipo
   */
  public function executeCreate()
  {
    $vground = new VirtualGround();
    $vground->setDisplay(true);
    $vground->setCod($this->getRequestParameter('name'));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $vground->setCulture($lang);
      $vground->setName($this->getRequestParameter('name'));
    }

    $vground->save();

    $this->redirect('virtualgrounds/index');
  }

  /**
   * --  DELETE --
   *
   * Parametros por URL: identificador del tipo
   *
   */
  public function executeDelete()
  {

    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($vground);

    $vground->delete();

    $this->redirect('virtualgrounds/index');
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



  public function executeUpdaterelation()
  {
    $c = new Criteria();
    $c->add(VirtualGroundRelationPeer::GROUND_ID, $this->getRequestParameter('ground'));
    $c->add(VirtualGroundRelationPeer::ENABLE, true);
    $aux = VirtualGroundRelationPeer::doSelectOne($c);

    if ($aux != null){
      $aux->delete();
    }

    $aux = new VirtualGroundRelation();
    $aux->setGroundId($this->getRequestParameter('ground'));
    $aux->setVirtualGroundId($this->getRequestParameter('category'));
    $aux->setEnable(true);
    $aux->save();
    
    return $this->renderText("");
  }


  public function executeUpdategroundtype()
  {
    //CAMBIAR LA CTE.
    $g_id = intval($this->getRequestParameter('id'));
    WidgetConstantPeer::put(10, $g_id);
    

    return $this->renderComponent('virtualgrounds', 'grounds');
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
      $vground = new VirtualGround();
    }
    else
    {
      $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($vground);
    }

    $vground->setCod($this->getRequestParameter('cod', ' '));


    $vground->setEditorial1(false);
    $vground->setEditorial2(false);
    $vground->setEditorial3(false);
    $vground->setOther(false);
    $vground->setGroundTypeId(null);

    if ($this->getRequestParameter('decision') == 'editorial1'){
      $vground->setEditorial1(true);
    }elseif ($this->getRequestParameter('decision') == 'editorial2'){
      $vground->setEditorial2(true);
    }elseif ($this->getRequestParameter('decision') == 'editorial3'){
      $vground->setEditorial3(true);
    }elseif (intval($this->getRequestParameter('decision')) != 0){
      $vground->setOther(true);
      $vground->setGroundTypeId($this->getRequestParameter('decision'));
    }

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $vground->setCulture($lang);
      $vground->setName($this->getRequestParameter('name_'. $lang, ' '));
    }
    
    
    /* Solo si es img */
    if(($this->getRequest()->hasFiles()) && (strlen($this->getRequest()->getFileName('ground_imagen')) != 0)){
      
      $fileName = $this->sanitizeFile($this->getRequest()->getFileName('ground_imagen'));
      $absCurrentDir = sfConfig::get('sf_upload_dir').'/pic/ground';
      $this->getRequest()->moveFile('ground_imagen', $absCurrentDir . '/' . $fileName);
    
      $vground->setImg('/uploads/pic/ground/' . $fileName);
    }

    try{
      $vground->save();
    }catch (Exception $e) {
      $this->msg_alert = array('error', "Actualizacion erronea Codigo repetido.");
    }

    $this->vground = $vground;

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
    $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getRequestParameter('id'));
    VirtualGroundRelationPeer::doDelete($c);

    $others = $this->getRequestParameter('relations');

    foreach($others as $k => $v){
      $rel = new VirtualGroundRelation();
      $rel->setVirtualGroundId($this->getRequestParameter('id'));
      $rel->setGroundId($k);
      $rel->save();
    }

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('virtualgrounds', 'grounds');
  }



  /**
   * --  UP -- /editar.php/up/id/:id
   *
   * Parametros por URL: id del vground
   *
   */
  public function executeUp()
  {
    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($vground);

    $vground->moveUp();
    $vground->save();

    $this->redirect('virtualgrounds/index');
  }


  /**
   * --  DOWN -- /editar.php/down/id/:id
   *
   * Parametros por URL: id del vground
   *
   */
  public function executeDown()
  {
    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($vground);

    $vground->moveDown();
    $vground->save();

    $this->redirect('virtualgrounds/index'); 
  }



  public function executeEditground()
  {
    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($vground);

    $c = new Criteria();
    $c->add(GroundPeer::GROUND_TYPE_ID, $this->getRequestParameter('type'));
    $this->grounds = GroundPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->rel = $vground->getRelationsId();    
  }

  public function executeTestcategory()
  {
    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('vg_id'));
    $this->forward404Unless($vground);
    $this->vg = $vground;
  }

  public function executeUpdatetestcategory()
  {
    // $c = new Criteria();
    // $c->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getRequestParameter('id'));
    // VirtualGroundRelationPeer::doDelete($c);

    // $others = $this->getRequestParameter('relations');

    // foreach($others as $k => $v){
    //   $rel = new VirtualGroundRelation();
    //   $rel->setVirtualGroundId($this->getRequestParameter('id'));
    //   $rel->setGroundId($k);
    //   $rel->save();
    // }

    $this->type = $this->getUser()->getAttribute('id', 1, 'tv_admin/groundtype');
    return $this->renderComponent('virtualgrounds', 'grounds');
  }

  public function executeGetchildren()
  {
    // $this->mm_id = $this->getRequestParameter('mm');

    $this->c = CategoryPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->c);

    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('vg_id'));
    $this->forward404Unless($vground);
    $this->vg_id = $vground->getId();

    $this->block_cat = $this->getRequestParameter('block_cat');
  }

  public function executeAddCategory()
  {       
    $category = CategoryPeer::retrieveByPKWithI18n($this->getRequestParameter('category'), $this->getUser()->getCulture());
    $this->forward404Unless($category);

    $vground = VirtualGroundPeer::retrieveByPk($this->getRequestParameter('vg_id'));
    $this->forward404Unless($vground);
    $this->vg_id = $vground->getId();

    $json     = array('added' => array(), 'recommended' => array());
    $func     = create_function('$a', 'return $a->getId();');
    $add_cats = array();
    
    if ($category->addVirtualGroundId($this->vg_id)){
      $add_cats [] = $category;
    }
  
    foreach($category->getRequiredWithI18n() as $required_cat){
      if($required_cat->addVirtualGroundId($this->vg_id)){
        $add_cats[] = $required_cat;
      }
    }  

    foreach($add_cats as $n){
      $json['added'][] = array(
             'vg_id' => $this->vg_id,
             'id'    => $n->getId(), 
             'cod'   => $n->getCod(), 
             'name'  => $n->getName(),
             'group' => array_map($func, $n->getPath())
             );
    }

    $this->getResponse()->setContentType('application/json');
    return $this->renderText(json_encode($json));
  }


  protected function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  protected function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}


