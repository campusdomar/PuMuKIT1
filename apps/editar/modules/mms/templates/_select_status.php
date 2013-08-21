<select name="status" id="filters_anounce" onchange="">
  <option <?php echo (($status == 0)?'selected="selected"':''); ?>value="0" >Bloqueado</option>
  <option <?php echo (($status == 1)?'selected="selected"':''); ?>value="1" >Oculto</option>
  <option <?php echo (($status == 2)?'selected="selected"':''); ?>value="2" >Mediateca</option>
  <option <?php echo (($status == 3)?'selected="selected"':''); ?>value="3" >Mediateca y Arca</option>
</select>
