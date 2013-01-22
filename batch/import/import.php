<?php

  /**
   * import batch script
   *
   *
   * @package    pumukit17
   * @subpackage batch
   * @version    $Id$
   */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

function set_boolean($str){
  return($str=="true");
}


function cmp($a, $b) {
  return (intval($a['rank']) < intval($b['rank'])) ? -1 : 1;
}

function lookfor_object($array, $object, $langs){
  $fobject = null;
  foreach($array as $elem){
    $encontrado = true;
    foreach($langs as $lang){
      $elem->setCulture($lang);
      if($elem->getName())
    	 if($elem->getName() != $object->name->{$lang}) $encontrado = false;	  
    }
    if($encontrado) {
      $fobject = $elem;
      break;
    }
  }
  return $fobject;
}

function showAndLog($mensaje, $tipo = "Info"){
  global $log;
  switch ($tipo) {
    case "Info":
      echo "\033[32mInfo:\033[37m ";
      break;
    case "Warning":
      echo "\033[35mAviso:\033[37m ";
      break;
    case "Debug":
      echo "\033[133mDebug:\033[37m ";
      break;
    case "Error":
      echo "\033[31mError:\033[37m ";
      break;
    case "New":
      echo "\033[34mNew:\033[37m ";
      break;
  }
  echo $mensaje . "\n";
  $log->log($mensaje, 0, $tipo);
}

function check_parameters($xml){
  foreach($xml->mmTemplates->mmTemplate as $mmt){
    $c = new Criteria();
    $c->add(BroadcastTypePeer::NAME, "" . $mmt->broadcast->broadcastType->name);
    $bt = BroadcastTypePeer::doSelectOne($c);
    if (!$bt) {  
      $mensaje = "error de importaciÃ³n:::no existe el broadcast_type \"". 
         $mmt->broadcast->broadcastType->name . "\"";
      showAndLog($mensaje, "Error");
      exit(-1);
    }
  }
  
  
  foreach($xml->mms->mm as $mm){
    foreach($mm->files->file as $xmlfile){      
      $c = new Criteria();
      $c->add(PerfilPeer::NAME, "" . $xmlfile->perfil->name);
      $perfil = PerfilPeer::doSelectOne($c);
      if(!$perfil){   

        //  warning y crear un perfil con solo el nombre.
        $perfil_temp = new Perfil();
        $perfil_temp->setName($xmlfile->perfil->name);
        $langs = sfConfig::get('app_lang_array', array('es'));
        foreach($langs as $lang){
          $perfil_temp->setCulture($lang);
          $perfil_temp->setDescription('Perfil creado automáticamente por el script de importación. Por favor, complételo');
        }
        $perfil_temp->save();
  	    $mensaje = "Se ha creado el perfil: ". $xmlfile->perfil->name;
        showAndLog($mensaje, "New");
      }
    }
    
    $c = new Criteria();
    $c->add(BroadcastTypePeer::NAME, "" . $mm->broadcast->broadcastType->name);
    $bt = BroadcastTypePeer::doSelectOne($c);
    if (!$bt) {  
      $mensaje = "error de importaciÃ³n:::no existe el broadcast_type \"". $mm->broadcast->broadcastType->name . "\"";
      showAndLog ($mensaje, "Error");
      exit(-1);
    }
  }
  
  $c = new Criteria();
  $c->add(SerialTemplatePeer::NAME, "" . $xml->serialTemplate->name);
  $st = SerialTemplatePeer::doSelectOne($c);
  
  if (!$st) {
    $mensaje = "error de importaciÃ³n:::no existe el serial_template \"". $xml->serialTemplate->name . "\"\n";
    showAndLog($mensaje, "Error");
    exit(-1);    
  }

  foreach($xml->mmTemplates->mmTemplate as $xmlmmt){
    foreach($xmlmmt->mmTemplatePersons->role as $xmlrole){
      $c = new Criteria();
      $c->add(RolePeer::COD, "" . $xmlrole->cod);
      $role = RolePeer::doSelectOne($c);
      
      if (!$role) {
        $mensaje = "error de importaciÃ³n:::no existe el role \"". $xmlrole->xml . "\"\n";
        showAndLog($mensaje, "Error");
	      exit(-1);    
      }
    }
  }

  foreach($xml->mms->mm as $xmlmm){
    foreach($xmlmm->mmPersons->role as $xmlrole){
      $c = new Criteria();
      $c->add(RolePeer::COD, "" . $xmlrole->cod);
      $role = RolePeer::doSelectOne($c);
      
      if (!$role) {
        $mensaje =  "error de importaciÃ³n:::no existe el role \"". $$xmlrole->xml . "\"\n";
        showAndLog($mensaje, "Error");
	      exit(-1);    
      }
    }
  }

}

  /* Los antiguos estados mm.statusid xxx_TRANC , XXX_BLOCK , XXX_TRASH son <0 
   pero se asimilan al antiguo 0 (working) y nuevo 1 (BLOQUEADO).
   Revisar lib/model/Mm.php y MmPeer en pumukit 1.

   Los nuevos mm.status_id (propiedades estáticas como antes) son 
   STATUS_NORMAL = 0; STATUS_BLOQ = 1 y (falta por implementar*) oculto = 2 ¿?

   Ahora hay una tabla pub_channel, los nuevos valores y se relaciona n-m con mm usando
   la tabla pub_channel_mm y las propiedades pub_channel_id y mm_id.
   La tercera propiedad status_id ya se establece a 1 por defecto ("relación existente").

  antiguo         nuevo           nuevo
  mm.status_id    mm.status_id    pubchannelmm.pub_channel_id

  <0 (varios)     1 Bloq          (nada)
   0 Working      1 Bloq          (nada)
   1 Oculto       2 Oculto *      (nada)
   2 Mediateca    0 Normal        1 WebTV
   3 ARCA         0 Normal        1 + 2 ARCA
   4 iTunesU      0 Normal        1 + 2 + 4 iTunes U                 
  */

