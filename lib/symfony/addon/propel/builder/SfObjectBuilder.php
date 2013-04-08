<?php

require_once 'propel/engine/builder/om/php5/PHP5ComplexObjectBuilder.php';

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage addon
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: SfObjectBuilder.php 3493 2007-02-18 09:23:10Z fabien $
 */
class SfObjectBuilder extends PHP5ComplexObjectBuilder
{
  public function build()
  {
    if (!DataModelBuilder::getBuildProperty('builderAddComments'))
    {
      return sfToolkit::stripComments(parent::build());
    }
    
    return parent::build();
  }

  protected function addIncludes(&$script)
  {
    if (!DataModelBuilder::getBuildProperty('builderAddIncludes'))
    {
      return;
    }

    parent::addIncludes($script);

    // include the i18n classes if needed
    if ($this->getTable()->getAttribute('isI18N'))
    {
      $relatedTable   = $this->getDatabase()->getTable($this->getTable()->getAttribute('i18nTable'));

      $script .= '
require_once \''.$this->getFilePath($this->getStubObjectBuilder()->getPackage().'.'.$relatedTable->getPhpName().'Peer').'\';
require_once \''.$this->getFilePath($this->getStubObjectBuilder()->getPackage().'.'.$relatedTable->getPhpName()).'\';
';
    }
  }

