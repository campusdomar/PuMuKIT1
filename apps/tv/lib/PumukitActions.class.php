<?php

class PumukitActions extends sfActions
{
  /**
  * Obtiene objetos multimedia a partir de una query que se pasa como parámetro
  * $maxPerPage int para número máximo de respuesta
  * $parent es posible que se devuelva sólo los hijos de una categoría determinada
  *
  **/
  protected function getMms(Criteria $c, $maxPerPage = null, $parent = null)
  {
    $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);

    $this->page = $this->getRequestParameter('page', 1);
    $unesco     = $this->getRequestParameter('unesco', 'all');
    $genre      = $this->getRequestParameter('genre', 'all');
    $only       = $this->getRequestParameter('only', 'all');
    $duration   = $this->getRequestParameter('duration', 'all');
    $year       = $this->getRequestParameter('year', 'all');
    $month      = $this->getRequestParameter('month', 'all');
    $day        = $this->getRequestParameter('day', 'all');
    $search     = $this->getRequestParameter('search', '');

    if($parent) {
        $c->addAnd(CategoryPeer::TREE_LEFT, $parent->getLeftValue(), Criteria::GREATER_THAN);
        $c->addAnd(CategoryPeer::TREE_RIGHT, $parent->getRightValue(), Criteria::LESS_THAN);
        $c->addAnd(CategoryPeer::SCOPE, $parent->getScopeIdValue(), Criteria::EQUAL);
      
    }

    $query = Sanitize::text($search);
    if ($query != '' && $query != null && $query != "\n"){
        $hits = MmPeer::getLuceneIndex()->find($query);
        $pks  = array();
        foreach ($hits as $hit){
            $pks[] = $hit->pk;
        }   
        $c->add(MmPeer::ID, $pks, Criteria::IN);
    }
    
    // Add select conditions to criteria
    if ($unesco != 'all' && $unesco != null && $unesco != ''){
        $c->addJoin(CategoryMmPeer::MM_ID, MmPeer::ID);
        $c->addJoin(MmPeer::ID, CategoryMmPeer::MM_ID);
        $c->add(CategoryMmPeer::CATEGORY_ID, $unesco);
    }
    
    if ($genre != 'all' && $genre != null && $genre != ''){
        $c->add(MmPeer::GENRE_ID, $genre);
    }
    
    if($only == 'audio') {
        $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
        $c->add(FilePeer::AUDIO, 1);
    }
    
    if($only == 'video') {
        $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
        $c->add(FilePeer::AUDIO, 0);
    }
    
    if (($duration = intval($duration)) != 0){
        $duration_sec = 60 * abs($duration);
        $c->add(MmPeer::DURATION, $duration_sec, ($duration < 0)?Criteria::LESS_EQUAL:Criteria::GREATER_EQUAL);
    }

    $year_present  = intval($year) != 0;
    $month_present = intval($month) != 0;
    $day_present   = intval($day) != 0;
    if ($year_present || $month_present || $day_present){
        $date_format_string    = ''; // http://dev.mysql.com/doc/refman/5.6/en/date-and-time-functions.html#function_date-format
        $date_requested_string = '';

        if ($year_present){
            $date_format_string    .= '%Y';
            $date_requested_string .= sprintf('%04d', $year);
        }
        if ($month_present){
            $date_format_string    .= '%m'; // two digit month.
            $date_requested_string .= sprintf('%02d', $month); // two digit month
        }
        if ($day_present){
            $date_format_string    .= '%d'; // two digit day
            $date_requested_string .= sprintf('%02d', $day);
        }

        $custom_criteria =' DATE_FORMAT(mm.RECORDDATE, "' . $date_format_string . '") = "' . $date_requested_string . '"';
        $c->add(MmPeer::RECORDDATE, $custom_criteria, Criteria::CUSTOM);
    }

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);

    $c->setDistinct(true);
    
    $cTotal = clone $c;
    
    $this->total_mm = MmPeer::doCount($cTotal, true);
    $this->total = ceil($this->total_mm / $maxPerPage);
    if ( $this->total < $this->page ) {
        $this->page = 1;
    }

    
    if ($maxPerPage) {
        $c->setLimit($maxPerPage);
        $offset = ($this->page - 1) * $maxPerPage;
        $c->setOffset($offset);
    } else {
        $c->setLimit(20);
        $c->setOffset(0);
    }
    
    return MmPeer::doSelectWithI18n($c);
  }

  /**
  * Agrupa los objetos multimedia en un array clave valor
  * la clave es su fecha de grabación y el valor el propio objeto multimedia
  * $mms conjunto de OOMM que se desea ordenar
  *
  **/
  protected function groupMms($mms)
  {
    $aux = array();
    foreach($mms as $mm){
        if (!array_key_exists($mm->getRecorddate('Y'), $aux)) {
            $aux[$mm->getRecorddate('Y')] = array();
        }
        $aux[$mm->getRecorddate('Y')][] = $mm;
    }
    
    return $aux;
  }

  /**
  * Genera la query por defecto para obtener entidades publicadas y publicas
  * 
  *
  **/
  protected function getCriteria()
  {
    $c = new Criteria();
    $c->setDistinct(true);
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c);

    return $c;
  }

  /**
  * Genera una array clave valor con años desde 1970 hasta la actualidad
  * 
  *
  **/
  protected function getYears()
  {
    $years = array();
    foreach ($this->getDates() as $date){
      $years[$date['date']] = $date['date'];
    }
    return $years;
  }

  /**
  * Genera una array clave valor de géneros
  * donde la clave es el identificador del género y el valor la entidad género
  *
  **/
  protected function getGenres()
  {
    $array_genres = array();
    $genres = GenrePeer::doSelectByAbcWithI18n($this->getUser()->getCulture());
    foreach ($genres as $genre){
      $array_genres [$genre->getId()] = $genre->getName();
    }
    return $array_genres;
  }

  /**
  * Genera una array clave valor de categorias UNESCO hijas de otra categoria UNESCO
  * donde la clave es el identificador de la categoria y el valor el nombre de la categoria
  *
  **/
  protected function getCategories($cat)
  {
    $array_unesco = array();
    foreach($cat->getChildren('doSelectWithI18n') as $cat_unesco){
      $array_unesco[$cat_unesco->getId()] = $cat_unesco->getName();
    }
    return $array_unesco;
  }

  /**
  * Obtiene una lista de fechas a partir de las
  * fechas de grabación en las cuales existe material audiovisual
  *
  **/
  protected function getDates()
  {
    $conexion = Propel::getConnection();
    $consulta = 'SELECT DISTINCT DATE_FORMAT(%s, "%%Y") AS date FROM %s ORDER BY %s DESC';
    $consulta = sprintf($consulta, MmPeer::RECORDDATE, MmPeer::TABLE_NAME, MmPeer::RECORDDATE);     

    $sentencia = $conexion->prepareStatement($consulta);
    
    return $sentencia->executeQuery();
  }

}
