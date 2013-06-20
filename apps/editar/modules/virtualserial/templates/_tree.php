<ul style="width: 95%;">
  <li class="first_node" style="margin-top: 3px;">
         <a href="#" id="0" 
            class="node <?php if($cat_id==0) echo 'clicked'?>" style="text-decoration: none;" 
            onclick="return treeUpdateMmList(this, 0)">
            <ins style="cursor: default;">&nbsp;</ins>
            <ins class="collapsed" style="cursor: default;">&nbsp;</ins>Todos [<span id="toUpdate-Todos"><?php echo $num_all ?></span>]
         </a>
  </li>
  <li class="first_node">
         <a href="#" id="-1" 
            class="node <?php if($cat_id==-1) echo 'clicked'?>" style="text-decoration: none;" 
            onclick="return treeUpdateMmList(this, -1)">
            <ins style="cursor: default;">&nbsp;</ins>
            <ins class="collapsed" style="cursor: default;">&nbsp;</ins>Sin categoría [<span id="toUpdate-Nocat"><?php echo $num_none ?></span>]
         </a>
  </li>
  <li class="first_node">
     <ins onclick="collapsedCat('category-<?php echo $salud[0]->getId()?>', $('toggle-<?php echo $salud[0]->getId()?>'))">&nbsp;</ins>
     <ins onclick="collapsedCat('category-<?php echo $salud[0]->getId()?>', this)" id="toggle-<?php echo $salud[0]->getId()?>" class="expanded">&nbsp;</ins>Ciencias de la salud
  </li>
  <ul id="category-<?php echo $salud[0]->getId()?>" style="width: 255px;">
     <?php foreach($salud as $c): ?>
       <li class="second_node" draggable="true" data-id="<?php echo $c->getId() ?>">
         <a href="#" id="<?php echo $c->getId()?>" draggable="false" class="node <?php if($cat_id==$c->getId()) echo 'clicked'?>" style="text-decoration: none;" 
            data-id="<?php echo $c->getId() ?>"
            onclick="return treeUpdateMmList(this, <?php echo $c->getId()?>)">
           <ins draggable="false" data-id="<?php echo $c->getId() ?>">&nbsp;</ins><?php echo $c->getName()?> [<span id="toUpdate-<?php echo $c->getId()?>"><?php echo $c->getNumMm() ?></span>]
         </a>
       </li>
     <?php endforeach;?>
  </ul>
  <li class="first_node">
   <ins onclick="collapsedCat('category-<?php echo $tecnologias[0]->getId()?>', $('toggle-<?php echo $tecnologias[0]->getId()?>'))">&nbsp;</ins>
   <ins onclick="collapsedCat('category-<?php echo $tecnologias[0]->getId()?>', this)" id="toggle-<?php echo $tecnologias[0]->getId()?>" class="expanded">&nbsp;</ins>Tecnologías
  </li>
    <ul id="category-<?php echo $tecnologias[0]->getId()?>" style="width: 255px;">
     <?php foreach($tecnologias as $c): ?>
       <li class="second_node" draggable="true" data-id="<?php echo $c->getId() ?>">
         <a href="#" id="<?php echo $c->getId()?>" draggable="false" class="node <?php if($cat_id==$c->getId()) echo 'clicked'?>" style="text-decoration: none;" 
            data-id="<?php echo $c->getId() ?>"
            onclick="return treeUpdateMmList(this, <?php echo $c->getId()?>)">
           <ins draggable="false" data-id="<?php echo $c->getId() ?>">&nbsp;</ins><?php echo $c->getName()?> [<span id="toUpdate-<?php echo $c->getId()?>"><?php echo $c->getNumMm() ?></span>]
         </a>
       </li>
     <?php endforeach;?>
  </ul>
  <li class="first_node">
   <ins onclick="collapsedCat('category-<?php echo $ciencias[0]->getId()?>', $('toggle-<?php echo $ciencias[0]->getId()?>'))">&nbsp;</ins>
   <ins onclick="collapsedCat('category-<?php echo $ciencias[0]->getId()?>', this)" id="toggle-<?php echo $ciencias[0]->getId()?>" class="expanded">&nbsp;</ins>Ciencias
  </li>
    <ul id="category-<?php echo $ciencias[0]->getId()?>" style="width: 255px;">
     <?php foreach($ciencias as $c): ?>
       <li class="second_node" draggable="true" data-id="<?php echo $c->getId() ?>">
         <a href="#" id="<?php echo $c->getId()?>" draggable="false" class="node <?php if($cat_id==$c->getId()) echo 'clicked'?>" style="text-decoration: none;" 
            data-id="<?php echo $c->getId() ?>"
            onclick="return treeUpdateMmList(this, <?php echo $c->getId()?>)">
           <ins data-id="<?php echo $c->getId() ?>" draggable="false">&nbsp;</ins><?php echo $c->getName()?> [<span id="toUpdate-<?php echo $c->getId()?>"><?php echo $c->getNumMm() ?></span>]
         </a>
       </li>
     <?php endforeach;?>
  </ul>
  <li class="first_node">
   <ins onclick="collapsedCat('category-<?php echo $juridicas[0]->getId()?>', $('toggle-<?php echo $juridicas[0]->getId()?>'))">&nbsp;</ins>
   <ins onclick="collapsedCat('category-<?php echo $juridicas[0]->getId()?>', this)" id="toggle-<?php echo $juridicas[0]->getId()?>" class="expanded">&nbsp;</ins>Jurídico-Social
  </li>
    <ul id="category-<?php echo $juridicas[0]->getId()?>" style="width: 255px;">
     <?php foreach($juridicas as $c): ?>
       <li class="second_node" draggable="true" data-id="<?php echo $c->getId() ?>">
         <a href="#" id="<?php echo $c->getId()?>" draggable="false" class="node <?php if($cat_id==$c->getId()) echo 'clicked'?>" style="text-decoration: none;" 
            data-id="<?php echo $c->getId() ?>"
            onclick="return treeUpdateMmList(this, <?php echo $c->getId()?>)">
           <ins data-id="<?php echo $c->getId() ?>" draggable="false">&nbsp;</ins><?php echo $c->getName()?> [<span id="toUpdate-<?php echo $c->getId()?>"><?php echo $c->getNumMm() ?></span>]
         </a>
       </li>
     <?php endforeach;?>
    </ul>
    <li class="first_node">
      <ins onclick="collapsedCat('category-<?php echo $humanidades[0]->getId()?>', $('toggle-<?php echo $humanidades[0]->getId()?>'))">&nbsp;</ins>
      <ins onclick="collapsedCat('category-<?php echo $humanidades[0]->getId()?>', this)" id="toggle-<?php echo $humanidades[0]->getId()?>" class="expanded">&nbsp;</ins>Humanidades
    </li>
    <ul id="category-<?php echo $humanidades[0]->getId()?>" style="width: 255px;">
      <?php foreach($humanidades as $c): ?>
        <li class="second_node" draggable="true" data-id="<?php echo $c->getId() ?>">
          <a href="#" id="<?php echo $c->getId()?>" draggable="false" class="node <?php if($cat_id==$c->getId()) echo 'clicked'?>" style="text-decoration: none;" 
            data-id="<?php echo $c->getId() ?>"
            onclick="return treeUpdateMmList(this, <?php echo $c->getId()?>)">
            <ins data-id="<?php echo $c->getId() ?>" draggable="false">&nbsp;</ins><?php echo $c->getName()?> [<span id="toUpdate-<?php echo $c->getId()?>"><?php echo $c->getNumMm() ?></span>]
          </a>
        </li>
      <?php endforeach;?>
    </ul>
