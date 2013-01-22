<?php
/**
 * MODULO WIDGETS INDEX. 
 * Modulo de administracion de los widgets que permiten la personalizacion del portal.
 *
 * @package    pumukit
 * @subpackage widgets
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class widgetsActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/widgets
   *
   */
  public function executeIndex()
  {
    sfConfig::set('template_menu', 'active'); 
    
    $this->bar_body = ElementWidgetPeer::doListJoinAll('Slidebar');
    $this->bar_footer = ElementWidgetPeer::doListJoinAll('Footerbar');
    $this->bar_header = ElementWidgetPeer::doListJoinAll('Headerbar');
    $this->body_index = ElementWidgetPeer::doListJoinAll('IndexBody');
  }

  /**
   * --  CREATE -- /editar.php/widgets/create/type/:id/bar/:id
   *
   */
  public function executeCreate()
  {
    $this->widgets = WidgetPeer::doListWithI18n($this->getRequestParameter('type'), $this->getUser()->getCulture());
    $this->bar = $this->getRequestParameter('bar');
  }

  /**
   * --  ADD -- /editar.php/widgets/add/id/:id/bar/:id
   *
   */
  public function executeAdd()
  {
    $aux = new ElementWidget();
    $aux->setBarWidgetId($this->getRequestParameter('bar', null));
    $aux->setWidgetId($this->getRequestParameter('id', null));
    
    try{
      $aux->save();
    }catch(Exception $e){}
    
    return $this->forward('widgets', 'index');
  }


  /**
   * --  DELETE -- /editar.php/widgets/delete/id/:id/bar/:id
   *
   */
  public function executeDelete()
  {
    $ElementWidget = ElementWidgetPeer::retrieveByPK($this->getRequestParameter('bar'), $this->getRequestParameter('id'));
    $this->forward404Unless($ElementWidget);

    $ElementWidget->delete();

    return $this->forward('widgets', 'index');
  }


  /**
   * --  EDIT -- /editar.php/widgets/edit/id/:id
   *
   */
  public function executeEdit()
  {
    //MAL falta seleccionar las temp y ctes adecuadas

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $c = new Criteria();
    $c->add(WidgetConstantPeer::WIDGET_ID, $this->getRequestParameter('id'));
    $this->constants = WidgetConstantPeer::doSelect($c);

    $c = new Criteria();
    $c->add(WidgetTemplatePeer::WIDGET_ID, $this->getRequestParameter('id'));
    $this->templates = WidgetTemplatePeer::doSelectWithI18n($c, $this->getUser()->getCulture()); 
  }

  /**
   * --  UPDATE -- /editar.php/widgets/update
   *
   *  POST: id, templates y constantes
   */
  public function executeUpdate()
  {
    $aux = $this->getRequest()->getParameterHolder()->getAll();
    
    if (isset($aux['template'])){
      foreach($aux['template'] as $k=>$v){
	WidgetTemplatePeer::put($k, $v);
      }
    }

    if(isset($aux['constant'])){
      foreach($aux['constant'] as $k=>$v){
	WidgetConstantPeer::put($k, $v);
      }
    }
        
    return $this->forward('widgets', 'index');
  }


  /**
   * --  UP -- /editar.php/widgets/up/id/:id/bar/:bar
   *
   */
  public function executeUp()
  {
    $ElementWidget = ElementWidgetPeer::retrieveByPK($this->getRequestParameter('bar'), $this->getRequestParameter('id'));
    $this->forward404Unless($ElementWidget);

    $ElementWidget->moveUp();
    $ElementWidget->save();

    return $this->forward('widgets', 'index');
  }

  /**
   * --  DOWN -- /editar.php/widgets/down/id/:id/bar/:bar
   *
   */
  public function executeDown()
  {
    $ElementWidget = ElementWidgetPeer::retrieveByPK($this->getRequestParameter('bar'), $this->getRequestParameter('id'));
    $this->forward404Unless($ElementWidget);

    $ElementWidget->moveDown();
    $ElementWidget->save();

    return $this->forward('widgets', 'index');
  }
 
}
