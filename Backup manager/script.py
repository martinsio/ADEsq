import zipfile, os, hashlib, datetime, smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

#____Info____
# Author: Martín Justo Fernandez
# Original file date: 26/04/2020
# Result: El script realiza una copia de un directorio y la envia a otro servidor mediante SCP.

# Devuelve la fecha actual en el formato deseado
def time():
    x = datetime.datetime.now()
    value = ("%s-%s-%s-%s-%s" % (x.day, x.month, x.year, x.hour, x.second))
    return value

#Guarda el contenido de un directorio con las propiedades preestablecidas en server-propierties.txt
def copia(file):
    # Abre el fichero ZIP en modo escritura
    backup = zipfile.ZipFile(file, 'w')

    # Añade los elementos al ZIP
    for folder, subfolders, files in os.walk(sproperties[8]):
        for file in files:
            backup.write(os.path.join(folder, file), os.path.relpath(os.path.join(folder, file), sproperties[8]), compress_type=zipfile.ZIP_DEFLATED)

    # Cierra el fichero ZIP.
    backup.close()

# Devuelve los hash MD5 y SHA del fichero pasado como parámetro
def hash(archivo):
    hashmd5 = hashlib.md5()
    hashsha = hashlib.sha256()
    with open(archivo, "rb") as f:
        for bloque in iter(lambda: f.read(4096), b""):
            hashmd5.update(bloque)
            hashsha.update(bloque)
    return hashmd5.hexdigest(), hashsha.hexdigest()

# Envia el fichero dado como parámetro "archivo" a la ruta indicada "ruta" del servidor destino.
def enviar(archivo, ruta):
    os.system("scp -i config/Certs/clave.pem "+archivo+" "+usuario+"@"+ip+":"+ruta)
    os.system("rm -r "+rutabackups+"*.zip")

#Notifica por correo a todas las direcciones establecidas en el fichero "to.txt". Además, notifica a un canal de Telegram.
def notificar ():
    to = explo("config/alerts/to.txt")
    for i in range(0, len(to)):
        correo(cfile, usuario, md5, sha, to[i])
    telegram(cfile, md5, sha)

#Envía una notificación a un canal de Telegram preesablecido.
def telegram (nombre, md5, sha):
    os.system('telegram-send --config /tel.conf --format markdown "Se ha creado la copia de seguridad '+nombre+' con los hash MD5: '+md5+' y SHA256: '+sha+'"')

# Enviar una notificación mediante correo electrónico a la dirección dada como parámetro "dest".
def correo(nombre, sysuser, hmd5, hsha, dest):
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

#Extrae los datos del fichero de configuración
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