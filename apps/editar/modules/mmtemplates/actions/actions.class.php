<?php

/**
 * mmstemplate actions.
 *
 * @package    pumukituvigo
 * @subpackage mmstemplate
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mmtemplatesActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeEdit()
  {

    $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($serial);

    $this->mm_template = MmTemplatePeer::get($serial->getId()); //createNew
    
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $cg = new Criteria();
    $cg->addAscendingOrderByColumn(GroundI18nPeer::NAME);
    $this->grounds = GroundPeer::doSelectWithI18n($cg, $this->getUser()->getCulture());

    $this->grounds_sel = $this->mm_template->getGrounds();


    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $c = new Criteria();
    $c->addAscendingOrderByColumn(RolePeer::RANK);
    $this->roles = RolePeer::doSelectWithI18n($c, $this->getUser()->getCulture()); //ORDER
  }




  /**
   * --  UPDATE -- /editar.php/mms/update
   *
   * Parametros por POST: Serializacion de formulario
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $mm = new MmTemplate();
    }
    else
    {
      $mm = MmTemplatePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($mm);
    }


    if ($this->getRequestParameter('publicdate'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('publicdate'), $this->getUser()->getCulture());      
      $mm->setPublicdate($timestamp);
    }

    if ($this->getRequestParameter('recorddate'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('recorddate'), $this->getUser()->getCulture());      
      $mm->setRecorddate($timestamp);
    }
    
    $mm->setSubserial($this->getRequestParameter('subserial', 0));
    $mm->setCopyright($this->getRequestParameter('copyright', 0));
    //$mm->setPrecinctId($this->getRequestParameter('precinct_id', 0));
    $mm->setGenreId($this->getRequestParameter('genre_id', 0));
    $mm->setBroadcastId($this->getRequestParameter('broadcast_id', 0));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm->setTitle($this->getRequestParameter('title_' . $lang, 0));
      $mm->setSubtitle($this->getRequestParameter('subtitle_' . $lang, 0));
      $mm->setKeyword($this->getRequestParameter('keyword_' . $lang, ' '));
      $mm->setDescription($this->getRequestParameter('description_' . $lang, ' '));
      $mm->setLine2($this->getRequestParameter('line2_' . $lang, ' '));
      $mm->setSubserialTitle($this->getRequestParameter('subserial_title_' . $lang, ' '));
    }
    
    $mm->save();

    return $this->renderText("OK");
  }



  /**
   * --  ADDGROUND -- /editar.php/mms/addground
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeAddGround()
  {
    $mmtemplate_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN
    $this->mm = MmTemplatePeer::retrieveByPk($mmtemplate_id); 
    
    $this->mm->setGroundId($ground_id);

    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 


    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');
    $this->grounds_sel = $this->mm->getGrounds();

    return $this->renderPartial('edit_ground');
  }


  /**
   * --  DELETEGROUND -- /editar.php/mms/deleteground
   *
   * Parametros por URL: identificador del objeto mulimedia e identificador del area de con.
   *
   */
  public function executeDeleteGround()
  {
    $mmtemplate_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN

    $gv = GroundMmTemplatePeer::retrieveByPK($ground_id, $mmtemplate_id);
    if (isset($gv)) $gv->delete();

    
    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmTemplatePeer::retrieveByPk($mmtemplate_id); 
    $this->grounds_sel = $this->mm->getGrounds();
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');

    return $this->renderPartial('edit_ground');
  }



  /**
   * --  RELAIONGROUND -- /editar.php/mms/relaionground
   *
   * Parametros por URL: 
   *          -identificador del objeto mulimedia 
   *          -identificadores de las areas de conociemiento
   *          -verbo que indoca la accion (incluir o eliminar)
   *
   */
  public function executeRelationgrounds()
  {
    $mm_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_ids = $this->getRequestParameter('ground_ids');

    if('incluir' == $this->getRequestParameter('function', 0)){
      foreach($ground_ids as $ground_id){
	$gv =  GroundMmTemplatePeer::retrieveByPK($ground_id, $mm_id);
	if (!$gv){
	  $gv = new GroundMmTemplate();
	  $gv->setMmTemplateId($mm_id);
	  $gv->setGroundId($ground_id);
	  $gv->save();
	}
      } 
    }elseif('eliminar' == $this->getRequestParameter('function', 0)){
      foreach($ground_ids as $ground_id){
	$gv = GroundMmTemplatePeer::retrieveByPK($ground_id, $mm_id);
	if (isset($gv)) $gv->delete();
      }
    }

    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $this->mm = MmPeer::retrieveByPk($mm_id); 
    $this->grounds = GroundPeer::doSelectWithI18n(new Criteria(), 'es');
    $this->grounds_sel = $this->mm->getGrounds();

    return $this->renderPartial('edit_ground');    
  }


}
