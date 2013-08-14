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
define('SERIAL_KEYWORD', "create_test_videos"); // Makes test serials easier to delete
$perfil_test = getPerfilTest(); // global

if (!checkParentCategoryCodesPresent()) {
    echo "\nCategories not found - try symfony init-categories\n\n";
    exit;
}


deleteTestSerials(); 
createSerialsWithDecisionesEditoriales();
exit;

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
        printf("\t%-'.40s ", "Looking for " . $check_code . " category ");
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
    echo "Creando nueva serie con el título: [" . $title . "] ...";

    if ($serial = SerialPeer::retrieveByTitle($title)){
        echo " Recuperada de la BD con id " . $serial->getId() . "\n";
    } else {
        $serial = new Serial();
        $serial->setCulture('es');
        $serial->setPublicdate("now"); // ¿Add date parameter?
        $serial->setTitle($title);
        $serial->setKeyword(SERIAL_KEYWORD);
        $serial->setDescription(''); // Add description parameter?
        $serial->setHeader('');
        $serial->setFooter('');
        $serial->setSerialTypeId(SerialTypePeer::getDefaultSelId());
        $serial->setSerialTemplateId(1); // = ordered by date by default.
        $status = $serial->save();
        echo " OK - status " . $status . " id " . $serial->getId() . "\n";
    }
    
    return $serial;
}

function createMmInSerial($title, $serial)
{
    echo "\tCreando nuevo mm con el título [" . $title . "] ...";

    if (!$serial){
        echo "\nError: serie inexistente, imposible crear mm\n";
        exit;
        //return false;
    }

    // Look for existing mms with the same title but only in this serial
    foreach ($serial->getMmsWithI18n() as $existing_mm){
        if ($existing_mm->getTitle() == $title) {
            echo " Recuperado de la BD con id " . $existing_mm->getId() . "\n";
            return $existing_mm;
        }
    }

    $mm = new Mm();
    $mm->setSerial($serial);
    $mm->setCulture('es');
    $mm->setRecordDate("now");
    $mm->setPublicDate("now");
    $mm->setTitle($title);
    $mm->setDescription("");
    
    $mm->setAudio(0);
    $mm->setBroadcastId(BroadcastPeer::getDefaultSelId());
    $mm->setGenreId(GenrePeer::getDefaultSelId());
    $mm->setStatusId(MmPeer::STATUS_NORMAL);
    $status = $mm->save();
    echo " OK - status " . $status . " id " . $mm->getId() . "\n";

    return $mm;
}

function publishMmInWebtv($mm)
{
    // Quick & dirty - pubchannel.id for webtv should be 1.
    $web_tv_id = 1;
    if (!$mm) {
        echo "Error: no se puede publicar mm inexistente\n";
        exit;
    }
    echo "\tPublicando el mm con id " . $mm->getId() . " ... ";
    $pcmm = PubChannelMmPeer::RetrieveByPk($web_tv_id, $mm->getId());

    if ($mm->getStatusId() != MmPeer::STATUS_NORMAL){
        echo "actualizando mm.status_id - ";
        $mm->setStatusId(MmPeer::STATUS_NORMAL);
        $mm->save();
    }

    if ($pcmm && ($pcmm->getStatusId() == PubChannelMmPeer::STATUS_READY)){
        echo "Ya existe pcmm correcto\n";
        
    } else if ($pcmm && ($pcmm->getStatusId() != PubChannelMmPeer::STATUS_READY)){
        echo "PubChannelMmPeer existe, actualizando status\n";
        $pcmm->setStatusId(PubChannelMmPeer::STATUS_READY);
        $pcmm->save();

    } else if (!$pcmm){
        $pcmm = new PubChannelMm();
        $pcmm->setPubChannelId($web_tv_id);
        $pcmm->setMmId($mm->getId());
        $pcmm->setStatusId(PubChannelMmPeer::STATUS_READY);
        $pcmm->save();
        echo "OK\n";
    } else {
        echo "Error - caso no contemplado en publishMmInWebtv\n";
        exit;
    }
    
    return $pcmm;
}

