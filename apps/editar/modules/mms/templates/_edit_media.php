<div id="tv_admin_container" style="padding: 4px 20px 20px">

<div style="height:41px"></div>

<fieldset id="tv_fieldset_none" class="">
  <dl style="margin: 0px">
    <div class="form-row">
      <dt><?php echo __('Im&aacute;genes:')?></dt>
      <dd>  
        <div id="pic_mms">
          <?php include_component('pics', 'list', array('mm' => $mm->getId())) ?> 
        </div>
      </dd>
    </div>

    <div class="form-row">
      <dt><?php echo __('Archivos de V&iacute;deo:')?></dt>
      <dd>  
        <div id="files_mms">
          <?php include_component('files', 'list', array('mm' => $mm->getId())) ?>
        </div>
      </dd>
    </div>
    
    <?php echo javascript_tag("
        if (typeof update_file == 'object') update_file.stop();
        update_file = new Ajax.PeriodicalUpdater('files_mms', '/editar.php/files/list/mm/".$mm->getId()."', {
          method: 'get', frequency: 8, decay: 1
        });
        if (document.location.hash != '#mediaMmHash') update_file.stop();
     ") ?>



    <div class="form-row">
      <dt><?php echo __('Materiales:')?></dt>
      <dd>  
        <div id="materials_mms">
          <?php include_component('materials', 'list', array('mm' => $mm->getId())) ?>              
        </div>
      </dd>
    </div>

    <div class="form-row">
      <dt><?php echo __('Links:')?></dt>
      <dd>  
        <div id="links_mms">
          <?php include_component('links', 'list', array('mm' => $mm->getId())) ?>              
        </div>
      </dd>
    </div>
  </dl>
</fieldset>


</div>