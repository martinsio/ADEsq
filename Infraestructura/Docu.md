# Docker Swarm

Swarm es el gestor de cluster integrado con Docker engine.


He añadido en los servidores en /etc/hosts nombres para los equipos para poder tener facilidad a la hora de hacer pruebas:
```
<ip> manager01
<ip> worker01
```
Luego iniciamos el cluster en el nodo manager01:
```
docker swarm init --advertise-addr <ip>
```
En los otros nodos hacemos este comando para entrar al cluster:
```
docker swarm join --token <TOKEN> --advertise-addr <ip>
```

Para hacer desplogar la aplicación:
```
docker stack deploy -c docker-compose.yml <nombre del stack>
```

Para ver los servicios:
```
docker service ls
```
![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Servicios/docker-swarm-running.png)

# Monitoreo

* Netdata

  Ofrece una interfaz web para poder ver el tráfico y los recursos de los contenedores. Para iniciarlo basta con copiar el docker-compose de su repositorio de Docker Hub.
  
  ![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Monitoreo/Netdata/netdata.png)

* Lazydocker
  
  Esta herramienta al contrario que la anterior ofrece una interfaz en la terminal para monitorear los contenedores, para iniciarlo basta con ir a repositorio de Github o Docker Hub.

  ![alt text](https://gitlab.com/adesq/voto/-/raw/c76d49935b9e3f21b95b1d1f4433d8f3911afe8b/Infraestructura/Monitoreo/Lazydocker/lazydocker.png)


Para aumentar la organización los contenedores los iniciamos por docker-compose y Los ficheros se encuentran separados del 'docker-compose.yml' de servicios para separar los servicios de monitoreo y servicios de la aplicación y poder gestionarlos mejor.


# Bibliografía

Docker swarm: 

* Hacer deploy: https://docs.docker.com/get-started/swarm-deploy/

* Desplegar en nodo específico: 

  * https://blog.raveland.org/post/constraints_swarm/
  * https://stackoverflow.com/questions/51298645/multiple-label-placement-constraints-in-docker-swarm

  * https://docs.docker.com/engine/swarm/services/#placement-constraints

* Caracteristicas de swarm: https://docs.docker.com/engine/swarm/

* Como trabajan los nodos: https://docs.docker.com/engine/swarm/how-swarm-mode-works/nodes/

* Balanceador de swarm: https://docs.docker.com/engine/swarm/ingress

* https://openwebinars.net/academia/aprende/docker-compose-swarm/


Portainer:
* https://www.portainer.io/installation/
* https://openwebinars.net/academia/aprende/docker-compose-swarm/
* https://clouding.io/hc/es/articles/360010398219-Instalar-Portainer-en-Ubuntu-18-04

MariaDB Cluster: https://hub.docker.com/r/toughiq/mariadb-cluster/

Varnish docker: 
* https://hub.docker.com/_/varnish

* https://dev.to/vuong/dockerization-varnish-nginx-try-to-hit-the-first-cache-375c

Netdata: https://www.youtube.com/watch?v=bGyMLNRBlQ0

Lazydocker: 
* https://www.youtube.com/watch?v=xV75Vh5SS7U
* https://github.com/jesseduffield/lazydocker

Docker-compose: https://docs.docker.com/compose/compose-file/