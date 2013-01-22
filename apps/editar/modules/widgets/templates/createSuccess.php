<div id="tv_admin_container">
  
  <fieldset>
    <div style="height:400px; overflow:scroll">
      <?php foreach($widgets as $w): ?>
        <div class="form-row">
          <?php echo link_to_remote('Add', array('success' => 'Modalbox.hide()', 
						 'update' => 'body_div', 
						 'url' => 'widgets/add?id=' . $w->getId().'&bar='.$bar, 
						 'script' => 'true') 
				    )?> - 
          <strong><?php echo $w->getName() ?></strong>: 
          <?php echo $w->getDescription() ?> 
        </div>
      <?php endforeach ?>
    </div>    
  </fieldset>
  
  
  
  
  <ul class="tv_admin_actions">
    <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
  </ul>
  
</div>
