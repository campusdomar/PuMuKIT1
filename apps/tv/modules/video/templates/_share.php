<div class="share_mmobj">
  <div style="">
    <!-- FIXME falta los enlaces y arraglar en codigo-->
    <a href="http://www.facebook.com/sharer.php?u=<?php echo url_for('video/index?id=' . $mmobj->getId(), true)?>">
      <img style="width:20px" src="/images/tv/iconos/facebook.png" title="<?php echo __("Compartir en facebook")?>" />
    </a>
    <a href="http://twitter.com/home?status=<?php echo urlencode(html_entity_decode($mmobj->getTitle(),  ENT_COMPAT, 'UTF-8'))?>
             <?php echo url_for('video/index?id=' . $mmobj->getId(), true)?>">
      <img style="width:20px" src="/images/tv/iconos/twitter.png" title="<?php echo __("Compartir en twitter")?>" />     
    </a>
    <a href="http://del.icio.us/post?url=<?php echo url_for('video/index?id=' . $mmobj->getId(), true)?>">
      <img style="width: 20px;" src="/images/tv/iconos/delicious.png" title="<?php echo __('Compartir en delicious')?>">
    </a>
    <a href="http://www.google.com/reader/link?url=<?php echo url_for('video/index?id=' . $mmobj->getId(), true)?>">
      <img style="width: 20px;" src="/images/tv/iconos/google.png"  title="<?php echo __('Compartir en google buz')?>">
    </a>





  </div>
  
  <div class="share_input" style="overflow:hidden;">   
    <span>URL:&nbsp;&nbsp;</span>
    <input type="text" value="<?php echo url_for('video/index?id=' .$mmobj->getId(), true) ?>" 
           onclick="this.select()" style="width: 70%; border: 1px solid #ccc; float:right" readonly="readonly"/>
  </div>
  <div class="share_input" style="overflow:hidden">   
    <span>EMBED:</span>
    <input type="text" value="&lt;embed width=&quot;620&quot; height=&quot;465&quot; flashvars=&quot;repeat=list&amp;file=<?php echo url_for('video/index?file_id=' . $file->getId(), true)?>&quot; allowscriptaccess=&quot;always&quot; allowfullscreen=&quot;true&quot; quality=&quot;high&quot; name=&quot;player&quot; id=&quot;player&quot; style=&quot;&quot; src=&quot;http://tv.usc.es/swf/player.swf?autostart=true&quot; type=&quot;application/x-shockwave-flash&quot;/&gt;" 
           onclick="this.select()" style="width: 70%; border: 1px solid #ccc; float:right" readonly="readonly"/>
  </div>
  <div class="share_input" style="overflow:hidden">   
    <span>IFRAME:</span>
    <input type="text" value="&lt;iframe src=&quot;<?php echo url_for('video/iframe?id=' . $mmobj->getId(), true) ?>&quot; style=&quot;border:0px #FFFFFF none;&quot; name=&quot;Pumukit - Media Player&quot; scrolling=&quot;no&quot; frameborder=&quot;1&quot; marginheight=&quot;0px&quot; marginwidth=&quot;0px&quot; height=&quot;740&quot; width=&quot;420&quot;&gt;&lt;/iframe&gt;" 
           onclick="this.select()" style="width: 70%; border: 1px solid #ccc; float:right" readonly="readonly"/>
  </div>
</div>
