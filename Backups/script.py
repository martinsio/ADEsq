import zipfile
import os

def copia():
    backup = zipfile.ZipFile('backups/fichero.zip', 'w') # Abrimos el fichero ZIP en modo escritura
    backup.setpassword(b"password")# Establecemos contraseña en formato Bytes
    backup.write('cosas', compress_type=zipfile.ZIP_DEFLATED) #Indicamos que debe comprimir

    backup.close() #Cerramos el fichero comprimido.

def hash(archivo):
    hashmd5 = hashlib.md5()
    hashsha = hashlib.sha256()
    with open(archivo, "rb") as f:  # Abrimos y calculamos el hash MD5
        for bloque in iter(lambda: f.read(4096), b""):
            hashmd5.update(bloque)
            hashsha.update(bloque)
    return hashmd5.hexdigest(), hashsha.hexdigest()  # Devolvemos el resultado

def enviar():
    os.system("scp bsckups/fichero.zip USER@SERVER:PATH")
    #falta añadir el login mediante clave