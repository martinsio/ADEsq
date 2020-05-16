# Docker Swarm

Swarm es el gestor de cluster integrado con Docker engine. Hemos elegido este orquestador para docker por la utilidad, facilidad e integración que tienen con docker. Docker swarm permite desplegar servicios en el cluster pero también permite desplegar más de un servicio en un stack (un yml donde se encuentran los servicios que se quieren desplegar con formato docker-compose).

Instrucciones:
<br>

He añadido en los servidores en /etc/hosts nombres para los equipos para poder tener facilidad a la hora de hacer conectarnos a cada nodo:
```
<ip> manager01
<ip> worker01
```
<br>

Luego iniciamos el cluster en el nodo manager01:

```
$ docker swarm init --advertise-addr <ip>
```
<br>

En los otros nodos hacemos este comando para entrar al cluster:
```
$ docker swarm join --token <TOKEN> --advertise-addr <ip>
```
<br>

Para hacer desplogar la aplicación:
```
$ docker stack deploy -c docker-compose.yml <nombre del stack>
```
<br>

Para ver los servicios:
```
$ docker service ls 
```
![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Servicios/docker-swarm-running.png)

<br>

Docker swarm tiene características interesantes que permiten escalar los servicios en el cluster.
```
$ docker service scale appvoting_varnish=2
```
![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Images/scale.png)

<br>

Otra característica interesante del Docker swarm es el balanceador que tiene llamado 'routing mesh', que permite que en caso que un servicio no se encuentre en un nodo a través de la red de swarm conecta con el contenedor que tiene el servicio que se encuentra en otro nodo y devuelve el resultado.

![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Images/ingress-routing-mesh.png)

<br>

Para aumentar la organización y eficiencia se separan los ficheros .yml para separar los servicios de las otras herramientas.

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

Docker-compose: https://docs.docker.com/compose/compose-file/
