<?php

/**
 * Timeframes module
 * Manage the entries from category_mm_timeframe that will control the
 * "Timed editorial decisions": objects with a publishing start & end times.
 *
 * @package    pumukit
 * @subpackage timeframes
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    0.1
 */
class timeframesActions extends sfActions
{
    public function executeIndex()
    {
      $this->redirect('timeframes/indexList');
    }
    

    /**
     * indexList - redirected from /editar.php/timeframes
     * Shows timeframes admin module with the table view.
     *
     * Accion por defecto del modulo. Layout: layout
     */
    public function executeIndexList()
    {
        sfConfig::set('timeframes_menu','active');
        if (!$this->getUser()->hasAttribute('page', 'tv_admin/timeframe')){
            $this->getUser()->setAttribute('page', 1, 'tv_admin/timeframe');    
        }
    }

    /**
     * indexDash - redirected from /editar.php/timeframes
     * Shows timeframes admin module with the dashboard view.
     * Layout: off
     */
    public function executeIndexDash()
    {
        sfConfig::set('timeframes_menu','active');
        // $this->blocks = array('total', 'diskfree', 'transcoderinfo', 'lastserial', 'lastserialpublic', 'minibuscador');
        $this->blocks = array(); 
        if ($this->hasRequestParameter('destacados') && 
            (in_array($this->getRequestParameter('destacados'), array('tv', 'radio', 'all')))) {
            $this->destacados = $this->getRequestParameter('destacados');
            $this->getUser()->setAttribute('destacados', $this->destacados, 'tv_admin/timeframes');
        } else {
            $this->destacados = $this->getUser()->getAttribute('destacados', 'all', 'tv_admin/timeframes');
        }

        // The submit form adds a request parameter with the checkbox status (hidden input = 0 if unchecked)
        // If the page is not requested via form submit, tries to get session value
        if ($this->hasRequestParameter('incluye_fijas')){ 
            $this->incluye_fijas = $this->getRequestParameter('incluye_fijas', 0);
            $this->getUser()->setAttribute('incluye_fijas', $this->incluye_fijas, 'tv_admin/timeframes');
        } else {
            $this->incluye_fijas = $this->getUser()->getAttribute('incluye_fijas', 0, 'tv_admin/timeframes');
        }
        if ($this->hasRequestParameter('incluye_en_proceso')){ 
            $this->incluye_en_proceso = $this->getRequestParameter('incluye_en_proceso', 0);
            $this->getUser()->setAttribute('incluye_en_proceso', $this->incluye_en_proceso, 'tv_admin/timeframes');
        } else {
            $this->incluye_en_proceso = $this->getUser()->getAttribute('incluye_en_proceso', 0, 'tv_admin/timeframes');
        }
    }

    /**
     * --  LIST -- /editar.php/timeframes/list
     * Shows the timeframes table, paginated and ¿filtered?. 
     * Renders the list component in order to be accesible by Ajax.
     *
     * Asynchronous action. Private processs.
     */
    public function executeList()
    {
        return $this->renderComponent('timeframes', 'list');
    }
   /**
     * --  DELETE -- /editar.php/timeframes/delete
     *
     * Asynchronous action. Private accesss.
     * id parameters received by URL or ids JSON by POST.
     */
    public function executeDelete()
    {
        if($this->hasRequestParameter('ids')){
            $timeframes = array_reverse(CategoryMmTimeframePeer::retrieveByPKs(json_decode($this->getRequestParameter('ids'))));
            foreach($timeframes as $timeframe){
                $timeframe->delete();
            }
            // Si se usa esta acción, hay que llamar a ...timeframe->deleteAndRemoveCategoryMm();

        } else if($this->hasRequestParameter('id')){
            $timeframe = CategoryMmTimeframePeer::retrieveByPk($this->getRequestParameter('id'));
            $timeframe->delete();
        } else {
            $this->msg_alert = array('info', "No se encontró timeframe para borrar.");            
        }

        $this->msg_alert = array('info', "Timeframe borrado.");
        return $this->renderComponent('timeframes', 'list');
    }

