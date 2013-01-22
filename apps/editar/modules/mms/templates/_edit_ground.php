<?php use_helper('Object');?>

<div style="height:41px"></div>
<div id="tv_admin_container" style="padding: 4px 20px 20px">
<fieldset id="tv_fieldset_none" class="" style="position:relative">


<?php include_component('grounds', 'recomendationlist', array('mm' => $mm, 'url' => 'mms/relationgrounds', 'div' => 'groundMmDiv',
							      'ground_id' => $sf_request->getParameter('ground', 0))); ?>

  <dl style="margin: 0px">

   <?php foreach($groundtypes as $groundtype):?>
    <?php $function = create_function('$a', 'return ($a->getGroundTypeId() == '.$groundtype->getId().');');?>
    <div class="form-row">
      <dt><?php echo $groundtype->getName()?>:</dt>
      <dd>  
        <div id="ground<?php echo $groundtype->getId()?>_mms">



<div style="margin-bottom: 5px; padding-left: 232px">
    <?php echo __('Filtar')?>:
    <input type="input" id="input_filter_<?php echo $groundtype->getId()?>" size="40" onkeypress="filtrar<?php echo $groundtype->getId()?>(this.value)" />
</div>

    <?php echo javascript_tag("
function filtrar".$groundtype->getId()."(que)
{
 var re = $$('select#grounds".$groundtype->getId()."_select option');
 for(var i=0; i < re.length; i++){
   if (que == ''){
     re[i].show();
   }else if(re[i].innerHTML.include(que)){
     re[i].show();
   }else{
     re[i].hide();
   }
 }
}
") ?>



<!-- classic -->
<?php
  echo select_tag('grounds'.$groundtype->getId().'_sel_select', 
		  objects_for_select(array_filter($grounds_sel->getRawValue(), $function), 'getId', 'getName'), 
		  array('size' => 20, 
			'style' => 'width:200px; height: 160px',
			'ondblclick' => "if(this.value != '') new Ajax.Updater('groundMmDiv', 
                                                          '/editar.php/mms/deleteGround/ground/' + this.value +'/id/".$mm->getId()."' , 
                                                          {asynchronous:true, evalScripts:true});"
			)
		  );
?>



<a href="#" onclick="if ($('grounds<?php echo $groundtype->getId()?>_select').value != '') {new Ajax.Updater('groundMmDiv', '/editar.php/mms/addGround/ground/' + $('grounds<?php echo $groundtype->getId()?>_select').value +'/id/<?php echo $mm->getId() ?>' , {asynchronous:true, evalScripts:true})}; return false;">&#8592;</a>
<a href="#" onclick="if ($('grounds<?php echo $groundtype->getId()?>_sel_select').value != '') {new Ajax.Updater('groundMmDiv', '/editar.php/mms/deleteGround/ground/' + $('grounds<?php echo $groundtype->getId()?>_sel_select').value +'/id/<?php echo $mm->getId() ?>', {asynchronous:true, evalScripts:true})}; return false;">&#8594;</a>


<?php
  echo select_tag('grounds'.$groundtype->getId().'_select', 
		  objects_for_select(array_filter($grounds->getRawValue(), $function), 'getId', 'getName'), 
		  array('size' => 20, 
			'style' => 'width:400px; height: 160px',
			'ondblclick' => "if(this.value != '') new Ajax.Updater('groundMmDiv', 
                                                          '/editar.php/mms/addGround/ground/' + this.value +'/id/".$mm->getId()."', 
                                                          {asynchronous:true, evalScripts:true});"
			)
		  );
?>
        
        </div>
      </dd>
    </div>
   <?php endforeach ?>







  </dl>
</fieldset>

</div>

<?php if (isset($msg_alert)) echo m_msg_alert($msg_alert) ?>