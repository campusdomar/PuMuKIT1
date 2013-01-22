<?php
/**
 * MODULO NAVIGATOR. 
 * Modulo de administracion de los ficheros publicos del portal. Con este modulo se puede administrar de forma remota, 
 * a traves del navegador WEB, los directorios y ficheros publicos como: ficheros adjuntos de los objetos multimedia, 
 * las capturas de los archivos de video y banners e imagenes para ilustrar tanto templates del portal como cabeceras de las series. 
 *
 * @package    pumukit
 * @subpackage navigator
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class navigatorActions extends sfActions
{
  protected
    $uploadDir     = '',
    $uploadDirName = '',
    $useThumbnails = false,
    $thumbnailsDir = '';

  public function preExecute()
  {
    if (sfConfig::get('app_sfMediaLibrary_use_thumbnails', true) && class_exists('sfThumbnail'))
    {
      $this->useThumbnails = true;
      $this->thumbnailsDir = sfConfig::get('app_sfMediaLibrary_thumbnails_dir', 'thumbnail');
    }

    $this->uploadDirName = sfConfig::get('app_sfMediaLibrary_upload_dir', sfConfig::get('sf_upload_dir_name').'');
    $this->uploadDir     = sfConfig::get('sf_web_dir').'/'.$this->uploadDirName;
  }

  /**
   * --  INDEX -- /editar.php/navigator
   * Muestra la lista de directorio y archivos de la ruta que se pasa por parametro.
   *
   * Accion por defecto en la aplicacion. Parametro por URL dir
   *
   */
  public function executeIndex()
  {
    sfConfig::set('template_menu','active');

    $currentDir = $this->dot2slash($this->getRequestParameter('dir'));
    $this->currentDir = $this->getRequestParameter('dir');
    $this->current_dir_slash = $currentDir.'/';
    $this->webAbsCurrentDir = $this->getRequest()->getRelativeUrlRoot().'/'.$this->uploadDirName.'/'.$currentDir;
    $this->absCurrentDir = $this->uploadDir.'/'.$currentDir;

    $this->forward404Unless(is_dir($this->absCurrentDir));

    // directories
    $dirsQuery = sfFinder::type('dir')->maxdepth(0)->prune('.*')->discard('.*')->relative();
    if ($this->useThumbnails)
    {
      $dirsQuery = $dirsQuery->discard($this->thumbnailsDir);
    }
    $dirs = $dirsQuery->in($this->absCurrentDir);
    sort($dirs);
    $this->dirs = $dirs;


    // files, with stats
    $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->discard('.*')->relative()->in($this->absCurrentDir);
    sort($files);
    $infos = array();
    foreach ($files as $file)
    {
      $ext = substr($file, strrpos($file, '.') - strlen($file) + 1);
      if (!$this->getRequestParameter('images_only') || $this->isImage($ext))
      {
        $infos[$file] = $this->getInfo($file);
      }
    }
    $this->files = $infos;

    // parent dir
    $tmp = explode(' ', $this->currentDir);
    array_pop($tmp);
    $this->parentDir = implode(' ', $tmp);
  }


  protected function isImage($ext)
  {
    return in_array(strtolower($ext), array('png', 'jpg', 'gif'));
  }

  public function executeChoice()
  {
    $this->executeIndex();
  }


  /**
   * --  RENAME -- /editar.php/index/rename
   * Renombra un fichero o directorio, si alguna ruta de la base de datos posee el nombre a renombrar,
   * esta tambien se actualiza.
   *
   * Parametros por POST current_path, name, new_name y type
   */
  public function executeRename()
  {
    $currentDir = $this->dot2slash($this->getRequestParameter('current_path'));
    $this->currentDir = $this->getRequestParameter('current_path');
    $type = $this->getRequestParameter('type');
    $this->count = $this->getRequestParameter('count');
    $this->webAbsCurrentDir = '/'.$this->uploadDirName.'/'.$currentDir;
    $absCurrentDir = $this->uploadDir.'/'.$currentDir;
    
    $this->forward404Unless(is_dir($absCurrentDir));

    $name = $this->getRequestParameter('name');
    $new_name = $this->getRequestParameter('new_name');
    if ($type === 'folder')
    {
      $new_name = $this->sanitizeDir($new_name);
      $this->forward404Unless(is_dir($absCurrentDir.'/'.$name));
    }
    else
    {
      $new_name = $this->sanitizeFile($new_name);
      $this->forward404Unless(is_file($absCurrentDir.'/'.$name));
    }

    @rename($absCurrentDir.'/'.$name, $absCurrentDir.'/'.$new_name);

    if(substr($currentDir, 0, 5) === '/pic/'){
      $c = new Criteria();
      $c->add(PicPeer::URL, '/uploads' . $currentDir . '/' . $name);
      $pics = PicPeer::doSelect($c); 
      foreach($pics as $pic){
	$pic->setUrl('/uploads' . $currentDir . '/' . $new_name);
	$pic->save();
      }
    }elseif(substr($currentDir, 0, 10) === '/material/'){
      $c = new Criteria();
      $c->add(MaterialPeer::URL, '/uploads' . $currentDir . '/' . $currentFile);
      $materials = MaterialPeer::doSelect($c); 
      foreach($materials as $material){
	$material->setUrl('/uploads' . $currentDir . '/' . $new_name);
	$material->save();
      }
    }

    if ($this->useThumbnails && ($type === 'file') && file_exists($absCurrentDir.'/'.$this->thumbnailsDir.'/'.$name))
    {
      @rename($absCurrentDir.'/'.$this->thumbnailsDir.'/'.$name, $absCurrentDir.'/'.$this->thumbnailsDir.'/'.$new_name);
    }

    $this->absCurrentDir = $absCurrentDir;
    $this->info = array();
    if (is_dir($absCurrentDir.'/'.$new_name) and ($type === 'folder'))
    {
      $this->name = $new_name;
    }
    else if (is_file($absCurrentDir.'/'.$new_name) and ($type === 'file'))
    {
      $this->name = $new_name;
      $this->info = $this->getInfo($new_name);
    }
    else
    {
      $this->name = $name;
      $this->info = $this->getInfo($name);
    }

    $this->type = $type;
  }

  protected function getInfo($filename)
  {
    $info = array();
    $info['ext']  = substr($filename, strrpos($filename, '.') - strlen($filename) + 1);
    $stats = stat($this->absCurrentDir.'/'.$filename);
    $info['size'] = $stats['size'];
    $info['thumbnail'] = true;
    if ($this->isImage($info['ext']))
    {
      if ($this->useThumbnails && is_readable(sfConfig::get('sf_web_dir').$this->webAbsCurrentDir.'/'.$this->thumbnailsDir.'/'.$filename))
      {
        $info['icon'] = $this->webAbsCurrentDir.'/'.$this->thumbnailsDir.'/'.$filename;
      }
      else
      {
        $info['icon'] = $this->webAbsCurrentDir.'/'.$filename;
        $info['thumbnail'] = false;
      }
    }
    else
    {
      if (is_readable(sfConfig::get('sf_web_dir').'/images/admin/navigator/'.$info['ext'].'.png'))
      {
        $info['icon'] = '/images/admin/navigator/'.$info['ext'].'.png';
      }
      else
      {
        $info['icon'] = '/images/admin/navigator/unknown.png';
      }
    }

    return $info;
  }


  /**
   * --  UPLOAD -- /editar.php/index/upload
   * Sube un archivo local a servidor, lo situa en la ruta indicada en el formulario
   *
   * Parametros por POST
   */
  public function executeUpload()
  {
    $currentDir = $this->dot2slash($this->getRequestParameter('current_dir'));
    $webAbsCurrentDir = '/'.$this->uploadDirName.'/'.$currentDir;
    $absCurrentDir = $this->uploadDir.'/'.$currentDir;

    $this->forward404Unless(is_dir($absCurrentDir));

    $filename = $this->sanitizeFile($this->getRequest()->getFileName('file'));
    $info['ext']  = substr($filename, strrpos($filename, '.') - strlen($filename) + 1);

    if ($this->isImage($info['ext']) && $this->useThumbnails)
    {
      if (!is_dir($absCurrentDir.'/'.$this->thumbnailsDir))
      {
        // If the thumbnails directory doesn't exist, create it now
        $old = umask(0000);
        @mkdir($absCurrentDir.'/'.$this->thumbnailsDir, 0777, true);
        umask($old);
      }
      $thumbnail = new sfThumbnail(64, 64);
      $thumbnail->loadFile($this->getRequest()->getFilePath('file'));
      $thumbnail->save($absCurrentDir.'/'.$this->thumbnailsDir.'/'.$filename);
    }
    $this->getRequest()->moveFile('file', $absCurrentDir.'/'.$filename);

    $this->redirect('navigator/index?dir='.$this->getRequestParameter('current_dir'));
  }



  /**
   * --  DELETE -- /editar.php/index/delete
   * Borra un fichero. Actualiza la base de datos si es necesario.
   *
   * Parametros por POST current_path y name
   */
  public function executeDelete()
  {
    $currentDir = $this->dot2slash($this->getRequestParameter('current_path'));
    $currentFile = $this->getRequestParameter('name');
    $absCurrentFile = $this->uploadDir.'/'.$currentDir.'/'.$currentFile;

    $this->forward404Unless(is_readable($absCurrentFile));

    if(substr($currentDir, 0, 5) === '/pic/'){
      $c = new Criteria();
      $c->add(PicPeer::URL, '/uploads' . $currentDir . '/' . $currentFile);
      PicPeer::doDelete($c); 
    }elseif(substr($currentDir, 0, 10) === '/material/'){
      $c = new Criteria();
      $c->add(MaterialPeer::URL, '/uploads' . $currentDir . '/' . $currentFile);
      MaterialPeer::doDelete($c);
    }

    unlink($absCurrentFile);

    if ($this->useThumbnails)
    {
      $absThumbnailFile = $this->uploadDir.'/'.$currentDir.'/'.$this->thumbnailsDir.'/'.$currentFile;
      if (is_readable($absThumbnailFile))
      {
        unlink($absThumbnailFile);
      }
    }

    $this->redirect('navigator/index?dir='.$this->getRequestParameter('current_path'));
  }


  /**
   * --  MKDIR -- /editar.php/index/mkdir
   * Crea una carpeta.
   *
   * Parametros por POST current_path y name
   */
  public function executeMkdir()
  {
    $currentDir = $this->dot2slash($this->getRequestParameter('current_dir'));
    $dirName = $this->sanitizeDir($this->getRequestParameter('name'));
    $absCurrentDir = $this->uploadDir.'/'.(empty($currentDir) ? '' : $currentDir.'/').$dirName;

    $old = umask(0000);
    @mkdir($absCurrentDir, 0777);
    if ($this->useThumbnails)
    {
      @mkdir($absCurrentDir.'/'.$this->thumbnailsDir, 0777);
    }
    umask($old);

    $this->redirect('navigator/index?dir='.$this->getRequestParameter('current_dir'));
  }



  /**
   * --  RMDIR -- /editar.php/index/rmdir
   * Borra un directorio vacio
   *
   * Parametros por POST current_path y name
   */
  public function executeRmdir()
  {
    $currentDir = $this->dot2slash('.'.$this->getRequestParameter('current_path'));
    $absCurrentDir = $this->uploadDir.'/'.$currentDir.'/'.$this->getRequestParameter('name');

    $this->forward404Unless(is_dir($absCurrentDir));

    if($this->useThumbnails && is_readable($absCurrentDir.'/'.$this->thumbnailsDir))
    {
      rmdir($absCurrentDir.'/'.$this->thumbnailsDir);
    }

    rmdir($absCurrentDir);

    $this->redirect('navigator/index?dir='.$this->getRequestParameter('current_path'));
  }


  /**
   * --  LIST -- /editar.php/index/list
   * Lista de forma asincrona el contenido de un directorio del servidor. El resultado es un vector codificador en JSON que procesa el cliente.
   *
   * Funcion asincrona, Parametros por POST current_path y name
   */
  public function executeList()
  {
    $dir = urldecode($this->getRequestParameter('dir'));

    $dir = str_replace(sfConfig::get('app_videoserv_url'), sfConfig::get('app_videoserv_mount'), $dir, $count0); 
    $dir = str_replace(sfConfig::get('app_transcoder_path_win'), sfConfig::get('app_transcoder_path_unix'), $dir, $count1);

    $dirs = sfFinder::type('dir')->maxdepth(0)->prune('.*')->discard('.*')->relative()->in($dir);
    rsort($dirs);
    $files = sfFinder::type('file')->maxdepth(0)->prune('.*')->discard('.*')->relative()->in($dir);

    $sal = array('dirs' => $dirs, 'files' => $files);    
    //$sal = sfFinder::type('any')->in($dir);
    
    return $this->renderText(json_encode($sal));
  }

  protected function dot2slash($txt)
  {
    return preg_replace('#[\+\s]+#', '/', $txt);
  }

  protected function slash2dot($txt)
  {
    return preg_replace('#/+#', '+', $txt);
  }

  protected function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  protected function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}
