<div id="tv_admin_container">

  <?php echo form_remote_tag(array( 
    'update' => 'hidden_div',  //FIXME
    'url' => 'virtualgrounds/updaterelations',
    'script' => 'true',
  )); ?>

<?php // Comprobar función javascript para calcular el vertical offset en vez de números mágicos.
// No funciona en todos los casos (cat. padre abierta o cerrada, cat. hija, etc.)
//getVerticalOffsetFromFirstLiText = function (spanElement){
  // Finds li parent, ul parent, first li and first span to get the real text offset.
  //return spanElement.parentNode.parentNode.children[0].children[0].positionedOffset()[1];
//} ?>

  <?php echo javascript_tag('
toggle_tree_cat_mmless = function (element, id, cat_id) {
  var firstLiTextVerticalOffset = 113; 
  if (element.parentElement.hasClassName("notload")) {
    element.parentElement.removeClassName("notload");
    new Ajax.Updater("cat_ul_children_" + id, "' . url_for('virtualgrounds/getchildrenmmless') . '/id/"  + id + "/block_cat/" + cat_id, {
      onComplete: function(){ 
        $("all_category_" + cat_id).scrollTop = ((element.positionedOffset()[1]) - firstLiTextVerticalOffset); }
    });
  } else {
    $$(".cat_li_parent_" + id).each(function(e){e.toggleClassName("nodisplay")});
    //element.scrollIntoView();
    $("all_category_" + cat_id).scrollTop = ((element.positionedOffset()[1]) - firstLiTextVerticalOffset);
  }
  element.parentElement.toggleClassName("expanded").toggleClassName("collapsed");
}

function create_li_in_select_mmless(cat, block_cat_id) {
  var $ul = $("select_ul_category_" + block_cat_id);
  var li = new Element("li", {"id": "select_li_" + cat.id, "class": "element"});
  var span1 = new Element("span", {"class": "icon"}).update("&nbsp;");
  var span2 = new Element("span", {"onclick":"$$(\'.clicked_category_left\').invoke(\'removeClassName\', \'clicked_category_left\'); this.addClassName(\'clicked_category_left\');", "ondblclick": "del_tree_cat(" + cat.id +", " + ")"}).update(cat.cod+ " - " + cat.name);
  li.insert(span1).insert(span2);
  //Add quit logica.
  $ul.insert(li);
}

function inc_num_mm(cat_id, num)
{
  var aux = $("info_num_mm_" + cat_id);
  if (aux){
    var nn = (parseInt(aux.innerHTML) + num);
    var p = aux.parentElement.parentElement;
    if (nn == 0){
      p.addClassName("nomm");
    } else {
      p.removeClassName("nomm");
    }
    aux.innerHTML = nn;
  }
}

') ?>

  <input type="hidden" name="id" id="id" value="<?php echo  $sf_request->getParameter('id')?>" />
  <fieldset>
    <div class="form-row" style="max-height: 600px; overflow-y: scroll; overflow-x: hidden;">
    
      <div style="width:30%; float:left; padding: 1%; min-height: 30px;">
          <input type="checkbox" 
                 name="categories[1]" 
                 checked="checked"> 
          prueba categoria 1
      </div>

      <div style="width:30%; float:left; padding: 1%; min-height: 30px;">
        <input type="checkbox" 
               name="categories[2]" 
        > 
        
        prueba categoria 2
      </div>

    <div>div dentro del fieldset antes del clear left </div>
    <div style="clear:left"></div>
    <div>div dentro del fieldset después del clear left </div>

    <?php foreach(CategoryPeer::doSelectParents() as $c): $children = $c->getChildren() ?>
      <?php if(!$c->getDisplay()) continue?>
      <div class="form-row">
        <dt><?php echo $c->getName()?>:</dt>
        <dd>
          <div id="category<?php echo $c->getId()?>_mms">
            <div style="overflow:hidden">
              <div style="float: left; height: 460px" class="category" id="all_category_<?php echo $c->getId()?>">
                <?php if(count($children)):?>
                  <ul class="category_tree">
                    <?php include_partial('virtualgrounds/list_categories_ajax', array(
                     'vg_id' => $vg_id,
                     'parent'    => 'root', 
                     'block_cat' => $c->getId(),
                     'nodes'     => $children)) ?>
                  </ul>
                <?php endif?>
              </div>

              <div style="height: 460px; float: left; padding: 220px 5px 0px">
                <a href="#" onclick="if ( $$('.clicked_category_left')[0] != undefined ) { $$('.clicked_category_left')[0].ondblclick() } return false;">&#8592;</a>
                <a href="#" onclick="if ( $$('.clicked_category_right')[0] != undefined ) { $$('.clicked_category_right')[0].ondblclick() } return false;">&#8594;</a>
              </div>

              <div style="width: 50%; height: 460px; border: 1px solid #bbb; float: left;" class="category" id="select_category_<?php echo $c->getId()?>">
                <ul class="category_tree" id="select_ul_category_<?php echo $c->getId()?>" >
                   <?php /* foreach($mm->getCategorys($c) as $mmc):?>
                   <li draggable="false" class="element" id="select_li_<?php echo $mmc->getId() ?>" >
                      <span class="icon">&nbsp;</span>
                      <span onclick="$$('.clicked_category_left').invoke('removeClassName', 'clicked_category_left'); this.addClassName('clicked_category');" ondblclick="javascript:del_tree_cat(<?php echo $mmc->getId()?>, <?php echo $mm->getId() ?>);" >
                      <?php echo $mmc->getCod() ?> - <?php echo $mmc->getName() ?> 
                      </span>
                   </li>
                   <?php endforeach */?>
                </ul>
              </div>

            </div>
          </div>
        </dd>
      </div>
    </div>
    <?php endforeach?>

  </fieldset>
  <div>
    Así queda un div fuera del fieldset.
  </div>
  <?php /* TO DO
    
    * Listar las categorías padres 
      . Bloques para categorías con display = 1 (p.ej. unesco y temáticas en uned)
      . En cada bloque se llama a un partial que lista las categorías
        - ajax para cargar sólo el invel que interesa

    * Configurar iconos [+] y [ ] según  esté abierta o cerrada cada categoría
    * ¿javascript para subir la categoría abierta como primera del listado?
    * checkboxes en cada categoría
    * lógica que empareje de alguna manera los checkboxes con los virtual_ground.

  */?>


  <ul class="tv_admin_actions">
    <li><?php echo submit_tag('OK','name=OK class=tv_admin_action_save onclick=Modalbox.hide()'); ?></li>
    <li><?php echo button_to_function('Cancel', "Modalbox.hide()", 'class=tv_admin_action_delete') ?> </li>
   </ul>

  </form>
</div>


<?php /*TO DO - revisar y extraer las funciones necesarias
echo javascript_tag("
var update_file;
window.onload = function(){
  $$('div.sidebar').invoke('setStyle', { height: document.height + 'px' });
  Shadowbox.init({
    skipSetup:  true,
    onOpen:     function(element) {
                  if (typeof update_file == 'object') update_file.stop();
                },
    onClose:    function(element) {
                  if (typeof update_file == 'object') update_file.start();
                }
  });
};

window.click_fila_virtualserial = function(tr, id)
{
  mmSelId = id;
  new Ajax.Updater('edit_mms', '" . url_for('virtualserial/edit') . "', {
      asynchronous: true, 
      evalScripts: true,
      parameters: {id: id},
      onComplete: function(){ $('search_loading_img').hide(); }
  });
  new Ajax.Updater('preview_mm', '" . url_for('virtualserial/preview') . "', {
      asynchronous: true, 
      evalScripts: true,
      parameters: {id: id}
  });
  $('search_loading_img').show(); 
  $$('.tv_admin_row_this').invoke('removeClassName', 'tv_admin_row_this');
  if (tr != null) tr.parentNode.addClassName('tv_admin_row_this');
};

window.create_div_in_table = function(cat, mm_id, idcat_to_add){
  if ( idcat_to_add == " . $cat_raiz_unesco->getId() . " ){
    var td = $('list_unesco');
    var div = new Element('div', {'id': 'cat-' + cat.id, 'class': 'label label-info unesco_element'}).update(cat.name + ' ');
    var a1 = new Element('a', {'class': 'unesco_element_a'}).update('X');
    a1.onclick = function() {
      if (window.confirm('¿Seguro?')){
         $('cat-'+cat.id).remove();
         del_tree_cat(cat.id, mm_id);
      }
    };
    div.insert(a1);
  }
  //Add quit logica.
  td.insert(div);
};


window.update_tree = function(){
  //new Ajax.Updater('jstree', '" . url_for('virtualserial/tree') . "', { asynchronous:true, evalScripts:true });
  new Ajax.Request('" . url_for('virtualserial/treeInfoJSON') . "', {
    method: 'GET',
    asynchronous:true,
    evalScripts:true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.info.length; i++) {
            var c = response.responseJSON.info[i];
            $('toUpdate-' + c.cat_id).innerHTML = c.num_mm;
        }
    }
  });
};


// OJO, CREAR ADD TREE SEVERAL CAT VIRTUALGROUND

window.add_tree_several_cat_virtualground = function (cat_id, vg_id, idcat_to_add) {
  new Ajax.Request('" . url_for('virtualserial/addCategory') . "',  {
    method: 'post',
    parameters: { category: cat_id, id: Object.toJSON(vg_id) },
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.added.length; i++) {
            var c = response.responseJSON.added[i];
            inc_num_mm(c.id, 1);
            if (c.vg_id == mmSelId && c.group.length!=0 && c.group[1]!=undefined) {
               create_li_in_select(c, c.group[1], vg_id);
               if ( idcat_to_add == " . $cat_raiz_unesco->getId() . " ){ //UNESCO
                 create_div_in_table(c, vg_id, idcat_to_add);
               }
            }
        }
        update_tree();
    }
  });
};

window.del_tree_cat = function(cat_id, mm_id) {
  //console.log('del_tree_cat info_num_mm_' + cat_id);

  new Ajax.Request('" . url_for('virtualserial/delCategory') . "', {
    method: 'post',
    parameters: {category: cat_id, id: mm_id},
    asynchronous: true,
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.deleted.length; i++) {
            var c = response.responseJSON.deleted[i];
            var element = $('select_li_' + c.id);
            var element2 = $('cat-'+c.id);
            if (element)  element.remove();
            if (element2)  element2.remove();
            inc_num_mm(c.id, -1);
        }
        update_tree();
    }
  });
};

window.update_preview = function(id) {
  new Ajax.Updater('preview_mm', '" . url_for("virtualserial/preview") . "/id/' + id, {asynchronous:true, evalScripts:true});
};

//Global var to DnD
var dragElement = null;
var dragDataElement = null;
var mmSelId = " . $sf_user->getAttribute('id', 'null', 'tv_admin/virtualserial') . "; //Se actualiza en click_fila_virtualserial
") ?>*/?>