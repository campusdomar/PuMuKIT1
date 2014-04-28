<select name="status" id="filters_anounce" onchange="">
  <option <?php echo (($status == 0)?'selected="selected"':''); ?>value="0" ><?php echo __('Bloqueado')?></option>
  <option <?php echo (($status == 1)?'selected="selected"':''); ?>value="1" ><?php echo __('Oculto')?></option>
  <option <?php echo (($status == 2)?'selected="selected"':''); ?>value="2" ><?php echo __('Mediateca')?></option>
  <option <?php echo (($status == 3)?'selected="selected"':''); ?>value="3" ><?php echo __('Mediateca y ARCA')?></option>
</select>
