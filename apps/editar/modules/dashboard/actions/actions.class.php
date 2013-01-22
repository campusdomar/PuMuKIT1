<?php

/**
 * dashboard actions.
 *
 * @package    pumukituvigo
 * @subpackage dashboard
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class dashboardActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    sfConfig::set('dashboard_menu','active');

    $this->blocks = array('total', 'diskfree', 'transcoderinfo', 'lastserial', 'lastserialpublic', 'minibuscador');
  }

  public function executeTotal()
  {
    $this->ini = $this->getRequestParameter("ini");
    $this->end = $this->getRequestParameter("end");
    return $this->renderComponent("dashboard", "totalinfo");
  }

  public function executeBuscar()
  {
    $this->name = $this->getRequestParameter('text');
    
    $c = new Criteria();
    $c->addDescendingOrderByColumn(SerialPeer::PUBLICDATE);
    $c->setLimit(4);
    if($this->getRequestParameter('all')){
      SerialPeer::addSeachCriteria($c, $this->name, 'es');
    }else{
      $c->add(SerialI18nPeer::TITLE, '%'.$this->name.'%', Criteria::LIKE);
    }
    $this->serials = SerialPeer::doSelectWithI18n($c, 'es');    
  }


  public function executeInfopdf()
  {
    $meses = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
    $anos = array(2006, 2007, 2008, 2009);

    $statuss = array('privado', 'oculto', 'mediateca', 'arca', 'total'); //Docencia y total
    $genres = GenrePeer::doSelect(new Criteria());

    $num_hours = array();
    $num_mms = array();

    foreach($anos as $a){
      foreach($meses as $m){
	foreach($genres as $g){

	  $c = new Criteria();
	  $c->add(MmPeer::GENRE_ID, $g->getId());
	  $c->add(MmPeer::PUBLICDATE, "$a-$m-01", Criteria::GREATER_THAN);
	  $c->addAnd(MmPeer::PUBLICDATE, "$a-$m-". $this->get_days_in_month($m, $a), Criteria::LESS_THAN);
	  $num_mms[$a][$m][$g->getId()] = MmPeer::doCount($c);

	  $conexion = Propel::getConnection();
	  $consulta = 'SELECT SUM(%s) AS total FROM %s, %s WHERE %s = %s';
	  $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID);

	  $consulta .= ' AND %s = %s';
	  $consulta = sprintf($consulta, MmPeer::GENRE_ID, $g->getId());
	  $consulta .= ' AND %s >= "%s" AND %s <= "%s"';
	  $consulta = sprintf($consulta, MmPeer::PUBLICDATE, "$a-$m-01", MmPeer::PUBLICDATE, "$a-$m-". $this->get_days_in_month($m, $a));
	  
	  $sentencia = $conexion->prepareStatement($consulta);
	  $resultset = $sentencia->executeQuery();
	  $resultset->next();
	  $num_hours[$a][$m][$g->getId()] = sprintf("%.2f", $resultset->getInt('total')/3600);

	  //N. HORAS
	  //?
	}
      }
    }
    
    $this->num_hours_D = $num_hours;
    $this->num_mms_D = $num_mms;
    $num_hours = array();
    $num_mms = array();


    foreach($anos as $a){
      foreach($genres as $g){
        $c = new Criteria();
	$c->add(MmPeer::GENRE_ID, $g->getId());
	
	$c->add(MmPeer::PUBLICDATE, "$a-01-01", Criteria::GREATER_THAN);
	$c->addAnd(MmPeer::PUBLICDATE, "$a-12-31", Criteria::LESS_THAN);
	$num_mms[$a][$g->getId()] = MmPeer::doCount($c);

	$conexion = Propel::getConnection();
	$consulta = 'SELECT SUM(%s) AS total FROM %s, %s WHERE %s = %s';
	$consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID);

	$consulta .= ' AND %s = %s';
	$consulta = sprintf($consulta, MmPeer::GENRE_ID, $g->getId());
       
	$consulta .= ' AND %s >= "%s" AND %s <= "%s"';
	$consulta = sprintf($consulta, MmPeer::PUBLICDATE, "$a-01-01", MmPeer::PUBLICDATE, "$a-12-31");
	  
	$sentencia = $conexion->prepareStatement($consulta);
	$resultset = $sentencia->executeQuery();
	$resultset->next();
	$num_hours[$a][$g->getId()] = sprintf("%.2f", $resultset->getInt('total')/3600);

      }
    }
    
    $this->num_hours_C = $num_hours;
    $this->num_mms_C = $num_mms;
    $num_hours = array();
    $num_mms = array();


    foreach($anos as $a){
      foreach($meses as $m){
	foreach($statuss as $sid => $s){
	  //N. SERIES
	  //$c = new Criteria();
	  //$c->add(MmPeer:STATUS_ID, $sid);
	  //$num_serials[$a][$m][$s] = SerialPeer::doCount($c);
	  //N. MM


	  $c = new Criteria();
	  if($s !== "total"){
	    $c->add(MmPeer::STATUS_ID, $sid);
	  }
	  $c->add(MmPeer::PUBLICDATE, "$a-$m-01", Criteria::GREATER_THAN);
	  $c->addAnd(MmPeer::PUBLICDATE, "$a-$m-". $this->get_days_in_month($m, $a), Criteria::LESS_THAN);
	  //var_dump($a);
	  //var_dump($m);
	  //var_dump($sid);
	  $num_mms[$a][$m][$sid] = MmPeer::doCount($c);

	  $conexion = Propel::getConnection();
	  $consulta = 'SELECT SUM(%s) AS total FROM %s, %s WHERE %s = %s';
	  $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID);

	  if($s !== "total"){
	    $consulta .= ' AND %s = %s';
	    $consulta = sprintf($consulta, MmPeer::STATUS_ID, $sid);
	  }
	  $consulta .= ' AND %s >= "%s" AND %s <= "%s"';
	  $consulta = sprintf($consulta, MmPeer::PUBLICDATE, "$a-$m-01", MmPeer::PUBLICDATE, "$a-$m-". $this->get_days_in_month($m, $a));
	  
	  $sentencia = $conexion->prepareStatement($consulta);
	  $resultset = $sentencia->executeQuery();
	  $resultset->next();
	  $num_hours[$a][$m][$sid] = sprintf("%.2f", $resultset->getInt('total')/3600);

	  //N. HORAS
	  //?
	}
      }
    }
    
    $this->num_hours_B = $num_hours;
    $this->num_mms_B = $num_mms;
    $num_hours = array();
    $num_mms = array();


    foreach($anos as $a){
      foreach($statuss as $sid => $s){
        $c = new Criteria();
	if($s !== "total"){
	  $c->add(MmPeer::STATUS_ID, $sid);
	}
	$c->add(MmPeer::PUBLICDATE, "$a-01-01", Criteria::GREATER_THAN);
	$c->addAnd(MmPeer::PUBLICDATE, "$a-12-31", Criteria::LESS_THAN);
	$num_mms[$a][$sid] = MmPeer::doCount($c);

	$conexion = Propel::getConnection();
	$consulta = 'SELECT SUM(%s) AS total FROM %s, %s WHERE %s = %s';
	$consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID);

	if($s !== "total"){
	  $consulta .= ' AND %s = %s';
	  $consulta = sprintf($consulta, MmPeer::STATUS_ID, $sid);
	}
	$consulta .= ' AND %s >= "%s" AND %s <= "%s"';
	$consulta = sprintf($consulta, MmPeer::PUBLICDATE, "$a-01-01", MmPeer::PUBLICDATE, "$a-12-31");
	  
	$sentencia = $conexion->prepareStatement($consulta);
	$resultset = $sentencia->executeQuery();
	$resultset->next();
	$num_hours[$a][$sid] = sprintf("%.2f", $resultset->getInt('total')/3600);

      }
    }
    

    $this->num_hours_A = $num_hours;
    $this->num_mms_A = $num_mms;
    $num_hours = array();
    $num_mms = array();

    $this->meses = $meses;
    $this->anos = $anos;
    $this->genres = $genres;
    $this->statuss = $statuss;

    //$this->setLayout(false);
    //$this->getResponse()->setHttpHeader('Content-Type', 'text/plain; charset=utf-8');

    
      
  }


  private function get_days_in_month($month, $year)
  {
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
  }



  public function executeSerial()
  {
    $serials = SerialPeer::doSelectWithI18n(new Criteria());
    header("Content-Type: application/xml");
?><data wiki-url="<?php echo sfConfig::get('app_info_link') ?>" wiki-section="<?php echo sfConfig::get('app_info_copyright') ?>">
  <?php foreach($serials as $serial):?>
    <event
        start="<?php echo $serial->getPublicdate('M j Y 00:00:00 \G\M\T')?>"
        title="<?php echo str_replace(array('"', "&"), array("'", "&amp;"), $serial->getTitle()) ?>"
        link="/editar.php/mms/index/serial/<?php echo $serial->getId() ?>"
        >
        <?php echo str_replace('&', '&amp;', $serial->getTitle()) ?>
    </event>
  <?php endforeach; ?>
</data>


<?php    
    return sfView::NONE;    
  }
}
