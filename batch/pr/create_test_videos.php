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

if (!checkParentCategoryCodesPresent()) {
    echo "\nCategories not found - try symfony init-categories\n\n";
    exit;
}

// globals. Predefined filenames = videos in /web/testvideos/ 
// There should be a thumbnail with the same name and .jpg extension.
$predefined_filenames = array(
        '74638.flv',
        'Invasiones Biológicas. Mejillón cebra. (Dreissena polymorpha).mp4',
        'The introduction of cats in islands ecosystems.flv',
        'What is the Campus do Mar_.webm');
define('TEST_KEYWORD', "create_test_videos"); // Makes test objects easier to delete
$perfil_test    = getPerfilTest();
$prepared_files = getPreparedFiles($predefined_filenames, $perfil_test);
// $prepared_pics  = createPreparedPics($predefined_filenames);

deleteTestPicMms();
deleteTestSerials(); 
$prepared_pics  = createPreparedPics($predefined_filenames);

createSerialsWithDecisionesEditoriales();
createSerialsForAllDirectrices();
createSerialsForAllLugares();
createSerialsWithNovedades();

deleteTestVirtualgrounds();
createVirtualGrounds();
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
        $serial->setKeyword(TEST_KEYWORD);
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

function createMmInSerial($title, $serial, $date = "now")
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
    $mm->setRecordDate($date);
    $mm->setPublicDate($date);
    $mm->setTitle($title);
    $mm->setDescription("");
    
    $mm->setAudio(0);
    $mm->setBroadcastId(BroadcastPeer::getDefaultSelId());
    $mm->setGenreId(GenrePeer::getDefaultSelId());
    $mm->setStatusId(MmPeer::STATUS_NORMAL);
    $status = $mm->save();
    echo " OK - status " . $status . " id " . $mm->getId() . "\n";

    $file_index = rand(0,3);
    $file1  = createFileInMm(prepareFile($file_index), $mm);
    assignPreparedPicToMm($file_index, $mm);

    return $mm;
}

