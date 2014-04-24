<?php

/**
 * Mm (class)
 *
 * Clase que representa una entrada en la
 * tabla 'mm'. Tabla que almacena los objetos
 * multimedia.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Mm extends BaseMm
{
  public function updateLuceneIndex()
  {
    $index = MmPeer::getLuceneIndex();
 
    // remove existing entries
    foreach ($index->find('pk:'.$this->getId()) as $hit)
      {
	$index->delete($hit->id);
      }
 
    $doc = new Zend_Search_Lucene_Document();
 
    // store Mm primary key to identify it in the search results
    $doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));

    // index Mm fields
    $doc->addField(Zend_Search_Lucene_Field::UnStored('title', Sanitize::text($this->getTitle()), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('subtitle', Sanitize::text($this->getSubtitle()), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('keyword', Sanitize::text($this->getKeyword()), 'utf-8'));
    $doc->addField(Zend_Search_Lucene_Field::UnStored('description', Sanitize::text($this->getDescription()), 'utf-8'));

    $persons = $this->getPersons();
    $personStr = "";

    foreach($persons as $person){
      $personStr .= $person->getName() . " ";
    }

    $doc->addField(Zend_Search_Lucene_Field::UnStored('persons', Sanitize::text($personStr), 'utf-8'));
    
    // add Mm to the index
    $index->addDocument($doc);
    $index->commit();
  }

  public function save($con = null)
  {

    if (is_null($con)) {
      $con = Propel::getConnection(MmPeer::DATABASE_NAME);//, Propel::CONNECTION_WRITE);
    }
    
    $con->begin();
    try {
      parent::save($con);
      $this->updateLuceneIndex();
      $con->commit();
    }
    catch (Exception $e) {
      $con->rollBack();
      throw $e;
    }
  }


  /**
   * Usada para guardar en la BBDD sin actualizar Lucene. Usar con cuidado.
   */
  public function saveInDB($con = null)
  {
    parent::save($con);
  }

  public function delete($con = null)
  {
    $index = MmPeer::getLuceneIndex();
    
    foreach ($index->find('pk:'.$this->getId()) as $hit) {
      $index->delete($hit->id);
    }
    
    return parent::delete($con);
  }
  /**
   * Devuelve el los primeros caracteres del titulo
   * Intenta cortar el string en un espacio
   *
   * @access public
   * @return String
   */
  public function getShortTitle($long = 50){
    $t = $this->getTitle(); 
    if(strlen($t) < $long){
      return $t;
    }
    
    $aux = @strpos($t, ' ', 50); 
    return substr_replace($t, '...', $aux?$aux:$long);
  }

  /**
   * Devuelve el master, primer fichero con perfil no publico
   * (OJO cambiar)
   *
   * @access public
   * @return Objeto File
   */
  public function getMaster()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    $c->add(PerfilPeer::MASTER, true);
    $c->addAscendingOrderByColumn(FilePeer::RANK);
    $c->setLimit(1);

    $f = FilePeer::doSelectWithI18n($c, $this->getCulture());
    return !empty($f) > 0 ? $f[0] : null;
  }


  /**
   * Devuelve el primer archivo multimedia, si no tiene devuelve null
   *
   * @access public
   * @return File
   */
  public function getFirstFile()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    $c->add(PerfilPeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    return FilePeer::doSelectOne($c);
  }
  /**
   * @var        Genre
   */
  protected $aFirstFilePublic;

  /**
   * Devuelve el primer archivo multimedia, si no tiene devuelve null
   *
   * @access public
   * @return File
   */
  public function getFirstPublicFile()
  {
    if ($this->aFirstFilePublic === null) {
      $c = new Criteria();
      $c->add(FilePeer::MM_ID, $this->getId());
      $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
      $c->add(PerfilPeer::DISPLAY, true);
      $c->addAscendingOrderByColumn(FilePeer::RANK);

      $this->aFirstFilePublic = FilePeer::doSelectOne($c);
      if ($this->aFirstFilePublic){
        $this->aFirstFilePublic->setMm($this);
      }
    }
    return $this->aFirstFilePublic;
  }

  /**
   * Devuelve el los archivos multimedia que tienen perfil publico.
   *
   * @access public
   * @return Array de Files
   */
  public function getFilesPublic()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    $c->add(PerfilPeer::DISPLAY, true);
    $c->add(FilePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    return FilePeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve el los archivos multimedia que se pueden descargar.
   *
   * @access public
   * @return Array de Files
   */
  public function getFilesToDownload()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->add(FilePeer::DOWNLOAD, true);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    return FilePeer::doSelectWithI18n($c, $this->getCulture());
  }


  /** 
   * Devuelve el los materiales que tienen perfil publico.    
   * 
   * @access public 
   * @return Array de Files   
   */
  public function getMaterialsPublic()
  {
    $c = new Criteria();
    $c->add(MaterialPeer::MM_ID, $this->getId());
    $c->add(MaterialPeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(MaterialPeer::RANK);

    return MaterialPeer::doSelectWithI18n($c, $this->getCulture());
  }
  /**
   * Devuelve los ficheros de video de un determiando perfil.
   *
   * @access public
   * @return array de Objeto Files
   */
  public function getFilesByPerfil($perfil_id)
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->add(FilePeer::PERFIL_ID, $perfil_id, is_int($perfil_id)?null:Criteria::IN);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    return FilePeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve el fichero de video de un determiando perfil.
   * OJO solo devuelve el primero
   *
   * @access public
   * @return Objeto File
   */
  public function getFileByPerfil($perfil_id)
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->add(FilePeer::PERFIL_ID, $perfil_id, is_int($perfil_id)?null:Criteria::IN);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    $f = FilePeer::doSelectWithI18n($c, $this->getCulture());
    return !empty($f) > 0 ? $f[0] : null;
  }



  /**
   * Devuelve los ficheros de video de un determiando perfil.
   *
   * @access public
   * @return array de Objeto Transcodings
   */
  public function getTranscodingsByPerfil($perfil_id)
  {
    $c = new Criteria();
    $c->add(TranscodingPeer::MM_ID, $this->getId());
    $c->add(TranscodingPeer::PERFIL_ID, $perfil_id, is_int($perfil_id)?null:Criteria::IN);
    $c->add(TranscodingPeer::STATUS_ID, array(0, 1, 2), Criteria::IN);

    return TranscodingPeer::doSelectWithI18n($c, $this->getCulture());
  }


  /**
   * Devuelve el fichero de video de un determiando perfil.
   *
   * @access public
   * @return Objeto File
   */
  public function getFileByPerfilAndLanguage($perfil_id, $language_id)
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->add(FilePeer::PERFIL_ID, $perfil_id, is_int($perfil_id)?null:Criteria::IN);
    $c->add(FilePeer::LANGUAGE_ID, $language_id, is_int($language_id)?null:Criteria::IN);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    $f = FilePeer::doSelectWithI18n($c, $this->getCulture());
    return !empty($f) > 0 ? $f[0] : null;
  }


  /**
   * Devuelve la primera tarea de codificacion, si no tiene devuelve null
   *
   * @access public
   * @return Transcoding
   */
  public function getFirstTranscoding()
  {
    $c = new Criteria();
    $c->add(TranscodingPeer::MM_ID, $this->getId());
    $c->addAscendingOrderByColumn(TranscodingPeer::ID);

    return TranscodingPeer::doSelectOne($c);
  }


  /**
   * Devuelve las personas asociadas al objeto multimedia, con el
   * rol dado, si rol es cero se devuelve todas las personas con rol visible.
   *
   * @access public
   * @param integer $role_id
   * @return ResulSet of Person
   */
  public function getPersons($role_id = 0)
  {
    $c = new Criteria();
    $c->addJoin(PersonPeer::ID, MmPersonPeer::PERSON_ID);
    $c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);
    if ($role_id != 0) {
      $c->add(MmPersonPeer::ROLE_ID, $role_id);
    }
    else {
      $c->add(RolePeer::DISPLAY, true);
      $c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID);
    }
    $c->add(MmPeer::ID, $this->getId());
    $c->addAscendingOrderByColumn(MmPersonPeer::RANK);

    return PersonPeer::doSelectWithI18n($c, $this->getCulture());
  }


  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Ground.
   */
  public function getGroundsWithI18n($ground_type = 0)
  {
    $c = new Criteria();

    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->add(GroundMmPeer::MM_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Grounds.
   */
  public function getGrounds($ground_type = 0)
  {
    $c = new Criteria();

    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->add(GroundMmPeer::MM_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelect($c);
  }



  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Grounds.
   */
  public function getFirstVirtualGround()
  {
    $c = new Criteria();

    $c->addJoin(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, VirtualGroundPeer::ID);
    $c->addJoin(GroundMmPeer::GROUND_ID, VirtualGroundRelationPeer::GROUND_ID);
    $c->add(GroundMmPeer::MM_ID, $this->getId());

    $c->addJoin(VirtualGroundRelationPeer::GROUND_ID, GroundPeer::ID);
    $c->add(GroundPeer::GROUND_TYPE_ID, WidgetConstantPeer::get(10));
    //sfConfig::get

    return VirtualGroundPeer::doSelectOne($c);
  }



  /**
   *
   *
   */
  public function getPlace($con = null)
  {
    $c = new Criteria();
    $c->addJoin(PlacePeer::ID, PrecinctPeer::PLACE_ID);
    $c->add(PrecinctPeer::ID, $this->getPrecinctId());
    list($resp) = PlacePeer::doSelectWithI18n($c, $this->getCulture());
    return $resp;
  }


  /**
   *
   *
   */
  public function getPlaceId($con = null)
  {
    return $this->getPlace()->getId();
  }


  /**
   *
   *
   */
  public function getPrecinctOfSerial($con = null)
  {
    if  ($this->isNew()) return false;
    $conexion = Propel::getConnection();
    $consulta = 'SELECT VARIANCE(%s) AS var, AVG(%s) AS avg  FROM %s WHERE %s=%s ';
    $consulta = sprintf($consulta, MmPeer::PRECINCT_ID, MmPeer::PRECINCT_ID, MmPeer::TABLE_NAME, MmPeer::SERIAL_ID, $this->getSerialId());
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    $precinct_id = $resultset->getInt('avg');
    
    if ($resultset->getFloat('var') === 0.0){
      //Usar hydrate
      $c = new Criteria();
      $c->add(PrecinctPeer::ID, $precinct_id);
      list($resp) = PrecinctPeer::doSelectWithI18n($c, $this->getCulture());
    }else{
      $resp = false;
    }

    return $resp;
  }


  /**
   *
   *
   */
  public function getPlaceOfSerial($con = null)
  {
    if  ($this->isNew()) return false;
    $conexion = Propel::getConnection();
    $consulta = 'SELECT VARIANCE(%s) AS var, AVG(%s) AS avg  FROM %s,%s WHERE %s=%s AND %s=%s';
    $consulta = sprintf($consulta, PrecinctPeer::PLACE_ID, PrecinctPeer::PLACE_ID, PrecinctPeer::TABLE_NAME, PlacePeer::TABLE_NAME, PrecinctPeer::ID, MmPeer::PRECINT_ID , MmPeer::SERIAL_ID, $this->getSerialId());
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    $place_id = $resultset->getInt('avg');
    
    if ($resultset->getFloat('var') === 0.0){
      //Usar hydrate
      $c = new Criteria();
      $c->add(PlacePeer::ID, $place_id);
      list($resp) = PlacePeer::doSelectWithI18n($c, $this->getCulture());
    }else{
      $resp = false;
    }

    return $resp;
  }

  /**
   * Genera un la url relativa de la pagina web de su serie. 
   * Lincandola con su video.
   *
   * @access public
   * @return String Url relativa.
   */
  public function getUrl($absolute = false)
  {
    //Hack
    $old = sfConfig::get('sf_no_script_name');
    sfConfig::set('sf_no_script_name', true);
    $controller = sfContext::getInstance()->getController();
    //$url = $controller->genUrl(array('module'=> 'video', 'action' => 'index', 'id' => $this->getId()), $absolute);
    $url = $controller->genUrl(array('module'=> 'video', 'action' => 'index', 'id' => $this->getId()), $absolute);
    sfConfig::set('sf_no_script_name', $old);
    return $url;
  }



  /**
   * Genera la segunda linea enriquezida el video.
   * Esta segunda linea, si esta vacia en la bbdd,
   * se genera con el genero y el nombre del primer 
   * actor en negrilla.
   *
   * @access public
   * @return String Line2
   */
  public function getLine2Rich()
  {
    $aux = parent::getLine2();
    if ($aux == '') {
      $aux =  $this->getGenreWithI18n()->getName();
      if ($this->getFirstPersonName($this->getCulture()) != '') $aux .= ' | <strong>'.$this->getFirstPersonName($this->getCulture()).'</strong>'; 
    }
    return $aux;
  }


  /**
   * Genera la segunda linea enriquezida el video.
   * Esta segunda linea, si esta vacia en la bbdd,
   * se genera con el genero y el nombre del primer 
   * actor en negrilla.
   *
   * @access public
   * @return String Line2
   */
  public function getLine2Basic()
  {
    return $this->getFirstPersonName();
  }

  /**
   * Devuelve La primera persona del video
   *
   * @access public
   * @return String Nombre del actor
   */
  public function getFirstPerson($culture = null, $role = 1)
  {
    $c = new Criteria();

    $c->addJoin(PersonPeer::ID, MmPersonPeer::PERSON_ID);
    $c->add(MmPersonPeer::ROLE_ID, $role);  /*actor*/
    $c->add(MmPersonPeer::MM_ID, $this->getId());
    $c->addAscendingOrderByColumn(MmPersonPeer::RANK);

    //MAL
    $p = PersonPeer::doSelectOne($c);
    return ((isset($p))? $p: null);
  }


  /**
   * Devuelve El nombre del primer actor del Video
   *
   * @access public
   * @return String Nombre del actor
   */
  public function getFirstPersonName($culture = null, $role = 1)
  {
    $p = $this->getFirstPerson($culture, $role);
    return ((isset($p))? $p->getHName() : '');
  }

  /**
   * Devuelve la duracion del primer File
   * 
   *
   * @access public
   * @return Lista de files
   *
   *
   * @internal OJO FALSTA PONER LA CULTURA.
   */
  public function getDuration($criteria = null, $con = null)
  {
    $aux = $this->getFirstFile();	
    if ($aux) return $aux->getDuration();
    else return 0;
  }



  /**
   * Devuelve la fecha de grabacion en texto
   *
   * @access public
   * @return String Fecha de grabacion
   */
  public function getRecorddateText()
  {
    setlocale(LC_ALL, $this->getCulture().'_ES.UTF8');
    return strftime("%d de %B de %Y", parent::getRecorddate(null));
  }

  /**
   * Sobreescribe la funcion copy.
   *
   *
   */
  public function copy($bool = false)
  {
    $mm2 = new Mm();

    $mm2->setSubserial($this->getSubserial());
    $mm2->setMail($this->getMail());       
    $mm2->setSerialId($this->getSerialId());  
    $mm2->setPrecinctId($this->getPrecinctId());  
    $mm2->setGenreId($this->getGenreId());  
    $mm2->setCopyright($this->getCopyright()); 
    $mm2->setBroadcastId($this->getBroadcastId());
    $mm2->setRecordDate($this->getRecordDate());
    $mm2->setPublicDate($this->getPublicDate());  

    $mm2->setAnnounce(false);
    $mm2->setStatusId(MmPeer::STATUS_BLOQ);
    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm2->setCulture($lang);
      $this->setCulture($lang);
      $mm2->setTitle($this->getTitle());
      $mm2->setSubtitle($this->getSubtitle());
      $mm2->setKeyword($this->getKeyword());
      $mm2->setDescription($this->getDescription());
      $mm2->setLine2($this->getLine2());
      $mm2->setSubserialTitle($this->getSubserialTitle());
    }
    $mm2->save();
    $grounds = $this->getGrounds();
    foreach($grounds as $gr){
      $gv = new GroundMm();
      $gv->setMmId($mm2->getId());
      $gv->setGroundId($gr->getId());
      $gv->save();
    }

    foreach ($this->getCategories() as $category){
      $category->addMmId($mm2->getId());
      foreach($category->getRequiredWithI18n() as $p){
        $p->addMmId($mm2->getId());
      }
      foreach($category->getPath() as $p){
	$p->addMmId($mm2->getId());
      }
    }
    $roles = RolePeer::doSelectWithI18n(new Criteria(), 'es');
    foreach($roles as $role){
      $persons = $this->getPersons($role->getId());
      foreach($persons as $p){
        $aux = new MmPerson();
        $aux->setMmId($mm2->getId());
        $aux->setRoleId($role->getId());
        $aux->setPersonId($p->getId());
        try{
          $aux->save();
          $aux->iniSort();
        }catch(Exception $e){
          //en js seria growl.alert('<h2>ALERT</h2>Persona Repetida');                                                                                                              
        } //Ya usado.                                                                                                                                                               
      }
    }
    return $mm2;
  }

  public function getTableName()
  {
    return 'mm';
  }


  /**
   * Genera un string con la duracion del primer file.
   *
   * @access public
   * @return String Duracion
   */
  public function getNumber()
  {
    $aux = $this->getDurationString();
    
    return ('Duracion :' . $aux );
  }

  /**
   * Asocio el objeto multimedia a dicho ground, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $ground_id
   */
  public function setGroundId($ground_id)
  {
    $gv =  GroundMmPeer::retrieveByPK($ground_id, $this->getId());
    if (!$gv){
      $gv = new GroundMm();
      $gv->setMmId($this->getId());
      $gv->setGroundId($ground_id);
      $gv->save();
    }
  }


  /**
   * Devuelve un array con los ids de los perfiles que contien el objeto multimedia
   *
   * @access     public
   * @return     array de integer ids de los perfiles
   */
  public function getPerfilIds()
  {
    $ids = array();
  
    $c = new Criteria();
    $c->clearSelectColumns();
    $c->addSelectColumn(PerfilPeer::ID);
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);

    $rs = PerfilPeer::doSelectRS($c);
    while ($rs->next()){
      $ids[] = $rs->getInt(1);
    }
    return $ids;
  }


  /**
   * Devuelve un array con los perfiles que contien el objeto multimedia
   *
   * @access     public
   * @return     array de integer ids de los perfiles
   */
  public function getPerfils()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);

    return  PerfilPeer::doSelect($c);
  }


  /**
   * Devuelve un array con los perfiles que contien el objeto multimedia
   *
   * @access     public
   * @return     array de integer ids de los perfiles
   */
  public function getLanguages()
  {
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);
    $c->setDistinct();

    return  LanguagePeer::doSelect($c);
  }

  /**
   * Tiene subtitulos
   *
   * @access public
   * @return boolena
   */
  public function hasSubtitles(){
    $c = new Criteria();
    $c->add(FilePeer::MM_ID, $this->getId());
    $c->add(FilePeer::LANGUAGE_ID, 19);

    return LanguagePeer::doCount($c);
  }

  /**
   * Returns array of mm's materials that match the extensions given (captions)
   *
   * @access public
   * @param array $extensions - caption formats to search in mat_type.type
   * @return file
   */
  public function getCaptions($extensions = array ('vtt')){
     
    $c = new Criteria();
    $c->addJoin(MatTypePeer::ID, MaterialPeer::MAT_TYPE_ID);
     
    $c->add(MatTypePeer::TYPE, $extensions, (is_array($extensions)) ?Criteria::IN : Criteria::EQUAL);
    $c->add(MaterialPeer::MM_ID, $this->getId());
     
    return MaterialPeer::doSelectOne($c); // TO DO: update logic to allow multiple captions to be returned.
  }


  /**
   *
   */
  public function getStatusText(){
    MmPeer::getStatusText($this->getStatusId());
  }

  /**
   * 
   */
  public function hasPubChannel($pub_channel)
  {
    if($this->getStatusId() == MmPeer::STATUS_BLOQ){
      return 0;
    }
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
    $c->add(PubChannelPeer::NAME, $pub_channel, is_int($pub_channel)?null:Criteria::IN);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    return $this->countPubChannelMms($c, true);
  }


  /**
   * 
   */
  public function hasPubChannelId($pub_channel_id)
  {
    if($this->getStatusId() == MmPeer::STATUS_BLOQ){
      return 0;
    }
    $c = new Criteria();

    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    return $this->countPubChannelMms($c, true);
  }

  /**
   *
   *@param array pubChannels
   *@return boolena estatus of the update
   */
  public function updatePubChannels($pub_channels_select){
    if(count($this->getMmMatterhorns()) != 0){
      //MMOC START
      //MM objeto multimedia tipo OC. Actualizo BBDD.
      $pcc = new Criteria();
      $pub_channels_all = PubChannelPeer::doSelect($pcc);
      
      if (!is_array($pub_channels_select)) $pub_channels_select = array();

      foreach($pub_channels_all as $pub_channel){
        $aux = $pub_channel->hasMm($this->getId());

	if(($aux == 0)&&(array_key_exists($pub_channel->getId(), $pub_channels_select))){
	  $pubc = PubChannelMmPeer::retrieveByPK($pub_channel->getId(), $this->getId());

	  if(is_null($pubc)){
	    $pubc = new PubChannelMm();
	    $pubc->setMmId($this->getId());
	    $pubc->setPubChannel($pub_channel);
	    $pubc->setStatusId(1);
	    $pubc->save();
	  }else{
	    $pubc->setStatusId(1);
	    $pubc->save();
	  }
    
	}elseif(($aux == 1)&&(!array_key_exists($pub_channel->getId(), $pub_channels_select))){
	  $pubc = PubChannelMmPeer::retrieveByPK($pub_channel->getId(), $this->getId());
	  if(!is_null($pubc)){
	    $pubc->delete();
	  }
	}      
      }
      return true;
      //MMOC END
    }else{
      $pcc = new Criteria();
      $pcc->add(PubChannelPeer::ENABLE, true);
      $pub_channels_all = PubChannelPeer::doSelect($pcc);
      
      if (!is_array($pub_channels_select)) $pub_channels_select = array();
      
      foreach($pub_channels_all as $pub_channel){
	$aux = $pub_channel->hasMm($this->getId());
	if(($aux == 0)
	   &&(array_key_exists($pub_channel->getId(), $pub_channels_select))
	   &&($pub_channels_select[$pub_channel->getId()] != "off")){
	  if($this->getMaster() == null){
	    $aux = new PubChannelMm();
	    $aux->setMm($this);
	    $aux->setPubChannel($pub_channel);
	    $aux->setStatusId(3);
	    $aux->save();
	  }else{
	    $perfiles_usados = $pub_channel->startSelectWorkflow($this);
	  }
        	  
	}elseif(($aux == 1)&&(!array_key_exists($pub_channel->getId(), $pub_channels_select))){
	  $pub_channel->startDeselectWorkflow($this);
	}      
      }
    }
    return true;
  }



  /**
   *
   *
   */
  public function activeAnyPubChannel(Perfil $perfil){
    //SI ES MASTER PONGO PUBCHANNEL QUE ESTEN EN 3
    //refactorizar en otro lado
    $master = $this->getMaster();
    if(!is_null($master)){
      $c = new Criteria();
      $c->add(PubChannelMmPeer::MM_ID, $this->getId());
      $c->add(PubChannelMmPeer::STATUS_ID, 3);
      $c->addJoin(PubChannelMmPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
      $pub_channels = PubChannelPeer::doSelect($c);
      foreach($pub_channels as $pub_channel){
	$pub_channel->startSelectWorkflow($this);
      }

      if ($master->getAspect() == 0){
	$pcps = $perfil->getPubChannelPerfilsRelatedByPerfilAudioId();
      } else if($master->getAspect() < 1.5){
	$pcps = $perfil->getPubChannelPerfilsRelatedByPerfil43Id();
      }else{
	$pcps = $perfil->getPubChannelPerfilsRelatedByPerfil169Id();
      }
    
    
      foreach($pcps as $pcp){
	$pub_channel = $pcp->getPubChannel();
	$has_all_files = true;

	foreach($pub_channel->getPubChannelPerfils() as $pcp2){
	  if ($master->getAspect() == 0){
	    $perfil = $pcp2->getPerfilRelatedByPerfilAudioId();
	  } else if($master->getAspect() < 1.5){
	    $perfil = $pcp2->getPerfilRelatedByPerfil43Id();
	  }else{
	    $perfil = $pcp2->getPerfilRelatedByPerfil169Id();
	  }


	      
	  if(count($this->getFilesByPerfil($perfil->getId())) == 0){
	    $has_all_files = false;
	  }
	
	}
      
	if($has_all_files ===  true){
	  $aux = PubChannelMmPeer::retrieveByPK($pub_channel->getId(), $this->getId());
	  if(!is_null($aux)){ //MIRA QUE ESTE EN ESTADO 2 Y NO 3
	    $aux->setStatusId(1);
	    //execute finish trascoder.
	    $aux->save();
	  }
	}
      }
    }
  }


  public function getSimilarMmsUnesco($cat_code = null, $exclude_serial=true){
    
    $c = new Criteria();
    
    if ($cat_code){
      //Con el mismo UNESCO
      $c->addJoin(CategoryMmPeer::MM_ID, MmPeer::ID);
      $c->addJoin(CategoryMmPeer::CATEGORY_ID, CategoryPeer::ID);
      $c->add(CategoryPeer::COD, $cat_code);
    } else {
      //Con la misma categoria.
      $catsId = $this->getCategoriesId(CategoryPeer::retrieveByCod("UNESCO"));
      $c->addJoin(CategoryMmPeer::MM_ID, MmPeer::ID);
      $c->add(CategoryMmPeer::CATEGORY_ID, $catsId, Criteria::IN);
      $c->addGroupByColumn(MmPeer::ID);
      $c->addDescendingOrderByColumn('count(' . CategoryMmPeer::CATEGORY_ID . ')');
    }
    
    if ($exclude_serial){
      $c->add(MmPeer::SERIAL_ID, $this->getSerialId(), Criteria::NOT_EQUAL);
    }
    $c->add(MmPeer::ID, $this->getId(), Criteria::NOT_EQUAL);
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);


    //Como mucho 20 y aleatorios
    $c->setLimit(10);
    $c->setDistinct(true);
    $c->addAscendingOrderByColumn('RAND()');
    
    return MmPeer::doSelect($c);
  }

  /**
   *
   *
   *
   */
  public function getSimilarMms(){
    
    $c = new Criteria();
  
    //Con el mismo ground.
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);
    $c->add(GroundMmPeer::GROUND_ID, GroundMmPeer::GROUND_ID . " IN (select ground_id from ground_mm where ground_mm.mm_id = " . $this->getId() . ") " ,Criteria::CUSTOM);

    //De series diferentes
    $c->add(MmPeer::SERIAL_ID, $this->getSerialId(), Criteria::NOT_EQUAL);

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);


    //Como mucho 20 y aleatorios
    $c->setLimit(20);
    $c->setDistinct(true);
    $c->addAscendingOrderByColumn('RAND()');
    
    return MmPeer::doSelect($c);
  }

  /**
   * Devuelve la lista de Objetos categoría
   * que identifican el video (ResulSet of Category)
   * Si se indica padre, devuelve sólo las hijas.
   *
   * @access public
   * @parameter Category $parent
   * @return ResulSet of Categorys.
   */
  public function getCategorys($parent = null)
  {
    $c = new Criteria();

    $c->addJoin(CategoryPeer::ID, CategoryMmPeer::CATEGORY_ID);
    $c->add(CategoryMmPeer::MM_ID, $this->getId());
    $c->addAscendingOrderByColumn(CategoryPeer::COD);
    if($parent) {
      $c->addAnd(CategoryPeer::TREE_LEFT, $parent->getLeftValue(), Criteria::GREATER_THAN);
      $c->addAnd(CategoryPeer::TREE_RIGHT, $parent->getRightValue(), Criteria::LESS_THAN);
      $c->addAnd(CategoryPeer::SCOPE, $parent->getScopeIdValue(), Criteria::EQUAL);

    }

    return CategoryPeer::doSelect($c);
  }

  public function getCategories($parent = null)
  {
    return $this->getCategorys($parent);
  }

  public function getCategoriesId($parent = null) {
    $categories = $this->getCategorys($parent);
    $f = create_function('$a', 'return $a->getId();');
    return array_map($f, $categories);
  }

  /**
   * Devuelve true si el Objeto contiene a la categoría
   * 
   * @access public
   * @parameter integer $id
   * @return Boolean.
   */
  public function hasCategoryId($id)
  {
    $c = new Criteria();

    $c->add(CategoryMmPeer::MM_ID, $this->getId());
    $c->add(CategoryMmPeer::CATEGORY_ID, $id);
    $c->addAscendingOrderByColumn(CategoryPeer::COD);

    return count(CategoryPeer::doSelect($c))>0;
  }


  /**
   * Devuelve los minutos de la duracion del archivo
   *
   * @access public
   * @return integer min
   */
  public function getDurationMin()
  {
    return floor($this->getDuration() / 60);
  }

  /**
   * Devuelve los segundos de la duracion del archivo
   *
   * @access public
   * @return integer seg
   */
  public function getDurationSeg()
  {
    $aux = $this->getDuration() %60;
    if ($aux < 10 ) $aux= '0' . $aux;
    return $aux;
  }

  /**
   * Devuelve un texto que representa la duracion del
   * archivo multimedia, del formato 1' 32''
   *
   * @access public
   * @return integer seg
   */
  public function getDurationString()
  {
    $min = $this->getDurationMin();
    if ($min == 0 ) $aux = $this->getDurationSeg() ."''";
    else $aux = $min . "' ". $this->getDurationSeg() ."''";
    return $aux;
  }

  /**
   * Usado en PicBehavior
   */
  public function isSerial(){
    return false;
  }

  public function getDefaultPic(){
    return '/images/sin_foto.jpg';
  }
  
}



sfPropelBehavior::add('Mm', array(
				  'sortableFk' => array('f_key' => 'serial_id'),
				  'pic' => array(), 
				  ) );
