<?php
/**
 * MODULO XML. 
 * Este modulo es el encargado de generar los diferentes FEEDs
 * con los datos que se tienen en el servidor. Los feed generados son:
 *    -ARCA FEED
 *    -VIDEOSITEMAP
 *
 * @package    pumukit
 * @subpackage xml
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot es)
 * @version    1.0
 */
class xmlActions extends sfActions
{


  /**
   * Se configura el modulo para:
   *  - Sin limite de tiempo de ejecucion.
   *  - Estrategia de escape BC.
   *  - Content-type: application/rss+xml; charset=utf-8. (view.yml)
   *  - Sin Layout. (view.yml)
   *
   */
  public function preExecute()
  {
    sfConfig::set('sf_escaping_strategy', 'bc');
    set_time_limit(0);
    //ini_set("memory_limit","256M");
  } 


  /**
   * --  ARCA -- /arca.xml
   * Genera FEED arca (http://arca.rediris.es/doc.php?dmod=tech).
   * se puede validar en http://validator.w3.org/feed/
   *
   */
  public function executeArca()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 2);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    //$c->add(SerialPeer::PUBLICDATE, '2009-01-01', Criteria::GREATER_THAN);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');


    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }

 public function executeNuevoarca()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 2);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    MmPeer::doSelectWithI18n($c, 'es');
    $c->setLimit(10);
    $this->mms = MmPeer::doSelectWithI18n($c, 'es');
   
    $cs = new Criteria();
    SerialPeer::addPubChannelCriteria($cs, 2);
    SerialPeer::addBroadcastCriteria($cs, array('pub'));
    $cs->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    $cs->setLimit(10);
    $this->serials = SerialPeer::doSelectWithI18n($cs, 'es');



    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }



  public function executeRsslast()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 2);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
 //   $c->add(SerialPeer::PUBLICDATE,'1800-01-01', Criteria::GREATER_THAN);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');

    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }


  public function executeNuevorss()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
 //   $c->add(SerialPeer::PUBLICDATE,'1800-01-01', Criteria::GREATER_THAN);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');

    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }

  public function executeNovedades()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
 //   $c->add(SerialPeer::PUBLICDATE,'1800-01-01', Criteria::GREATER_THAN);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');

    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }

  public function executeLastnews()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c, array('pub'));
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    MmPeer::doSelectWithI18n($c, 'es');
    $c->add(MmPeer::ANNOUNCE, true);
    $c->setLimit(10);
    $this->mms = MmPeer::doSelectWithI18n($c, 'es');

    $cr = new Criteria();
    $cr->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelectWithI18n($cr);
  }



  /**
   * --  VIDEOSITEMAP -- /videositemap.xml
   * Genera FEED Google VideoSiteMap
   * mas info en http://google.es/support/webmaster/bin/topic.py?topic=10079
   *
   */
  public function executeVideositemap()
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 3);
    SerialPeer::addBroadcastCriteria($c);

    $this->serials = SerialPeer::doSelectWithI18n($c);
  }

}
