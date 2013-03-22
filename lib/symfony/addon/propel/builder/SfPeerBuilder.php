<?php

require_once 'propel/engine/builder/om/php5/PHP5ComplexPeerBuilder.php';

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
 * @version    SVN: $Id: SfPeerBuilder.php 17357 2009-04-16 11:46:01Z FabianLange $
 */
class SfPeerBuilder extends PHP5ComplexPeerBuilder
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
  }

  protected function addSelectMethods(&$script)
  {
    parent::addSelectMethods($script);

    if ($this->getTable()->getAttribute('isI18N'))
    {
      $this->addDoSelectWithI18n($script);
    }
  }

  protected function addDoSelectWithI18n(&$script)
  {
    $table = $this->getTable();
    $thisTableObjectBuilder = OMBuilder::getNewObjectBuilder($table);
    $className = $table->getPhpName();
    $pks = $table->getPrimaryKey();
    $pk = PeerBuilder::getColumnName($pks[0], $className);

    // get i18n table name and culture column name
    foreach ($table->getReferrers() as $fk)
    {
      $tblFK = $fk->getTable();
      if ($tblFK->getName() == $table->getAttribute('i18nTable'))
      {
        $i18nClassName = $tblFK->getPhpName();
        // FIXME
        $i18nPeerClassName = $i18nClassName.'Peer';

        $i18nTable = $table->getDatabase()->getTable($tblFK->getName());
        $i18nTableObjectBuilder = OMBuilder::getNewObjectBuilder($i18nTable);
        $i18nTablePeerBuilder = OMBuilder::getNewPeerBuilder($i18nTable);
        $i18nPks = $i18nTable->getPrimaryKey();
        $i18nPk = PeerBuilder::getColumnName($i18nPks[0], $i18nClassName);

        $culturePhpName = '';
        $cultureColumnName = '';
        foreach ($tblFK->getColumns() as $col)
        {
          if (("true" === strtolower($col->getAttribute('isCulture'))))
          {
            $culturePhpName = $col->getPhpName();
            $cultureColumnName = PeerBuilder::getColumnName($col, $i18nClassName);
          }
        }
      }
    }

    $script .= "

  /**
   * Selects a collection of $className objects pre-filled with their i18n objects.
   *
   * @return array Array of $className objects.
   * @throws PropelException Any exceptions caught during processing will be
   *     rethrown wrapped into a PropelException.
   */
  public static function doSelectWithI18n(Criteria \$c, \$culture = null, \$con = null)
  {
    // we're going to modify criteria, so copy it first
    \$c = clone \$c;
    if (\$culture === null)
    {
      \$culture = sfContext::getInstance()->getUser()->getCulture();
    }

    // Set the correct dbName if it has not been overridden
    if (\$c->getDbName() == Propel::getDefaultDB())
    {
      \$c->setDbName(self::DATABASE_NAME);
    }

    ".$this->getPeerClassname()."::addSelectColumns(\$c);
    \$startcol = (".$this->getPeerClassname()."::NUM_COLUMNS - ".$this->getPeerClassname()."::NUM_LAZY_LOAD_COLUMNS) + 1;

    ".$i18nPeerClassName."::addSelectColumns(\$c);

    \$c->addJoin(".$pk.", ".$i18nPk.");
    \$c->add(".$cultureColumnName.", \$culture);

    ".(($this->getTable()->getColumn('rank'))?("if(count(\$c->getOrderByColumns()) == 0) \$c->addAscendingOrderByColumn(self::RANK);"):(""))."

    \$rs = ".$this->basePeerClassname."::doSelect(\$c, \$con);
    \$results = array();

    while(\$rs->next()) {
";
            if ($table->getChildrenColumn()) {
              $script .= "
      \$omClass = ".$this->getPeerClassname()."::getOMClass(\$rs, 1);
";
            } else {
              $script .= "
      \$omClass = ".$this->getPeerClassname()."::getOMClass();
";
            }
            $script .= "
      \$cls = Propel::import(\$omClass);
      \$obj1 = new \$cls();
      \$obj1->hydrate(\$rs);
      \$obj1->setCulture(\$culture);
";
//            if ($i18nTable->getChildrenColumn()) {
              $script .= "
      \$omClass = ".$i18nTablePeerBuilder->getPeerClassname()."::getOMClass(\$rs, \$startcol);
";
//            } else {
//              $script .= "
//      \$omClass = ".$i18nTablePeerBuilder->getPeerClassname()."::getOMClass();
//";
//            }

            $script .= "
      \$cls = Propel::import(\$omClass);
      \$obj2 = new \$cls();
      \$obj2->hydrate(\$rs, \$startcol);

      \$obj1->set".$i18nClassName."ForCulture(\$obj2, \$culture);
      \$obj2->set".$className."(\$obj1);

      \$results[] = \$obj1;
    }
    return \$results;
  }
";
  }

  protected function addDoValidate(&$script)
  {
      $tmp = '';
      parent::addDoValidate($tmp);

      $script .= str_replace("return {$this->basePeerClassname}::doValidate(".$this->getPeerClassname()."::DATABASE_NAME, ".$this->getPeerClassname()."::TABLE_NAME, \$columns);\n",
        "\$res =  {$this->basePeerClassname}::doValidate(".$this->getPeerClassname()."::DATABASE_NAME, ".$this->getPeerClassname()."::TABLE_NAME, \$columns);\n".
        "    if (\$res !== true) {\n".
        "        \$request = sfContext::getInstance()->getRequest();\n".
        "        foreach (\$res as \$failed) {\n".
        "            \$col = ".$this->getPeerClassname()."::translateFieldname(\$failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);\n".
        "            \$request->setError(\$col, \$failed->getMessage());\n".
        "        }\n".
        "    }\n\n".
        "    return \$res;\n", $tmp);
  }

  protected function addDoSelectRS(&$script)
  {
    $tmp = '';
    parent::addDoSelectRS($tmp);

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      $mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:addDoSelectRS:addDoSelectRS') as \$callable)
    {
      call_user_func(\$callable, '{$this->getClassname()}', \$criteria, \$con);
    }

";
      $tmp = preg_replace('/{/', '{'.$mixer_script, $tmp, 1);
    }


    /************************************************************
     *******************   ORDER DEFAULT   **********************
     ************************************************************/
    if ($this->getTable()->getColumn('rank')){
      $tmp = str_replace('$criteria->setDbName(self::DATABASE_NAME);',
			     "\$criteria->setDbName(self::DATABASE_NAME);\n\n".
			     "        //ADD DEFAULT ORDER\n".
                             "        if(count(\$criteria->getOrderByColumns()) == 0)\n".
			     "            \$criteria->addAscendingOrderByColumn(self::RANK);", $tmp);
    }


    $script .= $tmp;
  }

  protected function addDoUpdate(&$script)
  {
    $tmp = '';
    parent::addDoUpdate($tmp);

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      // add sfMixer call
      $pre_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:doUpdate:pre') as \$callable)
    {
      \$ret = call_user_func(\$callable, '{$this->getClassname()}', \$values, \$con);
      if (false !== \$ret)
      {
        return \$ret;
      }
    }

";

      $post_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:doUpdate:post') as \$callable)
    {
      call_user_func(\$callable, '{$this->getClassname()}', \$values, \$con, \$ret);
    }

    return \$ret;
";

      $tmp = preg_replace('/{/', '{'.$pre_mixer_script, $tmp, 1);
      $tmp = preg_replace("/\t\treturn ([^}]+)/", "\t\t\$ret = $1".$post_mixer_script.'  ', $tmp, 1);
    }

    $script .= $tmp;
  }

  protected function addDoInsert(&$script)
  {
    $tmp = '';
    parent::addDoInsert($tmp);

    if (DataModelBuilder::getBuildProperty('builderAddBehaviors'))
    {
      // add sfMixer call
      $pre_mixer_script = "

    foreach (sfMixer::getCallables('{$this->getClassname()}:doInsert:pre') as \$callable)
    {
      \$ret = call_user_func(\$callable, '{$this->getClassname()}', \$values, \$con);
      if (false !== \$ret)
      {
        return \$ret;
      }
    }

";

      $post_mixer_script = "
    foreach (sfMixer::getCallables('{$this->getClassname()}:doInsert:post') as \$callable)
    {
      call_user_func(\$callable, '{$this->getClassname()}', \$values, \$con, \$pk);
    }

    return";

      $tmp = preg_replace('/{/', '{'.$pre_mixer_script, $tmp, 1);
      $tmp = preg_replace("/\t\treturn/", "\t\t".$post_mixer_script, $tmp, 1);
    }

    $script .= $tmp;
  }

  /*MY*/
  protected function addRetrieveByPKMethods(&$script)
  {
    parent::addRetrieveByPKMethods($script);

    if ($this->getTable()->getAttribute('isI18N'))
    {
      if (count($this->getTable()->getPrimaryKey()) === 1) {
	$this->addRetrieveByPKWithI18n_SinglePK($script);
	$this->addRetrieveByPKsWithI18n_SinglePK($script);
      } else {
	//Not necessary
	//$this->addRetrieveByPKWithI18n_MultiPK($script);
      }
    }
  }



  /*MY*/
  /**
   * Adds the retrieveByPKWithI18n method for tables with single-column primary key.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addRetrieveByPKWithI18n_SinglePK(&$script)
  {
    $table = $this->getTable();
    $script .= "
	/**
	 * Retrieve a single object by pkey with their i18n objects.
	 *
	 * @param      mixed \$pk the primary key.
	 * @param      Connection \$con the connection to use
	 * @return     " . $table->getPhpName() . "
	 */
	public static function ".$this->getRetrieveMethodName()."WithI18n(\$pk, \$culture = null, \$con = null)
	{
		if (\$con === null) {
			\$con = Propel::getConnection(self::DATABASE_NAME);
		}

		\$criteria = new Criteria(".$this->getPeerClassname()."::DATABASE_NAME);
";
    if (count($table->getPrimaryKey()) === 1) {
      $pkey = $table->getPrimaryKey();
      $col = array_shift($pkey);
      $script .= "
		\$criteria->add(".$this->getColumnConstant($col).", \$pk);
";
    } else {
      // primary key is composite; we therefore, expect
      // the primary key passed to be an array of pkey
      // values
      $i=0;
      foreach($table->getPrimaryKey() as $col) {
	$script .= "
		\$criteria->add(".$this->getColumnConstant($col).", \$pk[$i]);";
	$i++;
      }
    } /* if count(table.PrimaryKeys) */
    $script .= "

		\$v = ".$this->getPeerClassname()."::doSelectWithI18n(\$criteria, \$culture, \$con);

		return !empty(\$v) > 0 ? \$v[0] : null;
	}
