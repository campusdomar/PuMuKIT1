<?php

/**
 * streamservs actions.
 *
 * @package    fin
 * @subpackage streamservs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class streamservsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('distri_menu', 'active');

    if(!$this->getUser()->hasAttribute('page', 'tv_admin/streamserv'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/streamserv');
  }



  /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
    return $this->renderComponent('streamservs', 'list');
  }

  /**
   * Executes other actions
   *
   */
  public function executeCreate()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->streamserv = new Streamserver();

    //$this->streamserv->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->streamserv = StreamserverPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->streamserv);

  }


  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $streamserv = new Streamserver();
    }
    else
    {
      $streamserv = StreamserverPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($streamserv);
    }
    

    $streamserv->setIP($this->getRequestParameter('ip', ' '));
    $streamserv->setName($this->getRequestParameter('name', ' '));
    $streamserv->setStreamserverTypeId($this->getRequestParameter('streamserver_type_id', 1));
    $streamserv->setDirOut($this->getRequestParameter('dir_out', ' '));
    $streamserv->setUrlOut($this->getRequestParameter('url_out', ' '));
    $streamserv->setDescription($this->getRequestParameter('description', ' '));
    
    $streamserv->save();

    $this->getUser()->setAttribute('id', $streamserv->getId(), 'tv_admin/streamserv');
    
    return $this->renderComponent('streamservs', 'list');
  }


  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $streamservs = StreamserverPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($streamservs as $streamserv){
	if ($streamserv->countPerfils() == 0)
          $streamserv->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $streamserv = StreamserverPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($streamserv->countPerfils() == 0)
        $streamserv->delete();
    }

    //return $this->redirect('streamservs/list');
    return $this->renderComponent('streamservs', 'list');
  }


  public function executeCopy()
  {
    $streamserv = StreamserverPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($streamserv);

    $streamserv2 = $streamserv->copy();
    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $streamserv2->setCulture($lang);
      $streamserv->setCulture($lang);
      $streamserv2->setDescription($streamserv->getDescription());
    }
            
    $streamserv2->save();
  

    //return $this->redirect('streamservs/list');
    return $this->renderComponent('streamservs', 'list');
  }

  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/streamserv');
    }
    //return $this->renderText('OK');
    return $this->renderComponent('streamservs', 'preview');
  }


  public function executeDefault()
  {
    $streamserv = StreamserverPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($streamserv);

    $streamserv->setDefaultSelect();

    return $this->renderText('OK');
  }
}
