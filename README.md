# README

## **DockerFile**

Cette partie indique, dans l'ordre, ce que fait le dockerfile

1) Le dockerfile des différents images Apache met à jour le système et installe "vim"
2) Modification de l'index du site statique afin d'ajouter un script custom "student.js"
3) Le script student.js est exécuté au chargement de la page web. Il contient une fonction loadAnimals() qui exécute une fonction faisant une requête sur l'api afin de recevoir du json contenant les Animals (voir partie précédente). Toutes les deux secondes, on remplace le texte de la class CSS "skills" par un nouvel Animal provenant du json.
4) Ainsi, sur la page principale du site statique, on peut voir un nouvel Animal toutes les deux secondes sous la bannière principale




## Sources annexes:
https://api.jquery.com/jquery.getjson/
https://learn.jquery.com/using-jquery-core/selecting-elements/
