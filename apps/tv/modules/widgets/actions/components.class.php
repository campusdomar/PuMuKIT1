<?php

/**
 * widgets components.
 *
 * @package    fin
 * @subpackage widgets
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class widgetsComponents extends sfComponents
{
  /**
   * Executes WIDGETS BANNER
   *
   */
  public function executeHeader()
  {
    //MAL NO PONGAS 1
    $this->header = WidgetTemplatePeer::get(1 ,$this->getUser()->getCulture(), '<h1>PUMUKIT<h1>');
  }

  public function executeSubheader()
  {
    $this->value = $this->getRequestParameter('module');
    $this->value = ($this->value=='templates'?$this->getRequestParameter('temp'):$this->value);
  }

  public function executeBreadcrumb()
  {
  }


  public function executeFooter()
  {
    //MAL no pongas 2
    $this->header = WidgetTemplatePeer::get(2 ,$this->getUser()->getCulture(), '<h1>PUMUKIT<h1>');
  }


  /**
   * Executes WIDGETS LATERAL
   *
   */
  public function executeIdioma()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }

  public function executeNoidioma()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es', 'gl'));
  }

  public function executeMenu()
  {
    $c = new Criteria();
    $c->add(TemplatePeer::TYPE, 2);
    $c->add(TemplatePeer::USER, 1);
    $this->templates = TemplatePeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->directs = DirectPeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());

    $this->value = $this->getRequestParameter('module');
    $this->value = ($this->value=='templates'?$this->getRequestParameter('temp'):$this->value);
  }

  public function executeTotal()
  {
    $this->num_series = PubChannelPeer::numSerials(1);
    $this->num_videos = PubChannelPeer::numMms(1);
    $this->horas = PubChannelPeer::numHours(1);
  }

  public function executeListacorreo()
  {
  }

  public function executeRss()
  {
    $this->rsss = array(
			array('rss', 'VIDEOTECA', '/xml/arca'), 
			);
  }

  public function executeBuscar()
  {
  }

  public function executeAuth()
  {
  }

  public function executeGoogle()
  {
    $this->domain = sfConfig::get('app_info_host', $this->getRequest()->getHost());
  }

  public function executeSoftware()
  {
    //falta poder configurar    
    $this->softwares = array(
			     array('wmplayer', 'Windows Media Player', 'http://www.microsoft.com/windows/windowsmedia/player/download/'), 
			     array('vlc', 'VLC Media Player', 'http://www.videolan.org/vlc/')
			     );
  }

  public function executeContacto()
  {
    $this->mail = WidgetConstantPeer::get(7);
    $this->telefono = WidgetConstantPeer::get(8);
    $this->info = WidgetConstantPeer::get(9);
  }

  public function executeProximas()
  {
    //MAL no pongas 4
    $this->text = WidgetTemplatePeer::get(4 ,$this->getUser()->getCulture(), '<h1>PUMUKIT<h1>');
  }

  public function executeHtml()
  {
    //MAL no pongas 4
    $this->text = WidgetTemplatePeer::get(5 ,$this->getUser()->getCulture(), '<h1>PUMUKIT<h1>');
  }

  public function executeMasvistostotal()
  {
    $this->mms = PubChannelPeer::masVistos(1, $this->getUser()->getCulture(), 0, 3);
  }

  public function executeMasvistosmes()
  {
    $this->mms = PubChannelPeer::masVistos(1, $this->getUser()->getCulture(), 30, 3);
  }

  public function executeMasvistossemana()
  {
    $this->mms = PubChannelPeer::masVistos(1, $this->getUser()->getCulture(), 7, 3);
  }

  public function executeMasvistosdia()
  {
    $this->mms = PubChannelPeer::masVistos(1, $this->getUser()->getCulture(), 1, 3);
  }

  public function executeMasvistostotalfalso()
  {
    //MAL 1, 4
    $this->mms = WidgetConstantPeer::getMasVistosFalso(1, 4);
  }
    
  public function executeMasvistosmesfalso()
  {
    //MAIL 4, 7
    $this->mms = WidgetConstantPeer::getMasVistosFalso(4, 7);
  }
  /**
   * Executes WIDGETS INDEX
   *
   */

  public function executeInfowebtv()
  {
    //MAL no pongas 3
    $this->text = WidgetTemplatePeer::get(3 ,$this->getUser()->getCulture(), '<h1>PUMUKIT<h1>');
  }

  public function executeNews()
  {
    $this->notices = NoticePeer::doListWithI18n($this->getUser()->getCulture(), 5);
  }

// El frontend usa Announcesv2
  public function executeAnnounces()
  {
    
    $this->announces = PubChannelPeer::getAnnounces(1, $this->getUser()->getCulture(), 6);
    //$pub_channel = PubChannelPeer::retrieveByPk(1);
    //$this->announces = $pub_channel->getAnnounces($this->getUser()->getCulture(), 6);
    //$this->announces = SerialPeer::getAnnounces(  $this->getUser()->getCulture(), 6); 
  }

  public function executeAnnouncesv2()
  {
    $this->last = PubChannelPeer::getSerialAndMmAnnounces(1, $this->getUser()->getCulture(), 3);
    //$this->last = PubChannelPeer::ultimos(1, $this->getUser()->getCulture(), 3);
    $this->popular = PubChannelPeer::masVistos(1, $this->getUser()->getCulture(), 3);
    //$this->featured = PubChannelPeer::anunciados(1, $this->getUser()->getCulture(), 3);

  }


  public function executeLastvistos()
  {
    $this->mms = SerialPeer::getLast($this->getUser()->getCulture(), 5);
  }

  public function executeNabbuttons()
  {
    $c = new Criteria();
    $c->add(VirtualGroundPeer::DISPLAY, true);
    $this->categories = VirtualGroundPeer::doSelect($c);

    $this->style = WidgetConstantPeer::get(11);
  }

  public function executeNabbuttonsv2()
  {
    $c = new Criteria();
    $c->add(VirtualGroundPeer::DISPLAY, true);
    $this->categories = VirtualGroundPeer::doSelect($c);

    $this->style = WidgetConstantPeer::get(11);
  }

}