function retrievePubchannelByName($name = "WebTV")
{
    $c = new Criteria();
    $c->add(PubChannelPeer::NAME, $name, Criteria::LIKE);

    return PubChannelPeer::doSelectOne($c);
}
function publishMmInWebtv($mm)
{
    
    $web_tv_id = retrievePubchannelByName("WebTV")->getId();
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
    $file->setCulture('es');
    $file->setDescription('TEST_KEYWORD');
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
    global $prepared_files; 
    if (!isset($prepared_files[$index])){
        echo "Error: el file predefinido " . $index . " no existe\n";
        exit;
    }

    return $prepared_files[$index]->copy();
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
    $c->add(PerfilPeer::NAME, $name, Criteria::LIKE);
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

/**
 * Uses $predefined_filenames to build a array of file objects
 * to be used as "file templates".
 */
function getPreparedFiles($predefined_filenames, $perfil_test)
{
    $predefined = array();
    foreach ($predefined_filenames as $predefined_filename){
        $path = SF_ROOT_DIR . "/web/testvideos/" . $predefined_filename;
        $url  = sfConfig::get('app_info_link', "http://pumukit18") . 
            "/testvideos/" . $predefined_filename;

        $ext      = extractExtension($predefined_filename);
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

        $file->autocomplete();

        $predefined[] = $file;
    }

    return $predefined;
}

function createPreparedPics($predefined_filenames)
{
    $predefined_pics = array();
    foreach ($predefined_filenames as $filename){
        $url = '/testvideos/' . extractName($filename) . '.jpg';
        if (!$pic = retrievePicByUrl($url)){
            $pic = new Pic();
            $pic->setUrl($url);
            $pic->save();
        }
        $predefined_pics[] = $pic;
    }
    
    return $predefined_pics;
}

function retrievePicByUrl($url)
{
    $c = new Criteria;
    $c->add(PicPeer::URL, $url, Criteria::LIKE);

    return PicPeer::doSelectOne($c);
}

function assignPreparedPicToMm($pic_index, $mm)
{
    global $prepared_pics;
    if (!isset($prepared_pics[$pic_index])){
        echo "\nError: no está preparada la pic con índice " . $pic_index . "\n";
        exit;
    }
    $pic_id = $prepared_pics[$pic_index]->getId();

    if (!$pic_mm = PicMmPeer::RetrieveByPk($pic_id, $mm->getId())){
        $pic_mm = new PicMm();
        $pic_mm->setPicId($pic_id);
        $pic_mm->setOtherId($mm->getId());
        $pic_mm->save();
    }
}


function extractName($filename){
    return substr($filename, 0, strrpos($filename, '.')); 
}

function getMimetype($ext)
{
    $c = new Criteria();
    $c->add(MimeTypePeer::NAME, $ext, Criteria::LIKE);
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
    $c->add(FormatPeer::NAME, $ext, Criteria::LIKE);
    if (!$format = FormatPeer::doSelectOne($c)){
        $format = new Format();
        $format->setName($ext);
        $format->save();
    }

    return $format;
}

function deleteTestPicMms()
{
    // deletes pic_mms without pic
    $existing_pics = PicPeer::doSelect(new Criteria());
    $pic_ids       = array();
    foreach ($existing_pics as $pic) $pic_ids[] = $pic->getId();

    $c = new Criteria();
    $c->add(PicMmPeer::PIC_ID, $pic_ids, CRITERIA::NOT_IN);
    $c->setDistinct();
    $empty_pic_mms = BasePicMmPeer::doDelete($c); // force delete

    if (!empty($empty_pic_mms)) echo "\nBorrados " . count($empty_pic_mms) . " pic_mms que hacían referencia a pics inexistentes\n\n"; // if the array is 
}

function deleteTestSerials()
{
    echo "Borrando test serials antiguas\n";
    $test_serials = doSelectSerialsWithKeyword(TEST_KEYWORD);
    foreach ($test_serials as $serial){
        $serial->delete();
    }
}

function doSelectSerialsWithKeyword($keyword = TEST_KEYWORD)
{

    $c = new Criteria();
    $c->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
    $c->add(SerialI18nPeer::KEYWORD, $keyword, Criteria::LIKE);
    return SerialPeer::doSelectWithI18n($c);
}

function deleteTestVirtualgrounds()
{
    echo "Borrando test virtualgrounds antiguos\n";
    $test_virtualgrounds = doSelectVirtualgroundsWithDescription(TEST_KEYWORD);
    foreach ($test_virtualgrounds as $vg){
        $vg->delete();
    }
}

function doSelectVirtualgroundsWithDescription($description = TEST_KEYWORD)
{
    $c = new Criteria();
    $c->add(VirtualGroundPeer::DESCRIPTION, $description, Criteria::LIKE);
    return VirtualGroundPeer::doSelectWithI18n($c);
}


function createTimeframe($category, $mm, $timestart, $timeend, $description = TEST_KEYWORD)
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
    createTimeframe($cat_editorial1, $mm1, $week_before, $day_before);

    $mm2    = createMmInSerial("Test mm publicado con editorial2 temporizada pasada ayer", $serial);
    createTimeframe($cat_editorial2, $mm2, $week_before, $day_before);

    $mm3    = createMmInSerial("Test mm publicado con editorial1 temporizada 2 horas y editorial2 fija", $serial);
    createTimeframe($cat_editorial1, $mm3, $hour_before, $hour_after);
    $mm3->setEditorial2(1);
    $mm3->save();

    $mm4    = createMmInSerial("Test mm publicado con editorial2 temporizada 2 días", $serial);
    createTimeframe($cat_editorial2, $mm4, $day_before, $day_after);

    $mm5    = createMmInSerial("Test mm publicado con editorial1 temporizada 2 semanas", $serial);
    createTimeframe($cat_editorial1, $mm5, $week_before, $week_after);

    $mm6    = createMmInSerial("Test mm publicado con editorial1 temporizada futura 1 semana", $serial);
    createTimeframe($cat_editorial1, $mm6, $day_after, $week_after);

    $mm7    = createMmInSerial("Test mm publicado con editorial2 temporizada futura 1 semana", $serial);
    createTimeframe($cat_editorial2, $mm7, $day_after, $week_after);

    $mm8    = createMmInSerial("Test mm publicado con editorial1 fija", $serial);
    $mm8->setEditorial1(1);
    $mm8->save();

    $mm9    = createMmInSerial("Test mm publicado con editorial1 fija", $serial);
    $mm9->setEditorial2(1);
    $mm9->save();

    $mm10    = createMmInSerial("Test mm publicado con editorial1 y editorial2 fijas", $serial);
    $mm10->setEditorial1(1);
    $mm10->setEditorial2(1);
    $mm10->save();

    publishAllMmFromSerial($serial);

    // ------- Sin publicar ----------
    $serial2 = createSerial("Test serie con decisiones editoriales fijas y temporizadas publicadas");
    
    $mm1    = createMmInSerial("Test mm sin publicar con editorial1 temporizada pasada ayer", $serial2);
    createTimeframe($cat_editorial1, $mm1, $week_before, $day_before);

    $mm2    = createMmInSerial("Test mm sin publicar con editorial2 temporizada pasada ayer", $serial2);
    createTimeframe($cat_editorial2, $mm2, $week_before, $day_before);

    $mm3    = createMmInSerial("Test mm sin publicar con editorial1 temporizada 2 horas y editorial2 fija", $serial2);
    createTimeframe($cat_editorial1, $mm3, $hour_before, $hour_after);
    $mm3->setEditorial2(1);
    $mm3->save();

    $mm4    = createMmInSerial("Test mm sin publicar con editorial2 temporizada 2 días", $serial2);
    createTimeframe($cat_editorial2, $mm4, $day_before, $day_after);

    $mm5    = createMmInSerial("Test mm sin publicar con editorial1 temporizada 2 semanas", $serial2);
    createTimeframe($cat_editorial1, $mm5, $week_before, $week_after);

    $mm6    = createMmInSerial("Test mm sin publicar con editorial1 temporizada futura 1 semana", $serial2);
    createTimeframe($cat_editorial1, $mm6, $day_after, $week_after);

    $mm7    = createMmInSerial("Test mm sin publicar con editorial2 temporizada futura 1 semana", $serial2);
    createTimeframe($cat_editorial2, $mm7, $day_after, $week_after);

    $mm8    = createMmInSerial("Test mm sin publicar con editorial1 fija", $serial2);
    $mm8->setEditorial1(1);
    $mm8->save();

    $mm9    = createMmInSerial("Test mm sin publicar con editorial1 fija", $serial2);
    $mm9->setEditorial2(1);
    $mm9->save();

    $mm10    = createMmInSerial("Test mm sin publicar con editorial1 y editorial2 fijas", $serial2);
    $mm10->setEditorial1(1);
    $mm10->setEditorial2(1);
    $mm10->save();
}

