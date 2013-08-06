<?php

/**
 * buscador actions.
 *
 * @package    pumukituvigo
 * @subpackage buscador
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class buscadorActions extends PumukitActions
{
    public function executeIndex()
    {
        $this->error = '';
        $this->total = 0;

        $this->getUser()->panNivelDos('Buscador', 'buscador/index');
        $this->title = "Resultados de la búsqueda: " . $this->search;

        $maxPerPage = $this->getRequestParameter('numPerPage', 20);

        $c = $this->getCriteria();
        $mms = array();
        try{
           $mms = $this->getMms($c, $maxPerPage);
        }catch(Exception $e){
           $this->error = $e->getMessage();
        }
    
        $this->years   = $this->getYears();
        $this->genres  = $this->getGenres();
        $this->unescos = $this->getCategories(CategoryPeer::retrieveByCod("UNESCO")); 
        $this->mms     = $this->groupMms($mms);
    }

}
