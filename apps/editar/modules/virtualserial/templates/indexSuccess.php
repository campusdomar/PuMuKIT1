<div id="tv_admin_container">

  <!-- TREE -->
  <div style="width: 17%; overflow: hiden; float: left">
    <div class="sidebar">
      <div class="unesco_title">
       <div style="width: 300px">
         <span style="color: #DE7010; font-size: 17px; font-weight: bold; vertical-align: bottom;">
           <img src="/images/admin/cab/serial_ico.png">Catalogador Unesco
         </span>
       </div>
      </div>
      <div style="padding: 2px; background-color: #8eb0bc; text-align: center; font-weight: bold; border: 1px solid gray;">
        Categorias UNESCO
      </div>
      <div class="jstree" id="jstree" style="padding: 6px 5px; overflow: auto; width: 300px;">
        <?php include_component('virtualserial', 'tree') ?>
      </div>
    </div>
  </div>

  <!-- LIST, EDIT & PREVIEW-->
  <div style="margin-left: 15%" id="mm_mms">
    <?php include_partial('virtualserial/listeditpreview')?>
  </div>



</div>



<?php echo javascript_tag("
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

window.add_tree_several_cat = function (cat_id, mm_id, idcat_to_add) {
  new Ajax.Request('" . url_for('virtualserial/addSeveralCategory') . "',  {
    method: 'post',
    parameters: { category: cat_id, id: Object.toJSON(mm_id) },
    asynchronous: true, 
    evalScripts: true,
    onSuccess: function(response){
        for (var i=0; i<response.responseJSON.added.length; i++) {
            var c = response.responseJSON.added[i];
            inc_num_mm(c.id, 1);
            if (c.mm_id == mmSelId && c.group.length!=0 && c.group[1]!=undefined) {
               create_li_in_select(c, c.group[1], mm_id);
               if ( idcat_to_add == " . $cat_raiz_unesco->getId() . " ){ //UNESCO
                 create_div_in_table(c, mm_id, idcat_to_add);
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
") ?>


<div style="display:none;">
   <!-- Para pre-cargar imagenes de DnD. -->
   <img width="35" id="dnd_imange_1" src="/images/admin/DnD/1.gif" />
   <img width="35" id="dnd_imange_2" src="/images/admin/DnD/2.gif" />
   <img width="35" id="dnd_imange_3" src="/images/admin/DnD/3.gif" />
   <img width="35" id="dnd_imange_4" src="/images/admin/DnD/4.gif" />
   <img width="35" id="dnd_imange_5" src="/images/admin/DnD/5.gif" />
   <img width="35" id="dnd_imange_6" src="/images/admin/DnD/6.gif" />
   <img width="35" id="dnd_imange_7" src="/images/admin/DnD/7.gif" />
   <img width="35" id="dnd_imange_8" src="/images/admin/DnD/8.gif" />
   <img width="35" id="dnd_imange_9" src="/images/admin/DnD/9.gif" />
   <img width="35" id="dnd_imange_10" src="/images/admin/DnD/10.gif" />
   <img width="35" id="dnd_imange_11" src="/images/admin/DnD/11.gif" />
   <img width="35" id="dnd_imange_12" src="/images/admin/DnD/12.gif" />
   <img width="35" id="dnd_imange_13" src="/images/admin/DnD/13.gif" />
   <img width="35" id="dnd_imange_14" src="/images/admin/DnD/14.gif" />
   <img width="35" id="dnd_imange_15" src="/images/admin/DnD/15.gif" />
   <img width="35" id="dnd_imange_16" src="/images/admin/DnD/16.gif" />
</div>