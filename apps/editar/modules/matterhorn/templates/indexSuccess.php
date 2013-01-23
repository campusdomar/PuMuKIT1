<h3 class="cab_body_div">Opencast-Matterhorn Import</h3>

<div id="matterhorn_info"></div>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <?php include_partial('filters') ?>
    <div id="info_matterhorn" style="padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; margin-bottom: 10px">
      <div style="text-align:center ">
       <img src="/images/admin/load/spinner.gif" />
      </div>
    </div>
  </div>
  <div id="tv_admin_content" >
    <div id="list_matterhorn">
      <div style="text-align:center">
       <img src="/images/admin/load/spinner.gif" />
      </div>
    </div>
  </div>
  <div style="clear:both"></div>
</div>



<script type="text/javascript"> 
//<![CDATA[

new Ajax.Updater('list_matterhorn', '<?php echo url_for('matterhorn/list') ?>', {asynchronous:true, evalScripts:true});
new Ajax.Updater('info_matterhorn', '<?php echo url_for('matterhorn/info') ?>', {asynchronous:true, evalScripts:true});



function matterhorn_info(msg){
  $('div_messages_span_info').innerHTML = msg;
  new Effect.Opacity('div_messages_info', {duration:7.0, from:1.0, to:0.0});
}

//]]>
</script>


<br />
<br />
<br />
<br />
<br />