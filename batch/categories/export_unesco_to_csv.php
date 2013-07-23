<?php
/**
 * Exporta desde la BD actual un csv con información necesaria 
 * para poblar las tablas category sólo con unescos.
 * Los renumera para que comiencen en 1 y sean correlativos.
 *
 * El csv estará ordenado por directamente por códigos unesco
 * en vez de por niveles. Ej. de líneas del csv:
 * U010000 (primer nivel)
 * U010100 (segundo nivel)
 * U010101 (tercer nivel)
 * U020000 (primer nivel)
 *
 * @package    pumukit
 * @subpackage batch
 * @author     Andres Perez <aperez@teltek.es>
 * @version    0.1
 * @copyright  Teltek 2013
 */
define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');


// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
// desactiva output buffering para que muestre por pantalla los echos en tiempo real
ob_implicit_flush(true);
ob_end_flush();

$filename = 'prueba_unescos.csv';

// ----------------------------- Script starts here -------------------


$cat_root   = CategoryPeer::doSelectRoot();
$cat_unesco = CategoryPeer::retrieveByCod('UNESCO');
$unescos    = getAllDescendantsOrderedByCod($cat_unesco);

$csv_unesco    = getCsvArrayFromCategory($cat_unesco);
$csv_unesco[2] = 0;

$array_csv_unescos = getEntireCsvArrayFromCategories($unescos);
$array_csv_total   = array_merge( array(//getCsvArrayFromCategory($cat_root),
                                        $csv_unesco),
                                  $array_csv_unescos);

renumber($array_csv_total);
$array_csv_columnas = array('id', 'cod', 'tree_parent_id', 'metacategory', 'display', 'name');
$array_csv = array_merge(array($array_csv_columnas), $array_csv_total);
writeCsvFileFromArray($filename, $array_csv);

// ----------------------------- Script ends here -------------------

function getAllDescendantsOrderedByCod($category, $limit = null)
{
    $c = new Criteria();
    $c->addAnd(CategoryPeer::TREE_LEFT, $category->getTreeLeft(), Criteria::GREATER_THAN);
    $c->addAnd(CategoryPeer::TREE_RIGHT, $category->getTreeRight(), Criteria::LESS_THAN);
    $c->addAnd(CategoryPeer::COD, 'U99%', Criteria::NOT_LIKE);
    // Same scope is taken for granted.
    $c->addAscendingOrderByColumn(CategoryPeer::COD);
    if ($limit) $c->setLimit($limit);

    return CategoryPeer::doSelectWithI18n($c);
}

function getCsvArrayFromCategory($category)
{

    $array_cat = array( $category->getId(),
                        $category->getCod(),
                        $category->getTreeParent(),
                        (int) $category->getMetacategory(),
                        (int) $category->getDisplay(),
                        $category->getName() );
    
    return $array_cat;
}

function getEntireCsvArrayFromCategories($categories)
{
    $array_csv = array();
    foreach ($categories as $category){
        $array_csv[] = getCsvArrayFromCategory($category);
    }

    return $array_csv;
}

function writeCsvFileFromArray($filename, $array_csv)
{
    $file = fopen($filename, "w");
    foreach ($array_csv as $array_csv_line){
        fputcsv($file, $array_csv_line, ';');
    }
    fclose($file);
}

// Assumes input array is ordered by cod, no recursion is needed.
function renumber(&$array_csv){
    $current_index = 1;
    $equivalences  = array();
    foreach ($array_csv as &$line){
        $id                = $line[0];
        $parent_id         = $line[2];
        $equivalences[$id] = $current_index;
        $line[0]           = $current_index;

        if (isset($equivalences[$parent_id])){
            $line[2] = $equivalences[$parent_id];
        }
        $current_index++;
    }
}