  protected function addClassBody(&$script)
  {
    parent::addClassBody($script);
    $this->addClearAllReferences($script);

    if ($this->getTable()->getAttribute('isI18N'))
    {
      if (count($this->getTable()->getPrimaryKey()) > 1)
      {
        throw new Exception('i18n support only works with a single primary key');
      }

      $this->addCultureAccessorMethod($script);
      $this->addCultureMutatorMethod($script);

      $this->addI18nMethods($script);
    }

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      $this->addCall($script);
    }
  }

  protected function addCall(&$script)
  {
    $script .= "

  public function __call(\$method, \$arguments)
  {
    if (!\$callable = sfMixer::getCallable('{$this->getClassname()}:'.\$method))
    {
      throw new sfException(sprintf('Call to undefined method {$this->getClassname()}::%s', \$method));
    }

    array_unshift(\$arguments, \$this);

    return call_user_func_array(\$callable, \$arguments);
  }

";
  }

  protected function addAttributes(&$script)
  {
    parent::addAttributes($script);

    if ($this->getTable()->getAttribute('isI18N'))
    {
      $script .= '
  /**
   * The value for the culture field.
   * @var string
   */
  protected $culture;
';
    }
  }

  protected function addCultureAccessorMethod(&$script)
  {
    $script .= '
  public function getCulture()
  {
    return $this->culture;
  }
';
  }

  protected function addCultureMutatorMethod(&$script)
  {
    $script .= '
  public function setCulture($culture)
  {
    $this->culture = $culture;
  }
';
  }

  protected function addI18nMethods(&$script)
  {
    $table = $this->getTable();
    $pks = $table->getPrimaryKey();
    $pk = $pks[0]->getPhpName();

    foreach ($table->getReferrers() as $fk)
    {
      $tblFK = $fk->getTable();
      if ($tblFK->getName() == $table->getAttribute('i18nTable'))
      {
        $className = $tblFK->getPhpName();
        $culture = '';
        $culture_peername = '';
        foreach ($tblFK->getColumns() as $col)
        {
          if (("true" === strtolower($col->getAttribute('isCulture'))))
          {
            $culture = $col->getPhpName();
            $culture_peername = PeerBuilder::getColumnName($col, $className);
          }
        }

        foreach ($tblFK->getColumns() as $col)
        {
          if ($col->isPrimaryKey()) continue;

          $script .= '
  public function get'.$col->getPhpName().'()
  {
    $obj = $this->getCurrent'.$className.'();

    return ($obj ? $obj->get'.$col->getPhpName().'() : null);
  }

  public function set'.$col->getPhpName().'($value)
  {
    $this->getCurrent'.$className.'()->set'.$col->getPhpName().'($value);
  }
';
        }

$script .= '
  protected $current_i18n = array();

  public function getCurrent'.$className.'()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = '.$className.'Peer::retrieveByPK($this->get'.$pk.'(), $this->culture);
      if ($obj)
      {
        $this->set'.$className.'ForCulture($obj, $this->culture);
      }
      else
      {
        $this->set'.$className.'ForCulture(new '.$className.'(), $this->culture);
        $this->current_i18n[$this->culture]->set'.$culture.'($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function set'.$className.'ForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->add'.$className.'($object);
  }
';
      }
    }
  }

  protected function addDoSave(&$script)
  {
    $tmp = '';
    parent::addDoSave($tmp);
    // add autosave to i18n object even if the base object is not changed
    $tmp = preg_replace_callback('#(\$this\->(.+?)\->isModified\(\))#', array($this, 'i18nDoSaveCallback'), $tmp);

    $script .= $tmp;
  }

  private function i18nDoSaveCallback($matches)
  {
    $value = $matches[1];

    // get the related class to see if it is a i18n one
    $table = $this->getTable();
    $column = null;
    foreach ($table->getForeignKeys() as $fk)
    {
      if ($matches[2] == $this->getFKVarName($fk))
      {
        $column = $fk;
        break;
      }
    }
    $foreign_table = $this->getDatabase()->getTable($fk->getForeignTableName());
    if ($foreign_table->getAttribute('isI18N'))
    {
      $foreign_tables_i18n_table = $this->getDatabase()->getTable($foreign_table->getAttribute('i18nTable'));
      $value .= ' || $this->'.$matches[2].'->getCurrent'.$foreign_tables_i18n_table->getPhpName().'()->isModified()';
    }

    return $value;
  }

  protected function addDelete(&$script)
  {
    $tmp = '';
    parent::addDelete($tmp);

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      // add sfMixer call
      $pre_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:delete:pre') as \$callable)
    {
      \$ret = call_user_func(\$callable, \$this, \$con);
      if (\$ret)
      {
        return;
      }
    }

";
      $post_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:delete:post') as \$callable)
    {
      call_user_func(\$callable, \$this, \$con);
    }

";
      $tmp = preg_replace('/{/', '{'.$pre_mixer_script, $tmp, 1);
      $tmp = preg_replace('/}\s*$/', $post_mixer_script.'  }', $tmp);
    }

    // update current script
    $script .= $tmp;
  }

  protected function addSave(&$script)
  {
    $tmp = '';
    parent::addSave($tmp);

    // add support for created_(at|on) and updated_(at|on) columns
    $date_script = '';
    $updated = false;
    $created = false;
    foreach ($this->getTable()->getColumns() as $col)
    {
      $clo = strtolower($col->getName());

      if (!$updated && in_array($clo, array('updated_at', 'updated_on')))
      {
        $updated = true;
        $date_script .= "
    if (\$this->isModified() && !\$this->isColumnModified(".$this->getColumnConstant($col)."))
    {
      \$this->set".$col->getPhpName()."(time());
    }
";
      }
      else if (!$created && in_array($clo, array('created_at', 'created_on')))
      {
        $created = true;
        $date_script .= "
    if (\$this->isNew() && !\$this->isColumnModified(".$this->getColumnConstant($col)."))
    {
      \$this->set".$col->getPhpName()."(time());
    }
";
      }
    }
    $tmp = preg_replace('/{/', '{'.$date_script, $tmp, 1);

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      // add sfMixer call
      $pre_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:save:pre') as \$callable)
    {
      \$affectedRows = call_user_func(\$callable, \$this, \$con);
      if (is_int(\$affectedRows))
      {
        return \$affectedRows;
      }
    }

";
      $post_mixer_script = <<<EOF

    foreach (sfMixer::getCallables('{$this->getClassname()}:save:post') as \$callable)
    {
      call_user_func(\$callable, \$this, \$con, \$affectedRows);
    }

EOF;
      $tmp = preg_replace('/{/', '{'.$pre_mixer_script, $tmp, 1);
      $tmp = preg_replace('/(\$con\->commit\(\);)/', '$1'.$post_mixer_script, $tmp);
    }

    // update current script
    $script .= $tmp;
  }




  /*My*/
  /**
   * Adds the hydrate() method, which sets attributes of the object based on a ResultSet.
   */
  protected function addHydrate(&$script)
  {
    $tmp = '';
    $new = (!$this->getTable()->getAttribute('isI18N'))?"\$this->setNew(false);":"\$this->setNew(false);
			\$this->setCulture(sfContext::getInstance()->getUser()->getCulture());";
    parent::addHydrate($tmp);
    // add autosave to i18n object even if the base object is not changed
    $tmp = str_replace('$this->setNew(false);', $new, $tmp);
    
    $script .= $tmp;
  }


  /*My*/
  /**
   * Adds the methods that get & set objects related by foreign key to the current object.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addFKMethods(&$script)
  {
    foreach ($this->getTable()->getForeignKeys() as $fk) {
      $this->addFKMutator($script, $fk);
      $this->addFKAccessor($script, $fk);
      
      if($this->getForeignTable($fk)->getAttribute('isI18N'))
      {
      	$this->addFKAccessorWithI18n($script, $fk);
      }
      
    } // foreach fk
  }


  /*My*/
  /**
   * Adds the accessor (getter) method for getting an fkey related object.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addFKAccessorWithI18n(&$script, ForeignKey $fk)
  {
    $table = $this->getTable();
    
    $className = $this->getForeignTable($fk)->getPhpName();
    $varName = $this->getFKVarName($fk);

    $and = "";
    $comma = "";
    $conditional = "";
    $arglist = "";
    $argsize = 0;
    foreach ($fk->getLocalColumns() as $columnName) {
      $column = $table->getColumn($columnName);
      $cptype = $column->getPhpNative();
      $clo = strtolower($column->getName());
      
      // FIXME: is this correct? what about negative numbers?
      if ($cptype == "integer" || $cptype == "float" || $cptype == "double") {
	$conditional .= $and . "\$this->". $clo ." > 0";
      } elseif($cptype == "string") {
	$conditional .= $and . "(\$this->" . $clo ." !== \"\" && \$this->".$clo." !== null)";
      } else {
	$conditional .= $and . "\$this->" . $clo ." !== null";
      }
      $arglist .= $comma . "\$this->" . $clo;
      $and = " && ";
      $comma = ", ";
      $argsize = $argsize + 1;
    }
    
    $pCollName = $this->getFKPhpNameAffix($fk, $plural = true);
    
    $fkPeerBuilder = OMBuilder::getNewPeerBuilder($this->getForeignTable($fk));
    
    $script .= "

	/**
	 * Get the associated $className object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     $className The associated $className object.
	 * @throws     PropelException
	 */
	public function get".$this->getFKPhpNameAffix($fk, $plural = false)."WithI18n(\$con = null)
	{
		if (\$this->$varName === null && ($conditional)) {
			// include the related Peer class
			include_once '".$fkPeerBuilder->getClassFilePath()."';
";
    $script .= "
			\$this->$varName = ".$fkPeerBuilder->getPeerClassname()."::".$fkPeerBuilder->getRetrieveMethodName()."WithI18n($arglist, \$this->getCulture(), \$con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   \$obj = ".$fkPeerBuilder->getPeerClassname()."::retrieveByPKWithI18n($arglist, \$this->getCulture(), \$con);
			   \$obj->add$pCollName(\$this);
			 */
		}
		return \$this->$varName;
	}
";
    
  } // addFKAccessor  



  /*My*/
  /**
   * Adds the methods for retrieving, initializing, adding objects that are related to this one by foreign keys.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addRefFKMethods(&$script)
  {
    foreach($this->getTable()->getReferrers() as $refFK) {
      // if ( $refFK->getTable()->getName() != $this->getTable()->getName() ) {
      $this->addRefFKInit($script, $refFK);
      $this->addRefFKGet($script, $refFK);
      $this->addRefFKCount($script, $refFK);
      $this->addRefFKAdd($script, $refFK);
      $this->addRefFKGetJoinMethods($script, $refFK);

      if($this->getTable()->getDatabase()->getTable($refFK->getTableName())->getAttribute('isI18N'))
      {
	$this->addRefFKGetWithI18n($script, $refFK);
      }
      // }
    }
  }


  /*My*/
  /**
   * Adds the method that returns the referrer fkey collection.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addRefFKGetWithI18n(&$script, ForeignKey $refFK)
  {
    $table = $this->getTable();
    $tblFK = $refFK->getTable();
    
    $fkPeerBuilder = OMBuilder::getNewPeerBuilder($refFK->getTable());
    $relCol = $this->getRefFKPhpNameAffix($refFK, $plural = true);
    
    $collName = $this->getRefFKCollVarName($refFK);
    $lastCriteriaName = $this->getRefFKLastCriteriaVarName($refFK);
    
    $script .= "
	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this ".$table->getPhpName()." has previously
	 * been saved, it will retrieve related $relCol from storage.
	 * If this ".$table->getPhpName()." is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection \$con
	 * @param      Criteria \$criteria
	 * @throws     PropelException
	 */
	public function get${relCol}WithI18n(\$criteria = null, \$con = null)
	{
		// include the Peer class
		include_once '".$fkPeerBuilder->getClassFilePath()."';
		if (\$criteria === null) {
			\$criteria = new Criteria();
		}
		elseif (\$criteria instanceof Criteria)
		{
			\$criteria = clone \$criteria;
		}

		if (\$this->$collName === null) {
			if (\$this->isNew()) {
			   \$this->$collName = array();
			} else {
";
    foreach ($refFK->getLocalColumns() as $colFKName) {
      // $colFKName is local to the referring table (i.e. foreign to this table)
      $lfmap = $refFK->getLocalForeignMapping();
      $localColumn = $this->getTable()->getColumn($lfmap[$colFKName]);
      $colFK = $refFK->getTable()->getColumn($colFKName);
      
      $script .= "
				\$criteria->add(".$fkPeerBuilder->getColumnConstant($colFK).", \$this->get".$localColumn->getPhpName()."());
";
    } // end foreach ($fk->getForeignColumns()
    
    $script .= "
				\$this->$collName = ".$fkPeerBuilder->getPeerClassname()."::doSelectWithI18n(\$criteria, \$this->getCulture(), \$con);
			}
		} else {
			// criteria has no effect for a new object
			if (!\$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.
";
    foreach ($refFK->getLocalColumns() as $colFKName) {
      // $colFKName is local to the referring table (i.e. foreign to this table)
      $lfmap = $refFK->getLocalForeignMapping();
      $localColumn = $this->getTable()->getColumn($lfmap[$colFKName]);
      $colFK = $refFK->getTable()->getColumn($colFKName);
      $script .= "

				\$criteria->add(".$fkPeerBuilder->getColumnConstant($colFK).", \$this->get".$localColumn->getPhpName()."());
";
    } // foreach ($fk->getForeignColumns()
    $script .= "
				if (!isset(\$this->$lastCriteriaName) || !\$this->".$lastCriteriaName."->equals(\$criteria)) {
					\$this->$collName = ".$fkPeerBuilder->getPeerClassname()."::doSelectWithI18n(\$criteria, \$this->getCulture(), \$con);
				}
			}
		}
		\$this->$lastCriteriaName = \$criteria;
		return \$this->$collName;
	}
