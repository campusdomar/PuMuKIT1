<?php

/**
 * TicketPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'ticket'
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class TicketPeer extends BaseTicketPeer
{


  public static function new_web($file)
  {
    $ticket = new Ticket();
    $ticket->setFileId($file->getId());
    $ticket->setDate('now');
    //CREAR ENLACE SIMBOLICO

    $ext = substr($file->getFile(), -3);

    $path_video_tmp = sfConfig::get('app_ticket_path');
    $name_file = preg_replace('/[^a-z0-9_\.-]/i', '_', $file->getMm()->getTitle()) .'.'.$ext;
    $path_video_tmp .= $name_file;
    while (file_exists($path_video_tmp)){
      $path_video_tmp = sfConfig::get('app_ticket_path');
      $name_file = rand().'.'.$ext;
      $path_video_tmp .= $name_file;
    } 
    
    $bool = symlink($file->getFile(), $path_video_tmp);

    $ticket->setEnd((1 * 3600) + time()); //UNA HORA DE TICKET
    $ticket->setPath($path_video_tmp);
    $ticket->setUrl(sfConfig::get('app_ticket_url', '../') . $name_file);
    if ($bool) $ticket->save();
    return $ticket;
  }

  /**
   * Sobrecarga la funcion doDelete para borrar, si existe,
   * el archivo alojado en el servidor.
   *
   */
  public static function doDelete($values, $con = null)
  {
    if (($values instanceof Ticket)&&(file_exists($values->getPath()))){
      unlink($values->getPath());
    }
    parent::doDelete($values, $con);
  }

}
