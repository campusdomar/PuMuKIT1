README
======

Qué es Pumukit?
----------------------------------------

PuMuKIT (PUblicador MUltimedia en KIT) permite publicar vía Internet los 
contenidos audiovisuales producidos en una Institución, Universidad, etc..

PuMuKIT publica los contenidos multimedia almacenados en su base de datos 
a través de sus canales de publicación. Estos canales pueden ser un portal 
WEB, una WEB-TV, un flujo RSS compatibles ARCA, iTunes U o YouTube.



Requisitos
------------------------------------

PuMuKIT es una aplicación LAMP, creada con el framework symfony. Usa ffmpeg
tanto para analizar los medios audiovisuales como para transcodificarlos.

Los requisitos para su instalación son linux, apache, mysql, ffmpeg, php5.
Es necesario tener instalado una version de ffmpeg que codifique a h264 y 
aac. Tambien se necesitan los siguientes modulos de php5: php5-ffmpeg 
php5-cli php5-xsl php5-mysql php5-ldap php5-curl.

El script doc/scripts/check_dependeces.php comprueba que se cumplen todas 
las dependencias.

PuMuKIT ha sido desarrollado y es frecuentemente instalado sobre Linux Debian
pero su uso no es imprescindible.



Instalación
------------------------------------

El proceso de instalación está descrito para una distribución tipo debian con
usuario con permisos de administración.

1. Descargamos la última versión de pumukit desde:

    http://code.google.com/p/pumukit/downloads/list


2. Accedemos con un terminal al directorio donde se ha descargado, 
descomprimimos el archivo y movemos la aplicación para situarla en 
/var/www/pumukit
    
    $ tar xvzf pumukit17.tgz
    $ mv pumukit17/ /var/www/pumukit


3. Instalamos las dependencias de pumukit (ver requisitos):
    $ aptitude install ffmpeg php5-ffmpeg php5-cli apache2 libapache2-mod-php5 mysql-server mysql-client php5-xsl php5-mysql php5-ldap php5-curl libavcodec-extra-53 libavdevice-extra-53 libavfilter-extra-2 libavformat-extra-53 libavutil-extra-51

    Puede dar algún aviso, aceptaremos la solución propuesta. Ejemplos:

  i)┌────────────────────────────────────────────────────────────────────┐
    │ No se satisfacen las dependencias de los siguientes paquetes:      │
    │  ... En conflicto con: ...  que es un paquete virtual.             │
    │Internal error: found 2 (choice -> promotion) mappings for a single │
    │ choice.                                                            │
    │Las acciones siguientes resolverán estas dependencias               │
    │      Mantener los paquetes siguientes en la versión actual:        │
    │...                                                                 │
    │¿Acepta esta solución? [Y/n/q/?]                                    │
    └────────────────────────────────────────────────────────────────────┘

ii) ┌────────────────────────────────────────────────────────────────────┐
    │Se instalarán los siguiente paquetes NUEVOS:                        │
    │...                                                                 │
    │Necesito descargar 32.7 MB de archivos. Después de desempaquetar se │
    │ usarán 89.7 MB.                                                    │
    │¿Quiere continuar? [Y/n/?]                                          │
    └────────────────────────────────────────────────────────────────────┘ 


4. Establecemos la contraseña del usuario root de MySQL

    ┌────────────────┤ Configuración de mysql-server-5.1 ├─────────────┐     
    │ Se recomienda que configure una contraseña para el usuario «root»│     
    │ (administrador) de MySQL, aunque no es obligatorio.              │     
    │                                                                  │     
    │ No se modificará la contraseña si deja ese campo en blanco.      │     
    │                                                                  │     
    │ Nueva contraseña para el usuario «root» de MySQL:                │     
    │                                                                  │     
    │ _________________________________________________________________│     
    │                                                                  │     
    │                            <Aceptar>                             │     
    │                                                                  │     
    └──────────────────────────────────────────────────────────────────┘

    En este ejemplo usaremos como contraseña para el usuario root de MySQL:
    password_mysql

    La volvemos a introducir cuando nos lo pida.
    Nota: Guardar la clave de root de mysql, más adelante nos hará falta.


5. Habilitamos el mod_rewrite de apache:

    $ a2enmod rewrite


6. Reiniciamos el servidor de apache. Podemos usar dos opciones:

    i)  $ /etc/init.d/apache2 restart
    ii) $ service apache2 restart


7. Creamos la base de datos pumukit y un usuario para darle acceso a la
aplicación. En nuestro ejemplo usamos "pmk_user" y suponemos que el servidor
MySQL está en la máquina local.

Nota: Al introducir este bloque de comandos, nos pedirá la clave de root de
MySQL que establecimos antes.

    $ mysql -u root -p <<EOF
    >  CREATE DATABASE pumukit DEFAULT CHARACTER SET utf8;
    >  GRANT ALL PRIVILEGES ON pumukit.* TO "pmk_user"@"localhost" IDENTIFIED BY "pmk_password";
    >  FLUSH PRIVILEGES;
    >EOF


8. Copiamos el virtualhost de ejemplo para apache para acceder a Pumukit:

    $ cp /var/www/pumukit/doc/files/apache.default /etc/apache2/sites-available/default


