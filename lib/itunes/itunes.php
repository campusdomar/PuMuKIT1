<?php

/**
 * itunes (class)
 *
 * Clase que facilita la comunicacion con un servidor WEB SERVICES Itunes_U
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 0.1
 *
 * @package Pumukit-lib
 */


class itunes{

  public static $languages = array(
				   "es" => array(4,6,11,13,14,15),
				   "gl" => array(4,6,11,13,14,15,12),
				   "en" => array(3,11,12,13),
				   "xx" => array(1,2,5,7,8,9,10,12)
				   );
				   
  
  public static $pumukit2itunesu = array(
					 "es" => array(
						       38 => "2134871153",
						       39 => "2196571481",
						       40 => "2196096790",
						       61 => "2196223446",
						       62 => "2196501595",
						       63 => "2196403587",
						       64 => "2195879667",
						       37 => "2196702458",
						       43 => "2135524617",
						       44 => "2196669693",
						       45 => "2196604271",
						       42 => "2196599877",
						       70 => "2205442891",
						       41 => "2196096836",
						       52 => "2154813647",
						       53 => "2196702487",
						       54 => "2196309824",
						       55 => "2196424325",
						       65 => "2196109068",
						       66 => "2196763937",
						       51 => "2196129651",
						       48 => "2154977285",
						       49 => "2195786312",
						       50 => "2195835382",
						       58 => "2196403380",
						       60 => "2196436088",
						       59 => "2196157720",
						       46 => "2196702645",
						       57 => "2155861107",
						       36 => "2196129831",
						       68 => "2198605565",
						       69 => "2205243062",
						       71 => "2205704824",
						       35 => "2196719022",
						       34 => "2196751860",
						       "def" => "2155010011"),
					 "gl" => array(
						       38 => "2193858278",
						       39 => "2195916726",
						       40 => "2196571457",
						       61 => "2195847316",
						       62 => "2196583586",
						       63 => "2195847340",
						       64 => "2196714658",
						       37 => "2196757940",
						       43 => "2193825686",
						       44 => "2195835204",
						       45 => "2195867760",
						       42 => "2195879576",
						       70 => "2205819185",
						       41 => "2196669727",
						       52 => "2193890929",
						       53 => "2196129682",
						       54 => "2195867839",
						       55 => "2195863761",
						       65 => "2196600309",
						       66 => "2196141894",
						       51 => "2195786285",
						       48 => "2193809264",
						       49 => "2196571737",
						       50 => "2196702668",
						       58 => "2196501439",
						       60 => "2196157774",
						       59 => "2195977730",
						       46 => "2196424498",
						       57 => "2196310018",
						       36 => "2193792979",
						       68 => "2198801966",
						       69 => "2205275809",
						       71 => "2205819371",
						       35 => "2192550159",
						       34 => "2195917033",
						       "def" => "2193350951"),
					 "en" => array(
						       38 => "2257652460",
						       39 => "2257652467",
						       40 => "2257439720",
						       61 => "2257685188",
						       62 => "2257734365",
						       63 => "2257636116",
						       64 => "2257668709",
						       37 => "2257619739",
						       43 => "2257734376",
						       44 => "2257358100",
						       45 => "2257603607",
						       42 => "2257668904",
						       70 => "2257603616",
						       41 => "2257538171",
						       48 => "2257407226",
						       49 => "2257472770",
						       50 => "2257390917",
						       58 => "2257603683",
						       60 => "2257440015",
						       59 => "2257701794",
						       46 => "2257374551",
						       52 => "2193138585",
						       53 => "2257358137",
						       54 => "2257619943",
						       55 => "2257636343",
						       65 => "2257358151",
						       66 => "2257423648",
						       51 => "2257538206",
						       57 => "2257620027",
						       36 => "2257620031",
						       68 => "2257276258",
						       69 => "2257571035",
						       71 => "2257374600",
						       35 => "2257341897",
                                                       34 => "2257538306",
						       "def" => "2193547708"),
					 "xx" => array(
						       38 => "2246296453",
						       39 => "2246296453",
						       40 => "2246296453",
						       61 => "2246296453",
						       62 => "2246296453",
						       63 => "2246296453",
						       64 => "2246296453",
						       37 => "2246296453",
						       43 => "2243936150",
						       44 => "2243936150",
						       45 => "2243936150",
						       42 => "2243936150",
						       70 => "2243936150",
						       41 => "2243936150",
						       52 => "2244975626",
						       53 => "2244975626",
						       54 => "2244975626",
						       55 => "2244975626",
						       65 => "2244975626",
						       66 => "2244975626",
						       51 => "2244975626",
						       48 => "2243936175",
						       49 => "2243936175",
						       50 => "2243936175",
						       58 => "2243936175",
						       60 => "2243936175",
						       59 => "2243936175",
						       46 => "2243936175",
						       57 => "2244197718",
						       36 => "2244197718",
						       68 => "2244197718",
						       69 => "2244197718",
						       71 => "2244197718",
						       35 => "2244197718",
						       34 => "2244197718",
						       "def" => "2246639940")
					 );
  /**
   *  getUrl function
   */
  static public function getUrl(){
    $url = sfConfig::get('app_itunesu_url');
    $debug = sfConfig::get('app_itunesu_debug');
    $admin_credentials = sfConfig::get('app_itunesu_acred');
    $identity = sfConfig::get('app_itunesu_identity');
    $key = sfConfig::get('app_itunesu_key');

    $tokendata = "credentials=" . urlencode($admin_credentials) . "&identity=" . urlencode($identity) . "&time=". urlencode(time()); //usar time por mktime
    $signature = hash_hmac('SHA256', $tokendata, $key);

    return $url . $debug . "?" . $tokendata . '&signature=' . $signature . "&type=XMLControlFile";
  }

