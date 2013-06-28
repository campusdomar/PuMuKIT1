<?php

/**
 * Crea un nuevo árbol con categorías que servirán de referencia para 
 * destacados radio y destacados tv - Decisiones editoriales temporizables 1 y 2
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @version    1
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
echo "\nCreando nuevo árbol de timeframes y categorías para destacados radio y tv\n\n";


$cat_root = CategoryPeer::doSelectRoot();
$cat_raiz_timeframes = creaCategory("Timeframes", $cat_root, "");
$cat_tf1 = creaCategory(CategoryMmTimeframePeer::EDITORIAL1, $cat_raiz_timeframes, "");
$cat_tf2 = creaCategory(CategoryMmTimeframePeer::EDITORIAL2, $cat_raiz_timeframes, "");

exit;

function creaCategory($name, $parent, $cod_prefix = '')
{
    $parent   = CategoryPeer::retrieveByPK($parent->getId());
    if (!$parent) {
        throw new Exception ("Error: no se encuentra categoría padre para crear ". $name);
    }

    $cod = substr($cod_prefix . $name, 0, 25); // long. máx. de category.cod

    $c = new Criteria();
    // $c->add(CategoryI18nPeer::NAME, $nombre);
    // $c->addJoin(CategoryI18nPeer::ID, CategoryPeer::ID);
    $c->add(CategoryPeer::COD, $cod);
    
    if (!$category = CategoryPeer::doSelectOne($c)){
        $category = new Category(); 
        $category->insertAsLastChildOf($parent);
        $category->setMetacategory(false);
        $category->setDisplay(true);
        $category->setRequired(false);
        $category->setCod($cod);
      
        $category->setCulture('es');
        $category->setName($name);
        
        $category->save();
        echo"Creada categoría " . $category->getCod() . " - " . $name . "\n";
    } else {
        echo "La categoría " . $name . " ya existe, la recupero de la BD\n";
    }
    
    return $category;
}
