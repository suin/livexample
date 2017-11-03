FROM php:5.5-alpine

# Build PHP environment
COPY docker/install.sh /install.sh
RUN sh /install.sh && rm /install.sh
COPY docker/php.ini /usr/local/etc/php/conf.d/docker-php-common.ini

# Application specific files
COPY docker/setup.sh /setup.sh
COPY composer.json /home/phper/composer.json
RUN sh /setup.sh && rm /setup.sh

# Xdebug port
EXPOSE 9000

# Application directory
VOLUME ["/app"]

# Default user
USER phper
WORKDIR /home/phper
