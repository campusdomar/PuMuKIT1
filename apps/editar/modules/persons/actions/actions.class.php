<?php
/**
 * MODULO PERSON ACTIONS. 
 * Modulo de administracion de las personas que estan asociadas a algun
 * objeto multimedia del catalogo. Esta relacion se realiza a traves del
 * un rol. Las tabla personas almacena los cargos por lo que una persona
 * con dos cargos diferentes tendra dos entrasa en la base de datos.
 *
 * @package    pumukit
 * @subpackage persons
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class personsActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/persons
   * Muestra el modulo de administracion de las personas, con la vista previa, formulario
   * de fultrado, listado de usuarios y acciones de nuevo...
   *
   * Accion por defecto del modulo. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('library_menu','active');

    $this->getUser()->setAttribute('sort', 'name', 'tv_admin/person');
    $this->getUser()->setAttribute('type', 'asc', 'tv_admin/person');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/person'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/person');
  }

  /**
   * --  LIST -- /editar.php/persons/list
   * Muestra la tabla que lista de forma paginada y filtrada las personas. Renderiza el componente
   * list para que sea accesibe como ajax.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('persons', 'list');
  }


  /**
   * --  LISTRELATION -- /editar.php/persons/listrelation
   * Muestra la lista de personas, junto con sus funciones de administración de las personas
   * asociadas a una determinado objeto multimedia y un determinado rol.
   *
   * Accion asincrona. Acceso privado. Paremetros mm y role por URL(id del rol y de objeto)
   *
   */
  public function executeListrelation()
  {
    $this->mm   = MmPeer::retrieveByPk($this->getRequestParameter('mm'));
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
    return $this->renderComponent('persons', 'listrelation');
  }


  /**
   * --  LISTRELATION -- /editar.php/persons/listrelation
   * Muestra la lista de personas, junto con sus funciones de administración de las personas
   * asociadas a una determinado objeto multimedia y un determinado rol.
   *
   * Accion asincrona. Acceso privado. Paremetros mm y role por URL(id del rol y de objeto)
   *
   */
  public function executeListrelationtemplate()
  {
    $this->mm   = MmTemplatePeer::retrieveByPk($this->getRequestParameter('mm'));
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
    return $this->renderComponent('persons', 'listrelationtemplate');
  }


  /**
   * --  PREVIEW -- /editar.php/persons/preview
   * Muestra la una perqueña vista previa de la persona con infomacion de sus metadatos y de los 
   * objetos multimedia a los que pertenece.
   *
   * Accion asincrona. Acceso privado. Paremetros id de la persona
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/person');
    }
    return $this->renderComponent('persons', 'preview');
  }


  /**
   * --  CREATE -- /editar.php/persons/create
   * Muesta el formulario de edicion de la persona nueva.
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->person = new Person();

    //init honorific with "D."
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    foreach(sfConfig::get('app_lang_array', array('es')) as $lang){
      $this->person->setCulture($lang);
      $this->person->setHonorific("D.");
    }

    /*De donde se accede persons o video ?*/
    $this->url = 'persons/update';
    $this->update = 'list_persons';

    $this->setTemplate('edit');
  }


  /**
   * --  CREATERELATION -- /editar.php/persons/createrelation
   * Muesta el formulario de edicion de la persona nueva, que se asociara a un
   * determinado objeto multimedia con un rol determindo
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreaterelation()
  {
    $this->person = new Person();

    $this->person->setName(preg_replace('/\d+ - /', '', $this->getRequestParameter('name')));

    /*De donde se accede persons o video ?*/
    if($this->hasRequestParameter('template')){
      $this->url = 'persons/updaterelation?template=true&mm='.$this->getRequestParameter('mm').'&role='.$this->getRequestParameter('role');
      $this->update = $this->getRequestParameter('role').'_person_mms'; //EL MISMO QUE EN MM:(
    }else{
      $this->url = 'persons/updaterelation?mm='.$this->getRequestParameter('mm').'&role='.$this->getRequestParameter('role');
      $this->update = $this->getRequestParameter('role').'_person_mms';
    }

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }



  /**
   * --  EDIT -- /editar.php/persons/edit/id/?
   * Muesta el formulario de edicion de la persona cuyo identificador se pada como paremetro.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, role y mm opcionales, (para conocer que template usar)
   *
   */
  public function executeEdit()
  {
    $this->person = PersonPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->person);

    /*De donde se accede persons o video ?*/
    if($this->hasRequestParameter('template')){
      $this->url = 'persons/updaterelation?template=true&mm='.$this->getRequestParameter('mm').'&role='.$this->getRequestParameter('role');
      $this->update = $this->getRequestParameter('role').'_person_mms';
    }elseif ($this->hasRequestParameter('role')){
      $this->url = 'persons/updaterelation?mm='.$this->getRequestParameter('mm').'&role='.$this->getRequestParameter('role');
      $this->update = $this->getRequestParameter('role').'_person_mms';
      //$this->preview = true;
    }else{
      $this->url = 'persons/update';
      $this->update = 'list_persons';

    }

    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }


  /**
   * --  UPDATE -- /editar.php/persons/update
   * Actualiza el contenido de una persona con el resultado del formulario de modificacion.
   * Si no existe persona con id dado se crea uno nuevo y se realizan validacion de email en 
   * el servidor. 
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    $this->update();

    $this->msg_alert = array('info', "Metadatos de la persona actualizados.");
    return $this->renderComponent('persons', 'list');
  }

  /**
   * --  LINK -- /editar.php/persons/link
   * Asocia una persona ya creada a un objeto multimedia con un rol determinado.
   *
   * Accion asincrona. Acceso privado. Parametros por URL: ids de la persona y objeto multimedia a asociar e id del rol.
   *
   */
  public function executeLink()
  {
    if($this->hasRequestParameter("template")){
      $this->mm   = MmTemplatePeer::retrieveByPk($this->getRequestParameter('mm'));
      $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
      
      $aux = new MmTemplatePerson();
      $aux->setMmTemplateId($this->mm->getId());
      $aux->setRoleId($this->role->getId());
      $aux->setPersonId($this->getRequestParameter('person'));
      try{
	$aux->save();
	$this->msg_alert = array('info', 
			  "Persona asociada correctamente a la plantilla con el rol " . $this->role->getName(). ". ");
      }catch(Exception $e){
	$this->msg_alert = array('error', 
			  "Persona ya asociada a la plantilla con el rol " . $this->role->getName(). ". ");
      } 
      
      return $this->renderComponent('persons', 'listrelationtemplate');
    }else{
      $this->mm   = MmPeer::retrieveByPk($this->getRequestParameter('mm'));
      $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
      
      $aux = new MmPerson();
      $aux->setMmId($this->mm->getId());
      $aux->setRoleId($this->role->getId());
      $aux->setPersonId($this->getRequestParameter('person'));
      try{
	$aux->save();
	$this->msg_alert = array('info', 
			   "Persona asociada correctamente al objeto multimedia \"" . $this->mm->getTitle()."\" con el rol " . $this->role->getName(). ". ");
      }catch(Exception $e){
	$this->msg_alert = array('error', 
			   "Persona ya asociada al objeto multimedia \"" . $this->mm->getTitle()."\" con el rol " . $this->role->getName(). ". ");
      } 
      
      return $this->renderComponent('persons', 'listrelation');
    }
}


  /**
   * --  UPDATERELATION -- /editar.php/persons/updaterelation
   * Actualiza el contenido de una persona con el resultado del formulario de modificacion.
   * Si no existe persona con id dado se crea uno nuevo y se realizan validacion de email en 
   * el servidor. Tras eso la asocia a un objeto multimedia con un rol determinado.
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdaterelation()
  {
    $person = $this->update();
    if($this->hasRequestParameter('template')){
      $this->mm   = MmTemplatePeer::retrieveByPk($this->getRequestParameter('mm'));
      $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));

      $aux = new MmTemplatePerson();
      $aux->setMmTemplateId($this->mm->getId());
      $aux->setRoleId($this->role->getId());
      $aux->setPersonId($person);
      try{
	$aux->save();
      }catch(Exception $e){
      }
      $component = 'listrelationtemplate';
    }else{
      $this->mm   = MmPeer::retrieveByPk($this->getRequestParameter('mm'));
      $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
      
      $aux = new MmPerson();
      $aux->setMmId($this->mm->getId());
      $aux->setRoleId($this->role->getId());
      $aux->setPersonId($person);
      try{
	$aux->save();
      }catch(Exception $e){
      }
      $component = 'listrelation';
    }

    $this->msg_alert = array('info', "Persona asociada correctamente al objeto multimedia \"" . $this->mm->getTitle()."\" con el rol " . $this->role->getName(). ". ");
    $this->preview = true;
    return $this->renderComponent('persons', $component);
  }


  /**
   * --  DELETE -- /editar.php/persons/delete
   * Borrar una persona de la base de datos si el parametro id se introduce en la URL, se 
   * pueden borrar varios personas si existe por POST un array de ids codificado en JSON.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $persons = PersonPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($persons as $person){
	$person->delete();
      }
      $this->msg_alert = array('info', "Personas borradas correctamente");

    }elseif($this->hasRequestParameter('id')){
      $person = PersonPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->msg_alert = array('info', "Personas ".$person->getName(). "borrada");
      $person->delete();
    }

    return $this->renderComponent('persons', 'list');
  }


  /**
   * --  DELETERELATION -- /editar.php/persons/deleterelation
   * Desasocia una persona ya creada a un objeto multimedia con un rol determinado.
   *
   * Accion asincrona. Acceso privado. Parametros por URL: ids de la persona y objeto multimedia a asociar e id del rol.
   *
   */
  public function executeDeleterelation()
  {
    $person = PersonPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('mm')); 
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
    $template = 'listrelation';

    if ($this->hasRequestParameter('role')){
      if($this->hasRequestParameter('template')){
	$mmPerson = MmTemplatePersonPeer::retrieveByPK( $this->mm->getId(), $person->getId(), $this->role->getId());
	$mmPerson->delete();
	$msg_c = "Persona desasocionada correctamente";
	$template = 'listrelationtemplate';
      }else{
	$mmPerson = MmPersonPeer::retrieveByPK( $this->mm->getId(), $person->getId(), $this->role->getId());
	$mmPerson->delete();
	$msg_c = "Persona desasocionada correctamente";
      }
    }

    //Solo Borro si no hay mas
    if (($person->countMmPersons() == 0)&&($person->countMmTemplatePersons() == 0)){
      $person->delete();
      $msg_c = "Persona ademas de desasociarse con el objeto multimedia se borro por no estar relacionada a nada mas";
    }

    $this->msg_alert = array('info', $msg_c);
    return $this->renderComponent('persons', $template);
  }

  /**
   * --  COPY -- /editar.php/persons/copy
   * Crea un persona con los mismos metadatos que otra original
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la persona a copiar
   *
   */
  public function executeCopy()
  {
    $person = PersonPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($person);

    $person2 = $person->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $person->setCulture($lang);
      $person2->setCulture($lang);
      $person2->setPost($person->getPost());
      $person2->setFirm($person->getFirm());
      $person2->setBio($person->getBio());
      $person2->setHonorific($person->getHonorific());
    }

    $person2->save();
    $this->msg_alert = array('info', "Persona clonada correctamente");
    return $this->renderComponent('persons', 'list');
  }

  /**
   * --  SEPARE -- /editar.php/separe/update
   * Procesa una, varias o todas las personas  para eliminar su campo honorifico de su nombre y almacenarlo en el lugar correspondiente.
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST o all por url.
   *
   */
  public function executeSepare()
  {
    $langs = sfConfig::get('app_lang_array', array('es'));
    $honor = array('D.', 'Dña.', 'Dª.', 'Dª', 'Dna.', 'Dr.', 'Dra.', 'Sr.', 'Sra.', 'Excma.', 'Excmo.', 'Excma', 'Excmo', 'Ilma.', 'Ilmo.', 'Ilma', 'Ilma');

    if($this->hasRequestParameter('ids')){
      $persons = PersonPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));
    }elseif($this->getRequestParameter('all')){
      $persons = PersonPeer::doSelect(new Criteria);
    }
    
    foreach($persons as $person){
      foreach($honor as $h){
    	$num = 0;
    	$person->setName(trim(str_replace($h, '', $person->getName(), $num)));
    	if ($num == 1){
	  foreach($langs as $lang){
            $person->setCulture($lang);
	    $person->setHonorific(trim($h.' '.$person->getHonorific()));
	    $person->save();
          }
	}
      }
    }

    $this->msg_alert = array('info', "Campos honorificos separados correctamente.");
    return $this->renderComponent('persons', 'list');
  }

  /**
   * --  MERGE -- /editar.php/merge
   * Junta 2 o más personas en una (la que tenga más vídeos).
   * Reasigna todo lo que haya vinculado con las absorbidas.
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST o all por url.
   *
   */
  public function executeMerge()
  {

    if (!$this->hasRequestParameter('ids')){
      $this->msg_alert = array('info', "No ha seleccionado ninguna persona");
  
      return $this->renderComponent('persons', 'list');
    } 

    $person_ids = json_decode($this->getRequestParameter('ids'));
    
    // Programación defensiva: js.js no debería dejar pasar si hay menos de 2 $person_ids
    if (1 > count($person_ids)){
      $this->msg_alert = array('info', "No ha seleccionado ninguna persona");
  
      return $this->renderComponent('persons', 'list');
    }
    if (1 == count($person_ids)){
      // $this->msg_alert = array('info', "Autofusión aún no está implementada. Se necesita al menos dos personas para una fusión satisfactoria");
      $this->msg_alert = array('info', "Número insuficiente de personas para unificar");
  
      return $this->renderComponent('persons', 'list');
    }

    // $this->msg_alert = array('info', "Combinando personas"); 
  
    $people        = PersonPeer::retrieveByPks($person_ids);
    $sorted_people = $this->getPeopleSortedByMmsNumberAndNameLength($people);
    $merger        = $sorted_people[0];
    $acquisitions  = array_slice($sorted_people, 1);
    foreach ($acquisitions as $person){
      if ($person->getId() != $merger->getId()){
        $this->mergePerson1IntoPerson2($person, $merger);
      } 
    }

    $this->msg_alert = array('info', "Unificando personas"); 
  
    return $this->renderComponent('persons', 'list');
  }

  /**
   * --  AUTOCOMPLETE -- /editar.php/persons/autocomplete
   * Muestra una lista com los nombres de las peronas similares al que se esta campo nombre.
   *
   * Accion asincrona. Acceso privado. Parametros name por URL.
   *
   */
  public function executeAutoComplete()
  {
    $c = new Criteria();
    $this->name = $this->getRequestParameter('name');
    $c->add(PersonPeer::NAME, '%' . $this->name . '%', Criteria::LIKE);
    $this->persons = PersonPeer::doSelect($c);
    
  }


  /**
   * --  LISTAUTOCOMPLETE -- /editar.php/persons/listautocomplete
   * Muestra el formulario de asociacion de una perona a un objeto multimedia. A traves de ese 
   * formulario se puede asociar una persona ya existente o una nueva a un objeto multimedia com un determinado rol.
   * Mientas se completa el nombre de la perona se muestras personas ya existentes con dicho nombre.
   *
   * Accion asincrona. Acceso privado. Parametros role y mm por URL.
   *
   */
  public function executeListAutoComplete()
  {
    $this->role_id = $this->getRequestParameter('role');
    $this->mm_id = $this->getRequestParameter('mm');  //OJO SI NO E
    $this->template = ($this->hasRequestParameter("template"))?'/template/true':'';
  }

  /**
   * --  UP -- /editar.php/persons/up
   * Las personas asociadas a un determinado objeto multimedia con un rol especifico, tienen un orden determinado.
   * Esta accion permite ascender a una determinada persona en dicha lista
   *
   * Accion asincrona. Acceso privado. Parametros id, role y mm por URL.
   *
   */
  public function executeUp()
  {
    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('mm')); 
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
    
    if($this->hasRequestParameter('template')){
      $mmper = MmTemplatePersonPeer::retrieveByPK($this->mm->getId(), $this->getRequestParameter('id'), $this->role->getId());
      $this->forward404Unless($mmper);
      $template = 'listrelationtemplate';
    }else{
      $mmper = MmPersonPeer::retrieveByPK($this->mm->getId(), $this->getRequestParameter('id'), $this->role->getId());
      $this->forward404Unless($mmper);
      $template = 'listrelation';      
    }

    $mmper->moveUp();
    $mmper->save();

    return $this->renderComponent('persons', $template);
  }

  /**
   * --  DOWN -- /editar.php/persons/down
   * Las personas asociadas a un determinado objeto multimedia con un rol especifico, tienen un orden determinado.
   * Esta accion permite descender a una determinada persona en dicha lista
   *
   * Accion asincrona. Acceso privado. Parametros id, role y mm por URL.
   *
   */
  public function executeDown()
  {
    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('mm')); 
    $this->role = RolePeer::retrieveByPk($this->getRequestParameter('role'));
    
    if($this->hasRequestParameter('template')){
      $mmper = MmTemplatePersonPeer::retrieveByPK($this->mm->getId(), $this->getRequestParameter('id'), $this->role->getId());
      $this->forward404Unless($mmper);
      $template = 'listrelationtemplate';
    }else{
      $mmper = MmPersonPeer::retrieveByPK($this->mm->getId(), $this->getRequestParameter('id'), $this->role->getId());
      $this->forward404Unless($mmper);
      $template = 'listrelation';      
    }

    $mmper->moveDown();
    $mmper->save();

    return $this->renderComponent('persons', $template);
  }



  /**
   *  Funcio de actualizar
   **/
  private function update()
  {
    if (!$this->getRequestParameter('id'))
    {
      $person = new Person();
    }
    else
    {
      $person = PersonPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($person);
    }

    $person->setName($this->getRequestParameter('name', ' '));
    $person->setEmail($this->getRequestParameter('email', ' '));
    $person->setWeb($this->getRequestParameter('web', ' '));
    $person->setPhone($this->getRequestParameter('phone', ' '));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $person->setCulture($lang);
      $person->setHonorific($this->getRequestParameter('honorific_'. $lang, ' '));
      $person->setFirm($this->getRequestParameter('firm_'. $lang, ' '));
      $person->setPost($this->getRequestParameter('post_'. $lang, ' '));
      $person->setBio($this->getRequestParameter('bio_'. $lang, ' '));
    }
    $person->save();

    $this->getUser()->setAttribute('id', $person->getId(), 'tv_admin/person');
    return $person->getId();
  }

  private function getPeopleSortedByMmsNumberAndNameLength($people)
  {
    $id_mms        = array();
    $id_namelength = array();
    foreach ($people as $person){
      $id_mms[$person->getId()] = $person->countMmPersons();
      $id_namelength[$person->getId()] = strlen(trim($person->getName()));
    }
    array_multisort($id_mms, SORT_DESC, $id_namelength, SORT_DESC, $people);

    return $people;
  }

  private function mergePerson1IntoPerson2($person1, $merger)
  {
    if (!$person1 || !$merger){
      // echo "Error al fusionar personas, ids incorrectos"
      return false;
    }
    $merger_id  = $merger->getId();
    $person1_id = $person1->getId();
    // echo "\n<br/>Asignando todo lo relacionado con " . $person1_id . " - " . $person1->getName() . " (" . $person1->countMmPersons() . ") a " . $merger->getId() . " - " . $merger->getName() . " (" . $merger->countMmPersons() . ")\n<br>";
    
    $mmps = $person1->getMmPersons();
    foreach ($mmps as $mmp){
      $resultado = $this->actualiza_mmp_nuevo_person_id($mmp, $merger_id);
    }

    $mmtps = $person1->getMmTemplatePersons();   
    foreach ($mmtps as $mmtp){
      $resultado = $this->actualiza_mmtp_nuevo_person_id($mmtp, $merger_id);
    }

    // No probado (de momento no se usa pic_person). Probablemente no deje actualizar y haya que crear nuevos pics.
    // if (!$merger->getPicPersons() && ($pps = $person1->getPicPersons())){  
    //   $pic_person = $pps[0];
    //   $pic_person->setOtherId($merger_id);
    //   $pic_person->save();
    // }
    
    $person1->delete();
  }
  
