<?php
/**
 * MODULO PICS ACTIONS. 
 * Modulo de administracion de las lugares donde se graban los 
 * objetos multimedia.
 *
 * @package    pumukit
 * @subpackage pics
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class picsActions extends sfActions
{
  /**
   * --  LIST -- /editar.php/pics/list
   *
   * Sin parametros o identificador de mm, serial o channel.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('pics', 'list');
  }

  /**
   * --  CREATE -- /editar.php/pics/create
   *
   * Parametros: id de mm, serial o channel
   *
   */
  public function executeCreate()
  {
    $limit = 12; //3x4

    $this->inicialize();

    $c = new Criteria();

    $this->page = $this->getRequestParameter('page', 1);
    $offset = ($this->page - 1) * $limit;
    $c->setLimit($limit);
    $c->setOffset($offset);

    $c->addDescendingOrderByColumn(PicPeer::ID);
    $this->pics = PicPeer::doSelect($c);

    $this->total_pic = PicPeer::doCount(new Criteria());
    $this->total = ceil($this->total_pic / $limit); 
  }


  /**
   * --  UPDATE -- /editar.php/pics/update
   *
   * Parametros: 
   *     -ID de mm, serial o channel
   *     -TYPE: url o file
   *
   */
  public function executeUpdate()
  {
    $limit = 12; //3x4

    $this->inicialize();

    if ($this->getRequestParameter('type') == 'url'){
      $aux = 'Pic'.ucfirst($this->que);
      $pic = new Pic();
      $pic->setUrl($this->getRequestParameter('url'));
      $pic->save();
      $pic_object = new $aux;
      $pic_object->setPicId($pic->getId());
      $pic_object->setOtherId($this->object_id);
      $pic_object->save();
    }elseif($this->getRequestParameter('type') == 'pic'){
      $aux = 'Pic'.ucfirst($this->que);
      if (call_user_func(array($aux . 'Peer', 'retrieveByPk'), $this->getRequestParameter('id'), $this->object_id) == null){
	$pic_object = new $aux;
	$pic_object->setPicId($this->getRequestParameter('id'));
	$pic_object->setOtherId($this->object_id);
	$pic_object->save();
      }
    }

    $this->preview = true;
    $this->msg_alert = array('info', "Nueva imagen insertada.");
    return $this->renderComponent('pics', 'list');
  }



  /**
   * --  UPLOAD -- /editar.php/pics/upload
   *
   * Parametros: 
   *    -id de mm, serial o channel (tipo de objeto)
   *    -type: url o file (metodo de subida)
   *
   */
  public function executeUpload()
  {
    $limit = 12; //3x4

    $currentDir = $this->inicialize(true);

    if ($this->getRequestParameter('type') == 'url'){
      $absCurrentDir = sfConfig::get('sf_upload_dir').'/pic/' . $currentDir;
      
      $fileName = $this->sanitizeFile($this->getRequest()->getFileName('file'));
      
      if ( strstr($this->getRequest()->getFileType('file'), 'image') == false ){
	return 'Fail';
      }
     
	
      $absFile = $absCurrentDir .'/' . $fileName;
	
      while(file_exists($absFile)){
	$r = rand ();
	$absFile = $absCurrentDir .'/' . $r . $fileName;
      }


      //copiar archivo
      //$this->getRequest()->moveFile('file', $absCurrentDir . '/' . $fileName);
      //Crear miniatura.
      try{
	$thumbnail = new sfThumbnail(sfConfig::get('app_thumbnail_hor'), sfConfig::get('app_thumbnail_ver'));
	$thumbnail->loadFile($this->getRequest()->getFilePath('file'));
	@mkdir($absCurrentDir, 0777, true);

	$thumbnail->save($absFile, 'image/jpeg');
      }catch(Exception $e){
	$this->getRequest()->moveFile('file', $absFile);
      }
      

      
      $aux = 'Pic'.ucfirst($this->que);
    
      $pic = new Pic();
      $pic->setUrl('/uploads/pic/' . $currentDir . '/' . $r . $fileName);
      $pic->save();
      $pic_object = new $aux;
      $pic_object->setPicId($pic->getId());
      $pic_object->setOtherId($this->object_id);
      $pic_object->save();
    }

    $this->msg_alert = array('info', "Nueva imagen insertada.");
  }

  /**
   * --  DELETE -- /editar.php/pics/delete
   *
   * Parametros: id de mm, serial o channel
   *
   */
  public function executeDelete()
  {
    if ($this->hasRequestParameter('serial')){
      $pic_relation = PicSerialPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('serial'));
    }elseif($this->hasRequestParameter('mm')){
      $pic_relation = PicMmPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('mm'));
    }
    $this->forward404Unless($pic_relation);

    $pic_relation->delete();

    $this->preview = true;
    $this->msg_alert = array('info', "Imagen borrada.");
    return $this->renderComponent('pics', 'list');
  }


  /**
   * --  UP -- /editar.php/pics/up
   *
   * Parametros: id de mm, serial o channel; id del pic
   *
   */
  public function executeUp()
  {
    if ($this->hasRequestParameter('serial')){
      $pic = PicSerialPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('serial'));
    }elseif($this->hasRequestParameter('mm')){
      $pic = PicMmPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('mm'));
    }
    $this->forward404Unless($pic);

    $pic->moveUp();
    $pic->save();

    $this->preview = true;
    return $this->renderComponent('pics', 'list');
  }

  /**
   * --  DOWN -- /editar.php/pics/down
   *
   * Parametros: id de mm, serial o channel; id del pic
   *
   */
  public function executeDown()
  {
    if ($this->hasRequestParameter('serial')){
      $pic = PicSerialPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('serial'));
    }elseif($this->hasRequestParameter('mm')){
      $pic = PicMmPeer::retrieveByPk($this->getRequestParameter('id'), $this->getRequestParameter('mm'));
    }
    $this->forward404Unless($pic);

    $pic->moveDown();
    $pic->save();

    $this->preview = true;
    return $this->renderComponent('pics', 'list');
  }


  /**
   * Genera la imagen para itunes y la devuelve
   *
   */
  public function executeItunes()
  {
    $pic = PicPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($pic);
    
    //return $this->renderText($pic->getFile());

    //var_dump("python /var/www2/pumukituvigo/batch/itunes/generate_pic/ponfaldoone.py ".$pic->getFile()." /tmp/last_img_itunes.jpg");exit;
    shell_exec("python /var/www2/pumukituvigo/batch/itunes/generate_pic/ponfaldoone.py ".$pic->getFile()." /tmp/last_img_itunes.jpg");
    
    
    header ("Content-Disposition: attachment; filename=itunes.jpg"); 
    //header('Content-type: application/octet-stream');
    readfile("/tmp/last_img_itunes.jpg");
    
    exit;
  }

  /**
   *
   *  AUX
   *
   */
  protected function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  protected function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }

  protected function inicialize($dir = false)
  {
    if ($this->hasRequestParameter('mm')){ 
      $this->object_id = $this->getRequestParameter('mm');      
      $this->url= 'pics/list?preview=true&mm='.$this->object_id;
      $this->upload = 'pic_mms';
      $this->que = 'mm';
      if($dir){
	$aux = MmPeer::retrieveByPk($this->object_id);
	$currentDir = 'Serial/' . $aux->getSerialId() . '/Video/' . $this->object_id;  
      }else{
	$currentDir = 'Video/' . $this->object_id;  
      }
    }elseif ($this->hasRequestParameter('serial')){
      $this->object_id = $this->getRequestParameter('serial');      
      $this->url= 'pics/list?preview=true&serial='.$this->object_id;
      $this->upload = 'pic_serials';
      $this->que = 'serial';
      $currentDir = 'Serial/' . $this->object_id;
    }elseif ($this->hasRequestParameter('channel')){ 
      $this->object_id = $this->getRequestParameter('channel');      
      $this->url= 'pics/list?channel='.$this->object_id;
      $this->upload = 'pic_channels';
      $this->que = 'channel';
      $currentDir = 'Channel/' . $this->object_id;  
    }else{
      $this->forward404();
    }
    
    return $currentDir;
  }

}
