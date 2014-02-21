<?php foreach($announces as $k => $announce): ?>
<div class="announce_element">
  <?php if($announce->hasSubtitles()): ?>
  <img style="padding-top:8px; width:70px; float:right" src="/images/tv/iconos/simbolo_manos_40.png" alter="signado" />
  <?php endif ?>
  <table>
   <tbody>
    <tr>
     <td>
        <div style="position: relative;">
        <?php if($announce->getSerialId() != $announce->getId()): ?>
	  <div class="thumbnail">
            <a href="<?php echo $announce->getUrl()?>" >
              <img class="play_icon" alt="" src="/images/tv/iconos/play_icon.png" />
              <img alt="serial_pic" class="serial" src="<?php echo $announce->getFirstUrlPic()?>"/>
            </a>
          </div>
        <?php else: ?>
	<div class="thumbnail">


<div class="album" style="margin:2px 20px 2px 2px;">
    <!-- <img src="<?php echo $announce->getUrl()?>"/> -->
    <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>" /></div>
    <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>" /></div>  
    <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>" /></div>
</div>

	</div>
         <?php endif ?>
       </div>
     </td>
     <td>
      <div class="info">
        <div class="title">
          <a href="<?php echo $announce->getUrl() ?>"><?php echo ($announce->getTitle()==""?'&nbsp;':$announce->getTitle())?></a>
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
<?php endforeach;?>
