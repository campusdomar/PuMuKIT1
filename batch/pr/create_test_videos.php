<?php

/**
 * Creates some series, mm and assigns some video files for testing purposes.
 *
 * @package    pumukituvigo
 * @subpackage batch
 * @author     Andres Perez <aperez@teltek.es>
 * @version    0.1
 * @copyright  Teltek 2013
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../..'));
define('SF_APP',         'editar');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       0);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
// disable output buffering to achieve "real time" terminal output
ob_implicit_flush(true);
ob_end_flush();
// ----------------------------- Script starts here -------------------

// ¿Tocar los virtualgrounds?




if (!checkParentCategoryCodesPresent()) {
    echo "\nCategories not found - try symfony init-categories\n\n";
    exit;
}

$serial1 = createSerial("Borrable jarl");


// ----------------------------- Script ends here -------------------

/**
 * Checks root and root children categories given by input parameter. 
 * @param $check_codes array of category.cod to check
 * @return boolean (all categories present).
 */
function checkParentCategoryCodesPresent($check_codes = array('root', 
    'Timeframes', 'Lugares', 'Directriz', 'UNESCO'))
{
    echo "\nChecking root and tree parent categories\n\n";
    
    $root = CategoryPeer::doSelectRoot();
    if ($root) {
        $parent_categories = array($root->getCod());
        foreach ($root->getChildren() as $cat){
            $parent_categories[] = $cat->getCod();
        }
    } else {
        echo "Error: root category missing.\n";
        
        return false;
    }

    foreach ($check_codes as $check_code){
        printf("\t%-'.40s ", "Looking for " . $check_code . " category");
        if (in_array($check_code, $parent_categories)){
           echo "OK\n";
        } else {
            echo "Error: " . $check_code . " category missing.\n";
            
            return false; 
        }

    }
    echo "\n";
    
    return true;
}

function createSerial($title = "Test serial")
{
    // Test serial already present?
    echo "Creando nueva serie con el título: [" . $title . "] ...";
    $serial = new Serial();
    $serial->setCulture('es');
    $serial->setPublicdate("now"); // ¿Add date parameter?
    $serial->setTitle($title);
    $serial->setDescription(''); // Add description parameter?
    $serial->setHeader('');
    $serial->setFooter('');
    $serial->setSerialTypeId(SerialTypePeer::getDefaultSelId());
    $serial->setSerialTemplateId(1); // = ordered by date by default.
    $status = $serial->save();
    echo " OK - status " . $status . "\n";
    
    return $serial;
}
