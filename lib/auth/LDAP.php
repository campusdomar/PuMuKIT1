<?php

/**
 * LDAP (class)
 *
 * Clase que facilita la comunicacion con un servidor LDAP
 *
 * Clase auxiliar utilizada para la comunicacion 
 * con el servidor LDAP, la configuracion de dicho servidor
 * se realiza a traves de las constantes de la clase.
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 0.45
 *
 * @package Pumukit-lib
 */
class LDAP {


  /**
   * constante que define la direcion dns del servidor ldap
   * @var const SERVER dns del servidor LDAP
   * @access public
   */
  const SERVER = '';
  /**
   * constante que define el DN del buscador
   * en el ldap
   * @var const DN_BUSCADOR dn para buscar
   * @access public
   */
  const DN_BUSCADOR = '';
  /**
   * constante que define la contrasenha
   * del buscador del  ldap
   * @var const PASS_BUSCADOR contasenha para buscar
   * @access public
   */
  const PASS_BUSCADOR = '';
  /**
   * constante que define el dn de un usuario el en LDAP
   * @var const DN_SEARCH dns del servidor LDAP
   * @access public
   */
  const DN_SEARCH = '';



  /**
   * Comprueba si existe un usuario con dicha contrasenha 
   * en el servidor LDAP
   *
   * @static
   * @access public
   * @return boolean true si existe el usuario
   * @param string $user nombre del usuario
   * @param string $pass contrasenha a verificar
   */
  static function isUser($user, $pass)
  {
    if ($pass === '') return false;
    $ret = false;
    $ds=ldap_connect( LDAP::SERVER ); 
    if ($ds) {
      $r=ldap_bind($ds, LDAP::DN_BUSCADOR, LDAP::PASS_BUSCADOR);

      $sr=ldap_search($ds, LDAP::DN_SEARCH, "uid=" . $user);
      if ($sr){
	$info = ldap_get_entries($ds, $sr);

	if (($info)&&($info["count"] != 0)){
	  
	  $dn = $info[0]["dn"];

	  $ret = @ldap_bind($ds, $dn, $pass);
	}
      }
      ldap_close($ds);
    }
    
    return $ret;
  }

  /**
   * Obtiene el nombre completo de usuario del 
   * servidor ldap.
   *
   * @static
   * @access public
   * @return string nombre completo del usuario
   * @param string $user nombre del usuario
   */
  static function getName($user)
  {
   
    $name = false;
    $ds=ldap_connect( LDAP::SERVER ); 
    if ($ds) {
      $r=ldap_bind($ds, LDAP::DN_BUSCADOR, LDAP::PASS_BUSCADOR);

      $sr=ldap_search($ds, LDAP::DN_SEARCH, "uid=" . $user);
      if ($sr){
	$info = ldap_get_entries($ds, $sr);
	if (($info)&&(count($info) != 0)){
	  
	  $name = $info[0]["cn"][0];
	  
	}
      }
      ldap_close($ds);
    }
    
    return $name;
  }

  /**
   * Obtiene el correo electronico de usuario del 
   * servidor ldap.
   *
   * @static
   * @access public
   * @return string correo del usuario
   * @param string $user nombre del usuario
   */
  static function getMail($user)
  {
   
    $name = false;
    $ds=ldap_connect( LDAP::SERVER ); 
    if ($ds) {
      $r=ldap_bind($ds, LDAP::DN_BUSCADOR, LDAP::PASS_BUSCADOR);

      $sr=ldap_search($ds, LDAP::DN_SEARCH, "uid=" . $user);
      if ($sr){
	$info = ldap_get_entries($ds, $sr);
	if (($info)&&(count($info) != 0)){
	  
	  $name = $info[0]["mail"][0];
	  
	}
      }
      ldap_close($ds);
    }
    
    return $name;
  }
}
