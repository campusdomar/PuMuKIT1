<?php
/**
 * MODULO FILES COMPONENTS. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los archivos multimedia de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage files
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class filesComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executeList()
  {
    if (isset($this->mm)){
      $this->files = FilePeer::getFilesFromMm($this->mm, $this->getUser()->getCulture());
      $this->transcodings = TranscodingPeer::getTranscodingsFromMm($this->mm, false);
      $this->oc = MmMatterhornPeer::retrieveByPK($this->mm);
    }elseif ($this->hasRequestParameter('mm')){
      $this->mm = $this->getRequestParameter('mm');
      $this->files = FilePeer::getFilesFromMm($this->getRequestParameter('mm'), $this->getUser()->getCulture());
      $this->transcodings = TranscodingPeer::getTranscodingsFromMm($this->getRequestParameter('mm'), false);
      $this->oc = MmMatterhornPeer::retrieveByPK($this->mm);
    }else{
      $this->files = array();
      $this->transcodings = array();
      $this->oc = null;
    }
  }

}
