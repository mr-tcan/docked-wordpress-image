FROM dockium/php:7.1.13_1

RUN apt-get update; \
    DEBIAN_FRONTEND=noninteractive apt-get install --no-install-recommends -y \
      git \
      openssh-client \
      tar; \
    rm -rf /var/lib/apt/lists/*

ARG WORDPRESS_VERSION=4.9.1
ARG WORDPRESS_SHA1=892d2c23b9d458ec3d44de59b753adb41012e903

WORKDIR /var/www/

RUN set -ex; \
	wget -O wordpress.tar.gz "https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz"; \
	echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c -; \
# upstream tarballs include ./wordpress/ so this gives us /var/www/wordpress
	tar -xzf wordpress.tar.gz -C /var/www/; \
	rm wordpress.tar.gz;

ARG PHP_VERSION=7.1

RUN apt-get update; \
	 DEBIAN_FRONTEND=noninteractive apt-get install --no-install-recommends -y \
		php${PHP_VERSION}-ctype \
  	php${PHP_VERSION}-ctype \
  	php${PHP_VERSION}-dom \
  	php${PHP_VERSION}-gd \
  	php${PHP_VERSION}-memcached \
  	php${PHP_VERSION}-redis \
  	php${PHP_VERSION}-soap; \
  rm -rf /var/lib/apt/lists/*

COPY files/content /var/www/content
COPY files/wp-config.php /var/www/wp-config.php
COPY files/docker-wp-entrypoint.sh /usr/local/bin/

RUN chown -R www-data:www-data . \
  && find . -type f -exec chmod 644 -- {} + \
  && find . -type d -exec chmod 755 -- {} + \
	&& chmod 644 ./wp-config.php \
	&& rm -rf /var/www/html \
  && chmod +x /usr/local/bin/docker-wp-entrypoint.sh

VOLUME /var/www/

ENTRYPOINT ["docker-wp-entrypoint.sh"]

CMD ["php-fpm7.1"]
