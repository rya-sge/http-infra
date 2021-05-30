---
You develop a web app (e.g. with express.js) that administrators can use to monitor and update your web infrastructure.
You find a way to control your Docker environment (list containers, start/stop containers, etc.) from the web app. For instance, you use the Dockerode npm module (or another Docker client library, in any of the supported languages).
You have documented your configuration and your validation procedure in your report.
---

# README

## **Management UI**

Afin de mettre en place un management UI, nous avons décidé d'utiliser Portainer. (https://www.portainer.io/)

## **Utilisation**
Pour cela, rien de plus simple, effectuez les commandes suivantes
```
docker volume create portainer_data
docker run -d -p 8000:8000 -p 9000:9000 --name=portainer --restart=always -v /var/run/docker.sock:/var/run/docker.sock -v portainer_data:/data portainer/portainer-ce
```

Cela va créer un volume pour Portainer et vous permettre de vous connecter à l'UI sur les ports désignés. (ex: localhost:9000)
Vous devriez voir apparaître une interface comme ceci :
![](figures/portainer.png)



## Validation

Nous avons arrêter avec le bouton stop un des containers et nous avons ensuite vérifié qu'il était bien stoppé

## Sources

https://documentation.portainer.io/v2.0/deploy/ceinstalldocker/
