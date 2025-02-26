FROM php:8.4-fpm

USER root

RUN apt-get update && apt-get install -y \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN if ! command -v composer >/dev/null 2>&1; then \
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    fi

RUN if ! command -v node >/dev/null 2>&1; then \
        curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
        apt-get install -y nodejs; \
    fi