function publishAllMmFromSerial($serial)
{
    foreach ($serial->getMms() as $mm){
        publishMmInWebtv($mm);
    }
}

function createFileInMm($file, $mm)
{
    echo "\tCreando nuevo file con el path [" . $file->getFile() . "] ... ";

    if (!$mm){
        echo "\nError: file inexistente, imposible crear mm\n";
        exit;
        //return false;
    }

    foreach($mm->getFiles() as $existing_file){
        if ($existing_file->getFile() == $file->getFile()) {
            echo " Recuperado de la BD con id " . $existing_file->getId() . "\n";
            return $existing_file;
        }
    }
    
    $file->setMmId($mm->getId());
    $status = $file->save();
    echo " OK - status " . $status . " id " . $file->getId() . "\n";

    return $file;
}

/**
 * Returns a new file object prepared with set fields
 * @param int $index selects one of the predefined filenames
 */
function prepareFile($index)
{
    global $perfil_test;

    $predefined_filenames = array(
        '74638.flv',
        'Invasiones Biológicas. Mejillón cebra. (Dreissena polymorpha).mp4',
        'The introduction of cats in islands ecosystems.flv',
        'What is the Campus do Mar_.webm');
    if (!isset($predefined_filenames[$index])){
        echo "Error: el file predefinido " . $index . " no existe\n";
        exit;
    }

    $path = SF_ROOT_DIR . "/web/testvideos/" . $predefined_filenames[$index];
    $url  = sfConfig::get('app_info_link', "http://pumukit18") . 
        "/testvideos/" . $predefined_filenames[$index];

    $ext      = extractExtension($predefined_filenames[$index]);
    $format   = getFormat($ext);
    $mimetype = getMimetype($ext);

    $file = new File();
    $file->setLanguage(getLanguage("ES"));
    
    $file->setUrl($url);
    $file->setFile($path);
    $file->setAudio($perfil_test->getAudio());
    $file->setPerfilId($perfil_test->getId());
    $file->setFormatId($format->getId());
    $file->setMimeTypeId($mimetype->getId());

    $file->setCulture('es');
    $file->setDescription('');

    return $file;
}



function extractExtension($filename){
    return substr(strrchr($filename, '.'), 1);
}

function getLanguage ($cod = "ES")
{
    $c = new Criteria();
    $c->add(LanguagePeer::COD, $cod);
    return LanguagePeer::doSelectOne($c);
}


/**
 * Finds or creates a minimum test profile for the test files
 * display = 1 and master = 0;
 */
function getPerfilTest($name = 'perfil_test')
{
    $c = new Criteria();
    $c->add(PerfilPeer::NAME, $name);
    if ($perfil = PerfilPeer::doSelectWithI18n($c, 'es')){
        
        return $perfil[0];
    } else{
        // ¿Crear streamserver?
        $perfil = new Perfil();
        $perfil->setName($name);
        $perfil->setDisplay(1);
        $perfil->setWizard(0);
        $perfil->setMaster(0);
        $perfil->setFormat('flv'); // arbitrario
        $perfil->setMimetype('video/x-flv');
        $perfil->setExtension('flv');  
        $perfil->setAudio(0);
        $perfil->setApp('create_test_videos.php');
        // $perfil->setStreamserverId($streamserver->getId());
        
        $perfil->setCulture('es');
        $perfil->setDescription("Perfil para vídeos de test");
        $perfil->setLink("Vídeo"); // 'Vídeo' o 'Audio'

        $perfil->save();
    }

    return $perfil;
}

function getMimetype($ext)
{
    $c = new Criteria();
    $c->add(MimeTypePeer::NAME, $ext);
    if (!$mt = MimeTypePeer::doSelectOne($c)){
        // creates real or dummy (unknown) mimetype
        $extension_mimetype = array(
        "flv"  => "video/x-flv",
        "mp4"  => "video/mp4",
        "webm" => "video/webm");
        $type = (isset($extension_mimetype[$ext])) ?
            $extension_mimetype[$ext] : "video/test-" . $ext;
        $mt = new MimeType();
        $mt->setName($ext);
        $mt->setType($type); 
        $mt->save();
    }

    return $mt;
}

