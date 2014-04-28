<div class="tv_admin_filters">
<?php echo form_remote_tag(array('update' => 'list_places', 'url' => 'places/list', 'script' => 'true' ), 'id=filter_places') ?>
  <fieldset>
    <h2>Buscar</h2>
    <div class="form-row">
      <label for="name"><?php echo __('Name:')?></label>
      <div class="content">
        <?php echo input_tag('filters[name]', null, array ('size' => 15)) ?>
      </div>
    </div>
    <div class="form-row">
      <label for="name"><?php echo __('Address:')?></label>
      <div class="content">
        <?php echo input_tag('filters[address]', null, array ('size' => 15)) ?>
      </div>
    </div>
  </fieldset>

  <ul class="tv_admin_actions">
<li><?php echo button_to_remote('reset', array('before' => '$("filter_places").reset();', 'update' => 'lista_places', 'url' => 'plac\
es/list?filter=filter ', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?></li>
<li><?php echo submit_tag('filter', 'name=filter class=tv_admin_action_filter') ?></li>
  </ul>
</form>
</div>
