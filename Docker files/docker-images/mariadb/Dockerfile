FROM toughiq/mariadb-cluster:2.1
COPY my.cnf /etc/mysql/my.cnf
COPY estructura_voto.sql /docker-entrypoint-initdb.d/
CMD ["mysqld"]
