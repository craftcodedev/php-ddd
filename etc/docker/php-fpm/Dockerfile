FROM php:8.0-fpm

# Set timezone
RUN rm /etc/localtime && \
    ln -s /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    date

# PHP deps
RUN apt-get update -qq && \
    apt-get install -y -qq --no-install-recommends \
    git \
    wget \
    libxml2-dev \
    libzip-dev \
    unzip \
    && \
    rm -Rf /var/lib/apt/lists/* && \
    # Type docker-php-ext-install to see available extensions
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    soap \
    zip \
    bcmath \
    sockets

#RUN git config --global user.email "hello@craft-code.com"
#RUN git config --global user.name "Craft Code"
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/app

#Create symfony project
#RUN symfony new /var/www/app --version=4.* --no-git