9. Configuramos el módulo de PHP, para ello editamos las siguientes líneas
de los ficheros /etc/php5/apache2/php.ini y /etc/php5/cli/php.ini :

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


10. Reiniciamos el servidor apache como antes:

    $ /etc/init.d/apache2 restart


11. Limpiamos la caché de Pumukit:

    $ php /var/www/pumukit/symfony cc


12. Damos permisos a los ficheros de Pumukit:

    $ php /var/www/pumukit/symfony fix


13. Opcional: si se va a emplear un usuario diferente al recomendado en
el punto 7 (pmk_user), cambiamos configuración de la BBDD en Pumukit.

Por ejemplo, podemos configurarlo para que pumukit se conecte con el usuario
root de MySQL.

Para ello editaremos dos archivos de configuración cambiando estos valores:
    /var/www/pumukit/config/databases.yml
        ...
        database: pumukit
        username: root
        password: password_mysql 

    /var/www/pumukit15/config/propel.ini
        ...
        propel.database.createUrl = mysql://root:password_mysql@localhost/
        propel.database.url = mysql://root:$password_mysql@localhost/pumukit


14. Ejecutamos la tarea de symfony para generar la base de datos y cargar
la configuración por defecto en la BBDD:

    $ php /var/www/pumukit/symfony propel-build-all-load editar

15. Ejecutamos la tarea personalizada para importar los árboles de categorías
en la BBDD:

    $ php /var/www/pumukit/symfony init-categories


16. Limpiamos la caché de Pumukit y reiniciamos el servidor de apache:

    $ php /var/www/pumukit/symfony cc
    $ /etc/init.d/apache2 restart


17. Probablemente haya que solucionar la falta de permisos del usuario con el
que accede el servidor de apache2 (en nuestro caso "www-data") a las carpetas
y ficheros de Pumukit.
Una manera de resolverlo es cambiar el propietario y grupo de los contenidos
de la carpeta pumukit:

    $ chown www-data:www-data /var/www/pumukit -R

             
Extra - prueba en local
------------------------------------

Configuración del servidor apache para probar pumukit en local con virtualhost

1. Añadimos la siguiente línea al archivo /etc/hosts 
    127.0.0.1    pumukit


2. Creamos o añadimos al archivo /etc/apache2/httpd.conf las siguientes líneas:

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


3. Reiniciamos el servidor apache:

    $ /etc/init.d/apache2 restart


Ahora, reiniciando el servicio apache2 e introduciendo "pumukit" en cualquier
navegador, debería mostrar la aplicación funcionando correctamente.

Introduciendo "pumukit/editar.php" se puede comprobar el backend.
El usuario por defecto para el backend es "prueba" y la contraseña "123456" .


Configuración de pumukit
------------------------------------

La configuración principal de Pumukit se realiza en un archivo en formato 
YAML ( http://es.wikipedia.org/wiki/YAML ). 
Siguiendo las instrucciones anteriores, estará localizado en:

    /var/www/pumukit/config/app.yml 

Es vital no alterar la indentación del archivo: 
dos espacios para cada categoría, cuatro espacios para cada clave.

Dentro de algunas categorías existe una clave "use:" que activará la
funcionalidad requerida si su valor es 1 o la desactivará con 0.

Las cadenas de texto como URL, usuario, contraseña, etc. deberán ir
encerradas entre comillas simples o dobles.


1. Reproducir un vídeo de introducción automáticamente antes de cada vídeo.
    - Buscamos en el archivo app.yml la categoría "intro".
    - Cambiamos el valor de "use:" de 0 a 1 (activa la funcionalidad).
    - Añadimos en el valor de "url:" la URL completa del vídeo a mostrar.
    Ejemplo:

  intro:
    use:    1
    url:    "http://servidor.com/ejemplo/video_intro.mp4"


2. Activar la funcionalidad Matterhorn. 

Matterhorn permite una instalación multimáquina con distintos servidores
para reproducir los vídeos y para administrar el sistema.

    - Buscamos en el archivo app.yml la categoría "matterhorn" 
    - Cambiamos el valor de "use:" de 0 a 1.
    - Añadimos en el valor de "server:" la URL completa del servidor donde
        esté alojado el reproductor de Matterhorn.
    - Añadimos en el valor de "server_admin" la URL completa del servidor
        con la interfaz de administración.
    - Añadimos en el valor de "user:" la cuenta de usuario que usará Pumukit
        para conectarse al servidor de Matterhorn. 
        
        -- Importante: es necesaria una cuenta de usuario que se autentifique
        vía Digest. Una cuenta de usuario normal no sirve. 
        Normalmente, esta cuenta de configura en el fichero config.properties
        en el servidor Matterhorn.

    - Añadimos en el valor de "password:" la contraseña del usuario para el
    servidor de Matterhorn.

  matterhorn:
    use:           1
    server:        "http://ejemplo-mh-engage-player.dominio.com"
    server_admin:  "http://ejemplo_interfaz_admin.dominio.com"
    user:          "usuario_matterhorn"
    password:      "contraseña_matterhorn"



Para más información: http://pumukit.uvigo.es
