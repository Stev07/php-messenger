# PHP Messenger
[Consigne](https://github.com/becodeorg/LIE-Hamilton-1.7/tree/master/02-La-colline/01-php-messenger)

Ce travail est réalisé par : 

1. Bénédicte Struvay
2. Marie Grosjean
3. Steve Dossin
4. Valentin Grégoire

> Ce travail est réalisé lors du cursus d'apprentissage de la formation BeCode à Liège et c'est donc un travail amateur.

### Bienvenue sur Ph-Essenger,
Notre application faite en PHP étant en fait plus un forum qu'un chat à proprement parler.

L'utilisateur peut s'incrire gratuitement au chat, et y créer un topic.
Une foi le topic créé, tout utilisateur peut poster un message dans ce topic, et ajouter des réactions aux messages.
 
Tous les fichiers de configuration pour la base de données en local se trouve dans le git, ainsi que les sources.

##### Architecture:
  - **Models** => Contient les modèles de classes
  - **Includes** => Fichiers à inclure dans les fichiers vues PHP
  - **Handlers** => Fichiers de gestion de réception de requête PHP
  - **Public** => Contient les fichiers publics de notre site tel que CSS, JS, et assets.
Et les vues sont à la racine.

##### Nous avons 4 vues:
  - **index.php** => Point d'entrée de notre site, permet le login ou le choix de s'inscrire.
  - **signin.php** => Faussement appelé *connexion en anglais*, c'est la page d'*inscription*.
  - **chat.php** => Coeur névralgique du chat.
  - **profil.php** => Gestion du profil de l'utilateur en cours.
Chaque vues à un gestionnaire qui s'occupe des requêtes (principalement des formulaires).

##### Nous avons 4 modèles:
  - **user.php** => Contient la classe qui correspond à la table *Users* dans la base de données.
  - **conversation.php** => Contient la classe qui correspond à la table *Conversations* dans la base de données.
  - **message.php** => Contient la classe qui correspond à la table *Messages* dans la base de données.
  - **reaction** => Contient la classe qui correspond à la table *Reactions* dans la base de données.
  
D'un point de vue mise en place, nous avons utiliser mysql5 comme Système de Gestion de Base de Données (SGBD) et php7.
>Vous trouverez un dump de la base de données, avec des exemples fictifs.
>Nous avons aussi utiliser un environnement docker pour le développement et nous vous fournissons notre fichier de configuration de docker pour vous aider à lancer l'environnement convenablement.
