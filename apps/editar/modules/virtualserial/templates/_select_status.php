<select name="status" id="filters_anounce" onchange="">
  <?php echo (($status == -50)?'<option selected="selected" value="-50" >Bloquedo codificando</option>':''); ?>
  <?php echo (($status == -49)?'<option selected="selected" value="-49" >Oculto codificando</option>':''); ?>
  <?php echo (($status == -48)?'<option selected="selected" value="-48" >Mediateca codificando</option>':''); ?>
  <?php echo (($status == -47)?'<option selected="selected" value="-47" >Arca codificando</option>':''); ?>

  <?php echo (($status == -20)?'<option selected="selected" value="-20" >Dueno bloq.(Bloquedo)</option>':''); ?>
  <?php echo (($status == -19)?'<option selected="selected" value="-19" >Dueno bloq.(Oculto)</option>':''); ?>
  <?php echo (($status == -18)?'<option selected="selected" value="-18" >Dueno bloq.(Mediateca)</option>':''); ?>
  <?php echo (($status == -17)?'<option selected="selected" value="-17" >Dueno bloq.(Arca)</option>':''); ?>

  <?php echo (($status == -10)?'<option selected="selected" value="-10" >Papelera(Bloquedo)</option>':''); ?>
  <?php echo (($status == -9)?'<option selected="selected" value="-9" >Papelera(Oculto)</option>':''); ?>
  <?php echo (($status == -8)?'<option selected="selected" value="-8" >Papelera(Mediateca)</option>':''); ?>
  <?php echo (($status == -7)?'<option selected="selected" value="-7" >Papelera(Arca)</option>':''); ?>

  <option <?php echo (($status == 0)?'selected="selected"':''); ?>value="0" >Bloqueado</option>
  <option <?php echo (($status == 1)?'selected="selected"':''); ?>value="1" >Oculto</option>
  <option <?php echo (($status == 2)?'selected="selected"':''); ?>value="2" >Mediateca</option>
  <option <?php echo (($status == 3)?'selected="selected"':''); ?>value="3" >Mediateca y Arca</option>
</select>
