<?php

/**
 * Subclass for performing query and update operations on the 'category' table.
 *
 * Las estructura del arbol es:
 * root
 *   UNESCO
 *     110000
 *       111100
 *   DIRECTRIZ
 *     tecnologia
 *     salud
 *
 * @package lib.model
 */ 
class CategoryPeer extends BaseCategoryPeer
{

  const TREE_ARRAY_NODE = 'node';
  const TREE_ARRAY_CHILDREN = 'children';
  const TREE_ARRAY_LEVEL = 'level';

 /**
   * 
   * @access public
   */
  public static function retrieveByCode($code)
  {
    $c = new Criteria();
    $c->setLimit(1);
    $c->add(CategoryPeer::COD, $code);
    //return CategoryPeer::doSelectOne($c);
    $v = CategoryPeer::doSelectWithI18n($c);

    return !empty($v) > 0 ? $v[0] : null;
  }

  public static function retrieveByCod($cod)
  {
    return self::retrieveByCode($cod);
  }

  /**
   * Encuentra una categoría por su nombre I18N y categoría padre.
   * @access public
   */
  public static function retrieveByName($name, $parent = null)
  {
    $c = new Criteria();
    $c->addJoin(CategoryPeer::ID, CategoryI18nPeer::ID);
    $c->add(CategoryI18nPeer::NAME, $name);
    if($parent) {
      $c->addAnd(CategoryPeer::TREE_LEFT, $parent->getLeftValue(), Criteria::GREATER_THAN);
      $c->addAnd(CategoryPeer::TREE_RIGHT, $parent->getRightValue(), Criteria::LESS_THAN);
      $c->addAnd(CategoryPeer::SCOPE, $parent->getScopeIdValue(), Criteria::EQUAL);
    }
    
    return CategoryPeer::doSelectOne($c);
  }

