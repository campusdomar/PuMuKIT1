<?php
/**
 * MODULO INDEX COMPONENTS. 
 * Modulo de configuracion de los usuarios que tienen acceso a la aplicacion de administracion.
 * Permite la creacion, edicion y eliminacion de los usuarios. 
 * Compone, en el menu, el unico elemento de la seccion de configuracion.  
 *
 *
 * @package    pumukit
 * @subpackage users
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 */

class usersComponents extends sfComponents
{

  /**
   * -- LIST -- _list
   * Crea una tabla paginada donde se listan los usuarios, asi como botones para su edicion,
   * clonacion y eliminacioon. La lista se pagina de 9 en 9 elementos.
   *
   */
  public function executeList()
  {
    $limit  = 9;
    $offset = 0;

    $c = new Criteria();
    $c->addAscendingOrderByColumn(UserPeer::ID);

    $this->processFilters($c);

    $cTotal = clone $c;

    if ($this->hasRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'tv_admin/user');
    }

    if ($this->getUser()->hasAttribute('page', 'tv_admin/user') )
    {
      $this->page = $this->getUser()->getAttribute('page', null, 'tv_admin/user');
      $offset = ($this->page - 1) * $limit;
      $c->setLimit($limit);
      $c->setOffset($offset);
    }

    $this->total_user = UserPeer::doCount($cTotal);
    $this->total_user_all = UserPeer::doCount(new Criteria());
    $this->total = ceil($this->total_user / $limit); 

    if ($this->total < $this->page)
    {
      $this->getUser()->setAttribute('page',1);
      $this->page = 1;
      $c->setOffset(0);
    }

    $this->users = UserPeer::doSelect($c);
  }

  /*funcion privada que filta la lista de usuario en funcion del formulario de filtrado*/
  protected function processFilters($c)
  {
    if ($this->getRequest()->hasParameter('filter')){
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('tv_admin/user/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'tv_admin/user/filters');
    }

    $filters = $this->getUser()->getAttributeHolder()->getAll('tv_admin/user/filters');

    if (isset($filters['name']) && $filters['name'] !== ''){
      $c->add(UserPeer::NAME, '%' . $filters['name']. '%', Criteria::LIKE);  
    }

  }
}
