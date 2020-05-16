# Docker Swarm

Swarm es el gestor de cluster integrado con Docker engine. Hemos elegido este orquestador para docker por la utilidad, facilidad e integración que tienen con docker. Docker swarm permite desplegar servicios en el cluster pero también permite desplegar más de un servicio en un stack (un yml donde se encuentran los servicios que se quieren desplegar con formato docker-compose).

Instrucciones:

He añadido en los servidores en /etc/hosts nombres para los equipos para poder tener facilidad a la hora de hacer conectarnos a cada nodo:
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

Docker swarm tiene características interesantes que permiten escalar los servicios en el cluster.
```
docker service scale <nombrestack>.apache
```

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