  /**
   * like retrieveByName but returns a resultset (all the categories with the given name)
   */
  public static function doSelectByName($name)
  {
    $c = new Criteria();
    $c->addJoin(CategoryPeer::ID, CategoryI18nPeer::ID);
    $c->add(CategoryI18nPeer::NAME, $name);
    
    return CategoryPeer::doSelectWithI18n($c);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectRoot(){
    $c = new Criteria();
    $c->add(CategoryPeer::TREE_PARENT, null, Criteria::ISNULL);

    return CategoryPeer::doSelectOne($c);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectParents()
  {
    $root = self::doSelectRoot();
    if ($root){
      return $root->getChildren();
    }
    return $root;
  }

  /**
   * 
   * @access public
   */
  public static function doSelectAllOrdered()
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(CategoryPeer::TREE_LEFT);
    return CategoryPeer::doSelectWithI18n($c);
  }

  /**
   * 
   * @access public
   */
  public static function buildTreeArray()
  {
    $nodes = self::doSelectAllOrdered();
    $nestedTree = array();
    $l = 0;

    if (count($nodes) > 0) {
      // Node Stack. Used to help building the hierarchy
      $stack = array();
      $stack_debug = array();
      foreach($nodes as $child) {
	// Number of stack items
	$l = count($stack);

	$item = array();
	$item[self::TREE_ARRAY_NODE] = $child; 
	$item[self::TREE_ARRAY_CHILDREN] = array();

	while($l>0 && !$child->isChildOf($stack[$l - 1][self::TREE_ARRAY_NODE])) {
	  array_pop($stack);
	  $l--;
	}
	$item[self::TREE_ARRAY_LEVEL] = $l;
	// Stack is empty (we are inspecting the root)
	if ($l == 0) {
	  // Assigning the root child
	  $i = count($nestedTree);
	  $nestedTree[$i] = $item;
	  $stack[] = &$nestedTree[$i];
	} else {
	  // Add child to parent

	  $i = count($stack[$l - 1][self::TREE_ARRAY_CHILDREN]);
	  $stack[$l - 1][self::TREE_ARRAY_CHILDREN][$i] = $item;
	  $stack[] = &$stack[$l - 1][self::TREE_ARRAY_CHILDREN][$i];
	}
      }
    }

    return $nestedTree;
  }


  private static function printStack($stack)
  {
    $out = "Stack: ";
    foreach($stack as $s){
      $aux = $s[self::TREE_ARRAY_NODE];
      $out .= ($aux->getCod() . ", ");
    }
    return $out;
  }


  /**
   * 
   * @access public
   */
  public static function doSelectRecommended($id)
  {
    $c = new Criteria();
    $c->addJoin(RelationCategoryPeer::TWO_ID, CategoryPeer::ID);
    $c->add(RelationCategoryPeer::RECOMMENDED, true);
    $c->add(RelationCategoryPeer::ONE_ID, $id);

    return CategoryPeer::doSelect($c);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectRecommendedWithI18n($id, $culture = null)
  {
    $c = new Criteria();
    $c->addJoin(RelationCategoryPeer::TWO_ID, CategoryPeer::ID);
    $c->add(RelationCategoryPeer::RECOMMENDED, true);
    $c->add(RelationCategoryPeer::ONE_ID, $id);

    return CategoryPeer::doSelectWithI18n($c, $culture);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectRequired($id)
  {
    $c = new Criteria();
    $c->addJoin(RelationCategoryPeer::TWO_ID, CategoryPeer::ID);
    $c->add(RelationCategoryPeer::RECOMMENDED, false);
    $c->add(RelationCategoryPeer::ONE_ID, $id);

    return CategoryPeer::doSelect($c);
  }

  /**
   * 
   * @access public
   */
  public static function doSelectRequiredWithI18n($id, $culture = null)
  {
    $c = new Criteria();
    $c->addJoin(RelationCategoryPeer::TWO_ID, CategoryPeer::ID);
    $c->add(RelationCategoryPeer::RECOMMENDED, false);
    $c->add(RelationCategoryPeer::ONE_ID, $id);

    return CategoryPeer::doSelectWithI18n($c, $culture);
  }


  /**
   * 
   * @access public
   */
  public static function countMmWithoutCategory($cat)
  {

    $conexion = Propel::getConnection();
    $consulta = 'select count(mm.id) as total from mm where mm.id not in '.
      ' (select distinct mm.id from mm left join category_mm on mm.id = category_mm.mm_id where category_mm.category_id in '.
      ' (select category.id from category where  category.tree_left > %s and category.tree_right < %s));';
    $consulta = sprintf($consulta, $cat->getTreeLeft(), $cat->getTreeRight());
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total');    
  }


  /**
   * 
   * @access public
   */
  public static function countMmWithCategory($cat)
  {

    $conexion = Propel::getConnection();
    $consulta = 'select count(mm.id) as total from mm left join category_mm on mm.id = category_mm.mm_id where category_mm.category_id in '.
      ' (select category.id from category where  category.tree_left > %s and category.tree_right < %s);';
    $consulta = sprintf($consulta, $cat->getTreeLeft(), $cat->getTreeRight());
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total');    
  }

  /**
   * 
   * @access public
   */
  public static function getFirstMmId($cat_id)
  {
    $conexion = Propel::getConnection();

    $consulta = 'select min(mm.id) from mm';
    if ($cat_id == -1){
      $unesco = CategoryPeer::retrieveByCode("UNESCO");
      $consulta = $consulta . " where mm.id not in (select distinct mm.id from mm left join category_mm on mm.id = category_mm.mm_id where category_mm.category_id in " .
        "(select category.id from category where  category.tree_left > " . $unesco->getTreeLeft() . " and category.tree_right < " . $unesco->getTreeRight() . ")) ";
    } else if ($cat_id != 0){
      $consulta = $consulta . ' left join category_mm on mm.id = category_mm.mm_id where category_mm.category_id = %s';
      $consulta = sprintf($consulta, $cat_id);
    }

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('min(mm.id)');
  }


  /**
   * 
   * @access public
   */
  public static function cloneCategoryInMms($mm_src, $mm_sink, $parent_cat=null, $log=false)
  {
    if($mm_src->getId() == $mm_sink->getId()) {
      return true;
    }
    
    $cats = $mm_src->getCategorys();
    $origin_cats = $mm_sink->getCategorys();
    if ((count($origin_cats) - count($cats)) > 4) {
      if ($log) {
	echo "Revisar serie " . $serie->getId() . " que contiene al objeto multimedia " . $mm->getID() . " y su diferencia de categorías es sospechoso (de " . count($origin_cats) . " pasaria a " . count($cats) . ")\n";
	continue;
      }
    }
    //quitar old
    foreach($origin_cats as $c){
      if(($parent_cat == null)||($c->isDescendantOf($parent_cat))) {
	$c->delMmId($mm_sink->getId());
      }
    }
    //meter nuevos
    foreach($cats as $c){
      if(($parent_cat == null)||($c->isDescendantOf($parent_cat))) {
	$c->addMmId($mm_sink->getId());
      }
    }
  }


  /**
   * 
   * @access public
   */
  public static function categorizeAllFrom($mm_src, $serie, $parent_cat=null, $log=false)
  {
    foreach($serie->getMms() as $mm){
      self::cloneCategoryInMms($mm_src, $mm, $parent_cat, $log);
    }
  }

  /**
   * 
   * @access public
   */
  public static function categorizeAllFromFirst($serie, $parent_cat=null, $log=false)
  {
    $mm_src = null;
    foreach($serie->getMms() as $mm){
      if($mm_src == null){
	//Primero
	$mm_src = $mm;
      }else{
	//RESTO
	self::cloneCategoryInMms($mm_src, $mm, $parent_cat, $log);
      }
    }
  }
}
