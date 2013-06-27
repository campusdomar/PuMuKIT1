<?php

/**
 * formats actions.
 *
 * @package    fin
 * @subpackage formats
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class formatsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/format'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/format');
  }

  /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
    return $this->renderComponent('formats', 'list');
  }

  /**
   * Executes other actions
   *
   */
  public function executeCreate()
  {
    $this->format = new Format();

    //$this->format->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->format = FormatPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->format);

  }


  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $format = new Format();
    }
    else
    {
      $format = FormatPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($format);
    }

    $format->setName($this->getRequestParameter('name', ' '));

    $format->save();

    $this->getUser()->setAttribute('id', $format->getId(), 'tv_admin/format');

    //return $this->redirect('formats/list');
    return $this->renderComponent('formats', 'list');
  }


  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $formats = FormatPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($formats as $format){
	$format->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $format = FormatPeer::retrieveByPk($this->getRequestParameter('id'));
      $format->delete();
    }

    //return $this->redirect('formats/list');
    return $this->renderComponent('formats', 'list');
  }


  public function executeCopy()
  {
    $format = FormatPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($format);

    $format2 = $format->copy();
            
    $format2->save();
  

    //return $this->redirect('formats/list');
    return $this->renderComponent('formats', 'list');
  }

  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/format');
    }
    return $this->renderText('OK');
  }


  public function executeDefault()
  {
    $format = FormatPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($format);

    $format->setDefaultSelect();

    return $this->renderText('OK');
  }
}
