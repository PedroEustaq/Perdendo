FROM php:8.3-apache

# Extensoes necessarias para conectar ao PostgreSQL do Supabase.
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Copia somente o contexto permitido pelo .dockerignore.
COPY . /var/www/html/

# Script que reconstrui o banco de demonstracao uma vez antes do Apache iniciar.
COPY docker-start.sh /usr/local/bin/docker-start.sh
COPY apache-vhost.conf /etc/apache2/sites-available/000-default.conf
RUN chmod +x /usr/local/bin/docker-start.sh \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["/usr/local/bin/docker-start.sh"]
