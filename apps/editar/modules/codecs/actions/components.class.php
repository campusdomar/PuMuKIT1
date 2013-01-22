<?php

/**
 * codecs components.
 *
 * @package    fin
 * @subpackage codecs
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class codecsComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executeList()
  {
    $limit  = 15;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(CodecPeer::ID);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/codec');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/codec') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/codec');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_codec_all = CodecPeer::doCount(new Criteria());
    $this->total_codec = CodecPeer::doCount($cTotal);
    $this->total = ceil($this->total_codec / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->codecs = CodecPeer::doSelect($c);
  }

}