function setStatusAndAddPubChannel($mm, $old_status){

  $status = intval($old_status) < 0 ? 0 : intval($old_status);
  $mm_id = $mm->getId();
  
  // Nuevos valores en pumukit 1.7
  $pc_itunesu = 4;
  $pc_arca    = 2;
  $pc_webtv   = 1;

  $mm_status_normal = MmPeer::STATUS_NORMAL; // = 0;  
  $mm_status_bloq   = MmPeer::STATUS_BLOQ;   // = 1;
  $mm_status_oculto = 2; // Falta por implementar.
  
  switch ($status) {   
    case 4:
      $pcm = new PubChannelMm();
      $pcm->setPubChannelId($pc_itunesu);
      $pcm->setMmId($mm_id);
      $pcm->save();
      // Continúa añadiendo los siguientes

    case 3: 
      $pcm = new PubChannelMm();
      $pcm->setPubChannelId($pc_arca);
      $pcm->setMmId($mm_id);
      $pcm->save();
      // Continúa añadiendo el siguiente
    
    case 2: 
      $pcm = new PubChannelMm();
      $pcm->setPubChannelId($pc_webtv);
      $pcm->setMmId($mm_id);
      $pcm->save();
      $mm->setStatusId($mm_status_normal);
      break;

    case 1: 
      $mm->setStatusId($mm_status_oculto);
      break;
    
    case 0:
      $mm->setStatusId($mm_status_bloq);
      break;

    default:
      echo "\033[31mERROR\033[37m ";
      echo "con el mm.status_id del pumukit antiguo";
      break;
  }
  // TO DO - revisar si da problemas o duplicados al persistir dos veces el mismo
  // objeto en propel (está persistido antes de la función para que genere Id,
  // y ahora le actualizo el StatusId)
  // Aparentemente no da errores.
  $mm->save();
  
}

/*  Existen los campos announce y email dentro de las tablas mm y serial.
    Como email prácticamente no se usa, simplemente anotaremos cada mm con announce = 1
    con el announce_channel email.
*/
function addAnnounceChannel($mm){
  $email_id = 1; // En el nuevo pumukit - announce_channel.id 1 = email.

  if ($mm->getAnnounce() == 1){
    $acm = new AnnounceChannelMm();
    $acm->setMmId($mm->getId());
    $acm->setAnnounceChannelId($email_id);
    $acm->save();
  }
}


function import_precinct($xml, $langs){
  $pc = new Precinct();
  $pc->setDefaultsel(set_boolean($xml->precinct->defaultsel));
  foreach($langs as $lang){
    $pc->setCulture($lang);
    $pc->setName($xml->precinct->name->{$lang});
    $pc->setEquipment($xml->precinct->equipment->{$lang});
    $pc->setComment($xml->precinct->comment->{$lang});
  }
  return $pc;
}

// TO DO borrar debug
function import_genre($xml, $langs){
  // echo "\nDEBUG tratando de importar el género ".$xml['id']." con los lenguajes".var_dump($langs);
  $genre = new Genre();
  $genre->setCod($xml->cod);
  $genre->setDefaultsel(set_boolean($xml->defaultsel));
  foreach($langs as $lang){
    $genre->setCulture($lang);
    $genre->setName($xml->name->{$lang});
  }
  $genre->save();
  return $genre;
}

