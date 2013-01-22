<?php 
if ($sf_request->isXmlHttpRequest()){
  echo javascript_tag("document.location.href='" . url_for('index/index?error=2') . "'");
}else{
  echo javascript_tag("document.location.href='" . url_for('index/index?error=2&url='.strtr($sf_request->getPathInfo(),'/','+')) . "'");
}
 ?>