";
  }


  /*MY*/
  /**
   * Adds the retrieveByPKs method for tables with single-column primary key.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addRetrieveByPKsWithI18n_SinglePK(&$script)
  {
    $table = $this->getTable();
    $script .= "
	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array \$pks List of primary keys with their i18n objects.
	 * @param      Connection \$con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function ".$this->getRetrieveMethodName()."sWithI18n(\$pks, \$culture = null, \$con = null)
	{
		if (\$con === null) {
			\$con = Propel::getConnection(self::DATABASE_NAME);
		}

		\$objs = null;
		if (empty(\$pks)) {
			\$objs = array();
		} else {
			\$criteria = new Criteria();";
    if (count($table->getPrimaryKey()) == 1) {
      $k1 = $table->getPrimaryKey();
      $script .= "
			\$criteria->add(".$this->getColumnConstant($k1[0]).", \$pks, Criteria::IN);";
    } else {
      $script .= "
			foreach(\$pks as \$pk) {";
      $i = 0;
      foreach($table->getPrimaryKey() as $col) {
	$script .= "
				\$c{$i} = \$criteria->getNewCriterion(".$this->getPeerClassname($col).", \$pk[$i], Criteria::EQUAL);";
	$j = $i - 1;
	if ($i > 0) {
	  $script .= "
				\$c{$j}->addAnd(\$c{$i});";
	} /* if $i > 0 */
	$i++;
      } /* foreach */
      
      $script .= "

				\$criteria->addOr(\$c0);
			}";
    } /* if count prim keys == 1 */
    $script .= "
			\$objs = ".$this->getPeerClassname()."::doSelectWithI18n(\$criteria, \$culture, \$con);
		}
		return \$objs;
	}