// Importante: como no funciona cambiar un valor y guardar el mismo objeto.
// ej.: $mmtp->setPersonId(nuevo) y $mmtp->save()
// creo uno nuevo y borro el original.

   /**
   * @param MmTemplatePerson $mmtp
   * @param Integer $merger_id
   * @return Boolean (existía previamente el nuevo objeto || resultado del save())
   */
  private function actualiza_mmtp_nuevo_person_id($mmtp, $merger_id){
    $new_mmtp = new MmTemplatePerson();
    $new_mmtp->setMmTemplateId($mmtp->getMmTemplateId());
    $new_mmtp->setRoleId($mmtp->getRoleId());
    $new_mmtp->setPersonId($merger_id);

    if ($already_present = MmTemplatePersonPeer::retrieveByPk($new_mmtp->getMmTemplateId(), $new_mmtp->getPersonId(), $new_mmtp->getRoleId())){
      $result = true;
      $mmtp->delete();
      // sf rompe si se intenta guardar otro mmtemplate con las mismas claves primarias.
    } else if ($result = $new_mmtp->save()){
      $mmtp->delete();
    } else {
      // Hay un error imprevisto al crear el mmtp actualizado
    }

    return $result;
  }
  /**
   * @param MmPerson $mmtp
   * @param Integer $merger_id
   * @return Boolean (existía previamente el nuevo objeto || resultado del save())
   */
  private function actualiza_mmp_nuevo_person_id($mmp, $merger_id){
    $new_mmp = new MmPerson();
    $new_mmp->setMmId($mmp->getMmId());
    $new_mmp->setRoleId($mmp->getRoleId());
    $new_mmp->setPersonId($merger_id);

    if ($already_present = MmPersonPeer::retrieveByPk($new_mmp->getMmId(), $new_mmp->getPersonId(), $new_mmp->getRoleId())){
      $result = true;
      $mmp->delete();
      // sf rompe si se intenta guardar otro mm con las mismas claves primarias.
    } else if ($result = $new_mmp->save()){
      $mmp->delete();
    } else {
      // Hay un error imprevisto al crear el mmp actualizado
    }

    return $result;
  }
}

