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

    // Envía a la vista obj. timeframe y un código numérico 
    // para determinar el mensaje de intervalo pasado, activo o futuro
    $this->timeframe1 = null;
    $this->timeframe2 = null;
    $this->interval1cmp = null;
    $this->interval2cmp = null;

    $timeframes = $this->mm->getCategoryMmTimeframes();

    foreach ($timeframes as $tf){
      $cat_timeframe = $tf->getCategory();
      switch (($cat_timeframe->getCod())) {
        case CategoryMmTimeframePeer::EDITORIAL1:
          $this->timeframe1 = $tf;
          $this->interval1cmp = $tf->intervalCmp();
          break;

        case CategoryMmTimeframePeer::EDITORIAL2:
          $this->timeframe2 = $tf;
          $this->interval2cmp = $tf->intervalCmp();
          break;

        default:
          break;
      }
    }
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->grounds_sel = $this->mm->getGrounds();
    $cg = new Criteria();
    $cg->addAscendingOrderByColumn(GroundPeer::COD);
    $this->grounds = GroundPeer::doSelectWithI18n($cg, $this->getUser()->getCulture());
    
    $c = new Criteria();
    $c->add(GroundTypePeer::DISPLAY, true);
    $c->addDescendingOrderByColumn(GroundTypePeer::RANK);
    $this->groundtypes = GroundTypePeer::doSelectWithI18n($c, 'es'); 

    $c = new Criteria();
    $c->addAscendingOrderByColumn(RolePeer::RANK);
    $this->roles = RolePeer::doSelectWithI18n($c, $this->getUser()->getCulture()); //ORDER
  }

  public function executeList()
  {
    $limit  = 11;
    $offset = 0;
    $years = array();
    foreach ($this->getDates() as $date){
        $years[$date['date']] = $date['date'];
    }
    $this->years = $years;

    $array_genres = array();
    $genres = GenrePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
    foreach ($genres as $genre){
        $array_genres [$genre->getId()] = $genre->getName();
    }
    $this->genres = $array_genres;

    $c = new Criteria();
    $this->processFilters($c);
    $c->add(MmPeer::SERIAL_ID, $this->getUser()->getAttribute('serial'));
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    $cTotal = clone $c;
    $this->total_mm = MmPeer::doCount($cTotal);
    $this->total = ceil($this->total_mm / $limit); 

    if ($this->hasRequestParameter('page'))
    {
      if ( $this->getRequestParameter('page') == 'last') {
         $this->getUser()->setAttribute('page', $this->total, 'tv_admin/mm');
      } else {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/mm');
    }
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
    if(count($this->mms) > 0) {
    $f = create_function('$a', 'return $a[\'id\'];');
    if (!in_array($this->getUser()->getAttribute('id', 0, 'tv_admin/mm'), array_map($f, $this->mms))){
      $this->getUser()->setAttribute('id', $this->mms[0]['id'], 'tv_admin/mm');      
    }
    }
  }

  protected function processFilters(Criteria $c)
  {
    $c->setDistinct(true);
    if ($this->getRequest()->hasParameter('search')){
        if ($this->getRequestParameter('search')!='reset...'){
            $searchs = $this->getRequestParameter('searchs');
            
            $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/mm/searchs');
            $this->getUser()->getAttributeHolder()->add($searchs, 'tv_admin/mm/searchs');
        }
    }
    $searchs = $this->getUser()->getAttributeHolder()->getAll('tv_admin/mm/searchs');
    // Add lucene text search hits
    if (isset($searchs['search'])){
        $query = Sanitize::Text($searchs['search']);
        if ($query != '' && $query != null && $query != "\n"){   
            $hits = MmPeer::getLuceneIndex()->find($query);
            $pks  = array();
            foreach ($hits as $hit){
                $pks[] = $hit->pk;
            }   
            $c->add(MmPeer::ID, $pks, Criteria::IN);
        }
    }
    
    if (isset($searchs['search_id']) && $searchs['search_id']!= ''){
        $c->add(MmPeer::ID, $searchs['search_id']);
    }
    if (isset($searchs['type'])){
        if ($searchs['type'] == 'audio'){
            $c->add(MmPeer::AUDIO, 1);
            
        } else if ($searchs['type'] == 'video'){
            $c->add(MmPeer::AUDIO, 0);
        }
    }
    
    if (isset($searchs['duration'])){
        if (($searchs['duration'] = intval($searchs['duration'])) != 0){
            $duration_sec = 60 * abs($searchs['duration']);
            $c->add(MmPeer::DURATION, $duration_sec, ($searchs['duration'] < 0)?Criteria::LESS_EQUAL:Criteria::GREATER_EQUAL);
        }
    }
    
    if (isset($searchs['year'])){
        if (intval($searchs['year']) != 0){
            $first_day = $searchs['year'] . '-01-01';
            $last_day  = ($searchs['year'] + 1) . '-01-01'; // por defecto, h:m:s = 00:00:00
            $c1 = $c->getNewCriterion(MmPeer::RECORDDATE, $first_day, Criteria::GREATER_EQUAL);
            $c2 = $c->getNewCriterion(MmPeer::RECORDDATE, $last_day, Criteria::LESS_EQUAL);
            $c1->addAnd($c2);
            $c->add($c1);
        }
    }

    if (isset($searchs['genre']) && $searchs['genre']!='all'){
        $c->add(MmPeer::GENRE_ID, $searchs['genre']);
    }

    if (isset($searchs['check']) && $searchs['check']!='all'){
        $c->add(MmPeer::EDITORIAL3, ($searchs['check'] == 'si')?true:false);
    }

  }

  protected function getDates()
  {
      $conexion = Propel::getConnection();
      // $consulta = 'SELECT DISTINCT DATE_FORMAT(%s, "%%Y-%%m-01") AS date FROM %s ORDER BY %s DESC';
      $consulta = 'SELECT DISTINCT DATE_FORMAT(%s, "%%Y") AS date FROM %s ORDER BY %s DESC';
      $consulta = sprintf($consulta, MmPeer::RECORDDATE, MmPeer::TABLE_NAME, MmPeer::RECORDDATE);
      $sentencia = $conexion->prepareStatement($consulta);

      return $sentencia->executeQuery();
  }
}
