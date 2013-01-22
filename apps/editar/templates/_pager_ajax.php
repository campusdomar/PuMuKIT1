<?php 
  $ver_anterior  = (($page == 1)? array('style' => 'visibility : hidden'): array('style' => 'color : blue; font-weight : normal ') );
  $ver_siguiente = (($page == $total || $total == 0)? array('style' => 'visibility : hidden'): array('style' => 'color : blue; font-weight : normal ') );
?>

  <div id="pager_<?php echo $name?>" style="float:left;">
    <div style="float:left; margin:0em .5em;"><?php echo link_to_remote('&laquo;Anterior', array('update' => 'list_'.$name.'s', 'url' => $name.'s/list?page='.($page-1), 'script' => 'true'), $ver_anterior)  ?></div>
    <div style="float:left; margin:0em .5em; width:9em">Pag. <span id="num_pag_<?php echo $name?>"><?php echo ($page)?></span> de <?php echo $total ?></div>
    <div style="float:left; margin:0em .5em; background:transparent url(/images/admin/pag/sliderbgleft100.png) no-repeat scroll left center; height:18px;  width:100px; ">
      <div id="track_<?php echo $name?>" style="background-color : #aaa;  height : 18px; background:transparent url(/images/admin/pag/sliderbgright.png) no-repeat scroll right center; ">
        <div id="handle_<?php echo $name?>" style="display : none; background-color : #f00; width : 12px; height : 18px; cursor : move; background:transparent url(/images/admin/pag/sliderhandle.png) no-repeat scroll center;"> </div>
      </div>
    </div>
    <div style="float:left; margin:0em .5em;"><?php echo link_to_remote('Siguiente&raquo;', array('update'=> 'list_'.$name.'s', 'url' => $name.'s/list?page='.($page+1), 'script' => 'true'), $ver_siguiente) ?></div>
  </div>

  <?php //aqui no funciona javascript_tag por no tener type ?>
  <?php if ( $total>1 ): ?>
    <script language="javascript" type="text/javascript">
      //<![CDATA[
      new Control.Slider("handle_<?php echo $name?>", "track_<?php echo $name?>", {
        range: $R(1,<?php echo $total ?>), 
        values: $R(1,<?php echo $total ?>).toArray(),
        sliderValue: <?php echo $page ?>,
        onSlide: function(v){$("num_pag_<?php echo $name?>").innerHTML= (v);},
        onChange: function(v){new Ajax.Updater("list_<?php echo $name ?>s", "/editar.php/<?php echo $name?>s/list/page/"+v, {asynchronous:true, evalScripts:true})}
      } );
    
      $("handle_<?php echo $name?>").show();    <?php  //evito efecto de empezar en cero y ponerse en su posicion ?>
      //]]>
    </script>
  <?php endif;?>
