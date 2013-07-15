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
class virtualserialComponents extends sfComponents
{
  public function executePreview()
  {
    $this->roles = RolePeer::doSelectWithI18n(new Criteria());

    $this->cat_raiz_unesco = DataBaseProxy::getUnesco();

    if ($this->getUser()->hasAttribute('id', 'tv_admin/virtualserial')){
      $this->mm = MmPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/virtualserial'));
      $this->file = ($this->mm)? $this->mm->getFirstFile() : null;
    }else{
      $this->mm   = null;
      $this->file = null;
    }
  }

  public function executePreviewMms2()
  {
    $this->roles = RolePeer::doSelectWithI18n(new Criteria());

    $this->cat_raiz_unesco = DataBaseProxy::getUnesco();

    if ($this->getUser()->hasAttribute('id', 'tv_admin/virtualserial')){
      $this->mm = MmPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/virtualserial'));
      $this->file = FilePeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/virtualserial'));
    }else{
      $c = new Criteria;
      $c->addJoin(MmPeer::ID, CategoryMmPeer::MM_ID);
      $c->add(CategoryMmPeer::CATEGORY_ID, 11);
      $c->addAscendingOrderByColumn(MmPeer::RANK);
      $this->mm = MmPeer::doSelectOne($c);
      $this->file = FilePeer::retrieveByPk($this->mm->getFilesPublic());
    }
  }

