FROM php:7.2-apache
COPY conf /etc/apache2

RUN a2enmode proxy proxy_http
RUN a2ensite 000-* 001-*
