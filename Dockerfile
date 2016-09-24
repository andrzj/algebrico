FROM php:5-apache
ADD . /var/www/html
ADD 000-algebrico.conf /etc/apache2/sites-available/

RUN echo 'America/Sao_Paulo' | tee /etc/timezone \
 && dpkg-reconfigure -f noninteractive tzdata \

 && /usr/sbin/a2enmod rewrite headers \
 && /usr/sbin/a2dissite '*' \
 && /usr/sbin/a2ensite 000-algebrico \
 && service apache2 restart \

 && apt-get update \
 && apt-get -y install git curl zlib1g-dev \
 && docker-php-ext-install zip pdo pdo_mysql \
 && apt-get -y autoremove \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* \
 && /usr/bin/curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && cd /var/www/html \
 && /usr/local/bin/composer install \
 && /bin/chown www-data:www-data -R /var/www/html/storage /var/www/html/bootstrap/cache
