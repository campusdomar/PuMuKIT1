<div id="new_template" style="padding-top: 10px">
  <?php echo form_tag('#', 'class=float-left id=sf_asset_mkdir_form name=sf_asset_mkdir_form') ?>
    <fieldset>


      <div class="form-row">
        <?php echo label_for('type', __('Basado en:'), '') ?>        
        <div class="content">
          <select name="type" id="type"
            onChange="new Ajax.Updater('list_vgrounds', '<?php echo url_for('virtualgrounds/updategroundtype')?>', {
                             parameters: 'id=' + this.value
                           })">
            <?php foreach(GroundTypePeer::doSelect(new Criteria()) as $g):?>
              <option value="<?php echo $g->getId() ?>"  
                      <?php echo ($g->getId() == $default_ground_type)?" selected=\"selected\" ":""?>
                >
                <?php echo $g->getName() ?>
              </option>
            <?php endforeach ?>
          </select>   
        </div>
      </div>

    </fieldset>
  </form>
</div>










