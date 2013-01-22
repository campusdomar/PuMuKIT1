<?php
/**
 * MODULO OAI. 
 * Implementacion del estandar OAI.
 * 
 *
 * @package    pumukit
 * @subpackage xml
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot es)
 * @version    1.0
 */
class oaiActions extends sfActions
{
  public function preExecute()
  {
    sfConfig::set('sf_escaping_strategy', 'bc');
  } 





  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    switch ($this->getRequestParameter('verb', 'vacio')) {
    case 'vacio':
      return $this->error('badVerb', 'Illegal OAI verb');
    case 'Identify':
      $this->forward('oai', 'Identify');
      break;
    case 'ListMetadataFormats':
      $this->forward('oai', 'ListMetadataFormats');
      break;
    case 'ListSets':
      $this->forward('oai', 'ListSets');
      break;
    case 'ListIdentifiers':
      $this->forward('oai', 'ListIdentifiers');
      break;
    case 'ListRecords':
      $this->forward('oai', 'ListRecords');
      break;
    case 'GetRecord':
      $this->forward('oai', 'GetRecord');
      break;
    default:
      return $this->error('badVerb', 'Illegal OAI verb');
    }
  }




  /**
   * Genera la salida de GetRecord
   */
  public function executeGetRecord()
  {


    if ($this->getRequestParameter('metadataPrefix', 'vacio') != 'oai_dc'){
      return $this->error('cannotDisseminateFormat', 'cannotDisseminateFormat');
    }



    $this->mm = MmPeer::retrieveByPK(substr(stristr($this->getRequestParameter('identifier'), '/'), 1)); //ojo idioma
    if ($this->mm == null) return $this->error('idDoesNotExist', 
      'The value of the identifier argument is unknown or illegal in this repository');


  }





  /**
   * Genera la salida de Identify
   */
  public function executeIdentify()
  {
  }





  /**
   * Genera la salida de ListIdentifiers
   */
  public function executeListIdentifiers()
  {
    if ($this->getRequestParameter('metadataPrefix', 'vacio') != 'oai_dc'){
      return $this->error('cannotDisseminateFormat', 'cannotDisseminateFormat');
    }
    
    $c = new Criteria();
    $this->filter($c);


    $this->mms = MmPeer::doSelectPublicWithI18n($c, $this->getUser()->getCulture());
    if (count($this->mms) == 0) return $this->error('noRecordsMatch', 
       'The combination of the values of the from, until, and set arguments results in an empty list');


    // Falta comprobar si el Repository soporta sets (noSetHierarchy)

     // y lo del ResumptionToken (badResumptionToken)




  }




  /**
   * Genera la salida de ListRecords
   */
  public function executeListRecords()
  {
    if ($this->getRequestParameter('metadataPrefix', 'vacio') != 'oai_dc'){
      return $this->error('cannotDisseminateFormat', 'cannotDisseminateFormat');
    }
    
    $c = new Criteria();
    $this->filter($c);

    $this->mms = MmPeer::doSelectPublicWithI18n($c, $this->getUser()->getCulture());
    if (count($this->mms) == 0) return $this->error('noRecordsMatch', 
       'The combination of the values of the from, until, and set arguments results in an empty list');


     // Falta comprobar si el Repository soporta sets (noSetHierarchy)

     // y lo del ResumptionToken (badResumptionToken)


  }





  /**
   * Genera la salida de ListMetadataFormats
   */
  public function executeListMetadataFormats()
  {


   if ($this->hasRequestParameter('identifier')) {
        $this->mm = MmPeer::retrieveByPK(substr(stristr($this->getRequestParameter('identifier'), '/'), 1));
   
    
       if ($this->mm == null) return $this->error('idDoesNotExist', 
      'The value of the identifier argument is unknown or illegal in this repository');



  }
  

       //y que hay formato de metadatos para el item elegido, en caso de existir identificador correcto (noMetadataFormat)


  }




  /**
   * Genera la salida el ListSets
   */
  public function executeListSets()
  {
    $this->channels = SerialTypePeer::doSelectWithI18n(new Criteria());
    $this->serials = array();

    foreach($this->channels as $ch){
      $c = new Criteria();
      $c->add(SerialPeer::SERIAL_TYPE_ID, $ch->getId());
      $this->serials[$ch->getId()] = SerialPeer::doSelectPublicWithI18n($c, $this->getUser()->getCulture());
    }

    // lo del ResumptionToken (badResumptionToken)

  }




  /**
   * Genera el XML de error. La fecha en formato ISO8601 y el request se calculan automaticamente.
   * Usa el template errorSuccess.
   * @param string $cod Codigo del error.
   * @param string $msg Mensaje de descripcion del error.
   * @return sfView::SUCCESS
   */
  protected function error($cod, $msg = '')
  {
    $this->cod = $cod;
    $this->msg = $msg;
    $this->setTemplate('error');
    return sfView::SUCCESS;
  }




  /**
   * Modifica el objeto criteria de entrada anadiendo filtros de fechas (until & from) y de set si estan definidos en la URI
   * @param Criteria $c Objeto a modificar.
   *
   **/
  protected function filter($c)
  {
    //FROM UNTIL SET (SERIAL_TYPE -> SERIAL)
    if ($this->hasRequestParameter('from')){  //ver que es YYYY-mm-dd
      $criterion = $c->getNewCriterion(MmPeer::PUBLICDATE, $this->getRequestParameter('from'), Criteria::GREATER_EQUAL);
    }
    
    if ($this->hasRequestParameter('until')){ //ver que es YYYY-mm-dd
      if (isset($criterion)){
	$criterion->addAnd($c->getNewCriterion(MmPeer::PUBLICDATE, $this->getRequestParameter('until'), Criteria::LESS_EQUAL));
      }else{
	$criterion = $c->getNewCriterion(MmPeer::PUBLICDATE, $this->getRequestParameter('until'), Criteria::LESS_EQUAL);
      }
    }
    
    if (isset($criterion)){
      $c->add($criterion);
    }

    if($this->hasRequestParameter('set')&&(is_int($this->getRequestParameter('set')))){
      $c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);
      $c->add(SerialPeer::SERIAL_TYPE_ID, intval($this->getRequestParameter('set')));
    }


    if(($this->hasRequestParameter('set'))&&($ret = strstr($this->getRequestParameter('set'), ':('))){
      $c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);
      $c->add(SerialPeer::SERIAL_TYPE_ID, intval($this->getRequestParameter('set')));

      $c->add(MmPeer::SERIAL_ID, intval(substr($ret, 2)));  
    }

  }
}
