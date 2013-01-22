<?php

/**
 * codecs actions.
 *
 * @package    fin
 * @subpackage codecs
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class codecsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/codec'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/codec');
  }


  /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
    return $this->renderComponent('codecs', 'list');
  }

  /**
   * Executes other actions
   *
   */
  public function executeCreate()
  {
    $this->codec = new Codec();

    //$this->codec->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->codec = CodecPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->codec);

  }


  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $codec = new Codec();
    }
    else
    {
      $codec = CodecPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($codec);
    }

    $codec->setName($this->getRequestParameter('name', ' '));

    $codec->save();

    $this->getUser()->setAttribute('id', $codec->getId(), 'tv_admin/codec');

    //return $this->redirect('codecs/list');
    return $this->renderComponent('codecs', 'list');
  }


  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $codecs = CodecPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($codecs as $codec){
	$codec->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $codec = CodecPeer::retrieveByPk($this->getRequestParameter('id'));
      $codec->delete();
    }

    //return $this->redirect('codecs/list');
    return $this->renderComponent('codecs', 'list');
  }


  public function executeCopy()
  {
    $codec = CodecPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($codec);

    $codec2 = $codec->copy();
            
    $codec2->save();
  

    //return $this->redirect('codecs/list');
    return $this->renderComponent('codecs', 'list');
  }

  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/codec');
    }
    return $this->renderText('OK');
  }


  public function executeDefault()
  {
    $codec = CodecPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($codec);

    $codec->setDefaultSelect();

    return $this->renderText('OK');
  }
}
