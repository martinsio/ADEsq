FROM alpine:3.9.6 as build1
RUN apk --update \
    add --no-cache apache2 \
    php7\
    php7-apache2 \
    curl \
    ca-certificates \
    openssl \
    git \
    php7 \
    php7-phar \
    php7-json \
    php7-iconv \
    php7-openssl \
    tzdata \
    openntpd \
    php7-ftp \
    php7-xdebug \
    php7-mcrypt \
    php7-mbstring \
    php7-soap \
    php7-gmp \
    php7-pdo_odbc \
    php7-dom \
    php7-pdo \
    php7-zip \
    php7-mysqli \
    php7-sqlite3 \
    php7-bcmath \
    php7-gd \
    php7-odbc \
    php7-pdo_mysql \
    php7-pdo_sqlite \
    php7-gettext \
    php7-xmlreader \
    php7-xmlwriter \
    php7-tokenizer \
    php7-xmlrpc \
    php7-bz2 \
    php7-pdo_dblib \
    php7-curl \
    php7-ctype \
    php7-session \
    php7-exif \
    && rm -f /var/cache/apk/*
COPY httpd.conf /etc/apache2/httpd.conf
COPY htdocs /var/www/localhost/htdocs
RUN rm /var/www/localhost/htdocs/index.html
EXPOSE 8080

FROM build1 as build2
ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]

