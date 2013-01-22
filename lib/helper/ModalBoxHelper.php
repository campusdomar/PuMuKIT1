<?php

/**
 * @package sfModalBoxPlugin
 *
 * @author Mickael Kurmann <mickael.kurmann@gmail.com>
 * @since  22 Apr 2007
 * @version 1.0.0
 *
 */

/**
 * Enable to use Modalbox script : http://okonet.ru/projects/modalbox/
 *
 * *
 * @author Gerald Estadieu <gestadieu@gmail.com>
 * @since  15 Apr 2007
 *
 */
function m_link_to($name, $url, $html_options, $modal_options = array())
{
    if(array_key_exists('title', $html_options))
    {
        $modal_options = array_merge($modal_options, array('title' => 'this.title'));
    }
    
    //$params_to_escape = sfConfig::get('app_params_to_escape_list');
    $params_to_escape = array('loadingString', 'closeString');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = _options_for_javascript($modal_options);

    $html_options['onclick'] = "Modalbox.show(this.href, " . $js_options . "); return false;";

    return link_to($name, $url, $html_options);
}



function m_msg_alert($msg_alert){
  return javascript_tag(
			"$('div_messages_span_" . $msg_alert[0] . "').innerHTML ='". $msg_alert[1]."';\n".
			visual_effect('opacity', 'div_messages_' . $msg_alert[0], array('duration' => '7.0', 'from' => '1.0', 'to' => '0.0'))
			);

}
