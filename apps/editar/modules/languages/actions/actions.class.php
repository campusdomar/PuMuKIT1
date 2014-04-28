<?php
/**
 * MODULO LANGUAGE ACTIONS. 
 * Modulo de administracion de las generos que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage language
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class languagesActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/languages
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');
    if (!$this->getUser()->setAttribute('page', 'tv_admin/language'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/language');
  }


  /**
   * --  LIST -- /editar.php/languages/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('languages', 'list');
  }


  /**
   * --  CREATE -- /editar.php/languages/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->language = new Language();

    //$this->language->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->language->setDefaultSel(0);    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/languages/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->language = LanguagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->language);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/languages/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $language = new Language();
    }
    else
    {
      $language = LanguagePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($language);
    }

    $language->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $language->setCulture($lang);
      $language->setName($this->getRequestParameter('name_'. $lang, ' '));
    }
    try{
      $language->save();
      $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Metadatos del idioma actualizados."));
      $this->getUser()->setAttribute('id', $language->getId(), 'tv_admin/language');
    }catch(Exception $e){
      $this->msg_alert = array('error', $this->getContext()->getI18N()->__("Código de idioma repetido."));
    }

    return $this->renderComponent('languages', 'list');
  }


  /**
   * --  DELETE -- /editar.php/languages/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $languages = LanguagePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($languages as $language){
	$language->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $language = LanguagePeer::retrieveByPk($this->getRequestParameter('id'));
      $language->delete();
    }
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Idioma borrado."));
    return $this->renderComponent('languages', 'list');
  }


  /**
   * --  COPY -- /editar.php/languages/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $language = LanguagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($language);

    $language2 = $language->copy();
    $language2->setCod('---');
            
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $language->setCulture($lang);
      $language2->setCulture($lang);
      $language2->setName($language->getName());
    }
    try{
      $language2->save();
      $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Idioma copiado."));
    }catch(Exception $e){
      $this->msg_alert = array('error', $this->getContext()->getI18N()->__("Código de idioma repetido."));
    }


    return $this->renderComponent('languages', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/languages/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/language');
    }
    return $this->renderText('OK');
  }


  /**
   * --  DEFAULT -- /editar.php/languages/default
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDefault()
  {
    $this->getResponse()->setContentType('text/javascript');
    $this->setLayout(false);
    $language = LanguagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($language);

    $language->setDefaultSelect();
  }
}
