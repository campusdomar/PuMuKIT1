<h1 id="library_h1"><?php echo __('Mediateca')?></h1>

<h2 id="library_es"><?php echo __('Catalogo')?> </h2>

<p style="padding:10px 0px">
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('En la Mediateca del Servicio aparecen los catálogos de archivos audiovisuales que están disponibles en este momento. Asimismo, estos archivos se encuentran divididos entre Videoteca Pública y Videoteca Privada (según sean de libre acceso o de acceso restringido sólo para los miembros de la comunidad universitaria). Se muestran agrupados según el criterio deseado.')?>
</p>

<div class="lib_menu">
  <div style="float: right" class="lib_menu_view">
    <a href="#" id="search_flecha" onclick="
          Effect.toggle('search_div', 'blind'); 
          this.childNodes[0].innerHTML = (this.childNodes[0].innerHTML == '&#9662;')?'&#9666;':'&#9662;';
          return false;
    "><span><?php echo ($sf_request->hasParameter('search'))?"&#9666;":"&#9662;" ?></span>  <?php echo __('Filtrar') ?></a>
  </div>
  <div class="lib_menu_sort">
    <?php echo __('Ordenar por') ?>:  
    <a href="<?php echo url_for('library/date' . $more) ?>">Fecha</a>,
    <a href="<?php echo url_for('library/place' . $more) ?>">Lugar</a>,
    <a href="<?php echo url_for('library/abc' . $more) ?>">Alfab&eacute;ticamente</a>,
    <a href="<?php echo url_for('library/channel' . $more) ?>">Categor&iacute;a</a>.
  </div>
  <div style="clear: right"></div>
</div>

<div id="search_div" style="text-align:center; <?php if(!$sf_request->hasParameter('search')) echo "display:none;"?>">
  <form action="<?php echo url_for('library/' . $sf_request->getParameter('action'))?>" 
        method="post" 
        style="width: 95%; margin: 10px; padding: 5px 0px; border: 2px solid #999999; background-color: #eee; ">
    <?php echo __("Filtrar") ?>:&nbsp;&nbsp;&nbsp;
    <input type="text" id="search" name="search" value="<?php echo $sf_request->getParameter('search', '')?>" />
    <?php echo ($sf_request->hasParameter('broadcast'))?'<input type="hidden" id="broadcast" name="broadcast" value="' . $sf_request->getParameter('broadcast') . '" />':'' ?>
    <input type="submit" value="OK" />
  </form>
</div>


<div class="library">
  <?php if (count($serials) == 0): ?>
    <div class="noSearch">
       <?php echo __('Su busqueda no produjo ningun resultado') . '&nbsp;&nbsp;&nbsp;' . link_to(__('Cancelar'), 'library/' . $sf_request->getParameter('action'))?>.
    </div>
  <?php endif ?>

  <?php foreach ($serials as $o => $ss):  ?>

    <div class="name">
      <?php echo $o ?>
    </div>
      <div class="list">
        <ul>      
          <?php foreach ($ss as $serial): $numV = PubChannelPeer::countMmsFromSerial(1, $serial->getId())?>
            <li>
              <?php echo link_to($serial->getTitle(), 'serial/index?id=' . $serial->getId() ,'class=azul')?>
              [<?php echo $numV?> V&iacute;deo<?php echo (($numV == 1)?'':'s')?>]
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

  
  <?php endforeach; ?>
</div>


