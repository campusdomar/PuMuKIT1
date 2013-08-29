<div class="share_mmobj" style="overflow: hidden;">
  <div id="social" style="overflow: hidden;">
    <div style="overflow: hidden; padding: 5px 0px;"> 
       <div style="width: 83px; height: 19px; float: left;">
         <a onclick="return Popup.open({url:this.href});" href="http://www.facebook.com/sharer.php?u=<?php echo $mmobj->getUrl(true)?>" title="Compartir en Facebook" class="facebook"><img src="/images/1.8/social/compartirfb.jpg" /></a>
       </div>
       <div style="width: 34px; height: 19px; float: left;">
         <a onclick="return Popup.open({url:this.href});" href="https://plus.google.com/share?url=<?php echo $mmobj->getUrl(true)?>" title="Compartir en Google +" class="facebook"><img src="/images/1.8/social/gplus_button_small.png" /></a>
       </div>
       <div style="width: 58px; height: 19px; float: left;">
         <a onclick="return Popup.open({url:this.href});" href="https://twitter.com/intent/tweet?text=<?php echo 'Vía ' . sfConfig::get('app_metas_title') . ' : ' . $mmobj->getUrl(true)?>" title="Compartir en Twitter" class="facebook"><img src="/images/1.8/social/twit_button.png" /></a>
       </div>
    </div>
      <table>
         <tr>
           <td>URL:</td>
           <td><input type="text" value="<?php echo url_for('mmobj/index?id=' .$mmobj->getId(), true) ?>" onclick="this.select()" style="border: 1px solid #ccc; font-size: 12px;" readonly="readonly"/></td>
         </tr>
         <tr>
           <td><span style="text-align: right;">EMBED:</span></td>
           <td><input type="text" value="&lt;iframe src=&quot;<?php echo url_for('mmobj/iframe?id=' . $mmobj->getId(), true) ?>&quot; style=&quot;border:0px #FFFFFF none;&quot; scrolling=&quot;no&quot; frameborder=&quot;1&quot; height=&quot;270&quot; width=&quot;480&quot; allowfullscreen webkitallowfullscreen&gt;&lt;/iframe&gt;" onclick="this.select()" style="border: 1px solid #ccc; font-size: 12px;" readonly="readonly"/></td>
         </tr>
      </table>
   </div>
</div>
<script type="text/javascript">
    var Popup = {
      open: function(options)
      {
        this.options = {
          url: '#',
          width: 600,
          height: 500,
          name:"_blank",
          location:"no",
          menubar:"no",
          toolbar:"no",
          status:"yes",
          scrollbars:"yes",
          resizable:"yes",
          left:"",
          top:"",
          normal:false
        }
        Object.extend(this.options, options || {});

        if (this.options.normal){
          this.options.menubar = "yes";
          this.options.status = "yes";
          this.options.toolbar = "yes";
          this.options.location = "yes";
        }

        this.options.width = this.options.width < screen.availWidth?this.options.width:screen.availWidth;
        this.options.height=this.options.height < screen.availHeight?this.options.height:screen.availHeight;
    var openoptions = 'width='+this.options.width+',height='+this.options.height+',location='+this.options.location+',menubar='+this.options.menubar+',toolbar='+this.options.toolbar+',scrollbars='+this.options.scrollbars+',resizable='+this.options.resizable+',status='+this.options.status
        if (this.options.top!="")openoptions+=",top="+this.options.top;
        if (this.options.left!="")openoptions+=",left="+this.options.left;
        window.open(this.options.url, this.options.name,openoptions );
        return false;
      }
    }
</script>