/*  Como algunos géneros de la instalación por defecto (en las fixtures) se corresponden
    pero no tienen exactamente la misma string, primero compruebo los que sé que existen
    por defecto:
      Si el género existe y tiene el mismo id lo recupera y devuelve.
      Si existe pero con un nuevo id, recupera y devuelve el correcto.
    Si no existe en la instalación por defecto,
      Busca en la BD, si existe lo devuelve.
      Si no existe, crea un género nuevo y lo devuelve.
*/
function findOrCreateGenre($xmlgenre, $langs) {
  $id                 = $xmlgenre['id'];
  $genero_existente   = array (1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
    11, 12, 13, 14, 15, 16, 17, 18);

  // Vídeo promocional, videoconferencia, Matterhorn
  $genero_actualizado = array ( 21 => 19, 22 => 20, 45 => 22 );

  // echo "\n Buscando si el genre ".$xmlgenre['id']." existe";
  // var_dump($xmlgenre);

  if (in_array($id, $genero_existente)) {
    $c = new Criteria();
    $c->add(GenrePeer::ID, $id);
    $genre = GenrePeer::doSelectOne($c);
    
    if (!$genre) {
      $mensaje = "Error - El genre ". $id . " no existe en la nueva versión";
      showAndLog($mensaje, "Error");
      exit ($mensaje);
    }

    return $genre;

  } else if (array_key_exists($id, $genero_existente)) {
    $c = new Criteria();
    $c->add(GenrePeer::ID, $genero_existente[$id]);
    $genre = GenrePeer::doSelectOne($c);
    
    if (!$genre) {
      $mensaje = "Error - El genre ". $id . " se corresponde con "
      . $genero_existente[$id]. " pero no existe en la nueva versión";
      showAndLog($mensaje, "Error");
      exit ($mensaje);
    }

    return $genre;

  } 
  // No está en la instalación original, buscarlo o crearlo.

  $c = new Criteria();
  $c->add(GenreI18nPeer::NAME, "" .$xmlgenre->name->$langs[0]);
  $c->addJoin(GenreI18nPeer::ID, GenrePeer::ID);
  $genre = GenrePeer::doSelectOne($c);

  if (!$genre) {
    $genre = import_genre($xmlgenre, $langs);
  }

  return $genre;
}

function findOrCreateMimetype($xmlmimetype){

  $c = new Criteria();
  $c->add(MimeTypePeer::NAME, "" . $xmlmimetype->name);
  $mimetype = MimeTypePeer::doSelectOne($c);
  if (!$mimetype) {   
    showAndLog("Se ha creado un nuevo mimetype -".$xmlmimetype->name."-", "New");
    $mimetype = new MimeType();
    $mimetype->setName($xmlmimetype->name);
    $mimetype->setDefaultSel(set_boolean($xmlmimetype->defaultsel));
    $mimetype->setType($xmlmimetype->type);
    $mimetype->save();
  }
  return $mimetype;
}

function import_broadcast($xml, $langs){

  $bc = new Broadcast();
  $bc->setDefaultsel(set_boolean($xml->defaultsel));
  $bc->setName($xml->name);
  $bc->setPasswd($xml->passwd);
  foreach($langs as $lang){
    $bc->setCulture($lang);
    $bc->setDescription($xml->description->{$lang});
  }
  $c = new Criteria();
  $c->add(BroadcastTypePeer::NAME, "" . $xml->broadcastType->name);
  $bt = BroadcastTypePeer::doSelectOne($c);
  $bc->setBroadcastType($bt);
  $bc->save();
  return $bc;
}

function import_ground($xml, $langs){

  $ground = new Ground();
  $ground->setCod($xml->cod);
  foreach($langs as $lang){
    $ground->setCulture($lang);
    $ground->setName($xml->name->{$lang});
  }
  $c = new Criteria();
  $c->add(GroundTypePeer::NAME, "" . $xml->groundType->name);
  $groundtype = GroundtypePeer::doSelectOne($c);    
  if (!$groundtype) {
    $groundtype = new Groundtype();
    $groundtype->setDisplay(set_boolean($xml->groundType->display));
    $groundtype->setName($xml->groundType->name);
    foreach($langs as $lang){
      $groundtype->setCulture($lang);
      $groundtype->setDescription($xml->groundType->description->{$lang});
    }
    $groundtype->save();
  }
  $ground->setGroundType($groundtype);
  $ground->save();
  return $ground;
}    


