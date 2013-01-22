aptitude install ffmpeg php5-ffmpeg php5-cli apache2 libapache2-mod-php5 mysql-server mysql-client php5-xsl php5-mysql php5-ldap php5-curl
a2enmod rewrite
/etc/init.d/apache2 restart 
mysql -u root <<EOF
CREATE DATABASE pumukit DEFAULT CHARACTER SET utf8;
EOF
mysql -u root pumukit < /var/www/pumukit/data/backup/050210.SQL