  public function executeEdit()
  {
    if ($this->getUser()->hasAttribute('id', 'tv_admin/virtualserial')){
      $this->mm = MmPeer::retrieveByPk($this->getUser()->getAttribute('id', null, 'tv_admin/virtualserial'));
    }else{
      $c = new Criteria;
      $c->addJoin(MmPeer::ID, CategoryMmPeer::MM_ID);
      $c->add(CategoryMmPeer::CATEGORY_ID, 11);
      $c->addAscendingOrderByColumn(MmPeer::RANK);
      $this->mm = MmPeer::doSelectOne($c);
    }
    $this->module = 'virtualserial';
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

  public function executeTree()
  {
      $this->mm_id_of_cat = array();

      $this->salud = array();//Ciencias de la vida y la salud
      $this->salud[] = CategoryPeer::retrieveByCode("U310000");
      $this->salud[] = CategoryPeer::retrieveByCode("U320000");
      $this->salud[] = CategoryPeer::retrieveByCode("U610000");
      $this->salud[] = CategoryPeer::retrieveByCode("U240000");
      $this->salud[] = CategoryPeer::retrieveByCode("U510000");
      $this->tecnologias = array();
      $this->tecnologias[] = CategoryPeer::retrieveByCode("U330000");
      $this->ciencias = array();
      $this->ciencias[] = CategoryPeer::retrieveByCode("U210000");
      $this->ciencias[] = CategoryPeer::retrieveByCode("U220000");
      $this->ciencias[] = CategoryPeer::retrieveByCode("U120000");
      $this->ciencias[] = CategoryPeer::retrieveByCode("U230000");
      $this->ciencias[] = CategoryPeer::retrieveByCode("U250000");
      $this->juridicas = array();
      $this->juridicas[] = CategoryPeer::retrieveByCode("U520000");
      $this->juridicas[] = CategoryPeer::retrieveByCode("U530000");
      $this->juridicas[] = CategoryPeer::retrieveByCode("U540000");
      $this->juridicas[] = CategoryPeer::retrieveByCode("U560000");
      $this->juridicas[] = CategoryPeer::retrieveByCode("U590000");
      $this->juridicas[] = CategoryPeer::retrieveByCode("U630000");
      $this->humanidades = array();
      $this->humanidades[] = CategoryPeer::retrieveByCode("U110000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U580000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U550000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U570000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U620000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U710000");
      $this->humanidades[] = CategoryPeer::retrieveByCode("U720000");
      // $this->institucional = CategoryPeer::retrieveByCode("U990100");;//UNESCO para contenidos propios
      // $this->cultural = CategoryPeer::retrieveByCode("U990200");;//UNESCO para contenidos propios


      //TODO MmPeer::... and CategoryPeer::...
      $this->num_all = MmPeer::doCount(new Criteria());

      $this->cat_raiz_unesco = DataBaseProxy::getUnesco(); //Necesaria para DnD
      $this->num_none = CategoryPeer::countMmWithoutCategory($this->cat_raiz_unesco);

      $this->cat_id = $this->getUser()->getAttribute('cat_id', null, 'tv_admin/virtualserial');
  }


  public function executeList()
  {
    $limit  = 11;
    $offset = 0;

    $c = new Criteria();
    $this->processSort($c);

    $this->error = '';
    $this->roles = RolePeer::doSelect(new Criteria());
    try{
      $this->processFilters($c, $this->roles);
    }catch(Exception $e){
      $hits = array();
      $this->error = $e->getMessage();
    }

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

    $cTotal = clone $c;

    if ($this->getUser()->hasAttribute('page', 'tv_admin/virtualserial') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/virtualserial');
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

    if(count($this->mms) > 0) {
        //Marco el primero si no esta seleccionado ningun video de la serie.
        $f = create_function('$a', 'return $a[\'id\'];');
        if (!in_array($this->getUser()->getAttribute('id', 0, 'tv_admin/virtualserial'), array_map($f, $this->mms))){
            $this->getUser()->setAttribute('id', $this->mms[0]['id'], 'tv_admin/virtualserial');      
            $this->reloadEditAndPreview = true;
        }
    }
  }

  protected function processSort(Criteria $c)
  {
    if ($this->getRequestParameter('sort')){
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'tv_admin/virtualserial');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'tv_admin/virtualserial');
    }


    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'tv_admin/virtualserial')){
      try{
          $sort_column = MmPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      }catch(Exception $e){
          try{
              $sort_column = MmI18nPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
          }catch(Exception $e){
          }
      }
      if ($this->getUser()->getAttribute('type', 'asc', 'tv_admin/virtualserial') == 'asc'){
          $c->addAscendingOrderByColumn($sort_column);
      }else{
          $c->addDescendingOrderByColumn($sort_column);
      }
      $c->addDescendingOrderByColumn(MmPeer::ID);
    }
  }

  protected function processFilters(Criteria $c, $roles)
  {
    $c->setDistinct(true);

    $id = $this->getUser()->getAttribute('cat_id', 0, 'tv_admin/virtualserial');
    if ($id == -1) {
      //TODO review
      $unesco = CategoryPeer::retrieveByCode("UNESCO");
      $query = "mm.id not in (select distinct mm.id from mm left join category_mm on mm.id = category_mm.mm_id where category_mm.category_id in " .
	"(select category.id from category where  category.tree_left > " . $unesco->getTreeLeft() . " and category.tree_right < " . $unesco->getTreeRight() . ")) ";
      $c->add(MmPeer::ID, $query, Criteria::CUSTOM);
    } elseif ($id != 0 ){
      $c->addJoin(MmPeer::ID, CategoryMmPeer::MM_ID);
      $c->add(CategoryMmPeer::CATEGORY_ID, $id);
    }

    if ($this->getRequest()->hasParameter('search')){
        if ($this->getRequestParameter('search')!='reset...'){
            $searchs = $this->getRequestParameter('searchs');
            
            $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/virtualserial/searchs');
            $this->getUser()->getAttributeHolder()->add($searchs, 'tv_admin/virtualserial/searchs');
        }
    }
    $searchs = $this->getUser()->getAttributeHolder()->getAll('tv_admin/virtualserial/searchs');
    // Add lucene text search hits
    if (isset($searchs['search'])){
        $query = Sanitize::text($searchs['search']);
        if ($query != '' && $query != null && $query != "\n"){
            $hits = MmPeer::getLuceneIndex()->find($query);
            $pks  = array();
            foreach ($hits as $hit){
                $pks[] = $hit->pk;
            }   
            $c->addAnd(MmPeer::ID, $pks, Criteria::IN);
        }
    }
    
    if (isset($searchs['search_id']) && $searchs['search_id']!= ''){
        $c->add(MmPeer::ID, $searchs['search_id']);
    }

    if (isset($searchs['serial']) && $searchs['serial']!= ''){
        $c->add(MmPeer::SERIAL_ID, $searchs['serial']);
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

    if (isset($searchs['title']) && $searchs['title']!=''){
       $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
       $c->add(MmI18nPeer::TITLE, '%' . $searchs['title'] . '%', Criteria::LIKE);
    }

    if (isset($searchs['subtitle']) && $searchs['subtitle']!=''){
       $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
       $c->add(MmI18nPeer::SUBTITLE, '%' . $searchs['subtitle'] . '%', Criteria::LIKE);
    }

    if (isset($searchs['keyword']) && $searchs['keyword']!=''){
       $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
       $c->add(MmI18nPeer::KEYWORD, '%' . $searchs['keyword'] . '%', Criteria::LIKE);
    }

    if ( isset($searchs['publicdateAdvancedStart']) && $searchs['publicdateAdvancedStart'] != '' ){
       $timestampStart = sfI18N::getTimestampForCulture($searchs['publicdateAdvancedStart'], $this->getUser()->getCulture());	
       $fechaInicio = date('Y-m-d', $timestampStart);
       $cpublic = $c->getNewCriterion(MmPeer::PUBLICDATE, $fechaInicio, Criteria::GREATER_EQUAL);
    }
    if ( isset($searchs['publicdateAdvancedFinish']) != '' && $searchs['publicdateAdvancedFinish'] != ''){
       $timestampFinish = sfI18N::getTimestampForCulture($searchs['publicdateAdvancedFinish'], $this->getUser()->getCulture());	
       $fechaFin = date('Y-m-d', $timestampFinish);
       if ( isset($cpublic) ) {
            $c2 = $c->getNewCriterion(MmPeer::PUBLICDATE, $fechaFin, Criteria::LESS_EQUAL);
            $cpublic->addAnd($c2);
        } else {
            $cpublic = $c->getNewCriterion(MmPeer::PUBLICDATE, $fechaFin, Criteria::LESS_EQUAL);
        }
    }
    if ( isset($cpublic) ) {
      $c->add($cpublic);
    }
    if ( isset($searchs['recorddateAdvancedStart']) && $searchs['recorddateAdvancedStart'] != '' ){
       $timestampStart = sfI18N::getTimestampForCulture($searchs['recorddateAdvancedStart'], $this->getUser()->getCulture());	
       $fechaInicio = date('Y-m-d', $timestampStart);

       $crecord = $c->getNewCriterion(MmPeer::RECORDDATE, $fechaInicio, Criteria::GREATER_EQUAL);
    }
    if ( isset($searchs['recorddateAdvancedFinish']) && $searchs['recorddateAdvancedFinish'] != '' ) {
       $timestampFinish = sfI18N::getTimestampForCulture($searchs['recorddateAdvancedFinish'], $this->getUser()->getCulture());	
       $fechaFin = date('Y-m-d', $timestampFinish);
       if ( isset($crecord) ) {
            $c2 = $c->getNewCriterion(MmPeer::RECORDDATE, $fechaFin, Criteria::LESS_EQUAL);
            $crecord->addAnd($c2);
        } else {
            $crecord = $c->getNewCriterion(MmPeer::RECORDDATE, $fechaFin, Criteria::LESS_EQUAL);
	}
    }
    if ( isset($crecord) ) {
      $c->add($crecord);
    }

    if (isset($searchs['description_advanced']) && $searchs['description_advanced']!=''){
       $c->add(MmI18nPeer::DESCRIPTION, '%' . $searchs['description_advanced'] . '%', Criteria::LIKE);
    }

    if (isset($searchs['titular']) && $searchs['titular']!=''){
       $c->add(MmI18nPeer::LINE2, '%' . $searchs['titular'] . '%', Criteria::LIKE);
    }

    if (isset($searchs['status']) && $searchs['status']!=-1){
       $c->add(MmPeer::STATUS_ID, $searchs['status']);
    }

    if (isset($searchs['news']) && $searchs['news'] == 'on'){
       $c->add(MmPeer::ANNOUNCE, 1);
    }

    if (isset($searchs['editorial1']) && $searchs['editorial1'] == 'on'){
       $c->add(MmPeer::EDITORIAL1, 1);
    }

    if (isset($searchs['editorial2']) && $searchs['editorial2'] == 'on'){
       $c->add(MmPeer::EDITORIAL2, 1);
    }

    foreach ($roles as $role) {
        if ( isset($searchs['person'][$role->getId()]) && $searchs['person'][$role->getId()]!='' ){
    	   $c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID);
	   $c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);
	   $c->add(MmPersonPeer::ROLE_ID, $role->getId());
	   $c->add(PersonPeer::NAME, '%' . $searchs['person'][$role->getId()] . '%', Criteria::LIKE);
         }
    }

    if (isset($searchs['broadcast_advanced']) && $searchs['broadcast_advanced']!=-1){
       $c->add(BroadcastPeer::BROADCAST_TYPE_ID, $searchs['broadcast_advanced']);
       $c->addJoin(BroadcastPeer::ID, MmPeer::BROADCAST_ID);
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