function import_pics($pics, $object){
  $array = array();
  $index = 0;
  foreach($pics as $pic){
    $array[$index]['url'] = $pic->url[0];
    $array[$index]['rank'] = intval($pic['rank']);
    $index++;
  }
  usort($array,"cmp");
  foreach($array as $pic){
    $object->setPic($pic['url']);
  }
  $object->save();
}


function import_person($xmlperson, $langs){
  	$person = new Person();	
	$person->setName($xmlperson->name);
	$person->setEmail($xmlperson->email);
	$person->setWeb($xmlperson->web);
	$person->setPhone($xmlperson->phone);
	foreach($langs as $lang){
	  $person->setCulture($lang);
	  $person->setHonorific($xmlperson->honorific->{$lang});
	  $person->setFirm($xmlperson->firm->{$lang});
	  $person->setPost($xmlperson->post->{$lang});
	  $person->setBio($xmlperson->bio->{$lang});
	}
	$person->save();
	return $person;
}

function import_mmTemplate($xml, $serial, $langs){
  if (empty( $xml->mmTemplates->mmTemplate[0])){

  //  echo "\033[34mDEBUG:\033[37m ";
  //  echo "La serie con id original " . $xml->id . 
  //  " e id nuevo ". $serial->getId() . " no tiene mm_template\n";
    return;
  }
  $mmt = new MmTemplate();
  $mmt->setSerialId($serial->getId());
  $xmlmmt = $xml->mmTemplates->mmTemplate[0];
  $mmt->setSubserial(set_boolean($xmlmmt->subserial));
  $mmt->setAnnounce(set_boolean($xmlmmt->announce));
  $mmt->setMail($xmlmmt->mail);
  $mmt->setRank($xmlmmt->rank);
  $mmt->setCopyright($xmlmmt->copyright);
  if ($xmlmmt->recordDate != '') $mmt->setRecordDate($xmlmmt->recordDate);
  if ($xmlmmt->publicDate != '') $mmt->setPublicDate($xmlmmt->publicDate);
  $mmt->setStatusId($xmlmmt->statusId);
  
  foreach($langs as $lang){
    $mmt->setCulture($lang);
    $mmt->setTitle($xmlmmt->title->{$lang});
    $mmt->setSubtitle($xmlmmt->subtitle->{$lang});
    $mmt->setKeyword($xmlmmt->keyword->{$lang});
    $mmt->setSubserialTitle($xmlmmt->subserialTitle->{$lang});
    $mmt->setDescription($xmlmmt->description->{$lang});
    $mmt->setLine2($xmlmmt->line2->{$lang});
  }

// TO DO Revisar, se importan pocos places. 
  
  /** se busca el place
   *   si no existe
   *       se importa el place
   *       se importa el precinct
   *       P = precinct
   *   si existe 
   *       se busca el precinct
   *        si existe
   *             P = precinct
   *        si no existe
   *             se importa el precinct
   *             P = precinct
   *  se asigna P al mmt
   */
  $c = new Criteria();
  $c->add(PlacePeer::COD, "" . $xmlmmt->place->cod);
  $pl = PlacePeer::doSelectOne($c);
  if (!$pl) {
    $pl = new Place();
    $pl->setCoorgeo($xmlmmt->place->coorgeo);
    $pl->setCod($xmlmmt->place->cod);
    foreach($langs as $lang){
      $pl->setCulture($lang);
      $pl->setName($xmlmmt->place->name->{$lang});
      $pl->setAddress($xmlmmt->place->address->{$lang});
    }
    $pl->save();
    $pc = import_precinct($xmlmmt->place, $langs);
    $pc->setPlaceId($pl->getId());
    $pc->save();
    $mmt->setPrecinctId($pc->getId());
  }
  else{
    $fprecinct = lookfor_object($pl->getPrecincts(), $xmlmmt->place->precinct, $langs);
    
    if (!$fprecinct) {
      $fprecinct = import_precinct($xmlmmt->place, $langs);
      $fprecinct->setPlaceId($pl->getId());
      $fprecinct->save();
    }
    $mmt->setPrecinctId($fprecinct->getId());
  }
  
  $genre = findOrCreateGenre($xmlmmt->genre, $langs);

  // $c = new Criteria();
  // $c->add(GenrePeer::COD, "" . $xmlmmt->genre->cod);
  // $genre = GenrePeer::doSelectOne($c);
  // if (!$genre) {
  //   $genre = import_genre($xmlmmt->genre, $langs);
  // }
  $mmt->setGenre($genre);

  $c = new Criteria();
   $c->add(BroadcastPeer::NAME, "" . $xmlmmt->broadcast->name);
  $broadcast = BroadcastPeer::doSelectOne($c);
  if (!$broadcast) {
    $broadcast = import_broadcast($xmlmmt->broadcast, $langs);
  }
  $mmt->setBroadcast($broadcast);
  
  // Si no se persiste aquí, no tendrá Id cuando se le llame más adelante.
  $mmt->save();

  foreach($xmlmmt->mmTemplateGrounds->ground as $xmlground){
    $c = new Criteria();
    $c->add(GroundPeer::COD, "" . $xmlground->cod);
    $ground = GroundPeer::doSelectOne($c);   
    if (!$ground) {
      $ground = import_ground($xmlground, $langs);
    }
    $gmmt = new GroundMmTemplate();
    $gmmt->setGroundId($ground->getId());
    $gmmt->setMmTemplateId($mmt->getId());
    $gmmt->setRank(0); //Pumukit 17 no parece setear el rank ¿?
    $gmmt->save();
    
  }
  
  //Todo esto se hace despues de crear la mmTemplate (se necesita el id)
  
  foreach($xmlmmt->mmTemplatePersons->role as $xmlrole){
    $duplicated_name_list[] = array(); 
    $c = new Criteria();
    $c->add(RolePeer::COD, "" . $xmlrole->cod);
    $role = RolePeer::doSelectOne($c);
    
    foreach($xmlrole->persons->person as $xmlperson){
      $c = new Criteria();
      $c->add(PersonPeer::NAME, "" . $xmlperson->name);
      $person = PersonPeer::doSelectOne($c);
    
      if (!$person) {
        $person = import_person($xmlperson, $langs);
      }

      // Apaño para que no rompa la importación si hay personas duplicadas 
      // en mmTemplatePersons y Propel trata de grabar un valor unique varias veces.
      // como p.ej. en la serie 0858 y M. Sheehan.

      if (in_array("$xmlperson->name", $duplicated_name_list)){
        echo "\033[34mDEBUG:\033[37m ";
        $mensaje = "La persona $xmlperson->name está duplicada en mmTemplatePersons";
        showAndLog($mensaje, "Debug");
      } else {
        $aux = new MmTemplatePerson();
        $aux->setMmTemplateId($mmt->getId());
        $aux->setRoleId($role->getId());
        $aux->setPersonId($person->getId());
        $aux->save();    
        $duplicated_name_list[] = "$xmlperson->name";
      }
    } // foreach $xmlrole->persons->person, muchas veces no existe.
    unset ($duplicated_name_list);
  }
  $mmt->save();
  
}

