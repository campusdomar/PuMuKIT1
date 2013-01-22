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
  public $server;
  public $user;
  public $password;
  public $anonymous = true;
  public $cookie;
  
  public function preExecute()
  {
    $this->server    = sfConfig::get('app_matterhorn_server');
    $this->user      = sfConfig::get('app_matterhorn_user');
    $this->password  = sfConfig::get('app_matterhorn_password');
    
    $this->anonymous = $this->getUser()->getAttribute('anonymous', false, 'tv_admin/matterhorn');
    $this->cookie    = $this->getUser()->getAttribute('cookie','','tv_admin/matterhorn');
    
    $this->init_cookie();
    /*
    if(!$this->anonymous){
      $this->init_cookie();
    }
    */
  }


  public function executeIndex()
  {
    $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/matterhorn');
  }


  public function executeDownload()
  {
    $oc = MmMatterhornPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($oc);

    $this->redirect($oc->getMasterUrl($this->cookie));
  }

  public function executeInfo()
  {
    if(!($info = $this->getInfo())){
      return sfView::ERROR;
    }

    $this->conf = $this->anonymous;
    $this->oc_server = $this->server;
    $this->username = $info['username'];
    $this->roles = implode(',', $info['roles']);
    $this->img = $info['org']['properties']['logo_small'];
  }


  public function executeList()
  {
    $limit  = 8;
    $offset = 0;
    
    if ($this->hasRequestParameter('reset')){
      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/matterhorn');
    }

    if ($this->hasRequestParameter('page')){
      $offset = $this->getRequestParameter('page') - 1;
      $this->getUser()->setAttribute('offset', $offset, 'tv_admin/matterhorn');
    }
    $offset = $this->getUser()->getAttribute('offset', 0, 'tv_admin/matterhorn');

    if ($this->hasRequestParameter('q')){
      $q_orig = $this->getUser()->getAttribute('q', '', 'tv_admin/matterhorn');
      $q = $this->getRequestParameter('q');
      if ($q != $q_orig) {
        $offset = 0;
      }
      $this->getUser()->setAttribute('q', $q, 'tv_admin/matterhorn');
    }
    $q = $this->getUser()->getAttribute('q', '', 'tv_admin/matterhorn');

    $out = $this->getAll($offset * $limit, $limit, $q);

    if(!$out || !isset($out['search-results']['total'])){
      return sfView::ERROR;
    }

    try{
      $total = $out['search-results']['total'];
    } catch (Exception $e) {
      return sfView::ERROR;
    }

    if ($total == 0) {
      $media_packages = array();
    } elseif ($total == 1) {
      $media_packages = array();
      $media_packages[] = $this->map_mp($out['search-results']['result']);
    } else {
      $media_packages = array();
      foreach($out['search-results']['result'] as $mp){
	$media_packages[] = $this->map_mp($mp);
      }
    }
    
    $this->total = $total;
    $this->page = $offset + 1;
    $this->total_page = ceil($this->total / $limit); 
    $this->media_packages = $media_packages;
    $this->mh_server = sfConfig::get('app_matterhorn_server');
  }


  public function executeToggle()
  {
    $this->getUser()->setAttribute('anonymous', 
				   $this->getRequestParameter('value', 'false') == "true", 
				   'tv_admin/matterhorn');
    return $this->renderText("Cambio realizado (reload)");
  }


  public function executeImport(){
    $id = $this->getRequestParameter('id');

    $aux = $this->get($id);
    $mp = $this->map_mp_all($aux["search-results"]["result"]);
    $mm = $this->createMm($mp);
  
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    //return $this->renderText(json_encode($mp));
    return $this->forward('matterhorn', 'list');
  }
  


  private function map_mp($mp){
      $img = null;
      
      if(isset($mp["mediapackage"]["attachments"]) and isset($mp["mediapackage"]["attachments"]["attachment"])){
	foreach($mp["mediapackage"]["attachments"]["attachment"] as $attach){
	  if(($attach['type'] == "presenter/search+preview") && ($attach['mimetype'] == "image/jpeg")){
	    $img = $attach['url'];
	  }
	}
      }

      /*MIRO SI EXISTE EN LA BBDD */
      $c = new Criteria();
      $c->add(MmMatterhornPeer::MH_ID, $mp['id']);
      $c->addJoin(MmPeer::ID, MmMatterhornPeer::ID);
      $mm = MmPeer::doSelectOne($c);
      
      //Antes $mp["dcCreated"]

      $date = strtotime($mp["mediapackage"]["start"]);
      

      return array("id" => $mp["id"], 
		   "title" => $mp["dcTitle"], 
		   "duration" => $mp["mediapackage"]["duration"], 
                   'serial_id' => isset($mp["mediapackage"]["series"])?$mp["mediapackage"]["series"]:null,
		   "date" => $date, 
		   "img" => $img,
		   'mm' => $mm);
  }


  private function map_mp_all($mp){
    $img = null;
    foreach($mp['mediapackage']['attachments']['attachment'] as $attach){
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
    $date = strtotime($mp["mediapackage"]["start"]);

    //FIXME ojo sino viene datos
    return array('id' => $mp['id'], 
		 'title' => isset($mp['dcTitle'])?$mp['dcTitle']:null, 
		 'date' => $date, 
		 'description' => isset($mp['dcDescription'])?$mp['dcDescription']:null,
		 'subject' => isset($mp['dcSubject'])?$mp['dcSubject']:null,
		 'language' => isset($mp['dcLanguage'])?$mp['dcLanguage']:null,
		 'creator' => isset($mp['dcCreator'])?$mp['dcCreator']:null,
		 'serial_id' => isset($mp["mediapackage"]["series"])?$mp["mediapackage"]["series"]:null,
		 "duration" => $mp["mediapackage"]["duration"], 
		 'img' => isset($img)?$img:null,
		 'mm' => $mm);
    
  }

  private function getAll($offset = 0, $limit = 5, $q = null)
  {
    $url_q = is_null($q)?'':('&q=' . urlencode($q));
    $sal = $this->getMatterhorn($this->server . $this->search_endpoint . '?limit=' . $limit . '&offset=' . $offset . $url_q);

    if ($sal["status"] !== 200) return false;
    
    //FIXME capturar si falla.
    return json_decode($sal["var"], true);
  }

  private function get($id)
  {
    $sal = $this->getMatterhorn($this->server . $this->search_endpoint . "?id=" . $id); 
	
    if ($sal["status"] !== 200) return false;
    
    //FIXME capturar si falla.
    return json_decode($sal["var"], true);
  }

  private function getInfo()
  {
    $sal = $this->getMatterhorn($this->server . '/info/me.json');
	
    if ($sal["status"] !== 200) return false;
    
    //FIXME capturar si falla.
    return json_decode($sal["var"], true);
  }


  /**
   *
   * Hace una peticion al core de matterhorn
   *
   **/
  private function getMatterhorn($url)
  {

    
    $sal = array();
    $ch = curl_init($url); 
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-Auth: Digest"));
    
    $sal["var"] = curl_exec($ch); 
    $sal["error"] = curl_error($ch);
    $sal["status"] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($sal["status"] !== 200){
      $this->init_cookie();
      $sal = $this->getMatterhorn($url);
    }

    return $sal;
    
  }

  private function init_cookie()
  {    
    $cookie = MmMatterhornPeer::getCookie($this->server, $this->user, $this->password);
    $this->cookie = $cookie;
    $this->getUser()->setAttribute('cookie', $cookie, 'tv_admin/matterhorn');
    return true; 
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
      $sal = $this->getMatterhorn($this->server . "/series/" . $oc_id. ".json");     
    
      if ($sal["status"] !== 200) return false;
      
      $data = json_decode($sal["var"], true);

    
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
      $mm->setSubtitle($mp['subject']);
      if (strlen($mp['description']) > 0){
          $mm->setDescription($mp['description']);
      }
    }

    $mm->setStatusId(MmPeer::STATUS_BLOQ);
    $mm->save();
    $mm->setPic($mp['img']);

    $mmMatterhorn = new MmMatterhorn();
    $mmMatterhorn->setId($mm->getId());
    $mmMatterhorn->setMhId($mp['id']); 
    $mmMatterhorn->setLanguageId(4);
    $mmMatterhorn->setPlayerUrl($this->server . '/engage/ui/watch.html?id=%id%'); 
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
