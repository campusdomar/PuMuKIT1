<?php
/**
 * Imports a csv and populates the category table with unesco tree.
 * Esisting entries are not updated, only new entries are added.
 *
 * CSV file has to be sorted by UNESCO codes (category.cod)
 * rather than hierarchy levels.
 * Example:  
 * U010000 (first level unesco)
 * U010100 (second level unesco)
 * U010101 (third level unesco)
 * U020000 (first level unesco)
 *
 * The first data entry (apart form header columns) has to be
 * UNESCO subtree container, with parent id = 0 to link it with root category.
 *
 * csv structure: 'id'; 'cod';'tree_parent_id'; 'metacategory'; 'display'; 'name'
 *
 * @package    pumukit
 * @subpackage batch
 * @author     Andres Perez <aperez@teltek.es>
 * @version    0.4
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

// borraTablasAPelo(array("category", "category_i18n"));
$filename = realpath(dirname(__file__).'/prueba_unescos.csv');

// ----------------------------- Script starts here -------------------

importCsvFile($filename);

echo "\nDebug - showing category tree:\n\n";
printCategoryTree();

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

function importCsvFile($filename, $num_rows = null)
{
    $cat_root = retrieveOrCreateRoot();
    // Initialize the equivalences array - Important: the csv file
    // is assumed to begin with UNESCO row and its parent id = 0.
    $imported_id_category_id = array(0 => $cat_root->getId());

    $row      = 1;
    if (($file = fopen($filename, "r")) !== FALSE) {
        while ( ($current_row = fgetcsv($file, 300, ";")) !== FALSE)  {
            $number = count($current_row);
            if ($number == 6 ){
                if (trim($current_row[0]) == "id") { // header row
                    continue;
                }

                if (!isset($imported_id_category_id[$current_row[2]])){
                    echo "\n\nCurrent csv row: " . $row . "\n";
                    print_r($current_row);
                    throw new Exception ("Parent category not defined");
                }

                $parent_cat = CategoryPeer::retrieveByPk($imported_id_category_id[$current_row[2]]);
                $category   = createCategoryFromCsvArray($current_row, $parent_cat);
                $imported_id_category_id[$current_row[0]] = $category->getId();
        
            } else {
                echo "\n Last valid row = \n". print_r($previous_content) . "\n";
                echo "\n Error: line $row has $number elements\n\n";
                print_r($current_row);
            }
            if ($row % 100 == 0 ) echo "Row " . $row . "\n";
            $previous_content = $current_row;
            
            if ($num_rows == $row) break;

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
        echo "\tNothing done - Category retrieved from DB id: " . $category->getId() . " cod: " . $category->getCod() . " name: " . $category->getName() . "\n";
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

function printCategoryTree($category = null, $indent = 0)
{
    if (!$category) $category = CategoryPeer::doSelectRoot();

    $padding = str_repeat("\t", $indent);
    echo $padding . $category->getCod() . 
        sprintf(' id:% 4d - parent:% 4d - lft:% 4d - rgt:% 4d - ',
            $category->getId(), $category->getTreeParent(),
            $category->getTreeLeft(), $category->getTreeRight()) .
        $category->getName() . "\n";
    foreach ($category->getChildren() as $child_cat){
        printCategoryTree($child_cat, $indent+1);
    }
}