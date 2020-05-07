FROM alpine:3.9.6 as build1
RUN apk --update \
    add --no-cache apache2 \
    php7-apache2 \
    php7-mcrypt \
    php7-mysqlnd \
    php7-mbstring \
    php7-pdo_mysql \
    && rm -f /var/cache/apk/*
RUN sed -i -e "s/80/8080/" /etc/apache2/httpd.conf
EXPOSE 8080

FROM build1 as build2
ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]

