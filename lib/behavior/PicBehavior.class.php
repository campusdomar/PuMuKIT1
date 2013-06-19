<?php

/**
 * PicSelect (behavior)
 *
 * Comportamiento para las tablas que estan relacionadas
 * de manera NM con la tabla Pic, es decir aquellas que 
 * tienen imagenes
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicBehavior
{  

  /**
   * Metodo de la Clase Object
   *
   * Devuelve la primera imagen con la que esta asociado el objeto
   * 
   *
   * @access public
   * @return Object Pic
   */
  public function getFirstPic($object)
  {
    $c = new Criteria();
    $c->addJoin(PicPeer::ID, constant('Pic' . get_class($object) . 'Peer::PIC_ID'));
    $c->add(constant('Pic' . get_class($object) . 'Peer::OTHER_ID'), $object->getId());
    $c->addAscendingOrderByColumn('rank');

    return PicPeer::doSelectOne($c);
  }



  /**
   * Metodo de la Clase Object
   *
   * Devuelve la ultima imagen con la que esta asociado el objeto
   * 
   *
   * @access public
   * @return Object Pic
   */
  public function getLastPic($object)
  {
    $c = new Criteria();
    $c->addJoin(PicPeer::ID, constant('Pic' . get_class($object) . 'Peer::PIC_ID'));
    $c->add(constant('Pic' . get_class($object) . 'Peer::OTHER_ID'), $object->getId());
    $c->addDescendingOrderByColumn('rank');

    return PicPeer::doSelectOne($c);
  }


  /**
   * Metodo de la Clase Object
   *
   * Devuelve la lista de Imagenes que contiene
   * el objeto (ResulSet of Files). Se puede limitar el numero de imagenes
   * por el parametro de entrada
   * 
   * @access    public
   * @param     integer numero de imagenes devueltas cero para todas.
   * @return    ResultSet of Pic
   */
  public function getPics($object, $num = 0)
  {
    $c = new Criteria();
    $c->addJoin(PicPeer::ID, constant('Pic' . get_class($object) . 'Peer::PIC_ID'));
    $c->add(constant('Pic' . get_class($object) . 'Peer::OTHER_ID'), $object->getId());
    $c->addAscendingOrderByColumn('rank');
    if ($num != 0) $c->setLimit($num);

    return  PicPeer::doSelect($c);
  }


  /**
   * Metodo de la Clase Object
   *
   * Devuelve la URLs de la primera imagenes 
   * que contiene la serie (string). Se puede forzar que la ruta devuelta sea absoluta
   * con el praemtro de entrada.
   *
   * @access     public
   * @parameter  boolean absolute (por defecto false)
   * @return     String Url de pics
   */
  public function getFirstUrlPic($object, $absolute = false)
  {
    $pic = $this->getFirstPic($object);
    $nopicfile = $object->getDefaultPic();
    $nopic = ($absolute)?sfConfig::get('app_info_link').$nopicfile:$nopicfile;
    $url = ($pic)? $pic->getUrl($absolute) : $nopic;
    return $url;
  }


  /**
   * Metodo de la Clase Object
   *
   * Devuelve la URLs de la ultima imagen 
   * que contiene la serie (string). Se puede forzar que la ruta devuelta sea absoluta
   * con el praemtro de entrada.
   *
   * @access     public
   * @parameter  boolean absolute (por defecto false)
   * @return     String Url de pics
   */
  public function getLastUrlPic($object, $absolute = false)
  {
    $pic = $this->getLastPic($object);
    $nopicfile = $object->getDefaultPic();
    $nopic = ($absolute)?sfConfig::get('app_info_link').$nopicfile:$nopicfile;
    $url = ($pic)? $pic->getUrl($absolute) : $nopic;
    return $url;
  }


  /**
   * Metodo de la Clase Object
   *
   * Devuelve la lista de URLs de las imagenes 
   * que contiene el objeto. Se puede forzar que la ruta devuelta sea absoluta
   * con el praemtro de entrada.
   *
   * @access    public
   * @parameter boolean absolute (por defecto false)
   * @param     integer numero de imagenes devueltas cero para todas.
   * @return    Array os String
   */
  public function getUrlPics($object, $absolute = false, $num = 0)
  {
    $pics = $this->getPics($object, $num);
    $nopicfile = $object->getDefaultPic();
    $url = array($nopicfile);
    foreach ($pics as $k => $pic){
      $url[$k] = $pic->getUrl($absolute);
    }

    return $url;
  }


  /**
   * Metodo de la Clase Object
   *
   * Asocia con el objeto una nuevo objeto imagen, creado a partir del parametro de entrada.
   *
   * @access    public
   * @parameter string url
   */
  public function setPic($object, $url)
  {
    $aux = 'Pic'.get_class($object);
    $pic = new Pic();
    $pic->setUrl($url);
    $pic->save();
    $pic_object = new $aux;
    $pic_object->setPicId($pic->getId());
    $pic_object->setOtherId($object->getId());
    $pic_object->save();

    return $pic;
  }

  /**
   * Metodo de la Clase Object
   *
   * Asocia con el objeto un objeto imagen, cuya id se pasa como parametro.
   *
   * @access    public
   * @parameter integer id
   *
   *@observations OJO SI YA LA TIENE
   */
  public function setPicId($object, $id)
  {
    $aux = 'Pic'.get_class($object);
    $pic_object = new $aux;
    $pic_object->setPicId($id);
    $pic_object->setOtherId($object->getId());
    $pic_object->save();

    return $id;
  }


  /**
   *
   */
  protected function add(Criteria $c, $className, $id){
    $c->addJoin(PicPeer::ID, constant('Pic'.$className.'Peer::PIC_ID'));
    $c->add(constant('Pic'.$className.'Peer::OTHER_ID'), $id);
    $c->addAscendingOrderByColumn('rank');
  }

}
