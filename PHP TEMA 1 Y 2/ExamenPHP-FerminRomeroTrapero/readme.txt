1. (0,5 puntos) Al pulsar "Entrar" deberemos comprobar que existe un usuario con el nombre y la clave introducidos. Si es así:
Lo guardaremos en la sesión.
Mostraremos su panel de control con los botones: recibidos, enviados, redactar y cerrar sesión.
Mostraremos sus mensajes recibidos
En caso contrario mostraremos la vista de identificación con un mensaje de "El usuario no existe".

FUNCIONA


2. Al pulsar "Registrarse" comprobaremos que no existe un usuario con ese nombre. Si es así:
(0,25 puntos) Grabaremos el nombre usuario y su clave en el fichero de usuarios.ini
(1 punto) Crearemos la estructura de directorios para ese usuario:
Usuarios
|- nombre_de_usuario
|- recibidos
|- enviados
Muy importante: cuando vayáis a crear el directorio no os olvidéis de indicar los permisos 0777 en formato numérico y no de cadena. 

FUNCIONA


(0,25 puntos) Volveremos a la vista de identificación. --> FUNCIONA


3. (1 punto) Cuando el usuario se identifique debe aparecer su nombre en todas las vistas junto al panel de control: recibidos, 
enviados, redactar, cerrar sesión como si de un menú se tratara. 
El panel de control es una vista independiente que puede incluirse condicionalmente si el usuario se ha identificado.

FUNCIONA

4. (1 punto) Al pulsar el botón recibidos debemos mostrar todos los mensajes recibidos por el usuario. A la derecha de cada 
mensaje debe aparecer un botón o un enlace "Ver".

FUNCIONA

5. (1 punto) Al pulsar el botón enviados debemos mostrar todos los mensajes enviados por el usuario. A la derecha de cada
mensaje debe aparecer un botón o un enlace "Ver".

FUNCIONA

5. (0,5 puntos) Al pulsar sobre el botón o el enlace "Ver" mostraremos en otra vista el contenido del mensaje.
Cada mensaje es un fichero cuyo nombre es un sello del tiempo (el tiempo actual en segundos) más un guión y el asunto del mensaje 
El formato o contenido de los mensajes enviados y recibidos es:
Primera línea: Remitente (para los mensajes recibidos) o Destinatario (para los mensajes enviados)
Segunda línea: asunto del mensaje
Resto de líneas: contenido del mensaje

NO FUNCIONA EL BOTON VER

6. Al pulsar "Redactar" mostraremos otra vista con:
(0,5 puntos) Una lista select para seleccionar al usuario destinatario que deberá ser previamente rellenada desde el controlador con los usuarios que haya en el sistema. 
Un campo de texto para el asunto.
Un textarea para el contenido del mensaje
Un botón "Enviar mensaje" para enviar al mensaje.

FUNCIONA

7 Al pulsar "Enviar mensaje":

7.1 (2 puntos) Guardaremos en la carpeta enviados del usuario un fichero con:
nombre: sello del tiempo (tiempo actual) más un guión seguido del asunto del mensaje.
primera línea del fichero: usuario al que va dirigido.
segunda línea del fichero: campo asunto
contenido: el contenido del textarea

FUNCIONA


7.2 (2 puntos) Guardaremos en la carpeta recibidos del usuario destinatario un fichero con:
nombre: sello del tiempo (tiempo actual) más un guión seguido del asunto del mensaje.
primera línea del fichero: usuario al que va dirigido.
segunda línea del fichero: campo asunto
contenido: el contenido del textarea

FUNCIONA


