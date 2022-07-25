# Backup manager
Debido a la singularidad del proyecto, se ha creado un script capaz de copiar y enviar directorios mediante SCP.
Se recomienda programar su ejecución mediante [Crontab.](https://www.redeszone.net/tutoriales/servidores/cron-crontab-linux-programar-tareas/)

# Ficheros en el directorio
El script está formado por un fichero .py y un directorio. Se describen a continuación:
 - Directorio **config**: Es el directorio donde se guardan todas las configuraciones del script.
 - Fichero **script.py**: Ejecutable principal. Es el fichero que se debe ejecutar cada vez que se quiera hacer una copia de seguridad.

## Configuración del script

Dentro del directorio **/config** se pueden encontrar los siguientes elementos:

 - Fichero **/alerts/to.txt**: Contiene las direcciones de correo a las que se notifica cada vez que se realiza una copia de seguridad. Debe haber una dirección por línea.
 - Directorio **/Certs**: Contiene el certificado .pem del servidor destino. El nombre debe ser obligatoriamente *clave.pem*
 - Fichero **/creds/creds.txt**: Contiene los datos de acceso al servidor de correo que envía las notificaciones. Debe respetar el formato del fichero de ejemplo. 
![enter image description here](https://i.ibb.co/0sB2NwQ/Captura-de-pantalla-2022-07-25-214238.png)
En el ejemplo se encuentra preconfigurado gmail como servidor de correo.
 - Fichero **server-properties.txt**: Contiene datos sobre el servidor de origen y el de destino.  Ver el siguiente apartado para más información.

### server-properties.txt
El fichero debe respetar el formato de ejemplo:
![server-properties-txt](https://i.ibb.co/Z1VyXQj/copia.png)

 - **Usuario:** Nombre de usuario que debe usar SCP en el servidor destino.
 - **IP del servdor:** Dirección IP del servidor destino.
 - **Ruta de origen:** Ruta de la que se realiza la copia de seguridad.
 - **Ruta de destino local:** Ruta del servidor origen en la que se guardará la copia hasta ser enviada.
 - **Ruta de destino remoto:** Ruta del servidor destino donde se almacenará la copia.