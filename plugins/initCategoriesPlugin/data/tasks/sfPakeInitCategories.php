<?php
/**
 * init-categories - task (symfony 1.0 command) to populate categories.
 * 
 * Fixtures are _really_slow_ initializing big amounts of nested set data.
 * This task uses the existing batch scripts to cut this time from ~20 to <1 min.
 * External plugin idea from http://www.lampjunkie.com/2008/04/custom-tasks-in-symfony-10/
 */
pake_desc('initialize root, timeframe and Unesco categories');
pake_task('init-categories');

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../../../..'));

function run_init_categories($task, $args)
{
    $script_paths = array(
        SF_ROOT_DIR . "/batch/timeframes/creacategoriasdestacadosradiotv.php",
        SF_ROOT_DIR . "/batch/pr/import_unesco_from_csv.php");
    
    foreach ($script_paths as $script){
        echo "\n---------------------------------------------------\n";
        echo "--- Executing: " . $script . "\n";
        echo shell_exec('php ' . $script);
        // echo $output;       
    }
}