   <?php $num = rand(); if ($page > 1 && $total != 0):?>
      <div style="float: left" class="previous <?php if($page == 1):?>disabled<?php endif ?>">
        <a href="<?php $_GET['page'] = ($page-1); echo $url . http_build_query($_GET, '', '&')?>">&larr; Más recientes</a>
      </div>
   <?php endif ?>
   <?php if ($page < $total && $total != 0):?>
     <div style="float:right;" class="next <?php if($page == $total):?>disabled<?php endif ?>">
       <a href="<?php $_GET['page'] = ($page+1); echo $url . http_build_query($_GET, '', '&')?>">Más antiguos&rarr;</a> 
     </div>
   <?php endif?>  
   <?php if ($total !=0):?>
     <div style="margin: auto; width: 33%;">
        <div style="float: left; margin: 0px 1em 0px 1em;">
           Pag. <span id="num_pag_<?php echo $num?>"><?php echo $page ?></span> de <?php echo $total ?>
        </div>
       <div style="float:left; margin:0em 1em 0em 0em; background:transparent url(/images/admin/pag/sliderbgleft100.png) no-repeat scroll left center; height:18px;  width:100px; ">
         <div id="track_<?php echo $num?>" style="background-color : #aaa;  height : 18px; background:transparent url(/images/admin/pag/sliderbgright.png) no-repeat scroll right center;">
           <div id="handle_<?php echo $num?>" class="selected" style="display : none; background-color : #f00; width : 12px; height : 18px; cursor : move; background:transparent url(/images/admin/pag/sliderhandle.png) no-repeat scroll center;"></div>
         </div>
       </div>
    </div>
   <?php endif ?>
  <?php if ( $total>1 ): ?>
    <script type="text/javascript" language="javascript">
      // <![CDATA[
     new Control.Slider('handle_<?php echo $num?>', 'track_<?php echo $num?>', {
        range: $R(1,<?php echo $total ?>), 
        values: $R(1,<?php echo $total ?>).toArray(),
        sliderValue: <?php echo $page ?>,
        onSlide: function(v){ $('num_pag_<?php echo $num?>').innerHTML= (v); },
	onChange: function(v){ window.location.href =  '<?php unset($_GET['page']); echo $url . http_build_query($_GET, '', '&') ?>&page='+v; }
      } );
      $('handle_<?php echo $num?>').show();
      // ]]>
    </script>
  <?php endif;?>