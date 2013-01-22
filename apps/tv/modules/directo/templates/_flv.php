<div style="width:100%; margin:0 auto; text-align:center" style="color:red" id="preview">Necesita instalar el Plugin de Flash</div>

<script type='text/javascript' src='/js/swfobject.js'></script>
<script type='text/javascript'>
  var s1 = new SWFObject('/swf/player.swf?autostart=true','player','<?php echo $canal->getResolution()->getHor()?>','<?php echo $canal->getResolution()->getVer()?>','9');
  s1.addParam('allowfullscreen','true');
  s1.addParam('allowscriptaccess','always');
  //s1.addParam('flashvars','repeat=list&file=<?php echo $canal->getUrl()?>');
  s1.addVariable('playlistfile','<?php echo url_for("directo/xml?canal=".$canal->getId()) ?>');
  s1.addVariable('repeat','list');
  s1.addVariable('autostart','true'); 
  s1.addVariable('stretching','uniform'); 
  s1.write('preview');
</script>