<?php

/**
 * Subclass for representing a row from the 'category' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Category extends BaseCategory
{

  /**
   * Devuelve codigo y nombre de la categoria
   */
  public function getCodName($sep = " - ")
  {
    return $this->getCod() . $sep . $this->getName();
  }

  /**
   * Asocio el objeto multimedia a dicho category, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $mm_id
   */
  public function addMmId($mm_id)
  {
    if(!$this->getMetacategory()){
      $cv =  CategoryMmPeer::retrieveByPK($this->getId(), $mm_id);
      if (!$cv){
      	$cv = new CategoryMm();
      	$cv->setMmId($mm_id);
      	$cv->setCategoryId($this->getId());
      	$cv->save();
      	
      	//Inc num mm.
      	$this->setNumMm($this->getNumMm() + 1);
      	$this->save();

      	return True;
      }
    }

    return False;
  }

  /**
   * Asocio la plantilla objeto multimedia a dicho category, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $mm_id
   */
  public function addMmTemplateId($mm_id)
  {
    if(!$this->getMetacategory()){
      $cv =  CategoryMmTemplatePeer::retrieveByPK($this->getId(), $mm_id);
      if (!$cv){
      	$cv = new CategoryMmTemplate();
      	$cv->setMmTemplateId($mm_id);
      	$cv->setCategoryId($this->getId());
      	$cv->save();
      	
      	return True;
      }
    }

    return False;
  }

  /** 
   * Adds the mm to the current category and all parent categories included
   * in the path.
   *
   * @access public
   * @param integer $mm_id
   *
   */
  public function addMmIdAndUpdateCategoryTree($mm_id)
  {
    $add_cats = array();
    $category = $this;
    foreach($category->getPath() as $p){
      if($p->addMmId($mm_id)){
        $add_cats[] = $p;
      }
    }
    if($category->addMmId($mm_id)){
      $add_cats[] = $category;
    }

    return $add_cats;
  }




  /**
   * Asocio el objeto multimedia a dicho category, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $mm_id
   */
  public function delMmId($mm_id)
  {
    if(!$this->getMetacategory()){
      $cv =  CategoryMmPeer::retrieveByPK($this->getId(), $mm_id);
      if ($cv){
	$cv->delete();
	
	//Dec num mm.
	$this->setNumMm($this->getNumMm() -1);
	$this->save();

	return True;
      }
    }
    return False;
  }



  /**
   * Asocio el objeto multimedia a dicho category, si no esta asociado antes.
   *
   * @access public
   * @parameter integer $mm_id
   */
  public function delMmTemplateId($mm_id)
  {
    if(!$this->getMetacategory()){
      $cv =  CategoryMmTemplatePeer::retrieveByPK($this->getId(), $mm_id);
      if ($cv){
	$cv->delete();
	return True;
      }
    }
    return False;
  }



  /**
   * 
   * @access public
   */
  public function getRecommended()
  {
    return CategoryPeer::doSelectRecommended($this->getId());
  }


  /**
   * 
   * @access public
   */
  public function getRecommendedWithI18n()
  {
    return CategoryPeer::doSelectRecommendedWithI18n($this->getId(), $this->getCulture());
  }


  /**
   * 
   * @access public
   */
  public function getRequired()
  {
    return CategoryPeer::doSelectRequired($this->getId());
  }


  /**
   * 
   * @access public
   */
  public function getRequiredWithI18n()
  {
    return CategoryPeer::doSelectRequiredWithI18n($this->getId(), $this->getCulture());
  }

  /**
   * Devuelve la lista de Mms de una categoría
   * @access public
   * @param  Category $parent
   * @return ResulSet of Categorys.
   */
  public function getMms($parent = null)
  {
    $c = new Criteria();

    $c->addJoin(MmPeer::ID, CategoryMmPeer::MM_ID);
    $c->add(CategoryMmPeer::CATEGORY_ID, $this->getId());
    $c->addAscendingOrderByColumn(MmPeer::ID);
    if($parent) {
      $c->addAnd(CategoryPeer::TREE_LEFT, $parent->getLeftValue(), Criteria::GREATER_THAN);
      $c->addAnd(CategoryPeer::TREE_RIGHT, $parent->getRightValue(), Criteria::LESS_THAN);
      $c->addAnd(CategoryPeer::SCOPE, $parent->getScopeIdValue(), Criteria::EQUAL);
 
    }

    return MmPeer::doSelect($c);
  }

  /**
   *
   */
  public function countPublicMms()
  {

    $conexion = Propel::getConnection();
    $consulta = "SELECT count( DISTINCT mm.ID) as total FROM mm, pub_channel_mm, broadcast_type, category_mm, serial, broadcast "
      ."WHERE pub_channel_mm.PUB_CHANNEL_ID=1 AND pub_channel_mm.STATUS_ID=1 "
      ."AND mm.STATUS_ID=0 AND broadcast_type.NAME IN ('pub','cor') AND category_mm.CATEGORY_ID=" . $this->getId() . " "
      ."AND serial.ID=mm.SERIAL_ID AND mm.ID=pub_channel_mm.MM_ID AND serial.ID=mm.SERIAL_ID AND mm.BROADCAST_ID=broadcast.ID "
      ."AND broadcast.BROADCAST_TYPE_ID=broadcast_type.ID AND mm.ID=category_mm.MM_ID AND pub_channel_mm.MM_ID=mm.ID AND "
      ."mm.BROADCAST_ID=broadcast.ID AND broadcast.BROADCAST_TYPE_ID=broadcast_type.ID";

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total');
  }


}

$columns_map = array(
  'left'   => CategoryPeer::TREE_LEFT,
  'right'  => CategoryPeer::TREE_RIGHT,
  'parent' => CategoryPeer::TREE_PARENT,
  'scope'  => CategoryPeer::SCOPE
);
 
sfPropelBehavior::add('Category', array('actasnestedset' => array('columns' => $columns_map)));