</ul>

<?php echo javascript_tag("
function treeHandleDragStart(e) {
  //console.log('TREE dragstart');
  this.style.opacity = '0.4';
  document.getElementById('list_unesco').style.backgroundColor = '#eef';

  dragElement = 'tree';
  dragDataElement = e.srcElement.getAttribute('data-id');
  e.dataTransfer.setData('id', dragDataElement)
}

function treeHandleDragEnd(e) {
  //console.log('TREE dragend');

  document.getElementById('list_unesco').style.backgroundColor = '#fff';
  this.style.opacity = '1';

  dragElement = dragDataElement = null;
}

function treeHandleDragOver(e) {
  e.preventDefault(); //Necesario para que funcione drop
  //console.log('TREE dragover');
  if (dragElement == 'list') {
    this.classList.add('over');
  }
}

function treeHandleDragEnter(e) {
  //console.log('TREE handleDragEnter');
  if (dragElement == 'list') {
    this.classList.add('over');
  }
}

function treeHandleDragLeave(e) {
  //console.log('TREE dragleave');
  this.classList.remove('over');
}

function treeHandleDrop(e) {
  //console.log('TREE drop');
  this.classList.remove('over');
  if (dragElement == 'list') {
    var ids = e.dataTransfer.getData('id').split(',');
    //console.log('#########-> Drop tree con id: ', ids);
    //console.log('add mm_id ' + ids[i] + ' in '+ e.srcElement.getAttribute('data-id'));
    add_tree_several_cat(e.srcElement.getAttribute('data-id'), ids, " . $cat_raiz_unesco->getId() . ");
  }
}

var nodes = document.querySelectorAll('.second_node');
[].forEach.call(nodes, function(node) {
  node.addEventListener('dragstart', treeHandleDragStart, false);
  node.addEventListener('dragend', treeHandleDragEnd, false);
  node.addEventListener('dragenter', treeHandleDragEnter, false);
  node.addEventListener('dragleave', treeHandleDragLeave, false);
  node.addEventListener('dragover', treeHandleDragOver, false);
  node.addEventListener('drop', treeHandleDrop, false);

});

function collapsedCat(node, obj) {
  Effect.toggle(node, 'blind', {
      afterFinish: function () {
         obj.toggleClassName('expanded').toggleClassName('collapsed');
      }
   });
}

function treeUpdateMmList(element, id) {
  $('search_loading_img').show(); 
  new Ajax.Updater('mm_mms', '" . url_for('virtualserial/listfromtree') . "', { asynchronous:true, evalScripts:true, parameters: {id: id}}); 
  $$('.clicked').invoke('removeClassName', 'clicked'); 
  element.addClassName('clicked'); 
  return false;
}
") ?>
