ARG PHP_VERSION=8.4
ARG TIMEZONE="Europe/Paris"

ARG OS_USERID=1000
ARG OS_USERNAME="vscode"

FROM php:${PHP_VERSION}-fpm-alpine

ARG TIMEZONE
ENV TZ=${TIMEZONE}


ARG OS_USERID
ARG OS_USERNAME

ARG WORKDIR

# PHP Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install main packages and remove default server definition
RUN apk add --no-cache \
  curl \
  wget \
  zip \
  bash \
  vim \
  git



RUN chmod uga+x /usr/local/bin/install-php-extensions && sync \
    && install-php-extensions \
            ctype \
            curl \
            dom \
            gd\
            iconv \
            intl \
            json \
            mbstring \
            pcre \
            simplexml \
            spl \
            xml \
            zip \
            openssl \
            soap \
            sodium \
            tokenizer \
            xmlrpc \
            mysqli \
            ldap \
            opcache \
            exif \

    &&  echo -e "\n opcache.enable=1 \n opcache.enable_cli=1 \n opcache.memory_consumption=128 \n opcache.interned_strings_buffer=8 \n opcache.max_accelerated_files=4000 \n opcache.revalidate_freq=60 \n opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    &&  echo -e "\n xdebug.mode=debug \n xdebug.remote_host=localhost \n xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    &&  echo -e "\n xhprof.output_dir='/var/tmp/xhprof'" >> /usr/local/etc/php/conf.d/docker-php-ext-xhprof.ini \
# Fix php.ini settings for enabled extensions
    && chmod +x "$(php -r 'echo ini_get("extension_dir");')"/* \
# Shrink binaries
    && (find /usr/local/bin -type f -print0 | xargs -n1 -0 strip --strip-all -p 2>/dev/null || true) \
    && (find /usr/local/lib -type f -print0 | xargs -n1 -0 strip --strip-all -p 2>/dev/null || true) \
    && (find /usr/local/sbin -type f -print0 | xargs -n1 -0 strip --strip-all -p 2>/dev/null || true) \
# Install msmtp - To Send Mails on Production & Development
    && apk add msmtp


# Create project root


RUN set -eux \
    && mkdir -p ${WORKDIR}/moodle ${WORKDIR}/vendor \
    && addgroup -g ${OS_USERID} -S ${OS_USERNAME} && adduser -u ${OS_USERID} -D ${OS_USERNAME} -G ${OS_USERNAME} -s /bin/sh \
    && chown -R ${OS_USERNAME}:${OS_USERNAME} ${WORKDIR}
USER ${OS_USERNAME}
WORKDIR ${WORKDIR}


EXPOSE 9000
CMD ["php-fpm"]