import zipfile
import os
import hashlib
import datetime
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
import smtplib

def time():
    # Definimos la fecha actual exacta para utilizarla de forma organizativa
    x = datetime.datetime.now()
    value = ("%s-%s-%s-%s-%s" % (x.day, x.month, x.year, x.hour, x.second))
    return value


def copia(file, ):
    # Abrimos el fichero ZIP en modo escritura
    backup = zipfile.ZipFile(file, 'w')

    # Establecemos contraseña en formato Bytes
    # backup.setpassword(b"password")

    # Añadimos los elementos al zip
    for folder, subfolders, files in os.walk(sproperties[8]):
        for file in files:
            backup.write(os.path.join(folder, file), os.path.relpath(os.path.join(folder, file), sproperties[8]), compress_type=zipfile.ZIP_DEFLATED)

    # Cerramos el fichero ZIP.
    backup.close()


def hash(archivo):
    # Calculamos los hash del ZIP
    hashmd5 = hashlib.md5()
    hashsha = hashlib.sha256()
    with open(archivo, "rb") as f:
        for bloque in iter(lambda: f.read(4096), b""):
            hashmd5.update(bloque)
            hashsha.update(bloque)
    return hashmd5.hexdigest(), hashsha.hexdigest()


def enviar(archivo, ruta):
    # Enviamos el fichero comprimido por SCP y lo eliminamos del almacenamiento local
    os.system("scp -i config/Certs/svBackups.pem "+archivo+" "+usuario+"@"+ip+":"+ruta)
    os.system("rm -r "+rutabackups+"*.zip")


def notificar ():
    to = explo("config/alerts/to.txt")
    for i in range(0, len(to)):
        correo(cfile, usuario, md5, sha, to[i])


def correo(nombre, sysuser, hmd5, hsha, dest):
    # Enviamos alerta por correo
    # Creación de la instáncia del mensaje
    msg = MIMEMultipart()

    # Credenciales del cliente
    creds = explo("config/creds/creds.txt")
    password = creds[4]
    msg['From'] = creds[1]

    # Contenido del correo
    msg['To'] = dest
    msg['Subject'] = "ADESQ - Copia realizada con éxito"
    message = ("Se ha creado la copia de seguridad "+nombre+". Podrá encontrarla en el directorio del usuario "+sysuser+". \n Los códigos HASH de la copia son \n \n MD5: "+hmd5+"\n SHA256: "+hsha)
    # Formato del correo
    msg.attach(MIMEText(message, 'plain'))

    # Servidor remitente
    server = smtplib.SMTP(creds[7])

    server.starttls()

    # Iniciamos login
    server.login(msg['From'], password)

    # Enviamos el mensaje
    server.sendmail(msg['From'], msg['To'], msg.as_string())

    # Cerramos la conexión
    server.quit()

    print("\nSe ha enviado satisfactoriamente una alerta a %s" % (msg['To']))

def explo(ruta):
    creds = open(ruta)

    data=[]
    for line in creds:
        data.append(line[0 : -1])

    return data

# Datos del servidor de backups
sproperties = explo('config/server-properties.txt')
usuario = sproperties[2]
ip = sproperties[5]

# Directorio de backups enlazado
rutabackups = sproperties[11]

# Generamos el nombre del fichero comprimido.
cfile=(time()+'.zip')

# Launch script
copia(rutabackups+cfile,)

md5,sha = hash(rutabackups+cfile)
print('El hash MD5 es: ', md5+'\nEl hash SHA256 es: ', sha)
print()

enviar(rutabackups+cfile,sproperties[14])

# Generar notificaciones
notificar()
