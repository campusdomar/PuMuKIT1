<?php

/**
 * @package sfPmkHelper
 *
 *
 * @since  03 Jun 2013
 * @version 1.0.0
 *
 */

/**
 * Functions to solve pumukits regular issues
 *
 * *
 * @author Gerald Estadieu <gestadieu@gmail.com>
 * @since  03 June 2013
 *
 */


function str_abbr($string, $len, $replacement) {

  $aux = @strpos($string, ' ', $len);
  return $aux?substr_replace($string, $replacement, $aux):$string;

}

/*
function m_msg_alert($msg_alert){
  return javascript_tag(
			"$('div_messages_span_" . $msg_alert[0] . "').innerHTML ='". $msg_alert[1]."';\n".
			visual_effect('opacity', 'div_messages_' . $msg_alert[0], array('duration' => '7.0', 'from' => '1.0', 'to' => '0.0'))
			);

}

function m_msg_alert_jquery($msg_alert){
  return ("<script type='text/javascript'>".
			"$('#div_messages_span_" . $msg_alert[0] . "').html('". $msg_alert[1]."');\n".
            "$('#div_messages_" . $msg_alert[0] . "').fadeTo('slow', 1);\n".
            "</script>"
			);
}

*/