<?php

/**
 * resolutions actions.
 *
 * @package    fin
 * @subpackage resolutions
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class resolutionsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');
    if(!$this->getUser()->hasAttribute('page', 'tv_admin/resolution'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/resolution');
  }



  /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
    return $this->renderComponent('resolutions', 'list');
  }

  /**
   * Executes other actions
   *
   */
  public function executeCreate()
  {
    $this->resolution = new Resolution();

    //$this->resolution->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->resolution = ResolutionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->resolution);

  }


  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $resolution = new Resolution();
    }
    else
    {
      $resolution = ResolutionPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($resolution);
    }

    $resolution->setHor($this->getRequestParameter('hor', ' '));
    $resolution->setVer($this->getRequestParameter('ver', ' '));

    $resolution->save();

    $this->getUser()->setAttribute('id', $resolution->getId(), 'tv_admin/resolution');

    //return $this->redirect('resolutions/list');
    return $this->renderComponent('resolutions', 'list');
  }


  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $resolutions = ResolutionPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($resolutions as $resolution){
	$resolution->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $resolution = ResolutionPeer::retrieveByPk($this->getRequestParameter('id'));
      $resolution->delete();
    }

    //return $this->redirect('resolutions/list');
    return $this->renderComponent('resolutions', 'list');
  }


  public function executeCopy()
  {
    $resolution = ResolutionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($resolution);

    $resolution2 = $resolution->copy();
            
    $resolution2->save();
  

    //return $this->redirect('resolutions/list');
    return $this->renderComponent('resolutions', 'list');
  }

  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/resolution');
    }
    return $this->renderText('OK');
  }


  public function executeDefault()
  {
    $resolution = ResolutionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($resolution);

    $resolution->setDefaultSelect();

    return $this->renderText('OK');
  }
}
