FROM php:8.2-fpm

ARG UNAME=admin
ARG UGROUP=admin

ARG UID=1000
ARG GID=1000

RUN useradd -ms /bin/bash $UNAME
RUN usermod -aG sudo $UNAME

RUN usermod  --uid $UID $UNAME
RUN groupmod --gid $GID $UGROUP

COPY php.ini /usr/local/etc/php/


RUN apt-get -o Acquire::Check-Valid-Until=false update \
    && apt-get update && apt-get install -y --no-install-recommends \
    software-properties-common \
    apt-utils \
    build-essential \
    wget \
    locales \
    locales-all \
    locales \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev g++ \
    curl \
    && pecl install xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

RUN docker-php-ext-install pdo_pgsql zip exif pcntl bcmath soap gettext intl \
    && docker-php-ext-configure intl \
    && docker-php-ext-enable xdebug

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

USER $UNAME

WORKDIR /var/www
