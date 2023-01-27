FROM php:8.0.13-fpm-alpine3.13 AS basic

ARG SERVICE_VERSION

ENV PROJECT_DIR /var/app
ENV PATH $PROJECT_DIR/bin:$PROJECT_DIR/vendor/bin:$PATH
ENV UID=$USER_ID
ENV GID=$GROUP_ID
ENV DD_VERSION=$SERVICE_VERSION

COPY --from=mlocati/php-extension-installer:1 /usr/bin/install-php-extensions /usr/local/bin/
RUN apk add git zip yaml-dev bash && \
    IPE_GD_WITHOUTAVIF=1 /usr/local/bin/install-php-extensions amqp-stable bcmath-stable zip-stable gd-stable pdo-stable pdo_pgsql-stable pdo_mysql-stable intl-stable yaml-stable && \
    mkdir /.composer  && \
    chown -R www-data:www-data /.composer && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer --2.2 && \
    curl -LO https://github.com/DataDog/dd-trace-php/releases/latest/download/datadog-setup.php && \
    php datadog-setup.php --php-bin=all --enable-appsec --enable-profiling && \
    rm -rf datadog-setup.php

# Locales
ENV MUSL_LOCALE_DEPS cmake make musl-dev gcc gettext-dev libintl
ENV MUSL_LOCPATH /usr/share/i18n/locales/musl

RUN apk add --no-cache \
    ${MUSL_LOCALE_DEPS} \
    && wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
    && unzip musl-locales-master.zip \
      && cd musl-locales-master \
      && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
      && cd .. && rm -r musl-locales-master

ENV PATH /var/app/bin:/var/app/vendor/bin:$PATH
WORKDIR /var/app

FROM basic as development
RUN apk add --no-cache git && \
    apk add --update linux-headers && \
    apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS && \
    pecl install xdebug 3 && \
    docker-php-ext-enable xdebug && \
    rm -rf /usr/share/php7 && \
    rm -rf /tmp/pear && \
    apk del .phpize_deps
RUN curl -LO https://github.com/DataDog/dd-trace-php/releases/latest/download/datadog-setup.php && \
        php datadog-setup.php --php-bin=all --enable-profiling