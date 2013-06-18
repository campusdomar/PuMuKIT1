<?php
/**
 *
 */
class Sanitize{
  static public function text($string){
      $con_acento = utf8_decode("ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿñÑ");
      $sin_acento = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuynN";
      $texto = strtr(utf8_decode($string), $con_acento, $sin_acento);

      return utf8_encode(strtolower($texto));
  }
}