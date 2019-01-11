FROM golang:1.11-alpine3.7 AS builder

RUN apk add --no-cache --update git

RUN go get -v -u github.com/ochinchina/supervisord

RUN CGO_ENABLED=0 GOOS=linux go build -a -ldflags "-extldflags -static" -o /usr/local/bin/supervisord github.com/ochinchina/supervisord

FROM alpine:3.7

COPY --from=builder /usr/local/bin/supervisord /usr/local/bin/supervisord

# ensure www-data user exists
RUN set -x; \
addgroup -g 82 -S www-data; \
adduser -u 82 -D -S -G www-data www-data

# Install dependencies.
RUN set -ex; \
    apk --update add --no-cache \
    ca-certificates \
    curl \
    mysql-client \
    nginx \
    shadow \
    ssmtp;

# trust this project public key to trust the packages.
RUN curl -SL https://php.codecasts.rocks/php-alpine.rsa.pub -o /etc/apk/keys/php-alpine.rsa.pub

# Install PHP and extensions. Make sure you can use HTTPS.
# Notice the @php is required to avoid getting default php packages
# from alpine instead.
ENV PHP_VERSION=7.2

RUN set -ex; \
    echo "@php https://php.codecasts.rocks/v3.7/php-${PHP_VERSION}" >> /etc/apk/repositories; \
    apk --update add --no-cache\
    php@php \
    php-curl@php \
    php-fpm@php \
    php-gd@php \
    php-json@php \
    php-mbstring@php \
    php-mysqli@php \
    php-opcache@php \
    php-openssl@php \
    php-phar@php \
    php-soap@php \
    php-zip@php; \
    ln -s /usr/bin/php7 /usr/bin/php;

# install gosu to run commands as non-root user
ENV GOSU_VERSION=1.11
RUN set -ex; \
    curl -o /usr/local/bin/gosu -L "https://github.com/tianon/gosu/releases/download/$GOSU_VERSION/gosu-amd64"; \
    chmod +x /usr/local/bin/gosu;

ENV WP_CLI_VERSION=2.1.0
ENV WP_CLI_CONFIG_PATH=/usr/local/docker/etc/wp-cli.yaml

RUN set -ex; \
    curl -L https://github.com/wp-cli/wp-cli/releases/download/v${WP_CLI_VERSION}/wp-cli-${WP_CLI_VERSION}.phar -o /usr/local/bin/wp; \
    chmod +x /usr/local/bin/wp;


RUN set -ex; \
    mkdir /var/www/wordpress; \
    chown www-data:www-data /var/www/wordpress;

WORKDIR /var/www/wordpress

ARG WP_VERSION=5.0.3

RUN set -ex; \
    gosu www-data wp core download --version=${WP_VERSION};

COPY docker /

RUN set -ex; \
    chmod +x /bin/docker-wp-entrypoint; \
    chown www-data:www-data /wp-config.php; \
    chmod 600 /wp-config.php; \
    mv /wp-config.php /var/www/wordpress/;

VOLUME /var/www/wordpress

EXPOSE 80

ENTRYPOINT ["/bin/docker-wp-entrypoint"]

CMD ["supervisord", "-c", "/etc/supervisor.conf"]
