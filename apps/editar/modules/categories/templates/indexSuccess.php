<h3 class="cab_body_div"><img src="/images/admin/cab/config_ico.png"/> Categories</h3>

<div id="tv_admin_container">

  <div id="tv_admin_content" style="margin: 0px">
    <div id="list_categories" name="list_categories" act="/categories/list">
      <?php include_component('categories', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li><?php if($root) echo button_to_function('Nuevo', 
                 'Modalbox.show("categories/create?root=true&parent_id=' . $root->getId() .'", {title:"Crear nueva categoria", width:800}); return false;', array ('class' => 'tv_admin_action_create')) ?>
        </li>
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
function load_children_cat(id) {
  $$(".c_" + id).each(function(e){ e.remove() });
  var tr = $('row_cat_' +id);
  var level = tr.getAttribute('data-level');
  new Ajax.Request('<?php echo url_for('categories/children')?>' , {
    asynchronous:true, 
    evalScripts:true, 
    parameters:  {'id': id, 'level': level},
    onSuccess: function(response) {
      var t = tr.up('tbody');
      var ss = t.childElements();
      var b_move = false;
      for (var i=0;i<ss.length;i++) {
        if(b_move) t.insert(ss[i]);
        if (ss[i] == tr) {
	  b_move = true;
	  t.insert(response.transport.response);
	}
      }
      if ($$('.d_' + id).length != 0) {
	$$('#row_cat_' + id + ' .element').each(function(e){
						  e.addClassName("expanded");
						  e.removeClassName("element")});
      }
    }
  });

}

function toggle_section_cat(id, element, level) {

  if(element.parentElement.hasClassName("expanded")){
    $$(".c_" + id).each(function(e){
      e.getElementsBySelector(".expanded").each(function(ee){ee.removeClassName("expanded").addClassName("collapsed");});
      e.hide();
    });
  }else{
    if(element.parentElement.hasClassName("noload")) {
      element.parentElement.removeClassName("noload");
      load_children_cat(id);
    }else {
      $$(".d_" + id).each(function(e){e.show()});
    }
  }
  element.parentElement.toggleClassName("expanded").toggleClassName("collapsed");
}


function cat_relation_change(one_id, two_id, value) {
  new Ajax.Request("/editar.php/categories/changecategory/oneid/" + one_id + "/twoid/" + two_id + "/value/" + value,  {
    asynchronous: true, 
    evalScripts: true,
  });
}


function cat_delete(id, pid) {
  if (window.confirm('Seguro')) { 
    new Ajax.Request('<?php echo url_for('categories/delete')?>', {
      asynchronous:true, 
      evalScripts:true,
      parameters:  {'id': id},
      onFailure: function() {window.alert('No se pueden borrar categorías con descendientes.')},
      onSuccess: function(response) { 
        $('row_cat_' +id).remove(); 
        if ($$('.d_' + pid).length == 0) {
	  $$('#row_cat_' + pid + ' .expanded').each(function(e){
						     e.removeClassName("expanded");
						     e.addClassName("element")});
      }
      }
    }); 
  }
  return false;
}

function cat_error(action){
  $('div_messages_span_error').innerHTML ='Error al ' + action + ' la catagoría. Código Repetido';
  new Effect.Opacity('div_messages_error', {duration:7.0, from:1.0, to:0.0});
}

</script>



<br />
<br />
<br />
<br />
<br />
<br />