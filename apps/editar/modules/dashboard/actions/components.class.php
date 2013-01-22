<?php

/**
 * Dashboard components.
 *
 * @package    fin
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardComponents extends sfComponents
{
  /**
   *
   *
   */
  public function executeDiskfree()
  {
    
    $disks = StreamserverPeer::doSelect(new Criteria());
    $return = array();
    foreach($disks as $disk){
      if(file_exists($disk->getDirOut())){
        $a = array($disk->getName(), 
		 sprintf('%.2f', (disk_total_space($disk->getDirOut())/1073741824)), 
		 sprintf('%.2f', (disk_free_space($disk->getDirOut())/1073741824))
		 );
        $return[] = $a;
      }
    }
    $this->disks = $return;
  }


  /**
   *
   *
   */
  public function executeTranscoderinfo()
  {
    $c = new Criteria();
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_ERROR);
    $this->t_error = TranscodingPeer::doCount($c);

    $c = new Criteria();
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_PAUSADO);
    $this->t_pausado = TranscodingPeer::doCount($c);

    $c = new Criteria();
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_EJECUTANDOSE);
    $this->t_ejec = TranscodingPeer::doCount($c);

    $c = new Criteria();
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_FINALIZADO);
    $this->t_fin = TranscodingPeer::doCount($c);

    $c = new Criteria();
    $c->add(TranscodingPeer::STATUS_ID, TranscodingPeer::STATUS_ESPERANDO);
    $this->t_stop = TranscodingPeer::doCount($c);
    
    $this->cpus = CpuPeer::doSelect(new Criteria());
  }


  /**
   *
   *
   */
  public function executeTotal()
  {
    $this->time_ini = intval((strtotime('01/01/2004')) / 86400);
    $this->time_end = intval((strtotime("+1 month")) / 86400);
  }


  /**
   *
   *
   */
  public function executeTotalinfo()
  {
    
    $dates = array("end" => ($this->end * 86400), "ini" => ($this->ini * 86400));

    $this->horas = FilePeer::doCountDurationPublic($dates);


    $c = new Criteria();
    $c->add(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
    $c->addAnd(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    $this->num_series = SerialPeer::doCount($c);



    
    $c = new Criteria();
    $c->add(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
    $c->addAnd(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    $this->num_series_total = SerialPeer::doCount($c);



    
    $c = new Criteria();
    $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
    $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);

    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);

    $this->num_videos = MmPeer::doCount($c);



    $c = new Criteria();
    $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
    $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    $this->num_videos_total = MmPeer::doCount($c);

  }

  /**
   *
   *
   */
  public function executeLastserial()
  {
    $c = new Criteria();
    $c->setLimit(7);
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');
  }


  /**
   *
   *
   */
  public function executeLastserialpublic()
  {
    $c = new Criteria();
    $c->setLimit(7);
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    SerialPeer::addPublicCriteria($c);
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');
  }

  /**
   *
   *
   *
   */
  public function executeMinibuscador()
  {
    
  }
  
}
