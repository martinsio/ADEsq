# ADESQ - Sistema de voto seguro
 Sistema para votaciones abiertas con infraestructura basada en docker y cloud.
 
![](https://i.ibb.co/CnghcXY/Imagen1.png)

# Miembros del equipo
 - Eduard Avellanet Reyes
 - Josue David Zambrano Perozo 
 - Pau Enjuanes Sumalla
 - Martín Justo Fernández

# Objetivos
 - Ofrecer la posibilidad de crear votaciones / votar de forma privada y segura.
 - Ofrecer al público general la documentación necesaria para la creación e implementación del servicio con el menor costo posible.
 - Adquirir nuevos conocimientos útiles para el desarrollo de otros proyectos de forma profesional.

# Conocimientos adquiridos durante el desarrollo
La realización de este proyecto ha permitido a los integrantes del grupo adquirir y aplicar conocimientos relacionados con el cloud computing. Algunos ejemplos pueden ser los servicios en la nube de Amazon, Docker y algunos de sus contenedores (Varnish, Traefik, Lazy Docker, Trivy, Sshuttle).

# Repositorio original
Esta documentación está basada en el repositorio original del proyecto.
Enlace: https://gitlab.com/adesq/voto

# Descripción del proyecto
El proyecto tiene como objetivo ofrecer una plataforma de voto escalable, segura y fácil de implementar. Se puede dividir en tres bloques principales:
 - **Página web:** Interfaz básica que permite a los usuarios tanto votar como crear sus propias votaciones, ya sean públicas o privadas.
 - **Base de datos:** Será la que almacene todos los datos. Se considera importante aplicar una buena seguridad a este apartado.
 - **Sistema de copias de seguridad:** Permite tener redundancia en los datos almacenados. Es un añadido a la seguridad general de la plataforma.


# Despliegue de la plataforma
## 1. Uso del docker-compose
Para que el despliegue sea exitoso, en primer lugar se debe instalar Docker. Para ello, dentro del directorio **/Docker files** se puede encontrar el fichero install-docker.sh. Tras su ejecución, Docker estará listo.

A continuación se deben desplegar los servicios haciendo uso del fichero **/Docker files/docker-swarm/docker-compose.yml**. Estando en el directorio del fichero lanzaremos los siguientes comandos:
- *docker-compose build*
- *docker-compose up*

Tras su correcta implementación, tendremos funcionando los servicios:
- **Apache**, puerto 8080
- **Varnish**, puerto 80
- **MariaDB**, puerto 10200

## 2. Importación de la base de datos
En el fichero **/Base de datos/estructura-voto.sql** podemos encontrar la estructura de la base de datos que requiere la página web.

![](https://i.ibb.co/chbQ6Gr/Imagen2.png)

Sabiendo que por defecto la base de datos creada por la ejecución del fichero **docker-compose.yml** tiene el nombre **basededatos**, podemos importar la configuración mediante el comando:
*docker exec -i mariadb mysql -root --password=**password_usuario** basededatos  < estructura-voto.sql*

## 3. Implementación de las copias de seguridad
Se deben seguir las instrucciones dadas en el fichero **/Backup manager/README.md**.