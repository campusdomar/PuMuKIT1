<?php

/**
 * Subclass for performing query and update operations on the 'pub_channel_mm' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PubChannelMmPeer extends BasePubChannelMmPeer
{
  /**
   * Valores de pub_channel_mm.status_id:
   */
  const STATUS_UNPUBLISHED = 0;  
  const STATUS_READY       = 1;
  const STATUS_TRANSCODING = 2;
  const STATUS_WAITING     = 3;
  /*
    0   Equivale a "despublicado"; como si no existiese.
    1   Disponible Y preparado.
    2   (Se  estan codificando los archivos necesarios)
    3   (Esperando master para codificar los archivos necesarios)
  */
}
