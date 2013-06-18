<h3 class="cab_body_div"><img src="/images/admin/cab/config_ico.png"/> Categories</h3>

<div id="tv_admin_container">

  <div id="tv_admin_content" style="margin: 0px">
    <div id="list_categories" name="list_categories" act="/categories/list">
      <?php include_component('categories', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
   <li><?php echo button_to_function('Nuevo', 'Modalbox.show("categories/create?parent_id=' . $root->getId() .'", {title:"Editar nuevo category", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?></li>
      </ul>
    </div>

    <select id="options_categories" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('role', $('options_categories'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <!-- <option value="delete_sel">Borrar selecionados</option>
      <option value="create">Crear nuevo</option> -->
    </select>
    
  </div>
</div>

<script>
function toggle_section_cat(id, element) {
  console.log(element);
  if(element.parentElement.hasClassName("expanded")){
    $$(".c_" + id).each(function(e){
      e.getElementsBySelector(".expanded").each(function(ee){ee.removeClassName("expanded").addClassName("collapsed");});
      e.hide();
    });
  }else{
    $$(".p_" + id).each(function(e){e.show()});
  }
  element.parentElement.toggleClassName("expanded").toggleClassName("collapsed");
}

function cat_relation_change(one_id, two_id, value) {
  new Ajax.Request("/editar.php/categories/changecategory/oneid/" + one_id + "/twoid/" + two_id + "/value/" + value,  {
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        console.log(response);
    }
  });
}
</script>

<br />
<br />
<br />
<br />
<br />
<br />