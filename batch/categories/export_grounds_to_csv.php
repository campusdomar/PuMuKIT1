<?php
/**
 * Exporta desde la BD actual un csv con información necesaria 
 * para poblar las tablas category con los antiguos grounds
 * excepto Unesco.
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


// ----------------------------- Script starts here -------------------
// globals
$filename = 'grounds.csv';
$langs    = array('es', 'gl', 'en'); // Same order than $arry_csv_cols
echo ""; // avoid  cookie/session warnings ?

$csv_cols    = array('id', 'cod', 'tree_parent_id', 'metacategory', 'display', 'name_es', 'name_gl', 'name_en');
$array_csv   = array($csv_cols);
$groundtypes = getAllGroundTypesExcept('Unesco');

echo "\n\nExporting existing grounds to " . $filename . "\n\nProgress (strings are trimmed):\n\n";
printCsvLine($csv_cols);
echo "--------------------------------------------------------------------------------------------------------------\n";

updateCsvArrayFromGroundtypes($array_csv, $groundtypes);
writeCsvFileFromArray($filename, $array_csv);
exit;

// ----------------------------- Script ends here -------------------

function getAllGroundTypesExcept($gt_name_excluded = 'Unesco')
{
    $c = new Criteria();
    $c->Add(GroundTypePeer::NAME, $gt_name_excluded, Criteria::NOT_LIKE);

    return GroundTypePeer::doSelectWithI18n($c);
}

function updateCsvArrayFromGroundtypes(&$array_csv, $gts){
    foreach ($gts as $gt){
        $grounds      = $gt->getGroundsWithI18n();
        $gt_id        = nextIdFromCsvArray($array_csv);
        $gt_parent_id = 0; 
        $gt_csv_line  = getCsvLineFromGroundtype($gt, $gt_id, $gt_parent_id);
        $array_csv[]  = $gt_csv_line;
        printCsvLine($gt_csv_line);
        foreach ($grounds as $ground){
            $g_id        = nextIdFromCsvArray($array_csv);
            $g_parent_id = $gt_id;
            $g_csv_line  = getCsvLineFromGround($ground, $g_id, $g_parent_id);
            $array_csv[] = $g_csv_line;
            printCsvLine($g_csv_line);
        }
    }
}

function getCsvLineFromGroundtype($gt, $id, $parent_id, $metacategory = 0, $display = 1)
{
    global $langs;
    $csv_line = array(  $id,
                        $gt->getName(),
                        $parent_id,
                        $metacategory,
                        $display);

    foreach ($langs as $lang){
        $gt->setCulture($lang);
        $csv_line[] = $gt->getDescription(); 
    }

    return $csv_line;
}

function getCsvLineFromGround($ground, $id, $parent_id, $metacategory = 0, $display = 1)
{
    global $langs;
    $csv_line = array( $id,
                        $ground->getCod(),
                        $parent_id,
                        $metacategory,
                        $display);
    
    foreach ($langs as $lang){
        $ground->setCulture($lang);
        $csv_line[] = $ground->getName(); 
    }

    return $csv_line;
}

function nextIdFromCsvArray($csv_array){
    $csv_line = end($csv_array);

    return (is_numeric($csv_line[0])) ? $csv_line[0] + 1 : 1;
}

function printCsvLine($csv_line){
    vprintf('% 3s | %-20s | % 3.3s | % 3.3s | % 3.3s | %-20.20s | %-20.20s | %-20.20s' . "\n",$csv_line );
}

function writeCsvFileFromArray($filename, $array_csv)
{
    $file = fopen($filename, "w");
    foreach ($array_csv as $array_csv_line){
        fputcsv($file, $array_csv_line, ';');
    }
    fclose($file);
}