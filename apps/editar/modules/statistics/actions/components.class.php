<?php
/**
 * MODULO STATISTICS COMPONENTS. 
 *
 * @package    pumukit
 * @subpackage statistics
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class statisticsComponents extends sfComponents
{
  /**
   * USO DE HARD DISK
   *
   */
  public function executeHd()
  {
    $hds_unix = sfConfig::get('app_transcoder_path_unix');
    $hds_win = sfConfig::get('app_transcoder_path_win');
    $hds = array();
    
    foreach($hds_unix as $h){
      $total = disk_total_space($h);
      $free = disk_free_space($h);
      $hds[] = array(
		     'unix' => $h,
		     'total' => $total,
		     'free' => $free,
		     'total_s' => $this->size2string($total),
		     'free_s' => $this->size2string($free),
		     '%' => ($free/$total),
		     );
    }
    
    $this->hds = $hds;
  }

  
  private function size2string($bytes)
  {
    $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
    for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
    return( round( $bytes, 2 ) . " " . $types[$i] );
  }

  /**
   * MAS VISTOS (Most  Viewed)
   *
   */
  public function executeMv()
  {
    
    $c = new Criteria();
    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    $c->addAscendingOrderByColumn(FilePeer::NUM_VIEW);
    $c->setLimit(6);
    $this->mms = MmPeer::doSelectWithI18n($c, 'es');
  }

  /**
   * LAST UPLOADED
   *
   */
  public function executeUpload()
  {
    $this->hds = array('UNO' => 0.5);
  }

  /**
   * ULTIMOS VISTOS
   *
   */
  public function executeView()
  {
    $this->hds = array('UNO' => 0.5);
  }

  /**
   * INFO
   *
   */
  public function executeInfo()
  {
    $this->hds = array('UNO' => 0.5);
  }

  /**
   * Pdf
   *
   */
  public function executePdf()
  {
    $this->hds = array('UNO' => 0.5);
  }


  /**
   * EXCEL
   *
   */
  public function executeExcel()
  {
    $this->hds = array('UNO' => 0.5);
  }
}
