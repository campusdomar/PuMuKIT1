<?php

/**
 * formats components.
 *
 * @package    fin
 * @subpackage formats
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class formatsComponents extends sfComponents
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
    $c->addAscendingOrderByColumn(FormatPeer::ID);


    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/format');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/format') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/format');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_format_all = FormatPeer::doCount(new Criteria());
    $this->total_format = FormatPeer::doCount($cTotal);
    $this->total = ceil($this->total_format / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->formats = FormatPeer::doSelect($c);
  }

}