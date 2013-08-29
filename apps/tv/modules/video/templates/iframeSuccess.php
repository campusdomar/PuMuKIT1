<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo $m->getTitle()?></title>
</head>
<body style="background: none">
<?php include_partial('playerhtml5',
                      array('mmobj' => $m, 'roles' => array(), 'file' => $file, 'w' => 'document.viewport.getWidth()', 'h' => 'document.viewport.getHeight()', 'noautostart' => true)
                      )
?>
</body>
</html>
