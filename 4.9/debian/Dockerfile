FROM pressmogul/php:7.2.10-fpm

ARG PHP_VERSION=7.2

RUN apt-get update; \
    DEBIAN_FRONTEND=noninteractive apt-get install --no-install-recommends -y \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-mysql \
    tar; \
    rm -rf /var/lib/apt/lists/*

ARG WORDPRESS_VERSION=4.9.8
ARG WORDPRESS_SHA1=0945bab959cba127531dceb2c4fed81770812b4f

ARG WEB_ROOT=/var/www/

WORKDIR ${WEB_ROOT}

RUN set -ex; \
    wget -O wordpress.tar.gz "https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz"; \
	  echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c -; \
    # upstream tarballs include ./wordpress/ so this gives us /var/www/wordpress
    tar -xzf wordpress.tar.gz -C ${WEB_ROOT}/; \
    rm wordpress.tar.gz;

COPY files/wp-config.php ${WEB_ROOT}/wordpress/wp-config.php

RUN set -ex; \
    { \
    echo '#!/bin/sh'; \
    echo ; \
    echo 'set -e'; \
    echo ; \
    echo 'exec "$@"'; \
    } | tee /usr/local/bin/docker-wp-entrypoint; \
    chmod +x /usr/local/bin/docker-wp-entrypoint


RUN set -ex; \
    chown -R www-data:www-data .; \
    find . -type f -exec chmod 644 -- {} +; \
    find . -type d -exec chmod 755 -- {} +; \
	rm -rf /var/www/html;

VOLUME /var/www/wordpress

ENTRYPOINT ["docker-wp-entrypoint"]

CMD ["php-fpm7.2"]
