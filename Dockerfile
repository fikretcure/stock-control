FROM php:8.4-fpm

USER root

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpq-dev \
    libxml2-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    g++ \
    libicu-dev \
    libzip-dev \
    bash \
    supervisor \
    && docker-php-ext-install pdo pdo_pgsql sockets \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pcntl

RUN pecl install swoole

RUN echo "extension=swoole.so" > /usr/local/etc/php/conf.d/20-swoole.ini


RUN if ! command -v composer >/dev/null 2>&1; then \
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    fi

RUN if ! command -v node >/dev/null 2>&1; then \
        curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
        apt-get install -y nodejs; \
    fi


