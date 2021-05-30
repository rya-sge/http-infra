# README

Cette branche (master) ne contient qu'un README explicatif afin d'expliquer la manière dont nous avons procédé. En effet, chaque branche se base sur la branche précédente et rajoute une fonctionnalité, ainsi chaque branche reflète l'avancement dans le projet. Chaque nouvelle fonctionnalité est détaillée dans le README de la branche. Voici l'ordre des branches et l'étape à laquelle elles correspondent.

Etape n°

1. Branche fb-apache-static
2. Branche fb-express-dynamic
3. Branche fb-apache-reverse-proxy
4. Branche fb-ajax-query
5. Branche fb-dynamic-configuration

Maintenant, les étapes additionnelles dans l'ordre.

Etape additionnelle n°

1. Branche load-balancing-multiple-server-nodes 
2. Branche fb-load-balancer-sticky-session
3. Branche dynamic-cluster-management
4. Branche fb-management-ui

Dans les README, sauf indication contraire, il faut partir du principe qu'on exécute les mêmes containers et de la même manière qu'à l'étape précédente. Les README sont volontairement légers et vont à l'essentiel, cad la mise en place de la nouvelle fonction/du nouveau service.

Dans certains scripts, les IP sont entrées en dur lors des docker run. Veillez à bien corriger ces adresses si c'est nécessaire afin que le proxy puisse accéder aux services.

 Egalement, faites bien attention à vérifier l'ip que vous définissez dans /etc/hosts pour le site web. 
