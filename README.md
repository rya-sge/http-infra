# Lancer un serveur httpd dans Docker

Cet article présente la création d'un dockerfile permettant de construire un conteneur exécutant un serveur httpd.

## Arborescence

- Le Dockerfile se trouve à la racine de arborescence
- Le Contenu du site, qui sera à copier dans le dossier /var/ww/html/ dans le Dockerfile se trouve dans le dossier contenu. Il contient égamenet le template boostrap

![10-liting-arborescence](assets\18-lab-arborescence.JPG)



## 1) Bootstrap

On télécharge et on met les fichiers du template bootstrap dans le dossier contenu.

Les fichiers peuvent être téléchargés au lien suivant : 

https://startbootstrap.com/template/bare

## 2) Contenu du Dockerfile

Contenu du Dockerfile

```
FROM php:7.2-apache
COPY contenu/ /var/www/html/
```



## 3) Lancement conteneur(build, run, etc.)

1) Construire le conteneur à partir de l'image

```
sudo docker build -t exemple/apache_php .
```

![11-build-image](assets\11-build-image.JPG)

2) Lancer le conteneur en arrière plan.

Pour rediriger, le port 80  du conteneur sur lequel écoute le serveur sera redirigé sur le port 9090 de la machine hôte (localhost)

```
sudo docker run -p 9090:80 exemple/apache_php


```

![17-lab-run](assets\17-lab-run.JPG)

3) Obtenir le nom de l'image : sudo docker ps

![16-lab-ps](assets\16-lab-ps.JPG)

4) Obtenir l'IP du conteneur

sudo docker inspect  admiring_leavitt | grep IPAddress

![15-labo-ip-grep](assets\15-labo-ip-grep.JPG)

L'ip permet d'accéder au serveur httpd depuis la machine hôte grâce à un navigateur.

5) Vérifier le résultat![14-affichage-site-template](assets\14-affichage-site-template.JPG)