";
  }


  /*MY*/
  /**
   * Adds the retrieveByPK method for tables with multi-column primary key.
   * @param      string &$script The script will be modified in this method.
   */
  protected function addRetrieveByPKWithI18n_MultiPK(&$script)
  {
    $table = $this->getTable();
    $script .= "
	/**
	 * Retrieve object using using composite pkey values.
	 * ";
    foreach ($table->getPrimaryKey() as $col) {
      $clo = strtolower($col->getName());
      $cptype = $col->getPhpNative();
      $script .= "@param $cptype $".$clo."
	   ";
    }
    $script .= "
	 * @param      Connection \$con
	 * @return     ".$table->getPhpName()."
	 */
	public static function ".$this->getRetrieveMethodName()."WithI18n(";
    $co = 0;
    foreach ($table->getPrimaryKey() as $col) {
      $clo = strtolower($col->getName());
      $script .= ($co++ ? "," : "") . " $".$clo;
    } /* foreach */
    $script .= ", \$culture = null, \$con = null) {
		if (\$con === null) {
			\$con = Propel::getConnection(self::DATABASE_NAME);
		}
		\$criteria = new Criteria();";
    foreach ($table->getPrimaryKey() as $col) {
      $clo = strtolower($col->getName());
      $script .= "
		\$criteria->add(".$this->getColumnConstant($col).", $".$clo.");";
    }
    $script .= "
		\$v = ".$this->getPeerClassname()."::doSelectWithI18n(\$criteria, \$culture, \$con);

		return !empty(\$v) ? \$v[0] : null;
	}";
  }

}
