# Escaner de vulnerabilidades en imagénes docker

Hemos optado por una herramienta llamada 'trivy' que es un contenedor que se crea, analiza las vulnerabilidades de la imagen seleccionada, imprime el resultado y se elimima.

```
$ docker run --rm -v [YOUR_CACHE_DIR]:/root/.cache/ aquasec/trivy [YOUR_IMAGE_NAME]
```

# Bibliografía

Trivy: 
* https://www.youtube.com/watch?v=xV75Vh5SS7U
* https://github.com/aquasecurity/trivy