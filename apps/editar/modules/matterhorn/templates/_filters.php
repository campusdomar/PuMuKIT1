<!-- Filter -->
<div class="tv_admin_filters">
<?php echo form_remote_tag(array('update' => 'list_matterhorn', 'url' => 'matterhorn/list', 'script' => 'true' ), 'id=filter_matterhorn') ?>
  <fieldset>
    <h2>Buscar</h2>

    <div class="form-row">
      <label for="name">Query:</label>
      <div class="content">
        <?php echo input_tag('q', null) ?>
      </div>
    </div>
  </fieldset>

  <ul class="tv_admin_actions">
    <li>
      <?php echo button_to_remote('cancelar', array('before' => '$("filter_matterhorn").reset();', 'update' => 'list_matterhorn', 'url' => 'matterhorn/list?reset=true', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?>
    </li>
    <li>
      <?php echo submit_tag('filtrar', 'name=filter class=tv_admin_action_filter') ?>
    </li>
  </ul>
</form>
</div>

