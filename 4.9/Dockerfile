FROM dockium/php:7.1.12_0

RUN apk add --no-cache --virtual .persistent-deps \
  curl \
  git \
	shadow \
  tar

ENV WORDPRESS_VERSION 4.9.1
ENV WORDPRESS_SHA1 892d2c23b9d458ec3d44de59b753adb41012e903

WORKDIR /var/www/

RUN set -ex; \
	curl -o wordpress.tar.gz -fSL "https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz"; \
	echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c -; \
# upstream tarballs include ./wordpress/ so this gives us /var/www/wordpress
	tar -xzf wordpress.tar.gz -C /var/www/; \
	rm wordpress.tar.gz;

RUN apk add --no-cache --virtual .wp-php-extensions \
	php7-ctype \
	php7-dom \
	php7-gd \
	php7-memcached \
	php7-redis \
	php7-soap

COPY files/wp-content /var/www/wp-content
COPY files/wp-config.php /var/www/wp-config.php
COPY files/.gitignore /var/www/.gitignore

RUN chown -R www-data:www-data . \
  && find . -type f -exec chmod 644 -- {} + \
  && find . -type d -exec chmod 755 -- {} + \
	&& chmod 444 ./wp-config.php \
	&& rm -rf /var/www/html

VOLUME /var/www/

COPY files/docker-wp-entrypoint.sh /usr/local/bin/

ENTRYPOINT ["docker-wp-entrypoint.sh"]

CMD ["php-fpm7"]
