FROM php:8.2-apache

# Instalar extensões do PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Configurar o DocumentRoot do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Copiar o código do Laravel para o diretório do servidor web
COPY . /var/www/html/

# Ajustar as permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Habilitar o módulo rewrite do Apache
RUN a2enmod rewrite

EXPOSE 80
