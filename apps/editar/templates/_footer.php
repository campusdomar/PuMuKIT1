<! --- MESSAGES ALERT --- !>
<div id="div_messages_error" class="div_messages">
  <span class="div_messages_span"  onclick="this.parentNode.setOpacity(0); return false" >x cerrar</span>
  <span id="div_messages_span_error">Error</span>
</div>


<div id="div_messages_info" class="div_messages">
  <span class="div_messages_span" onclick="this.parentNode.setOpacity(0); return false" >x cerrar</span>
  <span id="div_messages_span_info">Info</span>
</div>



<div id="footer">
   <div style="float:right; padding:5px 10px 0px 0px">&copy; Copyright Universidade de vigo 2011</div>
<p>
  <?php echo sfConfig::get('app_pumukit_version')?>
  <a href="<?php echo sfConfig::get('app_info_link')?>"><?php echo sfConfig::get('app_metas_title')?></a>
  <a href="http://arca.rediris.es/">Arca WEB</a>
  <a href="http://pumukit.org/">PumuKIT WEB</a>
</p>
</div>