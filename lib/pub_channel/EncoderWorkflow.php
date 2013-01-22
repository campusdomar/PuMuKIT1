<?php

/**
 * EncoderWorkflow (class)
 *
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.workflow
 */ 
class EncoderWorkflow extends BaseLink
{
  /**
   * Cambia el estado de un objeto multimedia creado nuevos videos con los perfiles pertinentes
   *
   * Devuelbe error_id:
   *   0:  Todo correcto
   *   -1: No permisos
   *   -2: No master
   *   -3: No video pub
   *   -4: No itunes video
   *   -5: No itunes audio
   *   -6: No itunes catalogado
   */
  public static function changeStatus(Mm $mm, $status_id, $user_id = 0){

    /* Asegurarme que tiene master */
    if(is_null($mm->getMaster())){
      return -2;
    }
    
    /* Si estado en mayor que 1 tengo que comprobar el WMV */
    if(($status_id > 0)&&(count($mm->getFilesPublic()) == 0)){
      //Generar WMV (normal o 16-9).
      
      EncoderWorkflow::encodeWMV($mm, $user_id);
      return -3;
    }
    
    /* Si estado en mayor que (iTunes) compruebo que esiste podcast_video** */
    if(($status_id > 3)&&(count($mm->getFileByPerfil(array(20, 21))) == 0)){
      EncoderWorkflow::encodePodcastVideo($mm, $user_id);
      return -4;
    }

    /* Si estado en mayor que (iTunes) compruebo que esiste podcast_audio** */
    if(($status_id > 3)&&(count($mm->getFileByPerfil(array(22))) == 0)){
      EncoderWorkflow::encodePodcastAudio($mm, $user_id);
      return -5;
    }

    /* Si estado en mayor que (iTunes) compruebo que este catalogado** */
    if(($status_id > 3)&&(count($mm->getGrounds(3)) == 0)){
      return -6;
    }


    if ($user_id == 0){
      $mm->setStatusId($status_id);
      $mm->save();
      return 0;
    }

    return -1;
  }

  /**
   * Crea el archivo de video para el portal publico. WMV p WMV_16_9
   *
   */
  public static function encodeWMV(Mm $mm, $user_id = 0){
    return self::encode($mm, 1, 5, $user_id);
  }

  /**
   * Crea el archivo de video para el portal publico. WMV p WMV_16_9
   *
   */
  public static function encodePodcastVideo(Mm $mm, $user_id = 0){
    return self::encode($mm, 21, 20, $user_id);
  }

  /**
   * Crea el archivo de video para el portal publico. WMV p WMV_16_9
   *
   */
  public static function encodePodcastAudio(Mm $mm, $user_id = 0){
    //cojer podcast video de original
    return self::encode($mm, 22, 22, $user_id);
  }

  /**
   *
   */
  private static function encode(Mm $mm, $perfil_id, $perfil_id_16_9, $user_id = 0){

    $master = $mm->getMaster();
    
    if((is_null($master)) || ($master->getResolutionVer() == 0)) {
      //echo "MAL";
      return false;
    }
    
    $perfil_id = ($master->getAspect() > 1.5)?$perfil_id_16_9:$perfil_id;

    $master->retranscoding($perfil_id, 2, $user_id, false);
    
    return true;
  }


  

}