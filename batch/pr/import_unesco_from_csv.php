<?php
/**
 * importa un csv y puebla la tabla category
 * creando el árbol unesco.
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

borraTablasAPelo(array("category", "category_i18n"));
$filename = 'prueba_unescos.csv';

// ----------------------------- Script starts here -------------------



importCsvFile($filename);

// ----------------------------- Script ends here -------------------

function retrieveOrCreateRoot($name = 'root')
{
    if (!$cat_root = CategoryPeer::doSelectRoot()){
        $cat_root = new Category();
        $cat_root->makeRoot();
        $cat_root->setMetacategory(false); // Uned dev value. If true, num_mm won't be updated anymore.
        $cat_root->setDisplay(true); // Uned dev value.
        $cat_root->setRequired(false);
        $cat_root->setCod($name);

        $lang = sfConfig::get('app_lang_default', 'es');
        // $langs = sfConfig::get('app_lang_array', array('es'));
        // foreach($langs as $lang){
            $cat_root->setCulture($lang);
            $cat_root->setName($name);
        // }

        $cat_root->save();
        $cat_root = CategoryPeer::doSelectRoot(); // To reassure that root category is properly updated.
        echo "Root category created\n";

    } else {
        echo "Root category retrieved from DB\n";
    }

    return $cat_root;
}

function importCsvFile($filename)
{
    $cat_root          = retrieveOrCreateRoot();  
    $array_imported_id_category = array(0 => $cat_root);

    $row      = 1;
    if (($file = fopen($filename, "r")) !== FALSE) {
        while (($current_row = fgetcsv($file, 300, ";")) !== FALSE) {
            $number = count($current_row);
            if ($number == 6 ){
                if (trim($current_row[0]) == "id") { // header row
                    continue;
                }

                if (!isset($array_imported_id_category[$current_row[2]])){
                    echo "\n\nCurrent csv row: " . $row . "\n";
                    print_r($current_row);
                    throw new Exception ("Parent category not defined");
                }

                $category = createCategoryFromCsvArray($current_row, $array_imported_id_category[$current_row[2]]);
                $array_imported_id_category[$current_row[0]] = $category;
        
            } else {
                echo "\n Last valid row = \n". print_r($previous_content) . "\n";
                echo "\n Error: line $row has $number elements\n\n";
                print_r($current_row);
            }
            if ($row % 100 == 0 ) echo "Row " . $row . "\n";
            $previous_content = $current_row;
            
            $row++;        
        } // end while
        fclose($file);
    } else {
        echo "\nERROR: in fopen($csv)\n\n";
    }
}

function createCategoryFromCsvArray($csv_array, $cat_parent)
{
    $c = new Criteria();
    $c->add(CategoryPeer::COD, $csv_array[1]);
    if (!$category = CategoryPeer::doSelectOne($c)){
        // create category
        $category = new Category();
        $category->setCod($csv_array[1]);
        $category->insertAsLastChildOf($cat_parent);
        $category->setMetacategory($csv_array[3]);
        $category->setDisplay($csv_array[4]);
        $category->setCulture('es');
        $category->setName($csv_array[5]);
        $category->save();
        echo "Category persisted - new id: " . $category->getId() . " cod: " . $category->getCod() . " name: " . $category->getName() . "\n";

    } else {
        echo "\tCategory retrieved from DB id: " . $category->getId() . " cod: " . $category_getCod . " name: " . $category->getName() . "\n";
        // ¿Update with csv_array?
        // ¿Check parent?
    }

    return $category;
}
/**
 * borraTablasAPelo - truncate tables instead of delete objects.
 * Aimed to speed up development and force the reset of id fields.
 */
function borraTablasAPelo($tables)
{
    $connection = Propel::getConnection();
    $query = '';
    echo"Truncating tables: ";
    if (!is_array($tables)){
        $tables = array($tables);
    }
    foreach ($tables as $table){
        echo $table . " ";
        $connection->executeUpdate('TRUNCATE TABLE '.$table);       
    }
    echo "\n\n";
}