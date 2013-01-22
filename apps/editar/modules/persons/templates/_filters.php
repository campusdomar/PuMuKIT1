<!-- Filter -->
<div class="tv_admin_filters">
<?php echo form_remote_tag(array('update' => 'list_persons', 'url' => 'persons/list', 'script' => 'true', 'before' =>  '$("filters_vowel").value= null' ), 'id=filter_persons') ?>
  <fieldset>
    <h2>Buscar</h2>

    <div class="form-row">
      <label for="name">Nombre:</label>
      <div class="content">
        <?php echo input_tag('filters[name]', null) ?>
      </div>
    </div>
    <div class="form-row">
      <label for="other">Otro:</label>
      <div class="content">
        <?php echo input_tag('filters[other]', null) ?>
      </div>
    </div>
    <div class="form-row">
      <label for="vowel">Vocal:</label>
      <div class="content">
        <input id="filters_vowel" type="hidden" value="" name="filters[vowel]"/>
        <a href="#" onclick="window.filter_click_vowel('A')">A</a> 
        <a href="#" onclick="window.filter_click_vowel('B')">B</a> 
        <a href="#" onclick="window.filter_click_vowel('C')">C</a> 
        <a href="#" onclick="window.filter_click_vowel('D')">D</a> 
        <a href="#" onclick="window.filter_click_vowel('E')">E</a> 
        <a href="#" onclick="window.filter_click_vowel('F')">F</a> 
        <a href="#" onclick="window.filter_click_vowel('G')">G</a> 
        <a href="#" onclick="window.filter_click_vowel('H')">H</a> 
        <a href="#" onclick="window.filter_click_vowel('I')">I</a> 
        <a href="#" onclick="window.filter_click_vowel('J')">J</a> 
        <a href="#" onclick="window.filter_click_vowel('K')">K</a> 
        <a href="#" onclick="window.filter_click_vowel('L')">L</a> 
        <a href="#" onclick="window.filter_click_vowel('M')">M</a> 
        <a href="#" onclick="window.filter_click_vowel('N')">N</a> 
        <a href="#" onclick="window.filter_click_vowel('O')">O</a> 
        <a href="#" onclick="window.filter_click_vowel('P')">P</a> 
        <a href="#" onclick="window.filter_click_vowel('Q')">Q</a> 
        <a href="#" onclick="window.filter_click_vowel('R')">R</a> 
        <a href="#" onclick="window.filter_click_vowel('S')">S</a> 
        <a href="#" onclick="window.filter_click_vowel('T')">T</a> 
        <a href="#" onclick="window.filter_click_vowel('U')">U</a> 
        <a href="#" onclick="window.filter_click_vowel('V')">V</a> 
        <a href="#" onclick="window.filter_click_vowel('W')">W</a> 
        <a href="#" onclick="window.filter_click_vowel('X')">X</a> 
        <a href="#" onclick="window.filter_click_vowel('Y')">Y</a> 
        <a href="#" onclick="window.filter_click_vowel('Z')">Z</a> 
      </div>
    </div>

  </fieldset>

  <ul class="tv_admin_actions">
    <li>
      <?php echo button_to_remote('cancelar', array('before' => '$("filter_persons").reset();', 'update' => 'list_persons', 'url' => 'persons/list?filter=filter ', 'script' => 'true'), 'class=tv_admin_action_reset_filter') ?>
    </li>
    <li>
      <?php echo submit_tag('filtrar', 'name=filter class=tv_admin_action_filter') ?>
    </li>
  </ul>
</form>
</div>



<?php echo javascript_tag("
  window.filter_click_vowel = function(vowel)
  {
    $('filters_vowel').value= vowel; 
    new Ajax.Updater('list_persons', '/editar_dev.php/persons/list', {asynchronous:true, 
                      evalScripts: true, 
                      parameters: Form.serialize($('filter_persons'))}
    );
  }
") ?>