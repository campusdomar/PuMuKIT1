<?php
/**
 * MODULO STATISTICS ACTIONS. 
 *
 * @package    pumukit
 * @subpackage staticstics
 * @author     Ruben Gonzalez Gonzalez <rubenrua ar uvigo dot es>
 * @version    1.0
 */
class statisticsActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/statistics
   * Muestra el modulo de estadisticas
   *
   * Accion por defecto en la aplicacion. Acceso privado. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('config_menu','active');;
  }
}
