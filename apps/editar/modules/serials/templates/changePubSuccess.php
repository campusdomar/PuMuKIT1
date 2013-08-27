<?php $pubs = PubChannelPeer::doSelect(new Criteria()); ?>

<div>
  <div id="tv_admin_container" style="width:100%">

Cambiar la difusion de los objetos multimedia de la serie: 
<div style="margin-bottom: 15p; font-size: 200%; color: #666666">&laquo;<?php echo $serial->getTitle() ?>&raquo;</div>

<!--  'update' => 'list_serials', -->

<?php echo form_remote_tag(array( 
  'update' => 'list_serials', 
  'url' => 'serials/update_pub',
  'script' => 'true',
)) ?>


<fieldset>

  <div class="form-row">
    <?php echo label_for('mm', 'Obj. MM:', 'class="required" ') ?>
    <div class="content" style="max-height: 400px; overflow-y: scroll">
  
      <table id="table_mms_change_pub" style="width:97%; border: 1px solid #000; padding: 1%;">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th><?php echo __('titulo')?></th>
            <?php if($sf_user->getAttribute('user_type_id', 1) == 0) :?>
            <th>Estado</th>
            <?php endif ?>
            <?php foreach($pubs as $p): ?>
              <th style="<?php echo $p->getEnable()?'':'color:grey'?>"><?php echo $p->getName()?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>

          <!-- todos -->
          <tr>
            <td></td>
            <td></td>
            <td><span style="font-weight: bold">TODOS</span></td>
            <?php if($sf_user->getAttribute('user_type_id', 1) == 0) :?>
            <td style="background: transparent">
              <select onchange="
if(this.value.length != 0){
  var val = this.value;
  $('table_mms_change_pub').select('select.status_change_pub').each(function(s){s.value = val});
}
                  " id="all_status_change_pub">
                <option selected="selected" ></option>
                <option value="0" >Publicado</option>
                <option value="1" >Bloqueado</option>
                <option value="2" >Oculto</option>
              </select>
            </td>
            <?php endif ?>
            <?php foreach($pubs as $p): ?>
	      <td style="text-align:center; background: transparent">
                <input type="checkbox"  
<?php if($p->getEnable() == 0):?>
disabled="disabled"
<?php else: ?>
 onchange="
var val = this.checked;
$('table_mms_change_pub').select('input.pub_channel_change_pub_<?php echo $p->getId()?>').each(function(s){s.checked = val});
                 "
<?php endif ?>
              />
              </td>
            <?php endforeach ?>
          </tr>

      
          <?php foreach($serial->getMms() as $mm): ?>
          <tr <?php echo ($mm->getStatusId() == 0)?'':' style="background-color: rgb(242, 242, 242)" '?>>
            <td style="background: transparent"><input id="<?php echo $mm->getId()?>" class="change_pub_mms" type="checkbox" checked="checked"> </td>
            <td style="background: transparent"><?php echo $mm->getId()?> </td>
            <td style="background: transparent"><?php echo $mm->getTitle() ?> </td> 
            <?php if($sf_user->getAttribute('user_type_id', 1) == 0) :?>
            <td style="background: transparent">
              <select name="data[<?php echo $mm->getId()?>][status]" id="filters_anounce_<?php echo $mm->getId()?>" onchange="" class="status_change_pub">
                <option <?php echo (($mm->getStatusId() == 0)?'selected="selected"':''); ?>value="0" >Publicado</option>
                <option <?php echo (($mm->getStatusId() == 1)?'selected="selected"':''); ?>value="1" >Bloqueado</option>
                <option <?php echo (($mm->getStatusId() == 2)?'selected="selected"':''); ?>value="2" >Oculto</option>
              </select>
            </td>
            <?php endif ?>

            <?php foreach($pubs as $p): ?>
               <?php if($p->getEnable() == 0):?>
                  <td style="background: transparent; color: grey; text-align: center">
                    <input type="checkbox" disabled="disabled" />
                  </td>
                <?php else:?>
                  <td style="text-align:center; background: transparent">
                    <!-- SOLO UNA QUERY-->
                    <?php $estado = $p->hasMm($mm->getId()) ?>
                      <input type="checkbox" 
                           onchange="" 
                           name="data[<?php echo $mm->getId()?>][pub_channels][<?php echo $p->getId()?>]" 
                           class="pub_channel_input_checkbox pub_channel_change_pub_<?php echo $p->getId()?>"
                           <?php echo ($estado !== 0)?'checked="checked"':""?>
                    />
                  </td>
                <?php endif ?>
            <?php endforeach ?>
            
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <div style="text-align: right">Seleccionar: 
      <a href="#" onclick="$('table_mms_change_pub').select('input.change_pub_mms').each(function(s){s.checked=false});return false">nada</a> 
      <a href="#" onclick="$('table_mms_change_pub').select('input.change_pub_mms').each(function(s){s.checked=true});return false">todo</a>
    </div>
  </div>


<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
</ul> 

</fieldset>
</form>
  </div>
</div>

