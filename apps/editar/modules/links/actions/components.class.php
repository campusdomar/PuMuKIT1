<?php
/**
 * MODULO LINKS COMPONENTES. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los enlaces de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage links
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class linksComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executeList()
  {
    if (isset($this->mm)){
      $this->links = LinkPeer::getLinksFromMm($this->mm, $this->getUser()->getCulture());
    }elseif ($this->hasRequestParameter('mm')){
      $this->mm = $this->getRequestParameter('mm');
      $this->links = LinkPeer::getLinksFromMm($this->getRequestParameter('mm'), $this->getUser()->getCulture());
    }else{
      $this->links = array();
    }
  }

}
