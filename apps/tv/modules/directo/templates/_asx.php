  <object id="MediaPlayer" 
       classid="CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6"
       standby="Loading Microsoft Windows Media Player components..."
       type="application/x-oleobject" width="<?php echo $canal->getResolution()->getHor()?>" height="<?php echo $canal->getResolution()->getVer() ?>">
    <param name="url" value="<?php echo $canal->getUrl()?>" />
    <param name="AutoStart" value="true" />
    <param name="ShowControls" value="1" />
    <param name="uiMode" value="mini" />

  
    <param value="<?php echo $canal->getUrl()?>" name="filename"/>
    <param value="1" name="showcontrols"/>
    <param value="0" name="showdisplay"/>
    <param value="0" name="showstatusbar"/>
    <param value="0" name="autosize"/>
  
    <embed 
           width="<?php echo $canal->getResolution()->getHor()?>" height="<?php echo $canal->getResolution()->getVer() ?>" 
           autosize="0" 
           showstatusbar="0" 
           showdisplay="0" 
           showcontrols="1" 
           filename="<?php echo $canal->getUrl()?>" 
           pluginspage="http://www.microsoft.com/windows/downloads/contents/products/mediaplayer/" 
           type="application/x-mplayer2" 
    />
  
  </object>