<?php

/**
 * Subclass for performing query and update operations on the 'category_mm_timeframe' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CategoryMmTimeframePeer extends BaseCategoryMmTimeframePeer
{
    // códigos para buscar categories.
    const EDITORIAL1 = "Destacados_TV";          // Código para editorial1 temporizada
    const EDITORIAL2 = "Destacados_Radio";    // Código para editorial2 temporizada

    static public function retrieveByCategoryIdMmId($category_id, $mm_id)
    {
        $c = new Criteria();
        $c->add(self::CATEGORY_ID, $category_id);
        $c->add(self::MM_ID, $mm_id);
        // ¿Comprobar >1 resultado y excepción?

        return self::doSelectOne($c);
    }

    static public function updateTimeframeFromPublishTab(
        $editorial_id, $mm_id, $editorial, $temporizada, $timestart, $timeend)
    {
        // $debug = false; // "Ingenioso" recurso para tener varios entornos de desarrollo a efectos de debug
        // $env = ($debug) ? sfConfig::get('sf_environment') : 'prod';

        // if ('dev' == $env){
        //     $array_dump = array('id' => $editorial_id, 'editorial' => $editorial, 
        //         'temporizada' => $temporizada,
        //         'timestart' => $timestart, 'timeend' => $timeend);
        //     echo "----------------------------<br/>Variables recibidas por CategoryMmTimeframePeer:<br/>";
        //     var_dump($array_dump); echo "<br/>";
        // }

        // Antes, el checkbox $editorial se correspondía directamente con mm->getEditorial1() p.ej.
        // Ahora, es necesario checkbox activo + radio = 'permanente' / checkbox activo + radio = 'temporizada'.
        // Aprovecho el código antiguo con estas asignaciones:
        $temp = ($editorial == 1 && $temporizada == 'temporizada') ? 1 : 0;
        $editorial = ($editorial == 1 && $temporizada == 'permanente') ? 1 : 0;

        if (1 == $editorial && 1 == $temp){
            echo "<br/>Error: decisión editorial " . $editorial_id . " no implementada - revisar CategoryMmTimeframePeer.php<br/>";
                return;
        }

        switch ($editorial_id){
            case 1:
                $cat_destacados_id = CategoryPeer::retrieveByCod(self::EDITORIAL1)->getId();
                break;
            case 2:
                $cat_destacados_id = CategoryPeer::retrieveByCod(self::EDITORIAL2)->getId();
                break;
            default:
                echo "<br/>Error: decisión editorial " . $editorial_id . " no implementada - revisar CategoryMmTimeframePeer.php<br/>";
                return;
                break;
        }

        $timeframe = self::retrieveByCategoryIdMmId($cat_destacados_id, $mm_id);    
        if (!$timeframe && $temp ){ 
          // --- Crear nuevo --- No existía un timeframe y se marcó
          // if ('dev' == $env) echo "<br/>Debug en CategoryMmTimeframePeer - creando nuevo timeframe\n<br/>";

            $tf = new CategoryMmTimeframe();
            $tf->setCategoryId($cat_destacados_id);
            $tf->setMmId($mm_id);
            if ($timestart && $timeend){
                $tf->setLocalFormatDates($timestart, $timeend, 'es'); //'es' = $this(viene de mms/actions)->getUser()->getCulture();
                $tf->save();
            } else {
              echo "<br/>CategoryMmTimeframePeer - Problema al crear timeframe: fechas inexistentes<br/>";
            }
        
        } else if ($timeframe && 0 == $temp){
            // --- Borrar tf --- Existía y se desmarcó.
            // if ('dev' == $env) echo "<br/>Debug en CategoryMmTimeframePeer - borrando timeframe\n<br/>";

            $timeframe->delete();

        } else if ($timeframe && 1 == $temp){
            // --- Actualizar timeframe --- Existía y sigue marcado
            // if ('dev' == $env) echo "<br/>Debug en CategoryMmTimeframePeer - actualizando timeframe\n<br/>";
            // Si existen fechas, siempre actualiza al pulsar ok aunque no cambien.
            if ($timestart && $timeend){         
                $timeframe->setLocalFormatDates($timestart, $timeend, 'es'); //'es' = $this(viene de mms/actions)->getUser()->getCulture();
                $timeframe->save();
            } else {
                echo "<br/>Problema al actualizar timeframe: fechas inexistentes<br/>";
            }

        } else {
          // --- DO NOTHING --- (no existía tf y tampoco se marcó el checkbox)
          // if ('dev' == $env) echo "<br/>Debug en CategoryMmTimeframePeer - DO NOTHING timeframe\n<br/>";   
        }
    }

    /**
     * Devuelve un resultset de mms con decisión editorial permanente
     * @param string  $cod  p.ej. "Destacados_TV", "Destacados_Radio"
     * @param boolean $public
     * @param $limit
     */
    static public function doSelectMmsWithPermanentEditorialFromCategoryCod($cod = null, $public = true, $limit = null)
    {
        $c = self::getNewCriteriaWithEditorialFromCategoryCod($cod);

        // Descarto todos los que tienen decisión editorial temporizada dentro de la categoría ($cod) buscada.
        $mm_ids_with_timeframe = self::getMmIdsWithTimeframeFromCategoryCod($cod, null);   
        // var_dump($mm_ids_with_timeframe) ; exit;
        $c->add(MmPeer::ID, $mm_ids_with_timeframe, Criteria::NOT_IN);
        
        if ($public) self::addPublicCriteria($c);
        if ($limit) $c->setLimit($limit);

        $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);

        return MmPeer::doSelect($c);
    }

    /**
     * Devuelve un resultset de mms con decisión editorial temporizada y activa en la fecha actual
     * @param string  $cod  p.ej. "Destacados_TV", "Destacados_Radio"
     * @param boolean $public
     * @param $limit
     */
    public static function doSelectMmsWithActiveTimeframeFromCategoryCod($cod = null, $public = true, $limit = null)
    {
        $c = self::getNewCriteriaWithCategoryFromCategoryCod($cod);
        self::addIsActiveTimeframeCriteria($c);
        
        if ($public) self::addPublicCriteria($c);
        if ($limit) $c->setLimit($limit);

        $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);

        return MmPeer::doSelect($c);
    }

    public static function doSelectMmsWithPermanentEditorialOrActiveTimeframeFromCod($cod = null, $public = true, $limit = null)
    {
        $mms_permanentes = self::doSelectMmsWithPermanentEditorialFromCategoryCod($cod, $public, $limit);
        $mms_timeframe_activo = self::doSelectMmsWithActiveTimeframeFromCategoryCod($cod, $public, $limit);

        // $destacados = array_merge($mms_permanentes, $mms_timeframe_activo);
        $destacados = self::mergeAndSortMms($mms_permanentes, $mms_timeframe_activo);
        
        return $destacados;
    }
    
    public static function doSelectDestacados($cod = null, $public = true, $limit = null)
    {
        return self::doSelectMmsWithPermanentEditorialOrActiveTimeframeFromCod($cod, $public, $limit);
    }

    /**
     * Busca los mms con timeframes de la categoría determinada por $category_destacados_id
     * Devuelve un resultset de CategoryMmTimeframes
     *
     * @param string  $cod    - de una categoría como "Destacados_TV", "Destacados_Radio"
     * @param boolean $active (true = dentro del intervalo; false/null = todos).
     * @return resultset CategoryMmTimeframes
     */
    public static function getTimeframesFromCategoryCod($cod, $active = null)
    {
        $c_mms_con_timeframes = self::getNewCriteriaWithCategoryFromCategoryCod($cod);
        
        if ($active){
            self::addIsActiveTimeframeCriteria($c_mms_con_timeframes);
        }

        return self::doSelect($c_mms_con_timeframes);       
    }

    /**
     * Busca los mms con timeframes de la categoría determinada por $category_destacados_id
     * Devuelve un array de ids
     *
     * @param string  $cod    - de una categoría como "Destacados_TV", "Destacados_Radio"
     * @param boolean $active (true = dentro del intervalo; false/null = todos).
     * @return array  mm_ids
     */
    public static function getMmIdsWithTimeframeFromCategoryCod($cod, $active = null)
    {
        $timeframes = self::getTimeframesFromCategoryCod($cod, $active);
        
        $mm_ids_with_timeframe = array();
        foreach ($timeframes as $timeframe){
            $mm_ids_with_timeframe[] = $timeframe->getMmId();
        }

        return $mm_ids_with_timeframe;
    }

    /**
     * Devuelve criteria con editorial1 o editorial2 seleccionado según $cod
     * @param string  $cod    - de una categoría como "Destacados_TV", "Destacados_Radio"
     * @return criteria $c
     */
    private static function getNewCriteriaWithEditorialFromCategoryCod($cod) 
    {
        $c = new Criteria();
        if (self::EDITORIAL1 == $cod) {
            $c->add(MmPeer::EDITORIAL1, 1);
        } else if (self::EDITORIAL2 == $cod){
            $c->add(MmPeer::EDITORIAL2, 1);
        } else {
            // Error: el cod de categoría no se corresponde con una de timeframes.
            return false;
        }

        return $c;
    }
    /**
     * Devuelve criteria con category seleccionada según $cod
     * @param string  $cod    - de una categoría como "Destacados_TV", "Destacados_Radio"
     * @return criteria $c
     */
    private static function getNewCriteriaWithCategoryFromCategoryCod($cod)
    {
        if ($category = CategoryPeer::retrieveByCod($cod)){
            $category_destacados_id = $category->getId();
        } else {
            throw new sfException("No existe category para destacados radio/tv, ejecutar batch/timeframes/creacategoriasdestacadosradiotv.php");
        }

        $c_mms_con_timeframes = new Criteria();
        $c_mms_con_timeframes->add(self::CATEGORY_ID, $category_destacados_id);

        return $c_mms_con_timeframes;
    }

    private static function addIsActiveTimeframeCriteria($c)
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        $c->addJoin(MmPeer::ID, self::MM_ID);
        $cstart = $c->getNewCriterion(self::TIMESTART, $now, Criteria::LESS_EQUAL);
        $cend   = $c->getNewCriterion(self::TIMEEND, $now, Criteria::GREATER_EQUAL);
        $cstart->addAnd($cend);
        $c->add($cstart);
        // return $cstart;       
    }

    private static function addPublicCriteria($c)
    {
        // Modifica criteria para que realice la busqueda en series del canal de publicación webtv.
        SerialPeer::addPubChannelCriteria($c, 1);       
        // Busca en series no ocultas    
        SerialPeer::addBroadcastCriteria($c);
        
        // pub_channel_mm.status_id 
        //      0 => No hay relación. Se usa para borrar provisionalmente.
        //      1 => Ficheros preparados.
        //      2 => En proceso (aún no está preparado el vídeo)
        //      3 => En proceso - aún no está procesado el máster.
        $c->add(PubChannelMmPeer::STATUS_ID, 1);

    }

    private static function mergeAndSortMms($mms1, $mms2)
    {
        $date_mm = array();

        foreach ($mms1 as $mm) {
            $date_mm[$mm->getRecordDate()][] = $mm;
        }
        foreach ($mms2 as $mm) {
            $date_mm[$mm->getRecordDate()][] = $mm;   
        }

        krsort($date_mm);

        $sorted_mms = array();
        foreach ($date_mm as $date => $mms){
            foreach ($mms as $mm){
                $sorted_mms[] = $mm;
            }
        }

        return $sorted_mms;
    }
}