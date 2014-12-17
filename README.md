PuMuKIT (Publisher Multimedia KIT)
=====================================

PuMuKIT (Publisher Multimedia KIT) publish on the Internet the audiovisual content produced in an institution, university, etc.

PuMuKIT publish the multimedia contents in your data base throwght its public channel. This channels can be a web portal, a WEB-TV, an ARCA RSS feed, iTunes U or YouTube.



Requirements
-------------------------------------

PuMuKIT is one application LAMP, created with the symfony framework. It uses ffmpeg to analyze the audiovisual data, as well as to transcode them.

The requirements for installation are linux, apache, mysql, ffmpeg, php5. You must have installed a version of ffmpeg encoding to h264 and aac. Also the following modules are required php5: php5-ffmpeg, php5-cli, php5-mysql, php5-ldap, php5-curl.

The script doc/scripts/check_dependences.php checks that meet all dependencies.

PuMuKIT has been developed and is often installed on Linux Debian but its use is not essential.



Installation
-------------------------------------

The installation process is described for a standard Debian distribution with administrator users.

1. Download the last version of pumukit:

	>[https://github.com/campusdomar/pumukit/archive/1.8.0-RC1.zip](https://github.com/campusdomar/pumukit/archive/1.8.0-RC1.zip)  
	>$ wget https://github.com/campusdomar/pumukit/archive/1.8.0-RC1.zip

2. Access a terminal to the directory where you downloaded , unzip file and move the application to place /var/www/

	>$ unzip 1.8.0-RC1.zip  
	>$ mv pumukit-1.8.0-RC1 /var/www/pumukit

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

14. Execute the custom task ((import category trees in the database)):

	>$ php /var/www/pumukit/symfony init-categories

15. Clean cache of Pumukit and restart the apache server:

	>$ php /var/www/pumukit/symfony cc  
	>$ /etc/init.d/apache2 restart

16. Probably have to address the lack of user permissions with accessing the server apache2 (in this case "www-data") to folders and Pumukit files.

    One way to solve it is to change the owner and group of the contents Pumukit folder:

	>$ chown www-data:www-data /var/www/pumukit -R



Extra
------------------------------------------------

Configuring the apache server to install locally with virtualhost Pumukit:

1. Add the following line to /etc/hosts

	>127.0.0.1     pumukit

2. Create or add to the file /etc/apache2/httpd.conf the following lines:  

	```
	ServerName nombre_del_host_local  
    NameVirtualHost 127.0.0.1:80  
    <VirtualHost *:80>  
    	ServerName pumukit  
        ServerAlias pumukit www.pumukit  
        DocumentRoot "/var/www/pumukit/web"  
        DirectoryIndex index.php  
        <Directory "/var/www/pumukit/web">  
        	AllowOverride Allow  
            All from All  
        </Directory>  
    </VirtualHost>
    ```

3. Restart the apache server:
	
	>$ /etc/init.d/apache2 restart


Now, restarting the service apache2 and introducing  "pumukit" in any browser, should show the application working correctly.

Introducing "pumukit/editar.php" you can check the backend.
The default user to the backend is "prueba" and password "123456".


Pumukit configuration
---------------------------------------------------

The principal configuration of Pumukit is performed in a file format YAML ( http://es.wikipedia.org/wiki/YAML). Following the above instructions will be located at:

>/var/www/pumukit/config/app.yml

In some categories there is a key "use:" activate the functionality required if its value is 1 or desactivated with 0.

Strings as URL, username, password, etc, must go enclosed in single or double quotes.

1. Play a introduction video before each video.
	- Find in app.yml the category "intro".
	- Change the value of "use:" of 0 to 1 (functionality enable).
	- Add in the value of "url:" complete URL of the video to show.

	Example:

		intro:
		  use:	1
		  url:	"http://servidor.com/ejemplo/video_intro.mp4"


2. Enable Matterhorn functionality.

   Matterhorn enables multi-machine install with multiple servers to play the video and to manage the system.

	- Find in app.yml the "matterhorn" category.
	- Change the value of "use:" of 0 to 1.
	- Add in the value of "server:" complete URL of the server where you stay Matterhorn player.
	- Add in the value of "server_admin" complete URL of the server with the administration interface.
	- Add in the value of "user:" the user account that you will use Pumukit to connect to the server Matterhorn.

		-- Important: You need a user account to authenticate using HTTP digest. A normal user account don't work. Typically, this account configured in the config.properties file in the Matterhorn server.

	- Add in the value of "password:" the password of user for the Matterhorn server.

	<pre><code>
    matterhorn:
    use:           1
    server:        "http://ejemplo-mh-engage-player.dominio.com"
    server_admin:  "http://ejemplo_interfaz_admin.dominio.com"
    user:          "usuario_matterhorn"
    password:      "contraseña_matterhorn"
    </code></pre>

More information: [http://pumukit.uvigo.es](http://pumukit.uvigo.es)