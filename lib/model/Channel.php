<?php

/**
 * Subclass for representing a row from the 'channel' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Channel extends BaseChannel
{

  /**
   *
   *
   *
   */
  public function countSerials($criteria = null, $distinct = false, $con = null)
  {
    include_once 'lib/model/om/SerialPeer.php';
    if ($criteria === null) {
      $criteria = new Criteria();
    }
    elseif ($criteria instanceof Criteria)
      {
	$criteria = clone $criteria;
      }

    $criteria->add(SerialPeer::SERIAL_TYPE_ID, $this->getId());

    return SerialPeer::doCount($criteria, $distinct, $con);
  }

}
