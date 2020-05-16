# Monitoreo

* Netdata

  Ofrece una interfaz web para poder ver el tráfico y los recursos de los contenedores. Para iniciarlo basta con copiar el docker-compose de su repositorio de Docker Hub.
  
  ![alt text](https://gitlab.com/adesq/voto/-/raw/master/Infraestructura/Monitoreo/Netdata/netdata.png)

* Lazydocker
  
  Esta herramienta al contrario que la anterior ofrece una interfaz en la terminal para monitorear los contenedores, para iniciarlo basta con ir a repositorio de Github o Docker Hub.

  ![alt text](https://gitlab.com/adesq/voto/-/raw/c76d49935b9e3f21b95b1d1f4433d8f3911afe8b/Infraestructura/Monitoreo/Lazydocker/lazydocker.png)


Para aumentar la organización los contenedores los iniciamos por docker-compose y los ficheros se encuentran separados del 'docker-compose.yml' de servicios para separar los servicios de monitoreo y servicios de la aplicación y poder gestionarlos mejor.

# Bibliografía

Portainer:
* https://www.portainer.io/installation/
* https://openwebinars.net/academia/aprende/docker-compose-swarm/
* https://clouding.io/hc/es/articles/360010398219-Instalar-Portainer-en-Ubuntu-18-04

Netdata: https://www.youtube.com/watch?v=bGyMLNRBlQ0

Lazydocker: 
* https://www.youtube.com/watch?v=xV75Vh5SS7U
* https://github.com/jesseduffield/lazydocker