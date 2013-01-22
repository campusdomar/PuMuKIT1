<div style="overflow:hidden">
<?php foreach($announces as $k => $announce): ?>
<div class="announce_element" style="width:49%; float:left; margin-right: 1%;in">
  <?php if($announce->hasSubtitles()): ?>
  <img style="padding-top:8px; width:70px; float:right" src="/images/tv/iconos/simbolo_manos_40.png" alter="signado" />
  <?php endif ?>
  <table>
   <tbody>
    <tr>
     <td>
       <div id="pic">
         <?php echo link_to(image_tag($announce->getFirstUrlPic(), 'class=announce'),  'video/index?id=' . $announce->getId() ) ?>
       </div>
     </td>
     <td>
      <div class="info">
        <div class="title">
          <?php echo ($announce->getTitle()==""?'&nbsp;':link_to( $announce->getTitle(), 'video/index?id=' . $announce->getId()))?>
        </div>
        <div class="line2">
          <?php echo str_replace(array('&lt;', '&gt;'), array('<', '>'), $announce->getLine2Rich()) ?>
        </div>
        <div class="date">
          <?php echo $announce->getPublicDate('d/m/Y') ?> 
        </div>
      </div>
     </td>
    </tr>
   </tbody>
  </table>
</div>
<?php echo (($k%2) != 0)?'<div style="float:left; width:100%">&nbsp;</div>':'' ?>
<?php endforeach;?>
</div>