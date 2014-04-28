<object id="mediaplayer"
    classid="CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6"
    standby="<?php echo __('Loading Microsoft Windows Media Player components...')?>"
    type="application/x-oleobject" width="<?php echo $hor?>" height="<?php echo $ver?>">
  <param name="url" value="<?php echo $url?>" />
  <param name="AutoStart" value="true" />
  <param name="ShowControls" value="1" />
  <param name="uiMode" value="mini" />


  <param value="<?php $url?>" name="filename"/>
  <param value="1" name="showcontrols"/>
  <param value="0" name="showdisplay"/>
  <param value="0" name="showstatusbar"/>
  <param value="0" name="autosize"/>

  <embed
    width="<?php echo $hor?>" height="<?php echo $ver?>"
    autosize="0"
    showstatusbar="0"
    showdisplay="0"
    showcontrols="1"
    filename="<?php echo $url?>"
    pluginspage="http://www.microsoft.com/windows/downloads/contents/products/mediaplayer/"
    type="application/x-mplayer2"
  />

</object>