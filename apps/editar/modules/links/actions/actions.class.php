<?php
/**
 * MODULO LINKS ACTIONS. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los enlaces de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage links
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class linksActions extends sfActions
{
  /**
   * --  LIST -- /editar.php/links/list
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeList()
  {
    return $this->renderComponent('links', 'list');
  }

  /**
   * --  CREATE -- /editar.php/links/create
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeCreate()
  {
    $this->link = new Link();

    //$this->link->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate
    $this->link->setMmId($this->getRequestParameter('mm'));
    $this->link->setUrl('...');
    
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  DELETE -- /editar.php/linkss/delete
   *
   * Parametros por URL: Identificador del link
   *
   */
  public function executeDelete()
  {
    $link = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($link);
    $link->delete();
    
    return $this->renderComponent('links', 'list');
  }

  /**
   * --  EDIT -- /editar.php/linkss/edit
   *
   * Parametros por URL: Identificador del link
   *
   */
  public function executeEdit()
  {
    $this->link = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->link);
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }

  /**
   * --  UPDATE -- /editar.php/linkss/update
   *
   * Parametros por POST
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $link = new Link();
    }
    else
    {
      $link = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($link);
    }
    $link->setMmId($this->getRequestParameter('mm', 0));
    $link->setUrl($this->getRequestParameter('url', 0));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $link->setCulture($lang);
      $link->setName($this->getRequestParameter('name_' . $lang, ' '));
    }
    
    $link->save();

    return $this->renderComponent('links', 'list'); 
  }

  /**
   * --  UP -- /editar.php/linkss/up
   *
   * Parametros por URL: Identificador del link
   *
   */
  public function executeUp()
  {
    $link = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($link);

    $link->moveUp();
    $link->save();

    return $this->renderComponent('links', 'list');
  }


  /**
   * --  DOWN -- /editar.php/linkss/down
   *
   * Parametros por URL: Identificador del link
   *
   */
  public function executeDown()
  {
    $link = LinkPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($link);

    $link->moveDown();
    $link->save();

    return $this->renderComponent('links', 'list');
  }
}
