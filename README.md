# MicroBlog
Micro Blog dans le cadre de la licence professionnelle DIM ayant pour but de nous initier au langage PHP

# Accueil du blog
Pour aller à la page d'accueil ouvrez index.php dans un navigateur

# Fonctionnement du micro blog :

N'importe quel utilisateur peut visualiser les messages postés sur le micro blog.
Si il veut publier un message, il doit tout d'abord s'inscrire (s'il ne l'est pas) et/ou se connecter à celui-ci.

Toute personne inscrite sur le micro blog peut ajouter des messages comme elle le souhaite.
Toute personne inscrite sur le micro blog peut modifier et supprimer un message même si celui-ci n'a pas été publié par celle ci.

Un moteur de recherche est présent, mais n'est pas encore fonctionnel

# Structure de la base de données

La structure de la base de données et fournie dans le répertoire sql

# Deuxième partie : Utilisation du moteur de template Smarty

Un utilisateur peut recherche un mot dans les messages entrés grâce au moteur de recherche

Le message est prévisualisé

Bouton LIKE pour un message

# Problèmes non résolus:

Lors des liens sur les hastags, les urls ou les mails, ne fonctionnent pas quand il y a plusieurs "liens" dans un meme message.

La REGEX sur l'adresse des sites web fonctionne, mais obligé de commenter soit celle ci ou celle pour les emails pour tester le fonctionnement de l'une ou l'autre.

Le LIKE ne fonctionne pas : pas d'appel AJAX
