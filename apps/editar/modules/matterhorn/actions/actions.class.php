<?php
/**
 * MODULO OC-MH ACTIONS. 
 * Modulo de importacion desde OC-MH
 *
 * @package    pumukit
 * @subpackage matterhorn
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class matterhornActions extends sfActions
{

  public $init_endpoint = '/welcome.html';
  public $search_endpoint = '/search/episode.json';
  public $engage_server;
  public $admin_server;
  public $user;
  public $password;
  
  public function preExecute()
  {
    $this->engage_server  = sfConfig::get('app_matterhorn_server');
    $this->admin_server   = sfConfig::get('app_matterhorn_server_admin');
    $this->user           = sfConfig::get('app_matterhorn_user');
    $this->password       = sfConfig::get('app_matterhorn_password');
  }


  public function executeIndex()
  {
    $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/matterhorn');
  }


  public function executeDownload()
  {
    $oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($oc);

    $this->redirect($oc->getMasterUrl()); 
  }

  public function executeInfo()
  {
    if(!($info = MmMatterhornPeer::serverInfo())){
      return sfView::ERROR;
    }

    $this->oc_server = $this->admin_server;
    $this->username = $info['username'];
    $this->roles = implode(',', $info['roles']);
    $this->img = $info['org']['properties']['logo_small'];
  }


  public function executeList()
  {
    $limit  = 8;
    $startPage = 0;
    
    if ($this->hasRequestParameter('reset')){
      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/matterhorn');
    }

    if ($this->hasRequestParameter('page')){
      $startPage = $this->getRequestParameter('page') - 1;
      $this->getUser()->setAttribute('startPage', $startPage, 'tv_admin/matterhorn');
    }
    $startPage = $this->getUser()->getAttribute('startPage', 0, 'tv_admin/matterhorn');


    if ($this->hasRequestParameter('q')){
      $q_orig = $this->getUser()->getAttribute('q', '', 'tv_admin/matterhorn');
      $q = $this->getRequestParameter('q');
      if ($q != $q_orig) {
        $startPage = 0;
      }
      $this->getUser()->setAttribute('q', $q, 'tv_admin/matterhorn');
    }
    $q = $this->getUser()->getAttribute('q', '', 'tv_admin/matterhorn');
   

    $media_packages = MmMatterhornPeer::getMediaPackages($limit, $startPage, $q);

    

    $this->total = MmMatterhornPeer::getNumMediaPackages($q);
    $this->page = $startPage + 1;
    $this->total_page = ceil($this->total / $limit); 
    $this->media_packages = $media_packages;
    $this->mh_server = $this->admin_server;
    $this->en_server = $this->engage_server;
  }



  public function executeImport(){
    $id = $this->getRequestParameter('id');

    $aux = MmMatterhornPeer::getMediaPackage($id);
    $mp = $this->map_mp_all($aux);
    $mm = $this->createMm($mp);
  
    /*
      $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
      return $this->renderText(json_encode($mp));
    */
    return $this->forward('matterhorn', 'list');
  }


  private function map_mp_all($mp){
    $img = null;

    foreach($mp['attachments']['attachment'] as $attach){
      if(($attach['type'] == 'presenter/search+preview') && ($attach['mimetype'] == 'image/jpeg')){
	$img = $attach['url'];
      }
    }
    
    /*MIRO SI EXISTE EN LA BBDD */
    $c = new Criteria();
    $c->add(MmMatterhornPeer::MH_ID, $mp['id']);
    $c->addJoin(MmMatterhornPeer::MH_ID, MmPeer::ID);
    $mm = MmPeer::doSelectOne($c);

    //Antes $mp["dcCreated"]
    $date = strtotime($mp["start"]);

    //FIXME ojo sino viene datos
    return array('id' => $mp['id'], 
		 'title' => isset($mp['title'])?$mp['title']:null, 
		 'date' => $date, 
		 'serial_id' => isset($mp["series"])?$mp["series"]:null,
		 "duration" => $mp["duration"], 
		 'img' => isset($img)?$img:null,
		 'mm' => $mm);
  }


  /**
   *
   *
   */
  private function getSeries($oc_id = null)
  {
    if($oc_id != null){
      
      /*MIRO SI EXISTE EN LA BBDD */
      $c = new Criteria();
      $c->add(SerialMatterhornPeer::MH_ID, $oc_id);
      $c->addJoin(SerialMatterhornPeer::ID, SerialPeer::ID);
      $s = SerialPeer::doSelectOne($c);
      

      if($s !== null){
	//FIXME mirar si se tiene que actualizar
	return $s;
      }

      /*OBTENGO DATOS*/
      $data = MmMatterhornPeer::series($oc_id);
    
      /*SI NO EXISTE CREO UNA NUEVA SERIE*/
      $s = new Serial();
      $s->setPublicdate("now");

      $s->setAnnounce(0);
      $cr = isset($data["http://purl.org/dc/terms/"]["license"][0]['value'])?$data["http://purl.org/dc/terms/"]["license"][0]['value']:"";
      $s->setCopyright($cr);
      $s->setSerialTypeId(SerialTypePeer::getDefaultSelId());
      $s->setSerialTemplateId(1);
      
      $langs = sfConfig::get('app_lang_array', array('es'));
      foreach($langs as $lang){
          $s->setCulture($lang);
          //FIXME
          $s->setTitle(isset($data["http://purl.org/dc/terms/"]["title"][0]['value'])?$data["http://purl.org/dc/terms/"]["title"][0]['value']:'');
          $s->setSubtitle(isset($data["http://purl.org/dc/terms/"]["subject"][0]['value'])?$data["http://purl.org/dc/terms/"]["subject"][0]['value']:'');
          $s->setKeyword('');
          $s->setDescription(isset($data["http://purl.org/dc/terms/"]["description"][0]['value'])?$data["http://purl.org/dc/terms/"]["description"][0]['value']:'');
      }
      
      $s->save();
      
      
      $sMatterhorn = new SerialMatterhorn();
      $sMatterhorn->setId($s->getId());
      $sMatterhorn->setMhId($oc_id);
      $sMatterhorn->save();
    }else{
    
      $s = new Serial();
      $s->setPublicdate("now");
      $s->setAnnounce(0);
      $s->setCopyright(sfConfig::get('app_info_copyright', 'Universidade de Vigo'));
      $s->setSerialTypeId(0);
      $s->setSerialTemplateId(1);
      
      $langs = sfConfig::get('app_lang_array', array('es'));
      foreach($langs as $lang){
	$s->setCulture($lang);
	//FIXME
	$s->setTitle("nuevo from OC-MH");
      }
      
      $s->save();
    }
    return $s;
    
  }

  private function createMm($mp)
  {
    if($mp['mm'] !== null){
      //FIXME mirar si se tiene que actualizar
      return $mp['mm'];
    }

    $serial = $this->getSeries($mp['serial_id']);
    $mm = MmPeer::createNew($serial->getId());

    $mm->setPublicdate("now");
    $mm->setRecorddate($mp['date']);

    $mm->setGenreId(22); //Genero matterhorn

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm->setTitle($mp['title']);
      /*
      if (strlen($mp['subject']) > 0){
	$mm->setSubtitle($mp['subject']);
      }
      if (strlen($mp['description']) > 0){
          $mm->setDescription($mp['description']);
      }
      */
    }

    $mm->setStatusId(MmPeer::STATUS_BLOQ);
    $mm->save();
    $mm->setPic($mp['img']);

    $mmMatterhorn = new MmMatterhorn();
    $mmMatterhorn->setId($mm->getId());
    $mmMatterhorn->setMhId($mp['id']); 
    $mmMatterhorn->setLanguageId(4);
    $mmMatterhorn->setPlayerUrl($this->engage_server . '/engage/ui/watch.html?id=%id%'); 
    $mmMatterhorn->setDuration($mp["duration"]/1000); 
    $mmMatterhorn->save();
   
    return $mm;

  }
  

  /**
   * CRUD
   */
  public function executeEdit()
  {
    $this->oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->oc);
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  public function executeUpdate()
  {
    $oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($oc);

    $oc->setLanguageId($this->getRequestParameter('language_id', 0));
    $oc->setDuration($this->getRequestParameter('duration_min', 0) * 60 + $this->getRequestParameter('duration_seg', 0));
    $oc->setDisplay($this->getRequestParameter('display', 0));
    $oc->setInvert($this->getRequestParameter('invert', 0));
  
    $oc->save();

    return $this->renderComponent('files', 'list'); 
  }


  /**
   * Screen by Screen
   */
  public function executeSbs()
  {

    $oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($oc);

    $oc->retranscoding(2, $this->getUser()->getAttribute('user_id'), true);


    return $this->renderComponent('files', 'list'); 
  }


  public function executeInfomp()
  {
    $oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($oc);

    $this->camera = $oc->getTrackUrlByType("presenter/delivery");
    $this->screen = $oc->getTrackUrlByType("presentation/delivery");    
  }


}
