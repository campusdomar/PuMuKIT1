<?php
/**
 * MODULO WIZARD ACTIONS. 
 * Pseudomodulo de administracion de los objetos multimedia a traves de wizard.
 * Se genera un wizard en modalbox con los siguintes pasos.
 *   -1. Datos de la seris (Primero)
 *   -2. Directorio o fichero (Primero serial_id o antes)
 *   -3. Datos del objeto multimedia
 *   -4. Datos de archivo
 *   -5. OK/cancel
 *
 * @package    pumukit
 * @subpackage wizards
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.5
 */
class wizardActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeSerial()
  {
    $this->serial = new Serial();
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  /**
   * Executes index action
   *
   */
  public function executeType()
  {
  }


  /**
   * Executes index action
   *
   */
  public function executeMm()
  {
    $langs = sfConfig::get('app_lang_array', array('es'));

    if(0 == intval($this->getRequestParameter("id"))){
      $this->serial = new Serial();
      //COMPLETAR
      foreach($langs as $lang){
	       $this->serial->setCulture($lang);
	       $this->serial->setTitle($this->getRequestParameter('title_' . $lang));
         $this->serial->setSubtitle($this->getRequestParameter('subtitle_' . $lang));
      }
      $this->mm = new Mm();
    }else{
      $this->serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->serial);
      $this->mm = MmPeer::createNewMm($this->serial->getId());
    }
    $this->langs = $langs;
    

  }



  /**
   * Executes index action
   *
   */
  public function executeFile()
  {
    $div = 'list_serials';
    $langs = sfConfig::get('app_lang_array', array('es'));

    if(0 == intval($this->getRequestParameter("serial_id"))){
      $this->serial = new Serial();
      //COMPLETAR
      foreach($langs as $lang){
	$this->serial->setCulture($lang);
	$this->serial->setTitle($this->getRequestParameter('serial_title_' . $lang));
	$this->serial->setSubtitle($this->getRequestParameter('serial_subtitle_' . $lang));
      }
    }else{
      $div = 'list_mms';
      $this->serial = SerialPeer::retrieveByPk($this->getRequestParameter('serial_id'));
      $this->forward404Unless($this->serial);
    }

    $this->mm = new Mm();
    foreach($langs as $lang){
      $this->mm->setCulture($lang);
      $this->mm->setTitle($this->getRequestParameter('title_' . $lang));
      $this->mm->setSubtitle($this->getRequestParameter('subtitle_' . $lang));
      $this->mm->setDescription($this->getRequestParameter('description_' . $lang));

      $this->mm->setSubserialTitle($this->getRequestParameter('subserialtitle_' . $lang));

    }

    $this->profiles = PerfilPeer::doSelectToWizard(true);
    $this->pub_channels = PubChannelPeer::doSelect(new Criteria());
    $this->langs = $langs;
    $this->div = $div;
  }



  /**
   * Executes index action
   *
   */
  public function executeEnd()
  {
    set_time_limit(0);
    $div= (0 == intval($this->getRequestParameter("serial_id")))?'serials':'mms';

    $langs = sfConfig::get('app_lang_array', array('es'));
    $language = LanguagePeer::retrieveByPK($this->getRequestParameter('idioma'));
    $this->forward404Unless($language);

    $files = null;


    //PERIL PARA MASTER
    $master = PerfilPeer::retrieveByPk($this->getRequestParameter('master'));
    
    //TODO: Mirar que el perfil es de master
    if($master == null){
      return $this->renderText($this->getContext()->getI18N()->__("ERROR- No hay seleccionado ningun perfil para master"));
      //return $this->forward($div, 'list');
    }

    $c = new Criteria();
    $c->add(PubChannelPeer::ID, $this->getRequestParameter('pub_channel'), Criteria::IN); 
    $pub_channels = PubChannelPeer::doSelect($c); 

    switch ($this->getRequestParameter('file_type', 0)) {
    case "file":
      $file_name = $this->getRequest()->getFileName('video');
      do{
        $path_video_tmp = sfConfig::get('app_transcoder_path_tmp').'/';
        $path_video_tmp .= $language->getCod().'_'.rand().'_'.$file_name;
      } while (file_exists($path_video_tmp));
      
      if(!$this->getRequest()->moveFile('video', $path_video_tmp)){
	return $this->renderText($this->getContext()->getI18N()->__("ERROR- [file] error haciendo un move file"));
	//return $this->forward($div, 'list');
      }
      $files = array($path_video_tmp);
      break;
    case "url":
      $aux = str_replace("\\", "/", $this->getRequestParameter('file'));
      $aux = str_replace(sfConfig::get('app_transcoder_path_win'), sfConfig::get('app_transcoder_path_unix'), $aux);
      if(file_exists($aux)){
	$files = array($aux);
      }else{
	return $this->renderText($this->getContext()->getI18N()->__("ERROR - [url] No files"));
	//return $this->forward($div, 'list');
      }
      break;
    case "dir":
      $aux = str_replace(
			 sfConfig::get('app_transcoder_path_win'), 
			 sfConfig::get('app_transcoder_path_unix'), 
			 $this->getRequestParameter('url')
			 );
      $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->in($aux);
      break;
    default:
      return $this->renderText($this->getContext()->getI18N()->__("ERROR - [default] "));
      //return $this->forward($div, 'list');
    }


    
    if(!is_array($files)){
      return $this->renderText($this->getContext()->getI18N()->__("ERROR - files no es un array"));
      //return $this->forward($div, 'list');
    }


    if(0 == intval($this->getRequestParameter("serial_id"))){
      $serial = SerialPeer::createNew(false);
      //COMPLETAR
      foreach($langs as $lang){
	$serial->setCulture($lang);
	$serial->setTitle($this->getRequestParameter('serial_title_' . $lang));
	$serial->setSubtitle($this->getRequestParameter('serial_subtitle_' . $lang));
      }
      
      $serial->save();
    }else{
      $serial = SerialPeer::retrieveByPk($this->getRequestParameter('serial_id'));
      $this->forward404Unless($serial);
    }

    foreach($files as $file){
      $file_name = basename($file);
      $path_video_tmp = $file;

      //analizo archivo
      try {
	$duration = FilePeer::getDuration($path_video_tmp);
      }
      catch (Exception $e) {
	//unlink($path_video_tmp);
	continue; 
      }

      if($duration == 0){
	continue;
      }

      //creo objeto multimedia OJO NOMBRE DE FORMULARIO????
      $mm = MmPeer::createNew($serial->getId());
      if(ereg('^([0-9]{6})_([0-9]+_)*(.*)\.(.{3})', basename($file), $out) != false){
	list($y_mm, $m_mm, $d_mm) = str_split($out[1], 2);
	$title_mm = $out[3];
	
	$mm->setRecordDate(mktime(0, 0, 0, $m_mm, $d_mm, $y_mm));
      }else{
	$title_mm = basename($file);
      }
      //$mm->setPublicDate('now');

      foreach($langs as $l){
      	$mm->setCulture($l);
      	if($this->getRequestParameter('file_type', 0) == "dir"){
      	  $mm->setTitle($file_name); //Nombre del archivo
        }else{
      	  $mm->setTitle($this->getRequestParameter("mm_title_" . $l)); //Nombre del archivo
        }
      	$mm->setSubtitle($this->getRequestParameter("mm_subtitle_" . $l)); //Nombre del archivo
      	if(strlen(trim($this->getRequestParameter("mm_description_" . $l))) > 0){
      	  $mm->setDescription($this->getRequestParameter("mm_description_" . $l)); //Nombre del archivo
      	}
        if(strlen(trim($this->getRequestParameter("mm_subserialtitle_" . $l))) > 0){
          $mm->setSubserialTitle($this->getRequestParameter("mm_subserialtitle_" . $l)); 
        }
      }
      $mm->save();

      //Relaciono en estado tres (si tengo dos masters)
      foreach($pub_channels as $p_ch){
	$aux = new PubChannelMm();
	$aux->setMm($mm);
	$aux->setPubChannel($p_ch);
	$aux->setStatusId(3);
	$aux->save();
      }

      //echo "  -Process profile: " . $profile->getName() . "\n";
      $trans = new Transcoding();
      $trans->setPerfilId($master->getId());
      $trans->setStatusId(1);
      $trans->setPriority($this->getRequestParameter('prioridad'));

      $trans->setTimeini('now');
      $trans->setMmId($mm->getId());
      
      foreach($langs as $l){
	$trans->setCulture($l);
	$trans->setDescription("");
      }
      
      $trans->save();
      
      //COMPLETO TAREA
      $trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
      $trans->setLanguage($language);
      
      $trans->setPid(0);
      $trans->setEmail($this->getUser()->getAttribute('email'));
      
      $trans->setDuration($duration);
      $trans->setPathsAuto($path_video_tmp);
      $trans->setUrl($trans->getPathEnd());
      
      $trans->save();
      
      TranscodingPeer::execNext();
    
    }

    //return $this->renderText($this->getContext()->getI18N()->__("OK- [END] "));
    //return $this->forward($div, 'list');
    $this->div = $div;
  }

}
