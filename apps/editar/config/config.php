<?php

// include project configuration
include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

// propel behavior definition
sfPropelBehavior::registerHooks('sortable', array(
						  ':save:pre'   => array('SortableBehavior', 'preSave'),
						  ':delete:pre' => array('SortableBehavior', 'preDelete'),
						  ));

sfPropelBehavior::registerMethods('sortable', array (
						     array ('SortableBehavior', 'getPosition'),
						     array ('SortableBehavior', 'setPosition'),
						     array ('SortableBehavior', 'swapWith'),
						     array ('SortableBehavior', 'getNext'),
						     array ('SortableBehavior', 'getPrevious'),
						     array ('SortableBehavior', 'isFirst'),
						     array ('SortableBehavior', 'isLast'),
						     array ('SortableBehavior', 'moveUp'),
						     array ('SortableBehavior', 'moveDown'),
						     array ('SortableBehavior', 'moveToPosition'),
						     array ('SortableBehavior', 'moveToBottom'),
						     array ('SortableBehavior', 'moveToTop'),
						     array ('SortableBehavior', 'insertAtPosition'),
						     ));

sfPropelBehavior::registerHooks('sortableFk', array(
						  ':save:pre'   => array('SortableFKBehavior', 'preSave'),
						  ':delete:pre' => array('SortableFKBehavior', 'preDelete'),
						  ));

sfPropelBehavior::registerMethods('sortableFk', array (
						     array ('SortableFKBehavior', 'getPosition'),
						     array ('SortableFKBehavior', 'setPosition'),
						     array ('SortableFKBehavior', 'swapWith'),
						     array ('SortableFKBehavior', 'getNext'),
						     array ('SortableFKBehavior', 'getPrevious'),
						     array ('SortableFKBehavior', 'isFirst'),
						     array ('SortableFKBehavior', 'isLast'),
						     array ('SortableFKBehavior', 'moveUp'),
						     array ('SortableFKBehavior', 'moveDown'),
						     array ('SortableFKBehavior', 'moveToPosition'),
						     array ('SortableFKBehavior', 'moveToBottom'),
						     array ('SortableFKBehavior', 'moveToTop'),
						     array ('SortableFKBehavior', 'insertAtPosition'),
						     ));

sfPropelBehavior::registerHooks('sortableFk2', array(
						  ':save:pre'   => array('SortableFK2Behavior', 'preSave'),
						  ':delete:pre' => array('SortableFK2Behavior', 'preDelete'),
						  ));

sfPropelBehavior::registerMethods('sortableFk2', array (
						     array ('SortableFK2Behavior', 'getPosition'),
						     array ('SortableFK2Behavior', 'setPosition'),
						     array ('SortableFK2Behavior', 'swapWith'),
						     array ('SortableFK2Behavior', 'getNext'),
						     array ('SortableFK2Behavior', 'getPrevious'),
						     array ('SortableFK2Behavior', 'isFirst'),
						     array ('SortableFK2Behavior', 'isLast'),
						     array ('SortableFK2Behavior', 'moveUp'),
						     array ('SortableFK2Behavior', 'moveDown'),
						     array ('SortableFK2Behavior', 'moveToPosition'),
						     array ('SortableFK2Behavior', 'moveToBottom'),
						     array ('SortableFK2Behavior', 'moveToTop'),
						     array ('SortableFK2Behavior', 'insertAtPosition'),
						     ));

sfPropelBehavior::registerMethods('default_select', array (
							   array ('DefaultSelectBehavior', 'setDefaultSelect'),
							   ));


sfPropelBehavior::registerMethods('pic', array (
						array ('PicBehavior', 'getFirstPic'),
						array ('PicBehavior', 'getLastPic'),
						array ('PicBehavior', 'getPics'),
						array ('PicBehavior', 'getFirstUrlPic'),
						array ('PicBehavior', 'getLastUrlPic'),
						array ('PicBehavior', 'getUrlPics'),
						array ('PicBehavior', 'setPic'),
						array ('PicBehavior', 'setPicId'),
						));

sfPropelBehavior::registerHooks('actasnestedset', array(
  ':save:pre'   => array('NestedSetBehavior', 'preSave'),
  ':delete:pre' => array('NestedSetBehavior', 'preDelete'),
));

sfPropelBehavior::registerMethods('actasnestedset', array (
  array ('NestedSetBehavior','getLeftValue'),
  array ('NestedSetBehavior','getRightValue'),
  array ('NestedSetBehavior','getParentIdValue'),
  array ('NestedSetBehavior','getScopeIdValue'),
  array ('NestedSetBehavior','setLeftValue'),
  array ('NestedSetBehavior','setRightValue'),
  array ('NestedSetBehavior','setParentIdValue'),
  array ('NestedSetBehavior','setScopeIdValue'),
  array ('NestedSetBehavior','makeRoot'),
  array ('NestedSetBehavior','insertAsFirstChildOf'),
  array ('NestedSetBehavior','insertAsLastChildOf'),
  array ('NestedSetBehavior','insertAsNextSiblingOf'),
  array ('NestedSetBehavior','insertAsPrevSiblingOf'),
  array ('NestedSetBehavior','insertAsParentOf'),
  array ('NestedSetBehavior','hasChildren'),
  array ('NestedSetBehavior','getChildren'),
  array ('NestedSetBehavior','getParent'),
  array ('NestedSetBehavior','getNumberOfChildren'),
  array ('NestedSetBehavior','getDescendants'),
  array ('NestedSetBehavior','getNumberOfDescendants'),
  array ('NestedSetBehavior','isRoot'),
  array ('NestedSetBehavior','hasParent'),
  array ('NestedSetBehavior','hasNextSibling'),
  array ('NestedSetBehavior','hasPrevSibling'),
  array ('NestedSetBehavior','isLeaf'),
  array ('NestedSetBehavior','isEqualTo'),
  array ('NestedSetBehavior','isChildOf'),
  array ('NestedSetBehavior','isDescendantOf'),
  array ('NestedSetBehavior','moveToFirstChildOf'),
  array ('NestedSetBehavior','moveToLastChildOf'),
  array ('NestedSetBehavior','moveToNextSiblingOf'),
  array ('NestedSetBehavior','moveToPrevSiblingOf'),
  array ('NestedSetBehavior','deleteChildren'),
  array ('NestedSetBehavior','deleteDescendants'),
  array ('NestedSetBehavior','retrieveFirstChild'),
  array ('NestedSetBehavior','retrieveLastChild'),
  array ('NestedSetBehavior','retrieveNextSibling'),
  array ('NestedSetBehavior','retrievePrevSibling'),
  array ('NestedSetBehavior','retrieveParent'),
  array ('NestedSetBehavior','retrieveSiblings'),
  array ('NestedSetBehavior','getLevel'),
  array ('NestedSetBehavior','setLevel'),
  array ('NestedSetBehavior','getPath'),
  array ('NestedSetBehavior','reload'),
));

