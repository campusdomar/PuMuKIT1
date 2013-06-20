<!-- LIST & EDIT-->
<div id="tv_admin_content_virtualserial" style="overflow: hidden; float: left; width: 78%">
  <!-- LIST -->
  <div id="list_mms" name="list_mms" act="/mms/list" style="overflow: hidden; min-width: 630px; margin-bottom: 3px; margin-right: 3px; overflow: hidden">
    <?php include_component('virtualserial', 'list') ?>
  </div>
  <!-- EDIT -->
  <div id="edit_mms" class="tv_admin_edit" style="float:left; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; padding-top: 5px; min-width: 93%; overflow: hidden;">  
    <?php include_component('virtualserial', 'edit')?>
  </div>

  <div style="clear:both"></div>
</div>

<!-- PREVIEW -->
<div id="tv_admin_bar" style="width: 19%; float:left">
  <div id="preview_mm" style="padding: 1%; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; overflow: hidden;">
    <?php include_component('virtualserial', 'preview') ?>
  </div>
</div>