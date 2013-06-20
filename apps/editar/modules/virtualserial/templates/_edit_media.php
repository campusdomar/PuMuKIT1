<div id="tv_admin_container" style="padding: 4px 20px 20px">

<div style="height:41px"></div>

<fieldset id="tv_fieldset_none" class="" style="background-color: rgba(255, 255, 255, 0.4);">
  <dl style="margin: 0px">
    <div class="form-row">
      <dt>Im&aacute;genes:</dt>
      <dd>
         <table>
            <tr>
               <td style="width: 90%">
                  <div id="pic_mms">
                     <?php include_component('pics', 'list', array('mm' => $mm->getId(), 'module' => $module)) ?> 
                  </div>
               </td>
               <td style="width: 10%">
                  <div id="pic_mms_preview">
                     <?php include_component('virtualserial', 'previewMms2', array('mm' => $mm->getId(), 'module' => $module)) ?> 
                  </div>
               </td>
            </tr>
         </table>
      <div style="clear : left"></div>
      </dd>
    </div>
    <div class="form-row">
      <dt>Archivos de V&iacute;deo:</dt>
      <dd>  
        <div id="files_mms">
	   <?php include_component('files', 'list', array('mm' => $mm->getId(), 'module' => $module)) ?>
        </div>
      </dd>
    </div>
    
    <?php echo javascript_tag("
        if (typeof update_file == 'object') update_file.stop();
        update_file = new Ajax.PeriodicalUpdater('files_mms', '/editar.php/files/list/mm/".$mm->getId()."/mod/" . $module . "', {
          method: 'get', frequency: 8, decay: 1
        });
        if (document.location.hash != '#mediaMmHash') update_file.stop();
     ") ?>



    <div class="form-row">
      <dt>Materiales:</dt>
      <dd>  
        <div id="materials_mms">
          <?php include_component('materials', 'list', array('mm' => $mm->getId())) ?>              
        </div>
      </dd>
    </div>

    <div class="form-row">
      <dt>Links:</dt>
      <dd>  
        <div id="links_mms">
          <?php include_component('links', 'list', array('mm' => $mm->getId())) ?>              
        </div>
      </dd>
    </div>
  </dl>
</fieldset>


</div>