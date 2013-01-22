<?php 

abstract class BaseWorkflow
{
  protected $name;


  /**
   * Se invoca al selecionar el canal de publicacion
   */
  abstract public function select(Mm $mm);

  /**
   * Se invoca, tras selecionar el canal de publicacion, cuando se terminan 
   * de transcodificar a los perfiles necesarios.
   */
  abstract public function postselect(Mm $mm);

  /**
   * Se invoca al deselecionar el canal de publicacion
   */
  abstract public function deselect(Mm $mm);
  abstract public function getName();


  public function __install(){
    $aux = new PubChannel();
    $aux->setName($this->getName());
    $aux->setBroadcastYypeId(1);
    $aux->save();
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