// Busca en la base de datos el perfil actual, si existe devuelve el ID.
// Sobreentiende que los perfiles han de estar creados previamente por la función
// de check_parameters

function getPerfilIdWithName($xml_name){

  $c = new Criteria();
  $c->add(PerfilPeer::NAME, "" . $xml_name);
  $perfil_buscado = PerfilPeer::doSelectOne($c);
  if (!$perfil_buscado){
    exit ("No se encontró el perfil - algo raro está pasando");
  }
  return $perfil_buscado->getId();
}

function import_mms($xml, $serial, $langs){

foreach($xml->mms->mm as $xmlmm){
  $mm = new Mm();
  $mm->setSerialId($serial->getId());
  $mm->setRank($xmlmm['rank']);
  $mm->setSubserial(set_boolean($xmlmm->subserial));
  $mm->setAnnounce(set_boolean($xmlmm->announce));
  $mm->setMail($xmlmm->mail);
  $mm->setCopyright($xmlmm->copyright);
  if ($xmlmm->recordDate != '') $mm->setRecordDate($xmlmm->recordDate); 
  if ($xmlmm->publicDate != '') $mm->setPublicDate($xmlmm->publicDate);
  $mm->setEditorial1($xmlmm->editorial1);
  $mm->setEditorial2($xmlmm->editorial2);
  $mm->setEditorial3($xmlmm->editorial3);
  foreach($langs as $lang){
    $mm->setCulture($lang);
    $mm->setTitle($xmlmm->title->{$lang});
    $mm->setSubtitle($xmlmm->subtitle->{$lang});
    $mm->setKeyword($xmlmm->keyword->{$lang});
    $mm->setSubserialTitle($xmlmm->subserialTitle->{$lang});
    $mm->setDescription($xmlmm->description->{$lang});
    $mm->setLine2($xmlmm->line2->{$lang});
  }


  $c = new Criteria();
  $c->add(PlacePeer::COD, "" . $xmlmm->place->cod);
  $pl = PlacePeer::doSelectOne($c);
  if (!$pl) {
    $pl = new Place();
    $pl->setCoorgeo($xmlmm->place->coorgeo);
    $pl->setCod($xmlmm->place->cod);
    foreach($langs as $lang){
      $pl->setCulture($lang);
      $pl->setName($xmlmm->place->name->{$lang});
      $pl->setAddress($xmlmm->place->address->{$lang});
    }
    $pl->save();
    $pc = import_precinct($xmlmm->place, $langs);
    $pc->setPlaceId($pl->getId());
    $pc->save();
    $mm->setPrecinctId($pc->getId());
  }
  else{
    $fprecinct = lookfor_object($pl->getPrecincts(), $xmlmm->place->precinct, $langs);

    if (!$fprecinct) {
      $fprecinct = import_precinct($xmlmm->place, $langs);
      $fprecinct->setPlaceId($pl->getId());
      $fprecinct->save();
    }
    $mm->setPrecinctId($fprecinct->getId());
  }
   
  $mm->setGenre(findOrCreateGenre($xmlmm->genre, $langs));

  $c = new Criteria();
   $c->add(BroadcastPeer::NAME, "" . $xmlmm->broadcast->name);
  $broadcast = BroadcastPeer::doSelectOne($c);
  if (!$broadcast) {
    $broadcast = import_broadcast($xmlmm->broadcast, $langs);
  }
  $mm->setBroadcast($broadcast);

  // Salvamos el Mm. Despues salvamos todo lo que falta y necesita el MmId
  $mm->save(); 

  showAndLog("El objeto mm con id=\"" . $xmlmm['id'] . 
    "\" se ha guardado con el nuevo id=\"" . $mm->getId() . "\"");

  setStatusAndAddPubChannel($mm, $xmlmm->statusId);
  addAnnounceChannel($mm);

  //Todo esto se hace despues de crear el mm (se necesita el id)
  foreach($xmlmm->mmGrounds->ground as $xmlground){
    $c = new Criteria();
    $c->add(GroundPeer::COD, "" . $xmlground->cod);
    $ground = GroundPeer::doSelectOne($c);
    
    if (!$ground) {
      $ground = import_ground($xmlground, $langs);
    }
    $gmm = new GroundMm();
    $gmm->setGroundId($ground->getId());
    $gmm->setMmId($mm->getId());
    $gmm->setRank(0); //Pumukit 17 no parece setear el rank
    $gmm->save();
  }
  
  foreach($xmlmm->mmPersons->role as $xmlrole){
    $c = new Criteria();
    $c->add(RolePeer::COD, "" . $xmlrole->cod);
    $role = RolePeer::doSelectOne($c);
        
    foreach($xmlrole->persons->person as $xmlperson){
      $c = new Criteria();
      $c->add(PersonPeer::NAME, "" . $xmlperson->name);
      $person = PersonPeer::doSelectOne($c);
      
      if (!$person) {
	      $person = import_person($xmlperson, $langs);
      }
      $aux = new MmPerson();
      $aux->setMmId($mm->getId());
      $aux->setRoleId($role->getId());
      $aux->setPersonId($person->getId());
      $aux->save();    
    }  
  }

  import_pics($xmlmm->mmPics->pic, $mm);
  
  foreach($xmlmm->files->file as $xmlfile){
    $file = new File();
    $file->setRank($xmlfile['rank']);
    $file->setFile($xmlfile->file);
    foreach($langs as $lang){
      $file->setCulture($lang);
      $file->setDescription($xmlfile->description->{$lang});
    }    

    $file->setPerfilId(getPerfilIdWithName ($xmlfile->perfil->name));
    // $file->setPerfilId($xmlfile->perfil['id']);

    $file->setUrl($xmlfile->url);
    if ($xmlfile->format->name != ""){
      $c = new Criteria();
      $c->add(FormatPeer::NAME, "" . $xmlfile->format->name);
      $format = FormatPeer::doSelectOne($c);    
      if (!$format) {
        showAndLog("Se ha creado un nuevo format -".$xmlfile->format->name, "New");
        $format = new Format();
        $format->setName($xmlfile->format->name);
        $format->setDefaultSel(set_boolean($xmlfile->format->defaultsel));
        $format->save();
      }
      $file->setFormat($format);
    }
    
    if ($xmlfile->codec->name != ""){
      $c = new Criteria();
      $c->add(CodecPeer::NAME, "" . $xmlfile->codec->name);
      $codec = CodecPeer::doSelectOne($c);    
      if (!$codec) {
        showAndLog("Se ha creado un nuevo codec: -" . $xmlfile->codec->name . "-", "New");
        $codec = new Codec();
        $codec->setName($xmlfile->codec->name);
        $codec->setDefaultSel(set_boolean($xmlfile->codec->defaultsel));
        $codec->save();
      }
      $file->setCodec($codec);
    } else {
      showAndLog("El file actual tiene codec en blanco -" . $xmlfile->codec->name . 
        "- saltándolo", "Warning");
    }
    

    $file->setMimeType(findOrCreateMimetype($xmlfile->mimetype));
   
    $c = new Criteria();
    $c->add(ResolutionPeer::HOR, "" . intval($xmlfile->resolution->hor));
    $c->add(ResolutionPeer::VER, "" . intval($xmlfile->resolution->ver));
    $resolution = ResolutionPeer::doSelectOne($c);    
    if (!$resolution) {
      showAndLog("Se ha creado una nueva resolución hor:" . $xmlfile->resolution->hor . 
        "- ver:" . $xmlfile->resolution->ver . "-", "New");
      $resolution = new Resolution();
      $resolution->setHor($xmlfile->resolution->hor);
      $resolution->setVer($xmlfile->resolution->ver);
      $resolution->setDefaultSel(set_boolean($xmlfile->resolution->defaultsel));
      $resolution->save();
    }
    $file->setResolution($resolution);
    $file->setBitrate($xmlfile->bitrate);
    $file->setFramerate($xmlfile->framerate);
    $file->setChannels($xmlfile->channels);
    $file->setAudio($xmlfile->audio);
    $file->setDuration($xmlfile->duration);
    $file->setNumView($xmlfile->numview);
    $file->setPuntSum($xmlfile->puntsum);
    $file->setPuntNum($xmlfile->puntnum);
    $file->setSize($xmlfile->size);
    $file->setResolutionHor($xmlfile->resolutionhor);
    $file->setResolutionVer($xmlfile->resolutionver);    
    $file->setDisplay(set_boolean($xmlfile->display));
    
    $c = new Criteria();
    $c->add(LanguagePeer::COD, "" . $xmlfile->language->cod);
    $language = LanguagePeer::doSelectOne($c);
    
    if (!$language) {
      $language = new Language();
      $language->setCod($xmlfile->language->cod);
      foreach($langs as $lang){
	$language->setCulture($lang);
	$language->setName($xmlfile->language->name->{$lang});
      }
      $language->save();
    }
    $file->setLanguage($language);
    $file->setMmId($mm->getId());
    $file->save();


    showAndLog("El file con id=\"" . $xmlfile['id'] .
    "\" se ha guardado con el nuevo id=\"" . $file->getId() . "\"", "New");


    foreach($xmlfile->tickets->ticket as $xmlticket){
      $ticket = new Ticket();
      $ticket->setFileId($file->getId());
      $ticket->setPath($xmlticket->path);
      $ticket->setUrl($xmlticket->url);
      if ($xmlticket->date != '') $ticket->setDate($xmlticket->date);
      $ticket->setEnd($xmlticket->end);
      $ticket->save();
    }    
  }
  
  //Hay que hacerlo despues de salvar el mm (por el $mm->getId)
  foreach($xmlmm->materials->material as $xmlmat){
    $mat = new Material();
    $mat->setMmId($mm->getId());
    foreach($langs as $lang){
      $mat->setCulture($lang);
      $mat->setName($xmlmat->name->{$lang});
    }
    $mat->setUrl($xmlmat->url);
    $mat->setRank($xmlmat['rank']);
    $mat->setDisplay(set_boolean($xmlmat->display));
    
    $c = new Criteria();
    $c->add(MatTypePeer::TYPE, "" . $xmlmat->mattype->type);
    $mattype = MatTypePeer::doSelectOne($c);
    if (!$mattype) {

      showAndLog("Se ha creado un nuevo mattype id -" . $xmlmat->mattype->type .
        "- type -" . $xmlmat->mattype->type . "- name -" . 
        $xmlmat->mattype->name->$lang[0]  ,"New");

      $mattype = new Mattype();
      $mattype->setType($xmlmat->mattype->type);
      $mattype->setDefaultsel(set_boolean($xmlmat->mattype->defaultsel));
      $mattype->setMimetype($xmlmat->mattype->mimetype);
      foreach($langs as $lang){
        $mattype->setCulture($lang);
	      $mattype->setName($xmlmat->mattype->name->{$lang});
      }
      $mattype->save();
    }
    $mat->setMatType($mattype);
    $mat->save();
  }
  
  //Hay que hacerlo despues de salvar el mm (por el $mm->getId)
  foreach($xmlmm->links->link as $xmllink){
    $link = new Link();
    $link->setUrl($xmllink->url[0]);
    $link->setRank(intval($xmllink['rank']));
    $link->setMmId($mm->getId());
    foreach($langs as $lang){
      $link->setCulture($lang);
      $link->setName($xmllink->name->{$lang});
    }          
    $link->save();
  }
  $mm->save();
 }
}

