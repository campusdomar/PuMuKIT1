PuMuKIT Installation Guide
====================================

*This page is updated to the 1.7 release* 

Requirements
-------------------------------------

PuMuKIT is a LAMP application, created with the framewirk Symfony. It uses ffmpeg to analyze the audiovisual data, as well as to transcode them.

The install requisites are: linux apache mysql ffmpeg php5. It does not work for versions above 5.2.x.

A ffmpeg version with H264 and AAC encoding capabilities is required.

The following PHP5 modules are also needed: php5-ffmpeg (0.5.x version) php5-cli php5-xsl php5-mysql php5-ldap php5-curl.

The script in doc\scripts\check_dependeces.php checks all the dependencies are met for this distribution.

PuMuKIT has been developed (and commonly run) under Linux Debian, but using it is not required.


Installation
-------------------------------------

The installation process is described for a standard Debian distribution with administrator users.

1. Download the last version of pumukit:

	>[https://github.com/campusdomar/pumukit/archive/1.7.0.zip](https://github.com/campusdomar/pumukit/archive/1.7.0.zip)  
	>$ wget https://github.com/campusdomar/pumukit/archive/1.7.0.zip

2. Access a terminal to the directory where you downloaded , unzip file and move the application to place /var/www/

	>$ tar xzvf pumukit17.tgz
	>$ mv pumukit-1.7.0 /var/www/pumukit

3. Install dependencies of pumukit (see requirements):
	
	>$ aptitude install ffmpeg php5-ffmpeg php5-cli apache2 libapache2-mod-php5 mysql-server mysql-client php5-xsl php5-mysql php5-ldap php5-curl libavcodec-extra-53 libavdevice- extra-53 libavfilter-extra-2 libavformat-extra-53 libavutil-extra-51

	Note: Keep mysql root password, we will need it later. In this manual, the key is represented as $PASSWORD_MYSQL

4. Enabled of mod_rewrite of apache:

	>$ a2enmod rewrite

5. Restart the apache server. We may use two options:

	>$ /etc/init.d/apache2 restart  

	or  
	>$ service apache2 restart

6. We create the Pumukit database and one user to give access to application. In our example we use "pmk_user" and assume that the server MySQL is on the local machine.

	Note: Entering this command block, we asked for the root password MySQL we used before.

	>$ mysql -u root -p <<EOF   
	>CREATE DATABASE pumukit DEFAULT CHARACTER SET utf8;  
	>GRANT ALL PRIVILEGES ON pumukit.* TO "pmk_user"@"localhost" IDENTIFIED BY "pmk_password";  
	>FLUSH PRIVILEGES;  
	>EOF

7. Copy the example for apache virtualhost to access Pumukit:

	>$ cp /var/www/pumukit/doc/files/apache.default /etc/apache2/sites-available/default

8. Configure PHP module, to do this edit the following lines of files /etc/php5/apache2/php.ini and /etc/php5/cli/php.ini :
	
	<pre><code>
	max_execution_time = 600 ; Maximum execution time of each script, in seconds  
    max_input_time = 60 ; Maximum amount of time each script may spend parsing request data  
    ...  
    memory_limit = 128M ; Maximum amount of memory a script may consume (128MB)  
    ...  
    ; Maximum size of POST data that PHP will accept.  
    post_max_size = 2008M  
    ...  
    ; Maximum allowed size for uploaded files.  
    upload_max_filesize = 2000M  
    ...  
    ; Maximum number of files that can be uploaded via a single request  
    max_file_uploads = 20  
    </code></pre>

9. Restart the apache server:

	>$ /etc/init.d/apache2 restart

10. We clean cache of Pumukit:

	>$ php /var/www/pumukit/symfony cc

11. We permissions to files Pumukit:

	>$ php /var/www/pumukit/symfony fix

12. Optional: if use a different user recommended in section 7 (pmk_user), database configuration change in Pumukit.

    For example, we can configure it to connect Pumukit user MySQL root.

    To do this edit two configuration files changing these values:  

    <pre><code>
	/var/www/pumukit/config/databases.yml
    ...
    database: pumukit  
    username: root  
    password: password_mysql   
  
    /var/www/pumukit/config/propel.ini  
    ...  
    propel.database.createUrl = mysql://root:password_mysql@localhost/  
    propel.database.url = mysql://root:$password_mysql@localhost/pumukit
    </code></pre>

13. Execute the task of symfony to generate the database and upload the default settings in the database:

	>$ php /var/www/pumukit/symfony propel-build-all-load editar

14. Clean cache of Pumukit and restart the apache server:

	>$ php /var/www/pumukit/symfony cc  
	>$ /etc/init.d/apache2 restart

15. Probably have to address the lack of user permissions with accessing the server apache2 (in this case "www-data") to folders and Pumukit files.

    One way to solve it is to change the owner and group of the contents Pumukit folder:

	>$ chown www-data:www-data /var/www/pumukit -R





Related Links
---------------------------------------------------

* [Install ffmpeg with H264 and AAC support in Ubuntu](http://ubuntuforums.org/showthread.php?t=786095)
* [Install ffmpeg with H264 and AAC support in Debian/Lenny](http://www.adminsehow.com/2009/07/how-to-install-ffmpeg-on-debian-lenny-from-svn/)
