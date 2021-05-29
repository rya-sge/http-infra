---
You have a GitHub repo with everything needed to build the Docker image.
You can do a demo, where you build the image, run a container and access content from a browser.
You generate dynamic, random content and return a JSON payload to the client.
You cannot return the same content as the webcast (you cannot return a list of people).
You don't have to use express.js; if you want, you can use another JavaScript web framework or event another language.
You have documented your configuration in your report.
---



# README

## Description

Nous avons été mandaté par une agence de renseignement afin de créer un serveur node js qui renvoie une liste d'agents secrets.

-L'espèce dont il fait partie

-Une adresse correspondant à son lieu d'opération

-Un prime number afin de pouvoir l'identifier. Un agent portant un nombre de Carmichael est un agent-double.

-Un numéro de téléphone afin de pouvoir être contacté

-Une adresse IP pour surfer sur internet

Pour répondre aux besoins du clients, nous avons utilisés le package chance.

Lien : [https://github.com/chancejs/chancejs/blob/master/docs/thing/animal.md](https://github.com/chancejs/chancejs/blob/master/docs/thing/animal.md)



## Lancement du serveur
Afin de lancer le serveur, exécutez le script build-image.sh
![](assets/buildscript.png)

Puis run le container avec le script run-container.sh. Le container sera exécuté en arrière plan. 
![](assets/runscript.png)



Si vous souhaitez voir la payload dans le terminal, éditer le fichier et retire l'option -d de la commande run ou lancer la commande suivante :



## Avec l'ip du conteneur

Afin de connaitre le nom du container :
![](assets/dockerps.png)

Afin de connaitre l'adresse IP du container :
![](assets/getip.png)



Ensuite, se rendre sur un navigateur et entrer l'adresse ip du docker avec le port 3000 afin de recevoir une liste d'animaux sous format json.

Il ne reste plus qu'à accéder au site depuis votre navigateur en précisant ip:3000

![](assets/ipport.png)





## 
