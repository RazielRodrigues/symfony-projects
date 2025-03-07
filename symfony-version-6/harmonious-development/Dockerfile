# Use a imagem oficial do PHP com Apache
FROM php:8.3-apache

# Atualize o sistema e instale as dependências necessárias
RUN apt-get update && \
    apt-get install -y \
        libicu-dev \
        zlib1g-dev \
        libzip-dev \
        unzip \
        git

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install intl pdo pdo_mysql zip

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale o Symfony cli
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Habilitar o módulo do Apache para o mod_rewrite
RUN a2enmod rewrite

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie o arquivo de configuração do Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Exponha a porta 80
EXPOSE 80

# Inicialize o Apache quando o contêiner for iniciado
CMD ["apache2-foreground"]
