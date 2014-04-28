<?php if($function):?>
<div id="ground_notices">
   <strong><?php echo __('Se recomienda')?> <?php echo $function?>:</strong><br/>
   <?php echo form_remote_tag(array(
				    'update'     => $div,
				    'url'        => $url,
				    'evalScript' => true,
				    )) ?>
     <input type="hidden" name="function" value="<?php echo $function ?>"/>
     <input type="hidden" name="ground" value="<?php echo $function ?>"/>
     <input type="hidden" name="id" value="<?php echo $mm->getId() ?>"/>
     <ul style="margin-left: 15px">
     <?php foreach($grounds as $ground): ?>
       <li style="list-style: none">
         <input type="checkbox" checked="checked" name="ground_ids[]" value="<?php echo $ground->getId()?>" /> 
         - (<?php echo $ground->getGroundType()->getName()?>) <?php echo $ground->getName()?>
       </li>
     <?php endforeach?>
     </ul>
     <br/>
     <div style="text-align:center">
       <a href="#" onclick="new Ajax.Updater('<?php echo $div?>', '<?php echo url_for($url)?>', {asynchronous:true, evalScripts:false, parameters:Form.serialize(this.parentNode.parentNode)}); return false;"><?php echo __('Aceptar')?></a>
       <!-- <a href="#" onclick="this.parentNode.parentNode.reset(); return false"><?php echo __('Reset')?></a> -->
       <a href="#" onclick="this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode); return false"><?php echo __('Cancelar')?></a>

     </div>
   </form>
</div>
<?php endif?>