";
  } // addRefererGet()



	/**
	 * Adds clearAllReferencers() method which resets all the collections of referencing
	 * fk objects.
	 * @param      string &$script The script will be modified in this method.
	 */
	protected function addClearAllReferences(&$script)
	{
		$table = $this->getTable();
		$script .= "
	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean \$deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences(\$deep = false)
	{
		if (\$deep) {";
		$vars = array();
		//Mio$f = create_function('$a', 'return $a->getName();');
		//Mio$aux=$this->getTable()->getReferrers();$aux= array_map($f, $aux);var_dump($aux); return;
               

		foreach ($table->getReferrers() as $refFK) {

		  $varName = $this->getRefFKCollVarName($refFK);
		  $vars[] = $varName;
		  $script .= "
			if (\$this->$varName) {
				foreach ((array) \$this->$varName as \$o) {
					\$o->clearAllReferences(\$deep);
				}
			}";
		  

		}
                
		foreach ($table->getForeignKeys() as $fk) {
		  $varName = $this->getFKVarName($fk);
		  $vars[] = $varName;
		  //$script .= "
		  //	if (\$this->$varName) {
		  //		\$this->{$varName}->clearAllReferences(\$deep);
		  //	}";
                }
		
		$script .= "
		} // if (\$deep)
";

		foreach ($vars as $varName) {
			$script .= "
		\$this->$varName = null;";
		}

		$script .= "
	}
";
	}

}

