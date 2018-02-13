FROM dockium/php:7.1.13_2

ARG PHP_VERSION=7.1

RUN apt-get update; \
    DEBIAN_FRONTEND=noninteractive apt-get install --no-install-recommends -y \
    php${PHP_VERSION}-gd \
    php${PHP_VERSION}-mysql \
    tar; \
    rm -rf /var/lib/apt/lists/*

ARG WORDPRESS_VERSION=4.9.4
ARG WORDPRESS_SHA1=0e630bf940fd586b10e099cd9195b3e825fb194c

ARG APP_ROOT=/var/www/

WORKDIR ${APP_ROOT}

RUN set -ex; \
    wget -O wordpress.tar.gz "https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz"; \
	  echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c -; \
    # upstream tarballs include ./wordpress/ so this gives us /var/www/wordpress
    tar -xzf wordpress.tar.gz -C ${APP_ROOT}/; \
    rm wordpress.tar.gz;

COPY files/wp-config.php ${APP_ROOT}/wp-config.php
COPY files/docker-wp-entrypoint.sh /usr/local/bin/

RUN set -ex; \
    chown -R www-data:www-data .; \
    find . -type f -exec chmod 644 -- {} +; \
    find . -type d -exec chmod 755 -- {} +; \
	  rm -rf /var/www/html; \
    chmod +x /usr/local/bin/docker-wp-entrypoint.sh

VOLUME /var/www/wordpress

ENTRYPOINT ["docker-wp-entrypoint.sh"]

CMD ["php-fpm7.1"]
