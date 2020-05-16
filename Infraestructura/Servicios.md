# Servicios

## Apache y PHP

Hemos creado una imagen de alpine en la cual hemos instalado todos los paquetes para apache y php para alojar la página web.

https://hub.docker.com/r/adesq/php-apache

## Mariadb

Hemos utilizado una imagen que estaba modificada para usar MariaDB es docker swarm y hemos creado una imagen a partir de ella para cargar nuestro fichero de configuración de mariadb para permitir el acceso remoto a al mariadb.

https://hub.docker.com/r/adesq/mariadb

## Varnish

Hemos utilizado la imagen oficial de varnish para para implementarlo junto al apache y hemos creado la imagen para cargar el fichero de configuración de varnish para indicarle la ruta del apache.

https://hub.docker.com/r/adesq/varnish

# Bibliografía

Repositorio de Docker Hub: https://hub.docker.com/u/adesq

Nuestra imagen de PHP y Apache: https://hub.docker.com/r/adesq/php-apache

Nuestra imagen de Varnish: https://hub.docker.com/r/adesq/varnish

Nuestra imagen de mariadb: https://hub.docker.com/r/adesq/mariadb

MariaDB Cluster: https://hub.docker.com/r/toughiq/mariadb-cluster/

Alpine con php y apache:
* https://github.com/eriksoderblom/alpine-apache-php/blob/master/Dockerfile
* https://github.com/janecekt/docker-alpine-apache-php/blob/master/Dockerfile
* https://github.com/ulsmith/alpine-apache-php7/blob/master/Dockerfile

Varnish docker: 
* https://hub.docker.com/_/varnish

* https://dev.to/vuong/dockerization-varnish-nginx-try-to-hit-the-first-cache-375c