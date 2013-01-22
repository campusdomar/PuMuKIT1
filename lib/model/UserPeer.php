<?php

/**
 * UserPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'user'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class UserPeer extends BaseUserPeer
{
  /**
   * Comprueba la existencia de us usuario con
   * dicho login y passwd.
   *
   *
   * @access public
   * @return User usuario si existe, false si no
   * @param string $longIn Login de usuario
   * @param string $passwdIn Passwd de usuario
   */
  static public function isUser($loginIn, $passwdIn){
    $aux = false;
    $c = new Criteria();
    $c->add(UserPeer::LOGIN, $loginIn);
    $user = UserPeer::doSelectOne($c);

    if(($user != false) && ($user->getPasswd() === $passwdIn)){
      $aux = $user;
    }
    
    return $aux;
  }
}
