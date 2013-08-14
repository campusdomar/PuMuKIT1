<div style="overflow: hidden; margin-left: 10px;">
<div class="pager" style="padding-bottom:30px; text-align:center; overflow:hidden; margin: 4px 0px 0px;">
   <?php if ($total > 1) include_partial('global/pager', array('page' => $page, 'total' => $total, 'url' => $url)) ?>
</div>
<?php if(count($mms)==0): ?>
  <div style="overflow: hidden;  text-align: center; margin-top: 10px;">
     No existen v&iacute;deos de estas caracter&iacute;sticas
  </div>
  <?php elseif ($page > $total || $page < 1): ?>
  <div style="overflow: hidden;  text-align: center; margin-top: 10px;">
    Página fuera de rango
  </div>
  <?php else : ?>
<ul>
  <?php foreach($mms as $date => $mm): ?>
   <li class="categories_list" style="list-style-type: none; margin-top: 0px;">
    <div class="unedtv_mmobjs unedtv_series">
      <div class="unedtv_mmobj_categories" style="width: 100%; background-color: #FFF;">
       <p style="width: 752px" class="categories_title"><?php echo $date ?></p>
     <?php  /* //TEST 
     foreach($mm as $m): ?>
         <?php include_partial('global/mmobj_uned', array('mm' => $m))?>
     <?php endforeach 
     // END TEST */?>
     
     <?php include_partial('global/mmobj', array('mmobjs' => $mm)) ?>
      </div>
    </div>
    <div style="widht:100%"></div>
   </li>
  <?php endforeach?>
</ul>
<?php endif?>
</div>
<div class="pager" style="padding-bottom:30px; text-align:center; overflow:hidden; margin: 4px 0px 2px;">
   <?php if ($total > 1) include_partial('global/pager', array('page' => $page, 'total' => $total, 'url' => $url)) ?>
</div>
</div>
