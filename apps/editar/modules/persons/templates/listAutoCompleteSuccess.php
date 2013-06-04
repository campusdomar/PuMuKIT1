<?php use_helper('Object') ?>


<div id="tv_admin_container">

<p>
Escriba el nombre de la persona que desea a&ntilde;adir. En caso de que ya exista en la base de datos aparecer&aacute; en una lista depegable, donde usted puede selecionarla y <strong>usarla</strong>. Si no existe en la base de datos <strong>cree</strong> una entrada nueva con el nombre escrito.
</p>

<fieldset>
  
  <div class="form-row">
    <?php echo label_for('name', 'Nombre:', 'class="required" ') ?>
    <div class="content">
    
      <input type="text" name="name" id="name" value="nombre a buscar" autocomplete="on" size="80" />
      <span id="indicator1" style="display: none"><?php echo image_tag('admin/load/spinner.gif', 'size=18x18 alt=trabajando...') ?></span>
      <div id="name_auto_complete" class="auto_complete" style="display:none"></div>
  
    </div>
  </div>
  
</fieldset>


<ul class="tv_admin_actions">
  <li>
    <?php echo button_to_function('Nuevo', '
      var aux=$("name").value.strip();
      if (aux == "nombre a buscar") aux="";
      Modalbox.show("/editar.php/persons/createrelation'.$template.'/mm/'.$mm_id.'/role/'.$role_id.'/name/" + aux, 
      {title:"Editar Nueva Novedad", width:800}); return false;', array ('class' => 'tv_admin_action_create')) 
    ?>
  </li>
  <li>
   <?php //if(isNaN(parseInt($('name').value))) {  ?>
    <input class="tv_admin_action_create" onclick="
      if(/^\d+ -/.test($('name').value.strip())) { 
        new Ajax.Updater('<?php echo $role_id?>_person_mms', 
                         '/editar.php/persons/link<?php echo $template?>/preview/true/mm/<?php echo $mm_id?>/role/<?php echo $role_id?>/person/'+parseInt($('name').value.strip()), 
                         {asynchronous:true, evalScripts:true}
        ); 
        Modalbox.hide();   
      }else{
        alert('Selecione antes una persona');
      }
      return false;" 
    type="button" value="Usar" />
  </li>


<!--
  <li>
<?php echo button_to_function('Info', 'Modalbox.show("/editar.php/persons/createFromPerson/mm/'.$mm_id.'/role/'.$role_id.'/name/" + $("name").value.strip(), {title:"Editar Nueva Novedad", width:800}); return false;', array ('class' => 'tv_admin_action_filter')) ?>
  </li>
-->


  <li>
    <?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?>
  </li>
</ul>

</div>
 
<div style="clear:right"></div>






<?php echo javascript_tag("
  if($('MB_content')) $('MB_content').setStyle({ 'position' : 'static' });
  new Ajax.Autocompleter('name', 'name_auto_complete', '/editar.php/persons/autoComplete', {minChars: 2, indicator: 'indicator1'});
  $('name').focus();  $('name').select();
") ?>