function import_serialItuness($xml, $serial, $langs){

  foreach($xml->serialItuness->serialItunes as $xmlsi){
    $si = new SerialItunes();
    $si->setSerialId($serial->getId());
    $si->setItunesId($xmlsi->itunesId);
    $si->setCulture($xmlsi->culture);
    $si->save();
  }
  
}

function checkIfSerialExists($xml, $langs){
  $c = new Criteria();
  // Ojo, sólo busca el primer lang.
  // Si título y subtítulo coinciden, comprueba también la fecha.

  $c->add(SerialI18nPeer::TITLE, "" . $xml->title->$langs[0]);
  $c->add(SerialI18nPeer::SUBTITLE, "" . $xml->subtitle->$langs[0]);
  $c->addJoin(SerialI18nPeer::ID, SerialPeer::ID);
  $c->add(SerialPeer::PUBLICDATE, trim($xml->publicDate));
  $ser = SerialPeer::doSelectOne($c);

  if (!$ser) {
    $mensaje = "La serie con id original " . $xml->id . 
    " es nueva. Procediendo a importar";
    showAndLog($mensaje, "");
    return (false);
  }
  $mensaje =  "La serie con id original " . $xml->id . 
    " ya existe con el id nuevo ". $ser->getId();
  showAndLog($mensaje, "Warning");
  return (true);
}

