<?php

/**
 * Ticket (class)
 *
 * Clase que representa una ticket para asegurar
 * la difusion de los objetos multimedia
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Ticket extends BaseTicket
{

  /**
   * Inicializa el Ticket. 
   * FALTA ver TicketPeer::new_web
   *
   * @access public
   */
  public function init($file)
  {
    $this->setFileId($file->getId());
    $this->setDate('now');
    //CREAR ENLACE SIMBOLICO

    $ext = substr($file->getFile(), -3);
    do{
      $path_video_tmp = sfConfig::get('app_candado_path', '/home/samba').'/';
      $name_file = rand().'.'.$ext;
      $path_video_tmp .= $name_file;
    } while (file_exists($path_video_tmp));

    $bool = symlink($file->getFile(), $path_video_tmp);

    $this->setEnd((1 * 3600) + time()); //UNA HORA DE TICKET
    $this->setPath($path_video_tmp);
    $this->setUrl(sfConfig::get('app_candado_url', 'mms://ehuvs.ehu.es/Secure/') . $name_file);
    if ($bool) $this->save();
  }

}
