<?php
/**
 * MODULO MATERIALS ACTIONS. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los materiales de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage materials
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class materialsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executeList()
  {
    if (isset($this->mm)){
      $this->materials = MaterialPeer::getMaterialsFromMm($this->mm, $this->getUser()->getCulture());
    }elseif ($this->hasRequestParameter('mm')){
      $this->mm = $this->getRequestParameter('mm');
      $this->materials = MaterialPeer::getMaterialsFromMm($this->getRequestParameter('mm'), $this->getUser()->getCulture());
    }else{
      $this->materials = array();
    }
  }
}
