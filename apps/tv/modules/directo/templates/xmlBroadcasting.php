<?php echo "<?xml"?> version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:jwplayer="http://developer.longtailvideo.com/trac/wiki/FlashFormats">
  <channel>
    <item>
      <title><?php echo $canal->getName()?></title>
      <description><?php echo $canal->getDescription()?></description>
      <media:content url="<?php echo ($canal->getSourceName()) ?>" width="720"/>
      <jwplayer:streamer><?php echo ($canal->getUrl())?></jwplayer:streamer>
      <jwplayer:type>rtmp</jwplayer:type>
    </item>
  </channel>
</rss>

