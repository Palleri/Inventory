FROM alpine:3.15
ARG TARGETPLATFORM
ENV webhook="" \
host="" \
name="" \
user="" \
password="" \
port="" \
token="" \
hahost=""
COPY app* /app/ 
RUN apk --update add --no-cache \
    lighttpd \
    bash \
    curl \
    busybox-initscripts \
    openrc \
    vim \
    py-pip \
    mariadb-connector-c-dev \
#    inotify-tools \
    grep \
    php-common \
    php-fpm \
#    php-pgsql \
    php-mysqli \
    php-curl \
    php-cgi \
    fcgi \
    mysql-client\
    coreutils \
#    php-pdo \
#    php-pdo_pgsql \
#    postgresql \
    && rm -rf /var/cache/apk/* \
&& adduser www-data -G www-data -H -s /bin/bash -D 
#&& pip install --no-cache-dir apprise
ADD /app/lighttpd.conf /etc/lighttpd/lighttpd.conf 

EXPOSE 80
#VOLUME /var/www


ENTRYPOINT [ "/app/entrypoint.sh" ]