function getFormat($ext)
{
    $c = new Criteria();
    $c->add(FormatPeer::NAME, $ext);
    if (!$format = FormatPeer::doSelectOne($c)){
        $format = new Format();
        $format->setName($ext);
        $format->save();
    }

    return $format;
}

function deleteTestSerials()
{
    $test_serials = doSelectSerialsWithKeyword(SERIAL_KEYWORD);
    foreach ($test_serials as $serial){
        $serial->delete();
    }
}

function doSelectSerialsWithKeyword($keyword = SERIAL_KEYWORD)
{

    $c = new Criteria();
    $c->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
    $c->add(SerialI18nPeer::KEYWORD, $keyword, Criteria::LIKE);
    return SerialPeer::doSelectWithI18n($c);
}

function createTimeframe($category, $mm, $timestart, $timeend, $description = SERIAL_KEYWORD)
{
    $category_id = (is_int($category)) ? $category : $category->getId();
    $mm_id       = (is_int($mm)) ? $mm : $mm->getId();
    echo "\tCreando el timeframe para cat: " . $category_id . " mm: " . $mm_id .
        " inicio: " . $timestart . " fin: " . $timeend . " description: " . $description ;
    
    $tf = new CategoryMmTimeframe();
    $tf->setCategoryId($category->getId());
    $tf->setMmId($mm->getId());
    $tf->setDescription($description); 
    $tf->setTimestart($timestart);
    $tf->setTimeend($timeend);
    $tf->save();
    echo " id: " . $tf->getId() . "\n";
    
    return $tf;
}