function createSerialWithDirectriz($cod = "Dhumanistica")
{
    $year_before   = date('Y-m-d H:i:s', strtotime('-1 year'));
    $cat_directriz = CategoryPeer::retrieveByCod($cod);
    if (!$cat_directriz) {
        echo "\nNo se encuentra la categoría directriz con cod=" . $cod . "\n\n";
        exit;
    }

    $serial_directriz = createSerial("Test serie con directriz " . $cod);

    $mm1 = createMmInSerial("Test mm con directriz " . $cod . " publicado el año pasado", $serial_directriz, $year_before);
    $cat_directriz->addMmIdAndUpdateCategoryTree($mm1->getId());
    
    $mm2 = createMmInSerial("Test mm con directriz " . $cod . " publicado el año actual", $serial_directriz);
    $cat_directriz->addMmIdAndUpdateCategoryTree($mm2->getId());

    publishAllMmFromSerial($serial_directriz);

    $mm3 = createMmInSerial("Test mm con directriz " . $cod . " sin publicar el año actual", $serial_directriz);
    $cat_directriz->addMmIdAndUpdateCategoryTree($mm3->getId());
}

function createSerialsForAllDirectrices()
{
    $tree_directriz = CategoryPeer::retrieveByCod("Directriz");
    foreach ($tree_directriz->getChildren() as $directriz){
        createSerialWithDirectriz($directriz->getCod());
    }

}

