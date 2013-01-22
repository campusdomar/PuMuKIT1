<div id="tv_admin_container" style="padding: 4px 20px 20px">

<div style="height:41px"></div>

<fieldset id="tv_fieldset_none" class="">
  <dl style="margin: 0px">
    <?php foreach($roles as $role): ?>
      <div class="form-row">
        <dt><?php echo $role->getName(); ?><?php echo ($role->getDisplay()?'*':'')?>:</dt>
        <dd>  
          <div id="<?php echo $role->getId(); ?>_person_mms">

	    <?php include_component('persons', 'listrelationtemplate', array('mm' => $mm, 'role' => $role)) ?>        
        
          </div>
        </dd>
      </div>
    <?php endforeach; ?>
  </dl>
</fieldset>


</div>