  /**
   *  ShowTree function
   */
  static public function ShowTree($KeyGroup = 'minimal'){
    $operation = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<ITunesUDocument>
  <Version>1.1.3</Version>
  <ShowTree>
    <KeyGroup>".$KeyGroup."</KeyGroup>
  </ShowTree>
</ITunesUDocument>
";
    $url = self::getUrl();
    
    $ch_ope = curl_init($url);
    curl_setopt($ch_ope, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_ope, CURLOPT_POST, 1);
    curl_setopt($ch_ope, CURLOPT_POSTFIELDS, $operation);

    return curl_exec($ch_ope);
  }



  /**
   *  DeleteCourse function
   *  OJO falata procesar la salida para que de false o true (bool)
   */
  static public function DeleteCourse($course_handle){
    $operation = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<ITunesUDocument>
  <Version>1.1.3</Version>
  <DeleteCourse>
    <CourseHandle>" . $course_handle . "</CourseHandle>
    <CoursePath></CoursePath>
  </DeleteCourse>
</ITunesUDocument>

";

    $url = self::getUrl();
    
    $ch_ope = curl_init($url);
    curl_setopt($ch_ope, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_ope, CURLOPT_POST, 1);
    curl_setopt($ch_ope, CURLOPT_POSTFIELDS, $operation);

    return curl_exec($ch_ope);
  }

  /**
   *  AddCourse function
   *  OJO cear function para sacar sal.
   */
  static public function AddCourse($serial_id, $verbose = false){
    if(($serial = SerialPeer::retrieveByPkWithI18n($serial_id, 'es')) == null){
      return null;
    }

    if($serial->countSerialItuness() != 0){
      return null;
    }

    
    
    //GROUND
    $itunes = array();
    $grounds = $serial->getGrounds(3);
    $f = create_function('$a', 'return $a->getId();');
    if($grounds == null){
      $itunes[] = "def";
    }else{
      $itunes = array_map($f, $grounds);
    }
    
    //CULTURA
    $cultures = array();
    $cultures_url = array();
    $languages = $serial->getLanguages();
    $fes = create_function('$a', 'return in_array($a->getId(), array(4,6,11,13,14,15));');
    $fgl = create_function('$a', 'return in_array($a->getId(), array(4,6,11,13,14,15,12));');
    $fen = create_function('$a', 'return in_array($a->getId(), array(3,11,12,13));');
    $fxx = create_function('$a', 'return in_array($a->getId(), array(1,2,5,7,8,9,10,12));');
    if(array_filter($languages, $fes))
      $cultures[] = "es";
      $cultures_url[] = "es/";
    if(array_filter($languages, $fgl))
      $cultures[] = "gl";
      $cultures_url[] = "gl/";
    if(array_filter($languages, $fen))
      $cultures[] = "en";
      $cultures_url[] = "en/";
    if(array_filter($languages, $fen))
      $cultures[] = "xx";
      $cultures_url[] = "";

    foreach($cultures as $j=>$c){
      if(in_array($c, array("es", "gl"))){
	$serial->setCulture($c);
      }else{
	$serial->setCulture("es");
      }  
    
      foreach($itunes as $i){
	if($verbose){
	  echo " - " . $serial->getId()." " . $serial->getTitle() . ": ";
	  echo $c . ", ";
	  if ($i == "def"){
	    echo "defecto";
	  }else{
	    $aux = GroundPeer::retrieveByPK($i);
	    echo $aux->getName();	    
	  }

	  echo ", " . self::$pumukit2itunesu[$c][$i] . "\n";
	}
	
	if(is_null(self::$pumukit2itunesu[$c][$i])){
	  echo "ERROR MUY GRAVE CON pumukit2itunesu\n";
	  exit;
	}
    
	$operation = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<ITunesUDocument>
  <Version>1.1.3</Version>
  <AddCourse>
    <ParentHandle>" . self::$pumukit2itunesu[$c][$i] . "</ParentHandle>
    <Course>
      <Name>" . $serial->getTitle() ."</Name>
      <ShortName>". $serial->getTitle() . "</ShortName>
      <Identifier>esuvigotvserialfeed". $serial->getId() . "</Identifier>
      <Instructor>Universidade de Vigo</Instructor>"
      .((strlen($serial->getDescription()) != 0)?"<Description>". $serial->getDescription() . "</Description>":"").
      "<Group>
        <Name>Video</Name>
        <GroupType>Feed</GroupType>
        <Explicit>no</Explicit>
        <ExternalFeed>
          <URL>http://tv.uvigo.es/videocast/". $cultures_url[$j].$serial->getId() .".xml</URL>
          <OwnerEmail>tv@uvigo.es</OwnerEmail>
          <PollingInterval>Daily</PollingInterval>
          <SecurityType>None</SecurityType>
          <SignatureType>None</SignatureType>
        </ExternalFeed>
      </Group>
      <Group>
        <Name>Audio</Name>
        <GroupType>Feed</GroupType>
        <Explicit>no</Explicit>
        <ExternalFeed>
          <URL>http://tv.uvigo.es/podcast/". $cultures_url[$j].$serial->getId() .".xml</URL>
          <OwnerEmail>tv@uvigo.es</OwnerEmail>
          <PollingInterval>Daily</PollingInterval>
          <SecurityType>None</SecurityType>
          <SignatureType>None</SignatureType>
        </ExternalFeed>
      </Group>
      <AllowSubscription>true</AllowSubscription>
    </Course>
  </AddCourse>
</ITunesUDocument>

";

 
	$url = self::getUrl();
	
	$ch_ope = curl_init($url);
	curl_setopt($ch_ope, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch_ope, CURLOPT_POST, 1);
	curl_setopt($ch_ope, CURLOPT_POSTFIELDS, $operation);
	
	$itunes_sal = curl_exec($ch_ope);   
	if (!$xml = simplexml_load_string($itunes_sal)){
	  echo "Ha ocurrido un error al procesar el documento XML \n";
	  exit;
	}else{ 
	  if($verbose){
	    var_dump($xml);
	  }
	  $itunesu_handle = $xml->AddedObjectHandle;

	  $a = new SerialItunes();
	  $a->setSerialId($serial->getId());
	  $a->setCulture($c);
	  $a->setItunesId($itunesu_handle);
	  $a->save();

	}
	file_put_contents(sfConfig::get('sf_log_dir') . '/itunes.log', $serial->getId() . " " . $c . " " . $itunesu_handle . " \n", FILE_APPEND);
	
      }
    }

    return true; //OJO
  }





