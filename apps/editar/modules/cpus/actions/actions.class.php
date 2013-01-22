<?php

/**
 * cpus actions.
 *
 * @package    fin
 * @subpackage cpus
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class cpusActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('transcoder_menu','active');

    if(!$this->getUser()->hasAttribute('page', 'tv_admin/cpu'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/cpu');
  }


  /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
    return $this->renderComponent('cpus', 'list');
  }

  /**
   * Executes other actions
   *
   */
  public function executeCreate()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->cpu = new Cpu();

    //$this->cpu->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->cpu);

  }


  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $cpu = new Cpu();
    }
    else
    {
      $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($cpu);
    }
    
    $param_error = true;
    $number_old = $cpu->getNumber();


    if (($this->getRequestParameter('max') < $this->getRequestParameter('min'))
	||($this->getRequestParameter('number') < $this->getRequestParameter('min'))
	||($this->getRequestParameter('number') > $this->getRequestParameter('max'))
	||($this->getRequestParameter('number') < 0)
	||($this->getRequestParameter('min') < 0)
	||($this->getRequestParameter('max') < 0)
	||(!is_numeric($this->getRequestParameter('number')))
	||(!is_numeric($this->getRequestParameter('max')))
	||(!is_numeric($this->getRequestParameter('min')))
	) {
      $param_error = false;
    }

    $cpu->setIP($this->getRequestParameter('ip', ' '));
    $cpu->setType($this->getRequestParameter('type', ' '));
    $cpu->setMin(intval($this->getRequestParameter('min', ' ')));
    $cpu->setMax(intval($this->getRequestParameter('max', ' ')));
    $cpu->setNumber(intval($this->getRequestParameter('number', ' ')));
    $cpu->setUser($this->getRequestParameter('user', ' '));
    $cpu->setPassword($this->getRequestParameter('password', ' '));
   
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $cpu->setCulture($lang);
      $cpu->setDescription($this->getRequestParameter('description_' . $lang, ' '));
    }
    if ($param_error) $cpu->save();

    $this->getUser()->setAttribute('id', $cpu->getId(), 'tv_admin/cpu');

    //Linea para ejecutar siguiente
    if (($number_old < $this->getRequestParameter('number'))&&($param_error)) {
      for($i = 0; $i < ($cpu->getNumber() - $number_old); $i++)
        TranscodingPeer::execNext();
    }
    
    return $this->renderComponent('cpus', 'list');
  }


  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $cpus = CpuPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($cpus as $cpu){
	$cpu->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
      $cpu->delete();
    }

    //return $this->redirect('cpus/list');
    return $this->renderComponent('cpus', 'list');
  }


  public function executeCopy()
  {
    $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($cpu);

    $cpu2 = $cpu->copy();
    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $cpu2->setCulture($lang);
      $cpu->setCulture($lang);
      $cpu2->setDescription($cpu->getDescription());
    }
            
    $cpu2->save();
  

    //return $this->redirect('cpus/list');
    return $this->renderComponent('cpus', 'list');
  }

  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/cpu');
    }
    //return $this->renderText('OK');
    return $this->renderComponent('cpus', 'preview');
  }


  public function executeDefault()
  {
    $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($cpu);

    $cpu->setDefaultSelect();

    return $this->renderText('OK');
  }
}
