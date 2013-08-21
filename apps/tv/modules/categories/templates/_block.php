<div class="announce_element">
  <table>
   <tbody>
    <tr>
     <td>
       <div class="album">
        <a href="<?php echo $announce->getUrl() ?>">
          <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>"></div>
          <?php if ('serial' == $announce->getTableName()):?>
          <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>"></div>
          <div class="picture"><img src="<?php echo $announce->getFirstUrlPic() ?>"></div>
          <?php endif?>
        </a>
       </div>
     </td>
     <td>
      <div class="info">
        <br />
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

