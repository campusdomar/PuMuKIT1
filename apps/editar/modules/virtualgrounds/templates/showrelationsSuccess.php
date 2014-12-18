<div id="tv_admin_container">

<?php echo form_remote_tag(array( 
  'update' => 'list_grounds', 
  'url' => 'grounds/updaterelations',
  'script' => 'true',
)) ?>

<input type="hidden" name="id" id="id" value="<?php echo  $sf_request->getParameter('id')?>" />


<fieldset>
<div class="form-row" style="max-height: 600px; overflow-y: scroll; overflow-x: hidden;">


<?php foreach($grounds as $ground): if($ground->getId() == $sf_request->getParameter('id')) continue;?>
 <!-- <?php echo $ground->getId(); var_dump($rel)?> -->
  <div style="width:30%; float:left; padding: 1%; min-height: 30px;">
    <input type="checkbox" 
           name="relations[<?php echo $ground->getId()?>]" 
           <?php echo (in_array($ground->getId(), $sf_data->getRaw('rel')))?'checked="checked"':'' ?>
    > 
    (<?php echo $ground->getGroundType()->getName() ?>) <?php echo $ground->getName() ?>
  </div>
<?endforeach?>
<div style="clear:left"></div>

</fieldset>

<ul class="tv_admin_actions">
  <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
  <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
 </ul>

</form>
</div>