function createSerialsForAllLugares()
{
    // Como los lugares tienen una cierta agrupación lógica según COD: T2-1 T2-2 ... 
    // la usaré para reunirlos en series.
    $year_before   = date('Y-m-d H:i:s', strtotime('-1 year'));
    $tree_lugares = CategoryPeer::retrieveByCod("Lugares");

    $grouped_cats = groupCategoriesByCod($tree_lugares);
    foreach ($grouped_cats as $prefix => $cat_group){
        $serial_lugar = createSerial("Test serie con lugares de tipo " . $prefix . "-X");
        foreach ($cat_group as $cat){
            $mm1 = createMmInSerial("Test mm con lugar " . $cat->getname() . " publicado el año pasado", $serial_lugar, $year_before);
            $cat->addMmIdAndUpdateCategoryTree($mm1->getId());
            publishMmInWebtv($mm1);
            
            $mm2 = createMmInSerial("Test mm con lugar " . $cat->getname() . " publicado el año actual", $serial_lugar);
            $cat->addMmIdAndUpdateCategoryTree($mm2->getId());
            publishMmInWebtv($mm2);

            $mm3 = createMmInSerial("Test mm con lugar " . $cat->getname() . " sin publicar el año actual", $serial_lugar);
            $cat->addMmIdAndUpdateCategoryTree($mm3->getId());   
        }
    }

}

function createSerialsWithNovedades()
{
    $year_before       = date('Y-m-d H:i:s', strtotime('-1 year'));
    $five_years_before = date('Y-m-d H:i:s', strtotime('-5 year'));

    // Serial marked with novedad
    $serial_novedad = createSerial("Test serie novedad");
    $serial_novedad->setAnnounce(1);
    $serial_novedad->save();
    
    $mm1 = createMmInSerial("Test mm publicado el año pasado dentro de una serie seleccionada como novedad", $serial_novedad, $year_before);
    $mm3 = createMmInSerial("Test mm publicado este año dentro de una serie seleccionada como novedad", $serial_novedad);

    $mm2 = createMmInSerial("Test mm publicado hace 5 años, mm y serie marcados como novedad", $serial_novedad, $five_years_before);
    $mm2->setAnnounce(1);
    $mm2->save();

    publishAllMmFromSerial($serial_novedad);
    $mm4 = createMmInSerial("Test mm sin publicar hace cinco años dentro de una serie seleccionada como novedad", $serial_novedad, $five_years_before);    

    // Serial with some mms marked as novedad and some not.
    $serial_with_novedades = createSerial("Test serie con algunos mm novedad y otros no");
    
    $mm5 = createMmInSerial("Test mm publicado el año pasado como novedad", $serial_with_novedades, $year_before);
    $mm5->setAnnounce(1);
    $mm5->save();

    $mm6 = createMmInSerial("Test mm publicado hace 5 años", $serial_with_novedades, $five_years_before);
    $mm7 = createMmInSerial("Test mm publicado este año como novedad", $serial_with_novedades);
    $mm7->setAnnounce(1);
    $mm7->save();

    publishAllMmFromSerial($serial_with_novedades);
    $mm8 = createMmInSerial("Test mm sin publicar ", $serial_with_novedades); 

}

function groupCategoriesByCod($cat_parent, $prefix_length = 2)
{
    $grouped_categories = array();
    foreach ($cat_parent->getChildren() as $category){
        $cod_prefix = substr($category->getCod(), 0, $prefix_length); // T2-1, T2-2 ...

        if (!isset($grouped_categories[$cod_prefix])){
            $grouped_categories[$cod_prefix] = array();
        }
            $grouped_categories[$cod_prefix][] = $category;
    }

    return $grouped_categories;
}

