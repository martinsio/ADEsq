import zipfile
import os
import hashlib
import datetime


def time():
    x = datetime.datetime.now()
    value = ("%s-%s-%s %s;%s" % (x.day, x.month, x.year, x.hour, x.second))
    return value


def copia(time):
    backup = zipfile.ZipFile(rutabackups+cfile, 'w') # Abrimos el fichero ZIP en modo escritura
    #backup.setpassword(b"password")# Establecemos contraseña en formato Bytes

    for folder, subfolders, files in os.walk('cosas'):
        for file in files:
            backup.write(os.path.join(folder, file), os.path.relpath(os.path.join(folder, file), 'cosas'), compress_type=zipfile.ZIP_DEFLATED)

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
    #falta añadir el login mediante claveosboxes.org


rutabackups = 'backups/'
cfile=(time()+'.zip') #Generamos el nombre del fichero comprimido.

copia(cfile)
md5,sha = hash(rutabackups+cfile)


print('El hash MD5 es: ', md5)
print('El hash SHA256 es: ', sha)
