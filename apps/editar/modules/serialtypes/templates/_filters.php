<!-- Filter -->
<div class="tv_admin_filters">
<?php echo form_remote_tag(array('update' => 'list_serialtypes', 'url' => 'serialtypes/list', 'script' => 'true' ), 'id=filter_serialtypes') ?>
  <fieldset>
    <h2><?php echo __('Buscar')?></h2>

    <div class="form-row">
      <label for="name"><?php echo __('Nombre:')?></label>
      <div class="content">
        <?php echo input_tag('filters[name]', null) ?>
      </div>
    </div>
  </fieldset>

  <ul class="tv_admin_actions">
    <li>
      <?php echo button_to_remote(__('reset'), array('before' => '$("filter_serialtypes").reset();', 'update' => 'list_serialtypes', 'url' => 'serialtypes/list?filter=filter ', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?>
    </li>
    <li>
      <?php echo submit_tag(__('filtrar'), 'name=filter class=tv_admin_action_filter') ?>
    </li>
  </ul>
</form>
</div>