    /**
     * --  CREATE -- /editar.php/timeframes/create
     * Asynchronous action. Private process.
     */
    public function executeCreate()
    {
      $this->timeframe = new CategoryMmTimeframe();
      $this->langs = sfConfig::get('app_lang_array', array('es'));
      $this->setTemplate('edit');
    }

    /**
     * --  EDIT -- /editar.php/timeframes/edit/id/?
     *
     * Asynchronous action. Private process.
     * Id parameter passed by URL; (role and mm are optional - template issues)?.
     */
    public function executeEdit()
    {
      $this->timeframe = CategoryMmTimeframePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->timeframe);
      $this->langs = sfConfig::get('app_lang_array', array('es')); 
    }

    public function executeEditDash()
    {
      $this->timeframe = CategoryMmTimeframePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->timeframe);
      $this->langs = sfConfig::get('app_lang_array', array('es')); 
    }

    /**
     * --  UPDATE -- /editar.php/timeframes/update
     *
     * Asynchronous action. Private process. 
     * Parameters passed by POST from the edition form
     */
    public function executeUpdate()
    {
        if (!$this->getRequestParameter('id')){
            $timeframe = new CategoryMmTimeframe();
        } else {
            $timeframe = CategoryMmTimeframePeer::retrieveByPk($this->getRequestParameter('id'));
            $this->forward404Unless($timeframe);
        }

        if ($this->getRequestParameter('timestart'))
        {
            $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('timestart'), $this->getUser()->getCulture());      
            $timeframe->setTimestart($timestamp);
        }

        if ($this->getRequestParameter('timeend'))
        {
            $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('timeend'), $this->getUser()->getCulture());
            $timeframe->setTimeend($timestamp);    
        }

        $timeframe->setCategoryId($this->getRequestParameter('category_id', ' '));
        $timeframe->setMmId($this->getRequestParameter('mm_id', ' '));
        $timeframe->setDescription($this->getRequestParameter('description', ' '));

      try{
        $timeframe->save();
        $this->msg_alert = array('info', "Metadatos del timeframe actualizados.");
      }catch(Exception $e){
        $this->msg_alert = array('error', "No se pudo guardar timeframe.");
      }
        
      $this->getUser()->setAttribute('id', $timeframe->getId(), 'tv_admin/timeframe');

      return $this->renderComponent('timeframes', 'list');
    }

    /**
     * Destacados_TV - genera editar.php/timeframes/editorial1_timeline.xml      
     * Contiene la lista de eventos "destacados tv" a mostrar en el dashboard.
     * Incluye los timeframes (temporizados) y de editorial1 y editorial2 (fijos)
     *
     * TO DO - limitar inferiormente la lista de timeframes a n meses o cargar dinámicamente
     */
    public function executeEditorial1Timeline()
    {
        sfLoader::loadHelpers(array('Url'));
        $this->incluye_fijas      = $this->getRequestParameter('incluye_fijas', 0);
        $this->incluye_en_proceso = $this->getRequestParameter('incluye_en_proceso', 0);
        $cod_destacados_tv        = CategoryMmTimeframePeer::EDITORIAL1;
        $category_destacados_tv_id = CategoryPeer::retrieveByCod($cod_destacados_tv)->getId();
        $tv_color =  sfConfig::get('mod_timeframes_destacados_tv_color', '#00FF00');
        header("Content-Type: application/xml");
        $mm_ids_not_published = $this->getMmIdsNotPublished();
        $mm_ids_not_ready     = $this->getMmIdsNotReady();?>
<data>
    <?php if ( $this->incluye_fijas == 1) $this->xmlEventsFromEditorialId(1, 
                                                    $category_destacados_tv_id, 
                                                    $tv_color, $mm_ids_not_published, 
                                                    $mm_ids_not_ready, 
                                                    $this->incluye_en_proceso);?>
    <?php $this->xmlEventsFromTimeframeCategoryId($category_destacados_tv_id, 
                                                  $tv_color, 
                                                  $mm_ids_not_published, 
                                                  $mm_ids_not_ready, 
                                                  $this->incluye_en_proceso);?>  
</data>
        <?php return sfView::NONE;    
    }

    /**
     * Destacados_Radio - genera editar.php/timeframes/editorial2_timeline.xml      
     *
     * TO DO - limitar inferiormente la lista de timeframes a n meses o cargar dinámicamente
     */
    public function executeEditorial2Timeline()
    {
        sfLoader::loadHelpers(array('Url'));
        $this->incluye_fijas      = $this->getRequestParameter('incluye_fijas', 0);
        $this->incluye_en_proceso = $this->getRequestParameter('incluye_en_proceso', 0);
        $cod_destacados_radio     = CategoryMmTimeframePeer::EDITORIAL2;
        $category_destacados_radio_id = CategoryPeer::retrieveByCod($cod_destacados_radio)->getId();
        $radio_color = sfConfig::get('mod_timeframes_destacados_radio_color', '#0000FF');
        header("Content-Type: application/xml");
        $mm_ids_not_published = $this->getMmIdsNotPublished();
        $mm_ids_not_ready     = $this->getMmIdsNotReady();?>
<data>
    <?php if ( $this->incluye_fijas == 1) $this->xmlEventsFromEditorialId(2, 
                                                    $category_destacados_radio_id, 
                                                    $radio_color, 
                                                    $mm_ids_not_published, 
                                                    $mm_ids_not_ready, 
                                                    $this->incluye_en_proceso);?>
    <?php $this->xmlEventsFromTimeframeCategoryId($category_destacados_radio_id, 
                                                  $radio_color, 
                                                  $mm_ids_not_published, 
                                                  $mm_ids_not_ready, 
                                                  $this->incluye_en_proceso);?>  
</data>
        <?php return sfView::NONE;    
    }

    public function executeAllEditorialTimeline()
    {
        sfLoader::loadHelpers(array('Url'));
        $this->incluye_fijas      = $this->getRequestParameter('incluye_fijas', 0);
        $this->incluye_en_proceso = $this->getRequestParameter('incluye_en_proceso', 0);
        $cod_destacados_tv        = CategoryMmTimeframePeer::EDITORIAL1;
        $category_destacados_tv_id = CategoryPeer::retrieveByCod($cod_destacados_tv)->getId();
        $tv_color = sfConfig::get('mod_timeframes_destacados_tv_color', '#00FF00');

        $cod_destacados_radio = CategoryMmTimeframePeer::EDITORIAL2;
        $category_destacados_radio_id = CategoryPeer::retrieveByCod($cod_destacados_radio)->getId();
        $radio_color = sfConfig::get('mod_timeframes_destacados_radio_color', '#0000FF');
        header("Content-Type: application/xml");
        $mm_ids_not_published = $this->getMmIdsNotPublished();
        $mm_ids_not_ready     = $this->getMmIdsNotReady();?>
<data>
    <?php if ( $this->incluye_fijas == 1) $this->xmlEventsFromEditorialId(1, 
                                                    $category_destacados_tv_id, 
                                                    $tv_color, 
                                                    $mm_ids_not_published, 
                                                    $mm_ids_not_ready, 
                                                    $this->incluye_en_proceso);?>
    <?php $this->xmlEventsFromTimeframeCategoryId($category_destacados_tv_id, 
                                                  $tv_color, 
                                                  $mm_ids_not_published, 
                                                  $mm_ids_not_ready, 
                                                  $this->incluye_en_proceso);?>
    <?php if ( $this->incluye_fijas == 1) $this->xmlEventsFromEditorialId(2, 
                                                    $category_destacados_radio_id, 
                                                    $radio_color, 
                                                    $mm_ids_not_published, 
                                                    $mm_ids_not_ready, 
                                                    $this->incluye_en_proceso);?>
    <?php $this->xmlEventsFromTimeframeCategoryId($category_destacados_radio_id, 
                                                  $radio_color, 
                                                  $mm_ids_not_published, 
                                                  $mm_ids_not_ready, 
                                                  $this->incluye_en_proceso);?>
</data>
        <?php return sfView::NONE;  
     }

    /**
     * Saca las entradas xml de los event de mms con decisión editorial fija.
     * $editorial_id 1 = Destacados_TV, 2 = Destacados_Radio.
     */
    private function xmlEventsFromEditorialId($editorial_id, $category_destacados_id, $color = '#0000FF', 
        $mm_ids_not_published = array(), $mm_ids_not_ready = array(), $incluye_en_proceso)
    {
        // Decisiones editoriales NO temporizadas => línea [-2 meses a +2 meses]
        $two_months_before = date('Y-m-d H:i:s', strtotime('-2 month'));
        $two_months_after  = date('Y-m-d H:i:s', strtotime('+2 month'));
        $two_hours_before  = date('Y-m-d H:i:s', strtotime('-2 hour'));
        $two_hours_after   = date('Y-m-d H:i:s', strtotime('+2 hour'));
        
        $c_excluir_timeframes = new Criteria();
        $c_excluir_timeframes->add(CategoryMmTimeframePeer::CATEGORY_ID, $category_destacados_id);
        $timeframes_tv = CategoryMmTimeframePeer::doSelect($c_excluir_timeframes);
        
        $mm_ids_with_timeframe = array();
        foreach ($timeframes_tv as $timeframe){
            $mm_ids_with_timeframe[] = $timeframe->getMmId();
        }

        $c = new Criteria();       
        if ($editorial_id == 1) {
            $c->add(MmPeer::EDITORIAL1, 1);
            $c->add(MmPeer::ID, $mm_ids_with_timeframe, Criteria::NOT_IN);

        } else if ($editorial_id == 2){
            $c->add(MmPeer::EDITORIAL2, 1);
            $c->add(MmPeer::ID, $mm_ids_with_timeframe, Criteria::NOT_IN);
        } else {
            throw new Exception ("timeframes - actions - decisión editorial " . $editorial_id ." no definida");
        }

        $mms_editorial = MmPeer::doSelect($c);?>
        <?php foreach ($mms_editorial as $mm):?>
            <?php if (1 != $incluye_en_proceso && 
            $this->idInArrays($mm->getId(), $mm_ids_not_published, $mm_ids_not_ready)) continue; ?>
<event
        durationEvent="true"
        start="<?php echo $two_months_before?>"
        end="<?php echo $two_months_after?>"
        latestStart="<?php echo $two_hours_before?>"
        earliestEnd="<?php echo $two_hours_after?>"
        color="<?php echo $color;?>"
        textColor="#000000"
        title="<?php echo str_replace(array('"', "&"), array("'", "&amp;"), $this->processMmTitle($mm, $mm_ids_not_published, $mm_ids_not_ready));?>"
        link="<?php echo url_for('virtualserial/index?mm_id=' . $mm->getId() . '#pubMmHash')?>">
</event>
        <?php endforeach;?>
        <?php /* Al añadir latestStart y earliestEnd consigo una línea larga celeste
                con este intervalo marcado en el color de destacado radio / tv.*/
    }

    /**
     * Saca las entradas xml de los event de timeframes según las categorías.
     */
    private function xmlEventsFromTimeframeCategoryId($cat_id, $color='#FF0000',
        $mm_ids_not_published = array(), $mm_ids_not_ready = array(), $incluye_en_proceso)
    {
        $c = new Criteria();
        $c->add(CategoryMmTimeframePeer::CATEGORY_ID, $cat_id);
        $timeframes = CategoryMmTimeframePeer::doSelectJoinAll($c);
        ?>
        <?php  foreach($timeframes as $timeframe):?>
            <?php if (1 != $incluye_en_proceso && 
                $this->idInArrays($timeframe->getMmId(), $mm_ids_not_published, $mm_ids_not_ready)) continue; ?>
<event
        durationEvent="true"
        start="<?php echo $timeframe->getTimestart('r')?>"
        end="<?php echo $timeframe->getTimeend('r')?>"
        color="<?php echo $color;?>"
        textColor="#000000"
        title="<?php echo str_replace(array('"', "&"), array("'", "&amp;"), $this->processMmTitle($timeframe->getMm(), $mm_ids_not_published, $mm_ids_not_ready));?>"
        link="<?php echo url_for('virtualserial/index?mm_id=' . $timeframe->getMmId() . '#pubMmHash')?>">
        <?php /* image="<?php echo $timeframe->getMm()->getPics()[0]->getUrl()?>" ?>
        link="/editar.php/timeframes/editDash/id/<?php echo $timeframe->getId() ?>">
        echo str_replace('&', '&amp;', $timeframe->getDescription()) */?>
</event>
        <?php endforeach; ?>
    <?
    }

    /**
     * Devuelve la lista de mm.id con files pendientes de procesar
     * Tienen una entrada en pub_channel_mm con status_id != 1
     * No entro en mm.status_id (me da igual que sea PUB, BLOQ o HID.)
     */
    private function getMmIdsNotReady()
    {
        $c = new Criteria();
        $c->add(PubChannelMmPeer::STATUS_ID, 1, Criteria::NOT_EQUAL);
        $pcms = PubChannelMmPeer::doSelect($c);
        $mm_ids = array();
        foreach ($pcms as $pcm){
            $mm_ids[] = $pcm->getMmId();
        }

        return $mm_ids;
    }

    /**
     * Devuelve la lista de mm.id con mm.status != PUB(desplegable select)
     * más los que no tengan asignado canal de publicación
     * (checkbox webtv, entrada en pub_channel_mm)
     */
    private function getMmIdsNotPublished($pub_channel_id = array(1))
    {
        $c = new Criteria();
        $c->addJoin(MmPeer::ID, PubChannelMmPeer::MM_ID, Criteria::LEFT_JOIN);
        $c_mm_bloq_or_hide     = $c->getNewCriterion(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL, Criteria::NOT_EQUAL);
        $c_without_pub_channel = $c->getNewCriterion(PubChannelMmPeer::MM_ID, null, Criteria::ISNULL);
        $c_mm_bloq_or_hide->addOr($c_without_pub_channel);
        $c->add($c_without_pub_channel);
        // Hago una búsqueda por columna específica acortar el tiempo de espera.
        $c->clearSelectColumns();
        $c->addSelectColumn(MmPeer::ID);

        $rs = MmPeer::doSelectRS($c);
        $mm_ids = array();
        while ($rs->next()){
           $mm_ids[] = $rs->getInt(1);
        }

        return $mm_ids;
    }

    private function processMmTitle($mm, $mm_ids_not_published, $mm_ids_not_ready)
    {
        if (in_array($mm->getId(), $mm_ids_not_published)){

            return '(SIN PUBLICAR EN WEBTV) ' . $mm->getTitle();
        } else if (in_array($mm->getId(), $mm_ids_not_ready)){

            return '(EN PROCESO) ' . $mm->getTitle() ;
        } else {

            return $mm->getTitle();
        }
    }

    private function idInArrays($id, $array1, $array2)
    {
        return (in_array($id, $array1) || in_array($id, $array2));
    }

/* Tiempos:
        start="<?php echo $timeframe->getTimestart('M j Y H:i:s \G\M\T-0100')?>"
        end="<?php echo $timeframe->getTimeend('M j Y H:i:s \G\M\T-0100')?>"
        */       
}