function createVirtualGrounds()
{
    $vg1 = createVirtualGroundWithRank("Test vg editorial 1", 2);
    $vg1->setEditorial1(1);
    $vg1->save();

    $vg2 = createVirtualGroundWithRank("Test vg editorial 2", 3);
    $vg2->setEditorial2(1);
    $vg2->save();

    $vg3 = createVirtualGroundWithRank("Test vg humanidades", 4);
    setVirtualgroundCategoriesByNames( $vg3, array("filología", "historia", "Educación", "pedagogia", "lingüística")); // Unesco
    setVirtualgroundCategoriesByCodes( $vg3, array("Dhumanistica","Djuridicosocial")); // Directriz

    $vg4 = createVirtualGroundWithRank("Test vg ciencias", 5);
    setVirtualgroundCategoriesByNames( $vg4, array("Física", "Matemáticas", "Química", "Astronomía y astrofísica", "Ciencias de la Tierra y del Cosmos"));// Unesco
    setVirtualgroundCategoriesByCodes( $vg4, array("Dciencia")); // Directriz
}

function createVirtualGroundWithRank($cod = "Test virtualground", $rank = 2)
{
    // Each picture is tailored to its position with specific dimensions.
    // This keeps the same layout.
    $img = "/uploads/pic/ground/" . ($rank - 1) . ".jpg"; 

    if (!$vground = retrieveVirtualGroundByCod($cod)){
        echo "\n\nCreando VirtualGround: " . $cod . "\n";
        $vground = new VirtualGround();
        $vground->setDisplay(true);
        $vground->setCod($cod);
        $vground->setImg($img);

        $langs = sfConfig::get('app_lang_array', array('es'));
        foreach($langs as $lang){
          $vground->setCulture($lang);
          $vground->setName($cod);
        }
        
        $vground->save();
        while ($vground->getRank() > $rank) {
            $vground->moveUp();
            $vground->save();
        }
    }
    
    return $vground;
}

function retrieveVirtualGroundByCod($cod)
{
    $c = new Criteria();
    $c->add(VirtualGroundPeer::COD, $cod, Criteria::LIKE);

    return VirtualGroundPeer::doSelectOne($c);
}

/**
 * @param Virtualground $vg
 * @param array $category_names list of category names (categoryi18n.name)
 * Given the standard db collation, this list is case and accent insensitive.
 */
function setVirtualgroundCategoriesByNames($vg, $category_names){
    if (!$vg){
        echo "Error: virtualground inexistente, no se pueden añadir categorías\n";
        exit;
    }
    if (!is_array($category_names)){
        $category_names = array($category_names);
    }

    $c = new Criteria();
    $c->addJoin(CategoryPeer::ID, CategoryI18nPeer::ID);
    $c->add(CategoryI18nPeer::NAME, $category_names, Criteria::IN);
    $categories = CategoryPeer::doSelectWithI18n($c);

    setVirtualgroundCategories($vg, $categories);
}

function setVirtualgroundCategoriesByCodes($vg, $category_codes){
    if (!$vg){
        echo "Error: virtualground inexistente, no se pueden añadir categorías\n";
        exit;
    }
    if (!is_array($category_codes)){
        $category_codes = array($category_codes);
    }

    $c = new Criteria();
    $c->add(CategoryPeer::COD, $category_codes, Criteria::IN);
    $categories = CategoryPeer::doSelectWithI18n($c);

    setVirtualgroundCategories($vg, $categories);
}

/**
 * @param Virtualground $vg
 * @param array $categories list of category objects
 */
function setVirtualgroundCategories($vg, $categories)
{
    $found_category_names = array();
    foreach ($categories as $cat){
        $found_category_names[] = $cat->getName();
    }
    // echo "\nDebug: se encontraron " . count($categories) . " categorías con los nombres " . implode(",",$category_names) . ":\n";
    echo "Asignando al vg: [" . $vg->getCod() . "] las categorías: " . implode(", ", $found_category_names) . " ...";

    foreach ($categories as $cat){
        $cat->addVirtualGroundId($vg->getId());
    }
    echo " OK\n";

    if (!$vg->getOther()){
        $vg->setOther(1);
        $vg->save();
    }
}