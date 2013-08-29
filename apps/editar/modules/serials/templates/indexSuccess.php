<h3 class="cab_body_div"><img src="/images/admin/cab/serial_ico.png"/> Series Multimedia</h3>

<div id="tv_admin_container">
  <div id="tv_admin_bar">
    <div id="preview_serial" style="min-height:74px; padding:5px; border: solid 1px #DDD; background: #8eb0bc url(/images/admin/cab/cab.gif) repeat-x scroll 0% 0%; margin-bottom: 10px">
      <?php include_component('serials', 'preview') ?>
    </div>
    
    <?php include_partial('acordeon', array('name' => 'serial', 'broadcasts' => $broadcasts, 'serialtypes' => $serialtypes)) ?> 

  </div>



  <div id="tv_admin_content" >
    <div id="list_serials" name="list_serials" act="/serials/list">
      <?php include_component('serials', 'list') ?>
    </div>

    <div style="float:right; width:50%">
      <ul class="tv_admin_actions">
        <!-- Falta -->
        <li>
         <?php echo link_to_function('Wizard', "Modalbox.show('".url_for("wizard/serial")."',{width:800, title:'PASO I: Serie'})", 'class=tv_admin_action_next') ?> 
        </li>
        <li>
         <?php echo link_to_remote('Crear', array('before' => '$("filter_serials").reset();', 'update' => 'list_serials', 'url' => 'serials/create?filter=filter', 'script' => 'true'), array('title' => 'Crear nueva seria', 'class' => 'tv_admin_action_create')) ?>
        </li>
      </ul>
    </div>

    <select id="options_serials" style="margin: 10px 0px; width: 33%" title="Acciones sobre elementos selecionados" onchange="window.change_select('serial', $('options_serials'))">
      <option value="default" selected="selected">Seleciona una acci&oacute;n...</option>
      <option disabled="">---</option>
      <option value="delete_sel">Borrar selecionados</option>
      <!-- <option value="inv_announce_sel">Anunciar/Desanunciar selecionados</option> -->
      <!-- <option value="inv_working_sel">Ocultar/Desocultar selecionados</option> Ocultarlos todos -->
    </select>
    
  </div>
  <div style="clear:both"></div>
</div>


</div>

<!-- div editar -->
<div id="edit_serials" class="tv_admin_edit">  
  <?php include_component('serials', 'edit')?>


<?php echo javascript_tag('
function toggle_tree_cat(element, id, mm_id, cat_id) {
  if (element.parentElement.hasClassName("notload")) {
    element.parentElement.removeClassName("notload");
    new Ajax.Updater("cat_ul_children_" + id, "' . url_for('mmtemplates/getchildren') . '/id/"  + id + "/block_cat/" + cat_id + "/mm/" + mm_id);
  } else {
    $$(".cat_li_parent_" + id).each(function(e){e.toggleClassName("nodisplay")});
    //element.scrollIntoView();
    $("all_category_" + cat_id).scrollTop = ((element.positionedOffset()[1]) - 44);
  }
  element.parentElement.toggleClassName("expanded").toggleClassName("collapsed");
}

function toggle_show_all()
{
  // SHOW - Quito el punto a los nodos que muestran sus hijos al desocultar
  $$(".expanded.element, .collapsed.element").each(function(e){
    e.removeClassName("element");
  });

  // SHOW & HIDE - Oculto/Muestro elementos finales que no tiene objetos multimedia
  $$(".nomm.element").each(function(e){
    e.toggleClassName("nodisplayall");
  });

  // SHOW & HIDE - Oculto/Muestro elementos todos sus hijos son finales sin objetos multimedia
  $$(".nomm.expanded, .nomm.collapsed").each(function(e){
    if (e.getElementsBySelector("li.nomm").length == e.getElementsBySelector("li").length) {
      e.toggleClassName("nodisplayall");
    }
  });

  // HIDE - Pongo el punto a los nodos que se quedan sin hijos al ocultar
  $$(".nomm").each(function(e){
    p = e.parentElement.parentElement;
    if (p.getElementsBySelector("li.nodisplayall").length == p.getElementsBySelector("li").length) {
      p.addClassName("element");
    }
  });

}

function create_li_in_select(cat, block_cat_id, mm_id) {
  var $ul = $("select_ul_category_" + block_cat_id);
  var li = new Element("li", {"id": "select_li_" + cat.id, "class": "element"});
  var span1 = new Element("span", {"class": "icon"}).update("&nbsp;");
  var span2 = new Element("span", {"onclick":"$$(\'.clicked_category_left\').invoke(\'removeClassName\', \'clicked_category_left\'); this.addClassName(\'clicked_category_left\');", "ondblclick": "del_tree_cat(" + cat.id +", "+ mm_id + ")"}).update(cat.cod+ " - " + cat.name);
  li.insert(span1).insert(span2);
  //Add quit logica.
  $ul.insert(li);
}

function add_tree_cat(cat_id, mm_id, block_cat_id) {
  new Ajax.Request("'. url_for("mmtemplates/addCategory") .'/id/" + mm_id,  {
    method: "post",
    parameters: "category=" + cat_id,
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.added.length; i++) {
            var c = response.responseJSON.added[i];
            if (c.group.length!=0 && c.group[1]!=undefined) {
               create_li_in_select(c, c.group[1], mm_id);  
            } 
        }
    }
  });  
}


function del_tree_cat(cat_id, mm_id) {
  // TODO Si ya lo tiene no hacer nada.
  console.log("del_tree_cat info_num_mm_" + cat_id);

  new Ajax.Request("'. url_for("mmtemplates/delCategory") .'/id/" + mm_id,  {
    method: "post",
    parameters: "category=" + cat_id,
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.deleted.length; i++) {
            var c = response.responseJSON.deleted[i];
            var $_element = $("select_li_" + c.id); 
            if ($_element)  $_element.remove(); 
        }
    }
  });  
}

window.update_preview = function(id) {
  new Ajax.Updater("preview_serial", "' . url_for('serials/preview') . '/id/" + id, {asynchronous:true, evalScripts:true});
}

') ?>

