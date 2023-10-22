FROM php:7.3.5-fpm-alpine3.9

# Install dev dependencies
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    imagemagick-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    sqlite-dev

# Install production dependencies
RUN apk add --no-cache \
    bash \
    curl \
    g++ \
    gcc \
    git \
    imagemagick \
    libc-dev \
    freetype libpng libjpeg-turbo freetype-dev libwebp-dev libjpeg-turbo-dev libpng-dev libxpm-dev \
    make \
    openssh-client \
    postgresql-libs \
    zlib-dev \
    libzip-dev

# Install PECL and PEAR extensions
RUN pecl install \
    imagick

# Install and enable php extensions
RUN docker-php-ext-enable \
    imagick
RUN docker-php-ext-configure zip --with-libzip
RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ --with-zlib-dir --with-xpm-dir --with-freetype-dir=/usr/include/
RUN docker-php-ext-install \
    curl \
    iconv \
    mbstring \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pcntl \
    tokenizer \
    xml \
    gd \
    zip \
    bcmath \
    opcache

RUN apk add --no-cache libmemcached-dev

RUN pecl install memcached

RUN docker-php-ext-enable memcached

# Cleanup dev dependencies
RUN apk del -f .build-deps
RUN apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Setup working directory
WORKDIR /var/www/app
