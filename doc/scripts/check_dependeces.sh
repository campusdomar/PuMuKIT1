#!/bin/sh

# CHECK PHP5 MODULES
php -v >


echo "CHECKING php modules"
for a in curl xsl mysql ldap ffmpeg 
do
  AUX=`php -m | grep $a | wc -l`
  if (( $AUX == 0 ))
  then 
    echo "ERROR es $a"
  fi
done

