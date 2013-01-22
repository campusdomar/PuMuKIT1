<?php


class LDAP {

  const SERVER = 'ldap.cesga.es';
  const DN_BUSCADOR = 'cn=cesgatv,o=CESGA,dc=cesga,dc=es';
  const PASS_BUSCADOR = 'pepito2';
  const DN_SEARCH = 'o=CESGA,dc=uvigo,dc=es';




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
      var_dump($r);
      $sr=ldap_search($ds, LDAP::DN_SEARCH, "uid=cesgatv");
      if ($sr){
	$info = ldap_get_entries($ds, $sr);

	if (($info)&&($info["count"] != 0)){
	  var_dump($ldap);
	  
	  $dn = $info[0]["dn"];
	}
      }
      ldap_close($ds);
    }
    
    return $ret;
  }
}




  if(count($argv) != 3){
  echo "ERROR en parametros: php ldap.php user passwd\n";
  exit(-1);
}


echo "#######################################################\n";

echo "Comprobando " . $argv[1] . "  " .  $argv[2] . "\n";
if (LDAP::isUser($argv[1], $argv[2])){
  echo "SI";
}else{
  echo "No";
}

echo "\n\n";
