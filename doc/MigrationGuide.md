# PuMuKIT Migration Guide
## <a name="Contents">Table of contents</a>
#### 1. <a href="#1.5b2to1.5">Migration from PuMuKIT 1.5b2 to 1.5</a>
#### 2. <a href="#1.5to1.6">Migration from PuMuKIT 1.5 to 1.6 </a>
#### 3. <a href="#1.6to1.7">Migration from PuMuKIT 1.6 to 1.7</a>
#### 4. <a href="#1.7to1.8">Migration from PuMuKIT 1.7 to 1.8</a>


## <a name="1.5b2to1.5">1. Migration from PuMuKIT 1.5b2 to 1.5 </a><a href="#Contents">(Top)</a>
In order to migrate from PuMuKIT 1.5 beta2 to the 1.5 version, we just need to replace the old version’s code files with the new ones.

In case you have any materials in your old installation, make sure not to overwrite the folders where the data is stored. In that case, it is recommended to only overwrite the following folders (with the final version’s content):

- the **lib** folder.
- the **apps** folder.
- the **web/webserver.php** file.

The database structure remains the same, so it is not necessary to make any changes to it.
To automate the update process, the following commands can be executed on a shell:

>$ cd {pumukit-dir}  
>$ rm -rf lib/  
>$ rm -rf apps/    
>$ rm -rf web/webserver.php  
>$ svn export http://pumukit.googlecode.com/svn/trunk/lib  
>$ svn export http://pumukit.googlecode.com/svn/trunk/apps  
>$ svn export http://pumukit.googlecode.com/svn/trunk/web/webserver.php web/webserver.php  


## <a name="1.5to1.6">2. Migration from PuMuKIT 1.5 to 1.6 </a> <a href="#Contents">(Top)</a>

In order to migrate from PuMuKIT 1.5 to 1.6, we just need to replace the old version’s code files with the new ones.

In case you have any materials in your old installation, make sure not to overwrite the folders where the data is stored. In that case, it is recommended to only overwrite the following folders (with the final version’s content):

- the **lib** folder.
- the **apps** folder.
- the **web/webserver.php** file.

To update the base structure the **_data/update/from15to16.sql_** script must be executed:
  >$ mysql -u root -p pumukit < data/update/from15to16.sql
  
One of the changes of the 1.6 version is its new frontend. In order to see it after the update from the 1.5 version it is necessary to modify the web/index.php file by replacing:

  > define('SF_APP', 'tv');  
  
with:  

  > define('SF_APP', &nbsp; 'tvdos');  
  
  
  
To automate this process, the following commands can be executed  on a shell:
  >$ cd {pumukit-dir}  
  >$ rm -rf lib/  
  >$ rm -rf apps/  
  >$ rm -rf web/webserver.php  
  >$ svn export http://pumukit.googlecode.com/svn/trunk/lib  
  >$ svn export http://pumukit.googlecode.com/svn/trunk/apps  
  >$ svn export http://pumukit.googlecode.com/svn/trunk/web/webserver.php web/webserver.php  
  >$ mysql -u root -p pumukit < data/update/from15to16.sql  
  

## <a name="1.6to1.7">3. Migration from PuMuKIT 1.6 to 1.7 </a><a href="#Contents">(Top)</a>
In order to migrate from PuMuKIT 1.6 to 1.7, we just need to replace the old version’s code files with the new ones and update the database.

In case you have any materials in your old installation, make sure not to overwrite the folders where the data is stored. In that case, it is recommended to only overwrite the following folders (with the final version’s content):

- the **lib** folder.
- the **apps** folder.

To update the database structure you must run the **_data/update/from16to17.sql_** script:

  >$ mysql -u root -p pumukit < data/update/from16to17.sql
  
One of the changes on the 1.7 version is the new fronted becoming the default one. After the update it is necessary to modify the **_web/index.php_** file by replacing:
  > define('SF_APP', 'tvdos');  
  
with:  

  > define('SF_APP', 'tv');  
  
To automate this process, the following commands can be executed on a shell:  
>$ cd {pumukit-dir}  
>$ rm -rf lib/  
>$ rm -rf apps/  
>$ rm -rf web/webserver.php  
>$ svn export http://pumukit.googlecode.com/svn/trunk/lib  
>$ svn export http://pumukit.googlecode.com/svn/trunk/apps  
>$ svn export http://pumukit.googlecode.com/svn/trunk/web/webserver.php web/webserver.php  
>$ mysql -u root -p pumukit < data/update/from16to17.sql  


## <a name="1.7to1.8">4. Migration from PuMuKIT 1.7 to 1.8 </a><a href="#Contents">(Top)</a>

In order to migrate from PuMuKIT 1.7 to 1.8, we just need to replace the old version’s code files with the new ones and update the database.

In case you have any materials in your old installation, make sure not to overwrite the folders where the data is stored. In that case, it is recommended to only overwrite the following folders (with the final version’s content):

- the **lib** folder.  
- the **apps** folder.  
- the **plugins** folder.  
- the **batch** folder.  
- the **web/css** folder.  
- the **web/images** folder.  
- the **web/js** folder.  
- the **web/swf** folder.  
- the **web/webserver.php** file.  

To update the database structure you must run the **_data/update/from17to18.sql_** script:
  >$ mysql -u root -p pumukit < data/update/from17to18.sql  
  
In order to initialize the 1.8 version categories the next command is used:
  >$ php symfony init-categories  
  
One of the changes of the 1.8 version is the number of views of each multimedia material is stored now in the mm table, therefore to initialize this field it is necessary to run a php script called **_"from17to18.php"_** which also synchronizes the knowledge areas with the categories and also makes some other profiles updates:
  >$ php data/update/from17to18.php
  
To automate this process, the following commands can be executed on a shell:  
>$ cd {pumukit-dir}  
>$ rm -rf lib/  
>$ rm -rf data/  
>$ rm -rf apps/  
>$ rm -rf plugins  
>$ rm -rf batch  
>$ rm -rf web/css  
>$ rm -rf web/images  
>$ rm -rf web/js  
>$ rm -rf web/swf  
>$ rm -rf web/webserver.php  
>$ git clone [https://github.com/campusdomar/pumukit.git] pumukir1.8src  
>$ cd pumukir1.8src  
>$ git checkout 1.8.x  
>$ cd ..  
>$ cp -rf pumukir1.8src/lib lib  
>$ cp -rf pumukir1.8src/data data  
>$ cp -rf pumukir1.8src/apps apps  
>$ cp -rf pumukir1.8src/plugins plugins  
>$ cp -rf pumukir1.8src/batch batch  
>$ cp -rf pumukir1.8src/web/css web/css  
>$ cp -rf pumukir1.8src/web/images web/images  
>$ cp -rf pumukir1.8src/web/js web/js  
>$ cp -rf pumukir1.8src/web/swf web/swf  
>$ cp -rf pumukir1.8src/web/webserver.php web/webserver.php  
>$ rm -rf pumukit1.8src  

>$ mysql -u pmk_user -p pumukit < data/update/from17to18.sql

>$ php symfony init-categories  
>$ php data/update/from17to18.php   
>$ php symfony clear-cache    

>$ sudo chown www-data:www-data /var/www/pumukit -R  
>$ chmod 777 data/  
>$ chmod 777 data/pumukit.index/  










