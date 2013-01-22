<?php
/**
 * MODULO TEMPLATES. 
 * Modulo de administracion de los templates del portal. Esisten cuatro tipos de templates 
 *  -- CSS
 *  -- HTML
 *  -- MAIL
 *  -- WIDGET
 *
 * @package    pumukit
 * @subpackage templates
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class templatesActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/templates
   *
   */
  public function executeIndex()
  {
    sfConfig::set('template_menu','active');

    $c = new Criteria();
    $c->add(TemplatePeer::TYPE, TemplatePeer::TYPE_WIDGET, Criteria::NOT_IN);

    if(!sfConfig::get('app_mail_use')){
      $c->addAnd(TemplatePeer::TYPE, TemplatePeer::TYPE_MAIL, Criteria::NOT_IN);
    }
    $c->addAscendingOrderByColumn(TemplatePeer::ID);
    //$this->templates = TemplatePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->templates = TemplatePeer::doSelect($c);
  }

  /**
   * --  CREATE -- /editar.php/templates/create
   *
   * Parametros por POST: nombre del nuevo template HTML de usuario 
   */
  public function executeCreate()
  {
    $template = new Template();
    $template->setName($this->getRequestParameter('name'));
    $template->setType(TemplatePeer::TYPE_PAGE);
    $template->setUser(true);
    $template->setCulture('gl');
    $template->setDescription('Template de usuario');
    $template->setCulture('es');
    $template->setDescription('Template de usuario');
    $template->setCulture('en');
    $template->setDescription('User template');
    $template->save();

    $this->redirect('templates/index');
    //exit;
  }


  /**
   * --  UPDATE -- /editar.php/templates/update
   *
   * Parametros por POST: id y text_culture de template a actualizar
   */
  public function executeUpdate()
  {
    $template = TemplatePeer::retrieveByPk($this->getRequestParameter('id'));
    if (!$template) return $this->renderText('No');
    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $template->setCulture($lang);
      $template->setText($this->getRequestParameter('text_' . $lang, ' '));
    }
    $template->save();
    return $this->renderText('Ok');
  }


  /**
   * --  UPDATECSS -- /editar.php/templates/updatecss
   *
   * Parametros por POST: id y text_css de template a actualizar
   * Al ser un template css no tiene cultura de usuario
   */
  public function executeUpdatecss()
  {
    $template = TemplatePeer::retrieveByPk($this->getRequestParameter('id'));
    if (!$template) return $this->renderText('No');
    
    $template->setCulture('css');
    $template->setText($this->getRequestParameter('text_css', ' '));
    
    $template->save();
    return $this->renderText('Ok');
  }

  /**
   * --  DELETE -- /editar.php/templates/delete
   *
   * Parametros por URL: id
   */
  public function executeDelete()
  {
    $template = TemplatePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($template);

    if ($template->getUser()) $template->delete();

    $this->redirect('templates/index');
  }



  /**
   * --  PREVIEW -- /editar.php/templates/preview
   *
   * Parametros por URL: id
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/templates');
    }
    return $this->renderText('OK');
  }
}

