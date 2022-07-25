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
## Uso del docker-compose

## Importación de la base de datos

## Implementación de las copias de seguridad