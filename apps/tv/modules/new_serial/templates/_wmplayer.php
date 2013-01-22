<div style="text-align:center">
  <object id="MediaPlayer" 
       classid="CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6"
       standby="Loading Microsoft Windows Media Player components..."
       type="application/x-oleobject" width="628" height="422">
    <param name="url" value="<?php echo $file->getUrl()?>" />
    <param name="AutoStart" value="true" />
    <param name="ShowControls" value="1" />
    <param name="uiMode" value="full" />

  
    <param value="<?php echo $file->getUrl()?>" name="filename"/>
    <param value="1" name="showcontrols"/>
    <param value="1" name="showdisplay"/>
    <param value="1" name="showstatusbar"/>
    <param value="1" name="autosize"/>
  
    <embed 
           width="628" height="422" 
           autosize="1" 
           showstatusbar="1" 
           showdisplay="1" 
           showcontrols="1" 
           filename="<?php echo $file->getUrl()?>" 
           pluginspage="http://www.microsoft.com/windows/downloads/contents/products/mediaplayer/" 
           type="application/x-mplayer2" 
    />
  
  </object>
</div>