<h3 class="cab_body_div"> Navigator (<?php echo $current_dir_slash?>)</h3>

<div id="sf_asset_container">

  <!-- <h1><?php echo __('Media library (%1%)', array('%1%' => $current_dir_slash), 'navigator') ?></h1> -->

  <div id="sf_asset_content">

    <div id="sf_asset_controls">

      <?php echo form_tag('navigator/upload', 'class=float-left id=sf_asset_upload_form name=sf_asset_upload_form multipart=true') ?>
      <?php echo input_hidden_tag('current_dir', $currentDir) ?>
      <fieldset>
        <div class="form-row">
          <?php echo label_for('file', __('Add a file:', array(), 'navigator'), '') ?>
          <div class="content"><?php echo input_file_tag('file') ?></div>
        </div>
      </fieldset>

      <ul class="sf_asset_actions">
        <li><?php echo submit_tag(__('Add', array(), 'navigator'), array (
          'name'    => 'add',
          'class'   => 'sf_asset_action_add_file',
          'onclick' => "if($('file').value.trim()=='') { alert('".__('Please choose a file first', array(), 'navigator')."');return false; }",
        )) ?></li>
      </ul>

      </form>

      <?php echo form_tag('navigator/mkdir', 'class=float-left id=sf_asset_mkdir_form name=sf_asset_mkdir_form') ?>
      <?php echo input_hidden_tag('current_dir', $currentDir) ?>
      <fieldset>
        <div class="form-row">
          <?php echo label_for('dir', __('Create a dir:', array(), 'navigator'), '') ?>
          <div class="content"><?php echo input_tag('name', null, 'size=15 id=dir') ?></div>
        </div>
      </fieldset>

      <ul class="sf_asset_actions">
        <li><?php echo submit_tag(__('Create', array(), 'navigator'), array (
          'name'    => 'create',
          'class'   => 'sf_asset_action_add_folder',
          'onclick' => "if($('dir').value=='') { alert('".__('Please enter a directory name first', array(), 'navigator')."');return false; }",
        )) ?></li>
      </ul>

      </form>

    </div>

    <div id="sf_asset_assets">

      <?php include_partial('navigator/dirs', array('dirs' => $dirs, 'currentDir' => $currentDir, 'parentDir' => $parentDir, 'is_file' => (count($files) > 0))) ?>
      <?php include_partial('navigator/files', array('files' => $files, 'currentDir' => $currentDir, 'webAbsCurrentDir' => $webAbsCurrentDir, 'count' => count($dirs))) ?>

    </div>

  </div>

</div>
