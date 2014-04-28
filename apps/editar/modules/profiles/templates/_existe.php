<?php
if (file_exists($_REQUEST['archivo'])){
  echo __('"OK"');
}else{
  echo __('"KO"');
}