function import_serial($xml, $serial, $langs){

  foreach($langs as $lang){
    $serial->setCulture($lang);
    $serial->setTitle($xml->title->{$lang});
    $serial->setSubTitle($xml->subtitle->{$lang});
    $serial->setKeyword($xml->keyword->{$lang});
    $serial->setDescription($xml->description->{$lang});
    $serial->setHeader($xml->header->{$lang});
    $serial->setFooter($xml->footer->{$lang});
    $serial->setLine2($xml->line2->{$lang});
  }
  $serial->setAnnounce(set_boolean($xml->announce));
  $serial->setCopyright($xml->copyright);
  $serial->setMail($xml->mail);
  if ($xml->publicDate != '') $serial->setPublicDate($xml->publicDate);
  
  //Si no existe SerialTemplate en la BBDD hay que crearlo
  
  $c = new Criteria();
  $c->add(SerialTemplatePeer::NAME, "" . $xml->serialTemplate->name);
  $st = SerialTemplatePeer::doSelectOne($c);
  $serial->setSerialTemplate($st);
  
  //Si no existe SerialType en la BBDD hay que crearlo
  
  $c = new Criteria();
  $c->add(SerialTypePeer::COD, "" . $xml->serialType->cod);
  $st = SerialTypePeer::doSelectOne($c);
  
  if (!$st) {
    $st = new SerialType();
    $st->setCod($xml->serialType->cod);
    $st->setDefaultsel(set_boolean($xml->serialType->defaultsel));
    foreach($langs as $lang){
      $st->setCulture($lang);
      $st->setName($xml->serialType->name->{$lang});
      $st->setDescription($xml->serialType->description->{$lang});
    }
    $st->save();
  }
  $serial->setSerialType($st); 
}

