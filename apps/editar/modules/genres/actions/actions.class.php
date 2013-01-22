<?php
/**
 * MODULO GENRE ACTIONS. 
 * Modulo de administracion de las generos que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage genre
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class genresActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/genres
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/genre'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/genre');
  }


  /**
   * --  LIST -- /editar.php/genres/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('genres', 'list');
  }


  /**
   * --  CREATE -- /editar.php/genres/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->genre = new Genre();

    $this->genre->setDefaultSel(0);    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/genres/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL
   *
   */
  public function executeEdit()
  {
    $this->genre = GenrePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->genre);

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/genres/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $genre = new Genre();
    }
    else
    {
      $genre = GenrePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($genre);
    }

    $genre->setCod($this->getRequestParameter('cod', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $genre->setCulture($lang);
      $genre->setName($this->getRequestParameter('name_'. $lang, ' '));
    }

    $genre->save();
    $this->msg_alert = array('info', "Metadatos del genero actualizados.");
    $this->getUser()->setAttribute('id', $genre->getId(), 'tv_admin/genre');

    return $this->renderComponent('genres', 'list');
  }

  /**
   * --  DELETE -- /editar.php/genres/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $genres = GenrePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($genres as $genre){
	$genre->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $genre = GenrePeer::retrieveByPk($this->getRequestParameter('id'));
      $genre->delete();
    }
    $this->msg_alert = array('info', "Genero borrado.");
    return $this->renderComponent('genres', 'list');
  }


  /**
   * --  COPY -- /editar.php/genres/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $genre = GenrePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($genre);

    $genre2 = $genre->copy();
            
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $genre->setCulture($lang);
      $genre2->setCulture($lang);
      $genre2->setName($genre->getName());
    }
      
    $genre2->save();
    $this->msg_alert = array('info', "Genero clonado.");

    return $this->renderComponent('genres', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/genres/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/genre');
    }
    return $this->renderText('OK');
  }



  /**
   * --  DEFAULT -- /editar.php/genres/default
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDefault()
  {
    $this->getResponse()->setContentType('text/javascript');
    $this->setLayout(false);
    $genre = GenrePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($genre);

    $genre->setDefaultSelect();
  }
}
