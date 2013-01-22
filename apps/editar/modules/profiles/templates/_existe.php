<?php
if (file_exists($_REQUEST['archivo'])){
  echo "OK";
}else{
  echo "KO";
}