// ---------------------------------------------------------------------------------------
// Inicio del programa.

$log = new sfFileLogger();
$log->initialize(array('file' => SF_ROOT_DIR . '/batch/import/log_import.log'));
 
// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

if (2 != count($argv)) exit(-1);
$file =$argv[1];


if (file_exists($file)) {
  $xml = simplexml_load_file($file,'SimpleXMLElement', LIBXML_NOCDATA);
} else {
  showAndLog("No existe el archivo " . $file, "Error");
  exit();
}


if (!$xml) {
  showAndLog("Error al cargar el XML de " . $file, "Error");
  showAndLog("Si hay libxml_get_errors, se mostrarán debajo.", "Error");
  foreach(libxml_get_errors() as $error) {
    showAndLog($error->message, "Error"); 
  }
  exit;
}

$serial = new Serial();

$langs = sfConfig::get('app_lang_array', array('es'));

if (checkIfSerialExists($xml, $langs) == true){
  showAndLog("No se realizará la importación ".$xml->id."\n", "Debug");
  exit ();
}

check_parameters($xml);

import_serial($xml, $serial, $langs);

$serial->save();


import_mmTemplate($xml, $serial, $langs);

import_mms($xml, $serial, $langs);

import_serialItuness($xml, $serial, $langs);

import_pics($xml->pics->pic, $serial);

showAndLog ("La serie con id: \"" . $xml->id . 
  "\" se ha importado correctamente con el id: \"" . $serial->getId() . "\"");
?>