# README

## **DockerFile**

Cette partie indique, dans l'ordre, ce que fait le dockerfile

1) Le dockerfile se base sur une image d'apache ayant également le support de php (php:7.2-apache)

2) Copie le contenu situé dans *conf* dans le dossier */etc/apache2* du conteneur

3) Active avec a2enmode les modules : *proxy* et *proxy_http*

- proxy fournit une passerelle pour le serveur HTTP Apache
- proxy_http fournit le support pour  des requêtes HTTP et HTTPS.

4) Active les sites 0001-* et 001-*





## Sources annexes:

https://httpd.apache.org/docs/2.4/fr/mod/mod_proxy_http.html