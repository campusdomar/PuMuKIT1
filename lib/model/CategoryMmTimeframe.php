<?php

/**
 * Subclass for representing a row from the 'category_mm_timeframe' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CategoryMmTimeframe extends BaseCategoryMmTimeframe
{
    /** 
     *  Borra timeframe. Desasigna la categoría (p.ej. "Destacados_tv") al mm.
     *
     *  Si la cat. padre no es root (p.ej., arbol de categorias que reúne a 
     *  todas las decisiones editoriales temporizables), también desasigna
     *  1 nivel de categoría padre.
     */
    public function deleteAndRemoveCategoryMm()
    {
        $category = $this->getCategory();
        $mm_id    = $this->getMmId();
        if ($cat_mm = CategoryMmPeer::retrieveByPk($this->getCategoryId(), $mm_id)){

            if ($category->hasParent()){
                $cat_padre = $category->getParent();
                if (!$cat_padre->isRoot()){
                    $cat_padre->delMmId($mm_id);
                }
            }
            $category->delMmId($mm_id);
        }
        // Si no hay category_mm asignada => timeframe fuera de plazo. Se borra igual.
            
        return $this->delete();         
    }

    /**
     * Recibe dos strings con fechas en formato local "dia/mes/año hora..."
     */
    public function setLocalFormatDates($timestart, $timeend, $culture = 'es')
    {
        $timestamp_timestart = sfI18N::getTimestampForCulture($timestart, $culture); 
        // var_dump($timestart);
        $this->setTimestart($timestamp_timestart);
        // var_dump($this->getTimestart());
        $timestamp_timeend = sfI18N::getTimestampForCulture($timeend, $culture); 
        $this->setTimeend($timestamp_timeend);
    }


    /**
     * Devuelve -1 si el intervalo es pasado, 0 si es actual o +1 si es futuro
     */
    public function intervalCmp()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));
        $timestart = $this->getTimestart();
        $timeend   = $this->getTimeend();

        if ($timestart > $timeend || $timestart == '' || $timeend == ''){
            echo "\n<br/> Error en el timeframe " . $this->getId() . " fecha inexistentes o inicio posterior al final<br/>\n";
            return false; //procesar algún error
        } else if ($timeend < $now){

            return -1;
        } else if ($timestart > $now) {

            return +1;
        } else if ($timestart < $now && $now < $timeend) {

            return 0;
        } else {
            echo "\n<br/>Error en el timeframe " . $this->getId() . " intervalo anómalo<br/>\n";
            return false;
        }
    }
}