// ------------------- CREATE TEST SETS -----------------------
function createSerialsWithDecisionesEditoriales()
{
    $hour_before  = date("Y-m-d H:i:s", time() - 3600);
    $hour_after   = date("Y-m-d H:i:s", time() + 3600);
    $day_before   = date('Y-m-d H:i:s', strtotime('-1 day'));
    $day_after    = date('Y-m-d H:i:s', strtotime('+1 day'));
    $week_before  = date('Y-m-d H:i:s', strtotime('-7 day'));
    $week_after   = date('Y-m-d H:i:s', strtotime('+7 day'));

    $cat_editorial1 = CategoryPeer::retrieveByCod(CategoryMmTimeframePeer::EDITORIAL1);
    $cat_editorial2 = CategoryPeer::retrieveByCod(CategoryMmTimeframePeer::EDITORIAL2);

    $serial = createSerial("Test serie con decisiones editoriales fijas y temporizadas publicadas");
    
    $mm1    = createMmInSerial("Test mm publicado con editorial1 temporizada pasada ayer", $serial);
    $file1  = createFileInMm(prepareFile(1), $mm1);
    createTimeframe($cat_editorial1, $mm1, $week_before, $day_before);

    $mm2    = createMmInSerial("Test mm publicado con editorial2 temporizada pasada ayer", $serial);
    $file2  = createFileInMm(prepareFile(2), $mm2);
    createTimeframe($cat_editorial2, $mm2, $week_before, $day_before);

    $mm3    = createMmInSerial("Test mm publicado con editorial1 temporizada 2 horas y editorial2 fija", $serial);
    $file3  = createFileInMm(prepareFile(3), $mm3);
    createTimeframe($cat_editorial1, $mm3, $hour_before, $hour_after);
    $mm3->setEditorial2(1);
    $mm3->save();

    $mm4    = createMmInSerial("Test mm publicado con editorial2 temporizada 2 días", $serial);
    $file4  = createFileInMm(prepareFile(1), $mm4);
    createTimeframe($cat_editorial2, $mm4, $day_before, $day_after);

    $mm5    = createMmInSerial("Test mm publicado con editorial1 temporizada 2 semanas", $serial);
    $file5  = createFileInMm(prepareFile(2), $mm5);
    createTimeframe($cat_editorial1, $mm5, $week_before, $week_after);

    $mm6    = createMmInSerial("Test mm publicado con editorial1 temporizada futura 1 semana", $serial);
    $file6  = createFileInMm(prepareFile(3), $mm6);
    createTimeframe($cat_editorial1, $mm6, $day_after, $week_after);

    $mm7    = createMmInSerial("Test mm publicado con editorial2 temporizada futura 1 semana", $serial);
    $file7  = createFileInMm(prepareFile(1), $mm7);
    createTimeframe($cat_editorial2, $mm7, $day_after, $week_after);

    $mm8    = createMmInSerial("Test mm publicado con editorial1 fija", $serial);
    $file8  = createFileInMm(prepareFile(2), $mm8);
    $mm8->setEditorial1(1);
    $mm8->save();

    $mm9    = createMmInSerial("Test mm publicado con editorial1 fija", $serial);
    $file9  = createFileInMm(prepareFile(3), $mm9);
    $mm9->setEditorial2(1);
    $mm9->save();

    $mm10    = createMmInSerial("Test mm publicado con editorial1 y editorial2 fijas", $serial);
    $file10  = createFileInMm(prepareFile(1), $mm10);
    $mm10->setEditorial1(1);
    $mm10->setEditorial2(1);
    $mm10->save();

    publishAllMmFromSerial($serial);

    // ------- Sin publicar ----------
    $serial2 = createSerial("Test serie con decisiones editoriales fijas y temporizadas publicadas");
    
    $mm1    = createMmInSerial("Test mm sin publicar con editorial1 temporizada pasada ayer", $serial2);
    $file1  = createFileInMm(prepareFile(1), $mm1);
    createTimeframe($cat_editorial1, $mm1, $week_before, $day_before);

    $mm2    = createMmInSerial("Test mm sin publicar con editorial2 temporizada pasada ayer", $serial2);
    $file2  = createFileInMm(prepareFile(2), $mm2);
    createTimeframe($cat_editorial2, $mm2, $week_before, $day_before);

    $mm3    = createMmInSerial("Test mm sin publicar con editorial1 temporizada 2 horas y editorial2 fija", $serial2);
    $file3  = createFileInMm(prepareFile(3), $mm3);
    createTimeframe($cat_editorial1, $mm3, $hour_before, $hour_after);
    $mm3->setEditorial2(1);
    $mm3->save();

    $mm4    = createMmInSerial("Test mm sin publicar con editorial2 temporizada 2 días", $serial2);
    $file4  = createFileInMm(prepareFile(1), $mm4);
    createTimeframe($cat_editorial2, $mm4, $day_before, $day_after);

    $mm5    = createMmInSerial("Test mm sin publicar con editorial1 temporizada 2 semanas", $serial2);
    $file5  = createFileInMm(prepareFile(2), $mm5);
    createTimeframe($cat_editorial1, $mm5, $week_before, $week_after);

    $mm6    = createMmInSerial("Test mm sin publicar con editorial1 temporizada futura 1 semana", $serial2);
    $file6  = createFileInMm(prepareFile(3), $mm6);
    createTimeframe($cat_editorial1, $mm6, $day_after, $week_after);

    $mm7    = createMmInSerial("Test mm sin publicar con editorial2 temporizada futura 1 semana", $serial2);
    $file7  = createFileInMm(prepareFile(1), $mm7);
    createTimeframe($cat_editorial2, $mm7, $day_after, $week_after);

    $mm8    = createMmInSerial("Test mm sin publicar con editorial1 fija", $serial2);
    $file8  = createFileInMm(prepareFile(2), $mm8);
    $mm8->setEditorial1(1);
    $mm8->save();

    $mm9    = createMmInSerial("Test mm sin publicar con editorial1 fija", $serial2);
    $file9  = createFileInMm(prepareFile(3), $mm9);
    $mm9->setEditorial2(1);
    $mm9->save();

    $mm10    = createMmInSerial("Test mm sin publicar con editorial1 y editorial2 fijas", $serial2);
    $file10  = createFileInMm(prepareFile(1), $mm10);
    $mm10->setEditorial1(1);
    $mm10->setEditorial2(1);
    $mm10->save();
}