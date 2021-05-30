---
You develop a solution, where the server nodes (static and dynamic) can appear or disappear at any time.
You show that the load balancer is dynamically updated to reflect the state of the cluster.
---



# README
Afin de mettre en place cette étape, nous avons ajouté dans le fichier config-template.php les lignes suivantes

```
<Location "/balancer-manager/">
    SetHandler balancer-manager
</Location>

ProxyPass '/balancer-manager/' !
```
Il devient alors possible d'avoir une inteface pour visualiser la configuration. Pour cela, il suffit de se connecter depuis le navigateur à cette adresse :
incroyable.ch/balancer-manager
![](assets/)
Et de voir les différentes caractéristiques lorsque des connexions sont effectuées sur les services.
![](assets/)