  static public function insert($serial_id, $culture, $where, $verbose = false)
  {
    if(($serial = SerialPeer::retrieveByPkWithI18n($serial_id, $culture)) == null){
      return null;
    }

    $operation = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<ITunesUDocument>
  <Version>1.1.3</Version>
  <AddCourse>
    <ParentHandle>" . $where . "</ParentHandle>
    <Course>
      <Name>" . $serial->getTitle() ."</Name>
      <ShortName>". $serial->getTitle() . "</ShortName>
      <Identifier>esuvigotvserialfeed". $serial->getId() . "</Identifier>
      <Instructor>Universidade de Vigo</Instructor>"
      .((strlen($serial->getDescription()) != 0)?"<Description>". $serial->getDescription() . "</Description>":"").
      "<Group>
        <Name>Video</Name>
        <GroupType>Feed</GroupType>
        <Explicit>no</Explicit>
        <ExternalFeed>
          <URL>http://tv.uvigo.es/videocast/". $culture ."/". $serial->getId() .".xml</URL>
          <OwnerEmail>tv@uvigo.es</OwnerEmail>
          <PollingInterval>Daily</PollingInterval>
          <SecurityType>None</SecurityType>
          <SignatureType>None</SignatureType>
        </ExternalFeed>
      </Group>
      <Group>
        <Name>Audio</Name>
        <GroupType>Feed</GroupType>
        <Explicit>no</Explicit>
        <ExternalFeed>
          <URL>http://tv.uvigo.es/podcast/". $culture ."/". $serial->getId() .".xml</URL>
          <OwnerEmail>tv@uvigo.es</OwnerEmail>
          <PollingInterval>Daily</PollingInterval>
          <SecurityType>None</SecurityType>
          <SignatureType>None</SignatureType>
        </ExternalFeed>
      </Group>
      <AllowSubscription>true</AllowSubscription>
    </Course>
  </AddCourse>
</ITunesUDocument>

";

 
    $url = self::getUrl();
    
    $ch_ope = curl_init($url);
    curl_setopt($ch_ope, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_ope, CURLOPT_POST, 1);
    curl_setopt($ch_ope, CURLOPT_POSTFIELDS, $operation);
  
    return curl_exec($ch_ope);  
  }
}







/*
    $contenido =itunes::ShowTree("maximal");

    
    if (!$xml = simplexml_load_string($contenido)){
      return null;
    }else{ 
      ### TENGO QUE CAMBIARLO POR LA NUEVA ESTRUCTURA, RELACIONADO CON AREA DE CONOCIMIENTO ITUNES 
      foreach($xml->Site->Section[0]->Division as $d){
	$sal[intval(substr($d->Identifier, -1, 1))] = array("handle" => strval($d->Section[0]->Handle), "name" => strval($d->Name));
      }
    }

*/