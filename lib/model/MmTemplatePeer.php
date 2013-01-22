<?php

/**
 * Subclass for performing query and update operations on the 'mm_template' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MmTemplatePeer extends BaseMmTemplatePeer
{


  /**
   * Crea nueva estructura  Obeto multimedia inicializando valores
   *
   * Observaciones no se comprueba que serial_id exist
   * @access public
   * @return MmTemplate
   */
  static public function createNew($serial_id)
  {
    $mm = new MmTemplate();
    
    $mm->setSerialId($serial_id);
    $mm->setPrecinctId(PrecinctPeer::getDefaultSelId());
    $mm->setGenreId(GenrePeer::getDefaultSelId());
    $mm->setBroadcastId(BroadcastPeer::getDefaultSelId());
    
    $mm->setStatusId(0);
    $mm->setCopyright( sfConfig::get('app_info_copyright', 'Universidade de Vigo') );
    
    $mm->setRecorddate('now');
    $mm->setPublicdate('now');
    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm->setTitle('nuevo');
    }
    
    
    $mm->save();
    return $mm;
  }

  static public function get($serial_id)
  {
    $c = new Criteria();
    $c->add(MmTemplatePeer::SERIAL_ID, $serial_id);
    $mm_template = self::doSelectOne($c);

    //SI NO EXSITE CREO UNO NUEVO.    
    if(is_null($mm_template)){
      $mm_template = self::createNew($serial_id); //createNew
    }

    return $mm_template;
  }

}
