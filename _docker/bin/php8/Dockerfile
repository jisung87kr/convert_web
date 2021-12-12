FROM php:8.0.3-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        vim \
        zip \
        libfontconfig \
        zlib1g \
        libxrender1 \
        libxext6 \
        libx11-6 \
        fontconfig \
        xfonts-75dpi \
        xfonts-base \
        wget \
        git \
        imagemagick \
        libmagickwand-dev \
        libmagickcore-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli mysqli pdo pdo_mysql \
    && a2enmod rewrite

RUN git clone https://github.com/Imagick/imagick /usr/src/php/ext/imagick; \
    docker-php-ext-install imagick

RUN curl -sL "https://deb.nodesource.com/setup_14.x" | bash -
RUN apt-get install -y nodejs

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN composer global require laravel/installer

RUN cd /var/www/html
RUN wget 'https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb' -P /var/www/html
RUN dpkg -i 'wkhtmltox_0.12.6-1.buster_amd64.deb'

RUN curl -o nanumfont.zip http://cdn.naver.com/naver/NanumFont/fontfiles/NanumFont_TTF_ALL.zip
RUN unzip -d /usr/share/fonts/nanum nanumfont.zip
RUN fc-cache -f -v

ENV PATH $PATH:~/.composer/vendor/bin
