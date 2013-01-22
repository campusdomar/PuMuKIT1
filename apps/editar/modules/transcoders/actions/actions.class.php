<?php

/**
 * trancoder actions.
 *
 * @package    pumukituvigo
 * @subpackage trancoder
 * @author     Ruben Glez <rubenrua
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class transcodersActions extends sfActions
{
  /**
   * Execute index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('transcoder_menu', 'active'); 
    
    if(!$this->getUser()->hasAttribute('page_past', 'tv_admin/transcoder'))
      $this->getUser()->setAttribute('page_past', 1, 'tv_admin/transcoder');   
    if(!$this->getUser()->hasAttribute('page_present', 'tv_admin/transcoder'))
      $this->getUser()->setAttribute('page_present', 1, 'tv_admin/transcoder');   
    if(!$this->getUser()->hasAttribute('page_future', 'tv_admin/transcoder'))
      $this->getUser()->setAttribute('page_future', 1, 'tv_admin/transcoder');   
  }

   /**
   * Executes transcodificar
   *
   */
  public function executeEdit()
  {
    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('mm'));
    $this->forward404Unless($this->mm);
  
    $this->profiles = PerfilPeer::doSelectToWizard(false);
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  public function executeCreate()
  {
    $this->profiles = PerfilPeer::doSelectWithI18n(new Criteria());
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }


  public function executeTranscoder()
  {
    $this->profiles = PerfilPeer::doSelectWithI18n(new Criteria());
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }
 
   /**
   * Executes components AJAX
   *
   */
  public function executeList()
  {
  }


  public function executeListpast()
  {
    return $this->renderComponent('transcoders', 'listpast');
  }


  public function executeListpresent()
  {
    return $this->renderComponent('transcoders', 'listpresent');
  }


  public function executeListfuture()
  {
    return $this->renderComponent('transcoders', 'listfuture');
  }

  /**
   * Executes other actions
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/transcoder');
    }
    return $this->renderComponent('transcoders', 'preview');
  }


  public function executePriorityup()
  {
   if($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($transc->getPriority() < 3 ){
        $transc->setPriority($transc->getPriority()+1);
        $transc->save();
      }
    }
    return $this->renderPartial('transcoders/list');
  }


  public function executePrioritydown()
  {
   if($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($transc->getPriority() > 1 ){ 
        $transc->setPriority($transc->getPriority()-1);
        $transc->save();
      }
    }
    return $this->renderPartial('transcoders/list');
  }


  public function executeCpusup()
  {
   if($this->hasRequestParameter('id')){
      $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($cpu->getNumber() < $cpu->getMax()){ 
        $cpu->setNumber($cpu->getNumber()+1);
        $cpu->save();
      }
    }
    TranscodingPeer::execNext();
    return $this->renderComponent('transcoders', 'cpus');
  }



  public function executeCpusdown()
  {
   if($this->hasRequestParameter('id')){
      $cpu = CpuPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($cpu->getNumber() > $cpu->getMin()){ 
        $cpu->setNumber($cpu->getNumber()-1);
        $cpu->save();
      }
    }
    return $this->renderComponent('transcoders', 'cpus');
  }


  public function executePause()
  {
    if($this->hasRequestParameter('ids')){
      $transcs = TranscodingPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));
      
      foreach($transcs as $transc){
	     $transc->setStatusId(0);
	     $transc->save();
      }

    }elseif($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
      $transc->setStatusId(0);
      $transc->save();
    }
    return $this->renderPartial('transcoders/list');
  }


  public function executeContinue()
  {
    if($this->hasRequestParameter('ids')){
      $transcs = TranscodingPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($transcs as $transc){
	     $transc->setStatusId(1);
	     $transc->save();
      }

    }elseif($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
      $transc->setStatusId(1);
      $transc->save();
    }
    TranscodingPeer::execNext();
    return $this->renderPartial('transcoders/list');
  }

  
  public function executeClean()
  {
    if($this->hasRequestParameter('ids')){
      $transcs = TranscodingPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($transcs as $transc){
	       $transc->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
      $transc->delete();
    }
    return $this->renderPartial('transcoders/list');
  }

  
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $transcs = TranscodingPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));
      foreach($transcs as $transc){
	if ($transc->getStatusId() != 3) {
	  $transc->deleteTempFiles();
	  $transc->delete();
	  TranscodingPeer::execNext();
	}
      }

    }elseif($this->hasRequestParameter('id')){
      $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
       if ($transc->getStatusId() != 3) {
	 $transc->deleteTempFiles();
	 $transc->delete();
	 TranscodingPeer::execNext();
       }
    }
    return $this->renderPartial('transcoders/list');
  }


  public function executeAltermail()
  {
   $transc = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
   $this->forward404Unless($transc);
  
   if ($transc->hasEmailOn()) $transc->setEmailOff();
   else $transc->setEmailOn();

   $transc->save();
   return $this->renderPartial('transcoders/list');
  }


  public function executeUpload()
  {
    set_time_limit(0);
    $this->setLayout(false);

    if (($this->getRequest()->hasFiles())||($this->getRequestParameter('file_type', 'url') == 'file')){

      $mm = MmPeer::retrieveByPKWithI18n($this->getRequestParameter('num_video'), $this->getUser()->getCulture());
      $this->forward404Unless($mm);
      
      $lang = LanguagePeer::retrieveByPK($this->getRequestParameter('idioma'));
      $this->forward404Unless($lang);


      if($this->getRequestParameter('file_type', 'url') == 'url'){
	$file_name = $this->getRequest()->getFileName('video');
      }else{
	$file_name = basename($this->getRequestParameter('file'));
      }
      
      do{
        $path_video_tmp = sfConfig::get('app_transcoder_path_tmp').'/'.$mm->getId().'_';
        $path_video_tmp .= $lang->getCod().'_'.rand().'_'.$file_name;
      } while (file_exists($path_video_tmp));
      
      if($this->getRequestParameter('file_type') == 'url'){
	if(!$this->getRequest()->moveFile('video', $path_video_tmp)){
	  return sfView::ERROR;
	}
      }else{
	$aux = str_replace("\\", "/", $this->getRequestParameter('file'));
	$aux = str_replace(sfConfig::get('app_transcoder_path_win'), sfConfig::get('app_transcoder_path_unix'), $aux);

	if(file_exists($aux)){
	  //copy($aux, $path_video_tmp);
	  $path_video_tmp = $aux;
	}else{
	  return sfView::ERROR;
	}
      }

      //analizo archivo
      try {
	$duration = FilePeer::getDuration($path_video_tmp);
      }
      catch (Exception $e) {
	if($this->getRequestParameter('file_type') == 'url')
	  unlink($path_video_tmp);
        return sfView::ERROR; //MAL
      }

      if($duration == 0){
	if($this->getRequestParameter('file_type') == 'url')
	  unlink($path_video_tmp);
        return sfView::ERROR; //MAL
      }
      
      
      $c = new Criteria();
      $c->addAscendingOrderByColumn(PerfilPeer::RANK);
      $c->add(PerfilPeer::ID, $this->getRequestParameter('master')); 
      $profiles = PerfilPeer::doSelect($c); 
      
      foreach($profiles as $profile){
      	$trans = new Transcoding();
      	$trans->setPerfilId($profile->getId());
      	$trans->setStatusId(1);
      	$trans->setPriority($this->getRequestParameter('prioridad'));  
	if (strpos($profile->getName(), 'master') !== false){
	  $trans->setPriority($this->getRequestParameter('prioridad') - 1);  
	}
      	$trans->setTimeini('now');
      	$trans->setMmId($mm->getId());
	
      	$langs = sfConfig::get('app_lang_array', array('es'));
      	foreach($langs as $l){
      	  $trans->setCulture($l);
      	  $trans->setDescription($this->getRequestParameter('description_' . $l, ' '));
      	}
      	
      	$trans->save();
      
      	$trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
      	$trans->setLanguage($lang);
      	$trans->setPriority($this->getRequestParameter('prioridad'));

      	$trans->setPid(0);
      	$user = UserPeer::retrieveByPK($this->getUser()->getAttribute('user_id'));
      	$trans->setEmail($user->getEmail());
      
      	$trans->setDuration($duration);
      	$trans->setPathsAuto($path_video_tmp);
      	$trans->setUrl($trans->getPathEnd());
      	$trans->save();
      
      	TranscodingPeer::execNext();
	$this->mm = $mm->getId();
      }
    }
  }



  public function executeDirectory()
  {
    set_time_limit(0);
    $langs = sfConfig::get('app_lang_array', array('es'));
    $lang = LanguagePeer::retrieveByPK($this->getRequestParameter('idioma'));
    $this->forward404Unless($lang);

    $c = new Criteria();
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);
    $c->add(PerfilPeer::ID, $this->getRequestParameter('perfil'), Criteria::IN); 
    $profiles = PerfilPeer::doSelect($c); 
    
    $aux = str_replace(
		       sfConfig::get('app_transcoder_path_win'), 
		       sfConfig::get('app_transcoder_path_unix'), 
		       $this->getRequestParameter('url')
		       );

    if(!count($profiles)){
      return $this->renderPartial('transcoders/list');
    }

    $this->forward404Unless(file_exists($aux));

    $serial = null;
    $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->in($aux);
    

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
	echo "Duracion 0\n";
	exit;
	continue;
      }

      //creo serial
      if($serial == null){
	$serial = SerialPeer::createNew(false);
	foreach($langs as $l){
	  $serial->setCulture($l);
	  $serial->setTitle(basename($aux)); 
	}
	$serial->save();
      }

      //creo objeto multimedia
      $mm = MmPeer::createNew($serial->getId());
      if(ereg('^([0-9]{6})_([0-9]+_)*(.*)\.(.{3})', basename($file), $out) != false){
	list($y_mm, $m_mm, $d_mm) = str_split($out[1], 2);
	$title_mm = $out[3];
	
	$mm->setRecordDate(mktime(0, 0, 0, $m_mm, $d_mm, $y_mm));
      }else{
	$title_mm = basename($file);
	$mm->setRecorddate('now');
      }
      //$mm->setPublicDate('now'); //From MmTemplate


      foreach($langs as $l){
	$mm->setCulture($l);
	$mm->setTitle(strtr($title_mm, '_', ' ')); 
      }
      $mm->save();

      foreach($profiles as $profile){
	//echo "  -Process profile: " . $profile->getName() . "\n";
	$trans = new Transcoding();
	$trans->setPerfilId($profile->getId());
	$trans->setStatusId(1);
	$trans->setPriority($this->getRequestParameter('prioridad'));
	if (strpos($profile->getName(), 'master') !== false){
	  $trans->setPriority($this->getRequestParameter('prioridad') - 1);  //MENOS
	}
	$trans->setTimeini('now');
	$trans->setMmId($mm->getId());
	
	foreach($langs as $l){
	  $trans->setCulture($l);
	  $trans->setDescription();
	}
      	
	$trans->save();

	//COMPLETO TAREA
	$trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
	$trans->setLanguage($lang);

	$trans->setPid(0);
	$trans->setEmail($this->getUser()->getAttribute('email'));
	
	$trans->setDuration($duration);
      	$trans->setPathsAuto($path_video_tmp);
	$trans->setUrl($trans->getPathEnd());
    
	$trans->save();
    
	TranscodingPeer::execNext();
    
      } 
    }
    return $this->renderPartial('transcoders/list');
  }




  public function executeOne()
  {
    set_time_limit(0);
    $langs = sfConfig::get('app_lang_array', array('es'));
    $lang = LanguagePeer::retrieveByPK($this->getRequestParameter('idioma'));
    $this->forward404Unless($lang);

    $c = new Criteria();
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);
    $c->add(PerfilPeer::ID, $this->getRequestParameter('perfil'), Criteria::IN); 
    $profiles = PerfilPeer::doSelect($c); 
    
    $url_in = str_replace(
		       sfConfig::get('app_transcoder_path_win'), 
		       sfConfig::get('app_transcoder_path_unix'), 
		       $this->getRequestParameter('url')
		       );

    $url_out = str_replace(
		       sfConfig::get('app_transcoder_path_win'), 
		       sfConfig::get('app_transcoder_path_unix'), 
		       $this->getRequestParameter('urlout')
		       );

    if(!count($profiles)){
      return $this->renderText("Selecione un perfil");
    }

    if(!file_exists($url_in)){
      return $this->renderText("No existe fiechero de entrada");
    }

    
    if(file_exists($url_out)){
      return $this->renderText("Ya existe fichero de salida " . $url_out);
    }
    
    $file_name = basename($url_in);
    $path_video_tmp = $url_in;

    
    //analizo archivo
    try {
      $duration = FilePeer::getDuration($path_video_tmp);
    }
    catch (Exception $e) {
      return $this->renderText("Error al analizar el archivo");
    }

    if($duration == 0){
      return $this->renderText("Error al analizar el archivo.");
    }

    foreach($profiles as $profile){
      //echo "  -Process profile: " . $profile->getName() . "\n";
      $trans = new Transcoding();
      $trans->setPerfilId($profile->getId());
      $trans->setStatusId(1);
      $trans->setPriority($this->getRequestParameter('prioridad'));
      if (strpos($profile->getName(), 'master') !== false){
	$trans->setPriority($this->getRequestParameter('prioridad') - 1);  //MENOS
      }
      $trans->setTimeini('now');
      $trans->setMmId(0);  //NO CREE MM
	
      foreach($langs as $l){
	$trans->setCulture($l);
	$trans->setDescription('Transcodificacion independiente');
      }
      	
      $trans->save();

      //COMPLETO TAREA
      $trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
      $trans->setLanguage($lang);
      
      $trans->setPid(0);
      $trans->setEmail($this->getUser()->getAttribute('email'));
      
      $trans->setDuration($duration);
      
      $trans->setPathsIni($path_video_tmp);


      $extension = substr($trans->getPathIni(), -3, 3);
      $extension_final = (($trans->getPerfil()->getExtension() == '???')?($extension):($trans->getPerfil()->getExtension()));
      $trans->setExtIni($extension);
      $trans->setExtEnd($extension_final);
      $trans->setUrl($trans->getPathEnd());
      $trans->setPathEnd($url_out . "." . $extension_final);      
      $trans->save();
    
      TranscodingPeer::execNext();
      
    } 
    return $this->renderText("Transcodificacion metida en la cola.");
  }


  public function executeMasterserial()
  {
    $c = new Criteria();
    //$c->add(PerfilPeer::DISPLAY, 0);
    $this->profiles = PerfilPeer::doSelectWithI18n($c);
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $c = new Criteria();
    $c->add(SerialPeer::ID, $this->getRequestParameter('id', $this->getUser()->getAttribute('serial')));
    list($aux) = SerialPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->serial = $aux;
    $this->forward404Unless($this->serial);
  }


  public function executeMasterserialproccess()
  {
    set_time_limit(0);
    $langs = sfConfig::get('app_lang_array', array('es'));
    $lang = LanguagePeer::retrieveByPK($this->getRequestParameter('idioma'));
    $this->forward404Unless($lang);


    $c = new Criteria();
    $c->addAscendingOrderByColumn(PerfilPeer::RANK);
    $c->add(PerfilPeer::ID, $this->getRequestParameter('perfil'), Criteria::IN); //dado
    $profiles = PerfilPeer::doSelect($c); 

    $serial = SerialPeer::retrieveByPk($this->getRequestParameter('serial_id'));
    $this->forward404Unless($serial);
    
    $aux = str_replace(
		       sfConfig::get('app_transcoder_path_win'), 
		       sfConfig::get('app_transcoder_path_unix'), 
		       $this->getRequestParameter('url')
		       );


    
    if(!count($profiles)){
      return $this->renderComponent('mms', 'list');
    }

    $this->forward404Unless(file_exists($aux));

    //creo objeto multimedia

    $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->in($aux);
    
    $this->msg_alert = array('info', "Procesados ".count($files)." ficheros. ");

    foreach($files as $file){
      //echo "-Process file:" . $file . "\n";

      $mm = MmPeer::createNew($serial->getId());
      
      //$mm->setPublicDate('now');
      $mm->setRecorddate('now');
      
      foreach($langs as $l){
	$mm->setCulture($l);
	$mm->setTitle('Bruto de camara ' . $file_name); //falta def title titulo nombre de archivo
      }
      $mm->save();
      $mm->setPicId(3922);
      

      $file_name = basename($file);
      $path_video_tmp = $file;

      //analizo archivo
      try {
	$duration = FilePeer::getDuration($path_video_tmp);
      }
      catch (Exception $e) {
	//unlink($path_video_tmp);
	$this->msg_alert = array('error', "Existe algun archivo mal procesado.");
	continue; 
      }

      if($duration == 0){
	//exit;
	$this->msg_alert = array('error', "Existe algun archivo mal procesado.");
	continue;
      }

      foreach($profiles as $profile){
	//echo "  -Process profile: " . $profile->getName() . "\n";
	$trans = new Transcoding();
	$trans->setPerfilId($profile->getId());
	$trans->setStatusId(1);
	$trans->setPriority($this->getRequestParameter('prioridad'));
	$trans->setTimeini('now');
	$trans->setMmId($mm->getId());
	
	foreach($langs as $l){
	  $trans->setCulture($l);
	  $trans->setDescription();
	}
      	
	$trans->save();

    
	//COMPLETO TAREA
	$trans->setName(substr($file_name, 0 , strlen($file_name)- 4));
	$trans->setLanguage($lang);
	//$trans->setComment()//varios idiomas
	//falta duracion
	$trans->setPid(0);
	$trans->setEmail($this->getUser()->getAttribute('email'));
	
	$trans->setDuration($duration);
      	$trans->setPathsAuto($path_video_tmp);
	$trans->setUrl($trans->getPathEnd());
    
	$trans->save();
    
	TranscodingPeer::execNext();
    
      } 
    }
    return $this->renderComponent('mms', 'list');
  }
 


  /**
   * --  RETRANSCODIFICAR -- /editar.php/transcoding/retrans
   *
   * Parametros por URL: 
   *   - Identificador del tarea erronea
   *
   */
  public function executeRetrans()
  {
    
    $trans = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($trans);

    if($trans->getStatusId() != TranscodingPeer::STATUS_ERROR){
      $this->msg_alert = array('error', "La tarea no es erronea.");
      return $this->renderComponent('files', 'list');
    }
    
    @mkdir($trans->getPerfil()->getDirOut() . '/' . $trans->getMm()->getSerialId(), 0777, true);
    $trans->setStatusId(1);
    $trans->setPriority(2);
    $trans->setTimeini('now');
    $trans->save();

    TranscodingPeer::execNext();
    
    //OJO LO QUE TENGO QUE DEVOLVER
    $this->msg_alert = array('info', "Retranscodificando tarea.");
    return $this->renderComponent('files', 'list');
  }


  /**
   * --  DELETEFROMFILE -- /editar.php/transcoding/deletefromfile
   *
   * Parametros por URL: 
   *   - Identificador del tarea erronea
   *
   */
  public function executeDeletefromfile()
  {
    
    $trans = TranscodingPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($trans);

    if($trans->getStatusId() != TranscodingPeer::STATUS_ERROR){
      $this->msg_alert = array('error', "La tarea no es erronea.");
      return $this->renderComponent('files', 'list');
    }
    
    //$transc->deleteTempFiles();
    $trans->delete();

    //OJO LO QUE TENGO QUE DEVOLVER
    $this->msg_alert = array('info', "Transcodificacion borrada.");
    return $this->renderComponent('files', 'list');
  }




  /**
   *
   */
  private function elimina_acentos($cadena){
    //Elimina acentos y caracteres no validos de los nombres de los videos
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿñÑ";
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuynN"; 
    return(ereg_replace('[^0-9A-Za-z]', '_', strtr(utf8_decode($cadena),$tofind,$replac)));
  } 

}


