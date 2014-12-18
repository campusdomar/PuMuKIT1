<?php
/**
 * MODULO MMS COMPONENTS. 
 * Modulo de administracion de los objetos multimedia. Permite administrar
 * los objetos multimedia de una serie. Su formulario de edicion se divide en 
 * cuatro pestanas:
 *   -Metadatos
 *   -Areas de conocimiento
 *   -Personas
 *   -Multimedia 
 *
 * @package    pumukit
 * @subpackage mms
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class mmsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */

  public function executePreview()
  {
    $this->roles = RolePeer::doSelectWithI18n(new Criteria());
    if ($this->getUser()->getAttribute('id', 0, 'tv_admin/mm') != 0){
      $this->mm = MmPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/mm'));
    }else{
      $c = new Criteria;
      $c->add(MmPeer::SERIAL_ID, $this->getUser()->getAttribute('serial'));
      $c->addAscendingOrderByColumn(MmPeer::RANK);
      $this->mm = MmPeer::doSelectOne($c);
    }
  }

  public function executeEdit()
  {
    if ($this->getUser()->getAttribute('id', 0, 'tv_admin/mm') != 0){
      $this->mm = MmPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/mm'));
    }else{
      $c = new Criteria;
      $c->add(MmPeer::SERIAL_ID, $this->getUser()->getAttribute('serial'));
      $c->addAscendingOrderByColumn(MmPeer::RANK);
      $this->mm = MmPeer::doSelectOne($c);
    }
    
    if (!isset($this->mm)) return;

    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->grounds_sel = $this->mm->getGrounds();
    $cg = new Criteria();
    $cg->addAscendingOrderByColumn(GroundI18nPeer::NAME);
    $this->grounds = GroundPeer::doSelectWithI18n($cg, $this->getUser()->getCulture());
    
    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $c = new Criteria();
    $c->addAscendingOrderByColumn(RolePeer::RANK);
    $this->roles = RolePeer::doSelectWithI18n($c, $this->getUser()->getCulture()); //ORDER
  }

  public function executeList()
  {
    $limit  = 11;
    $offset = 0;

    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $this->getUser()->getAttribute('serial'));
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/mm');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/mm') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/mm');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_mm = MmPeer::doCount($cTotal);
    $this->total = ceil($this->total_mm / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    //$this->mms = MmPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->mms = MmPeer::doList($c, $this->getUser()->getCulture());
    
    //Marco el primero si no esta seleccionado ningun video de la serie.
    $f = create_function('$a', 'return $a[\'id\'];');
    if (!in_array($this->getUser()->getAttribute('id', 0, 'tv_admin/mm'), array_map($f, $this->mms))){
      $this->getUser()->setAttribute('id', $this->mms[0]['id'], 'tv_admin/mm');      
    }
  }
}
