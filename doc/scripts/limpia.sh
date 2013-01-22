if [ "/var/www/pumukit/doc" = `pwd` ] 
then
  rm -rf ../log/*
  rm -rf ../web/uploads/material/*
  rm -rf ../web/uploads/pic/*
  rm -rf ../web/uploads/ftp/*
  rm -rf ../web/almacen/downloads/*
  rm -rf ../web/almacen/masters/*
  cd ..
  php symfony propel-build-all-load editar
  php symfony cc
fi
