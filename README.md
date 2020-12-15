# GreenHouse

GreenHouse est un projet encadré de Polytech Tours permettant le gestion de maisons et d'appartements sur le plan écologique.

## Installation du projet

1) Le projet utilise des dépendances gérées avec composer, pour installer les dépendances lancer:
```
composer install
```

2) Afin de garantir une phase de développement simple et un déploiement propre,
nous utilisons des fichiers de configurations, pour créer le votre, copier le fichier d'exemple `conf.inc.example.php` 
vers le fichier `conf.inc.php`. Il vous faudra renseigner vos identifiants SQL, le domaine que vous utiliserez pour l'application (https://localhost en développement) ainsi que le chemin relatif de votre installation apache (depuis le domaine renseigné) vers le dossier public (sans slash à la fin). 

> Par exemple si mon installation apache pointe vers `/var/www` et que mon projet est le dossier `/var/www/Polytech/GreenHouse`, je renseigne **`/Polytech/GreenHouse/public`**

3) Pour finir, si vous êtes sur un environnement linux, il est **nécessaire** de donner les droits à votre utilisateur Apache (généralement www-data) sur le dossier `data`. 

> Il est important de donner les droits **récursivement** sur le dossier data. Exemple: `sudo chown www-data:lucas data/ -R`. N.B.: Si après le premier affichage du site non fructueux, le fichier 'mois/jour.txt' n'est pas créé, exécuter à nouveau la commande.

## Utilisation et développement

La phase de développement pour tous les membres du groupe s'effectue sur l'IDE Jetbrains PHPStorm, nous utilisons MYSQL
comme SGBD avec PhpMyAdmin.

### Front

1) Nous utilisons Font Awesome (https://fontawesome.com/start) pour intégrer des icônes. Pour insérer une icône, 
il suffit d'écrire un tag <i> avec la classe correspondant à l'icône voulue (trouvée sur le site de Font Awesome)

> Exemple <i class="fas fa-vials"></i> correspond à une éprouvette

2) Les fichiers de style inclus dans le projet sont générés par minification et compilation de fichier SCSS. 
Par soucis de temps, nous nous contenterons d'une architecture SCSS simples en n'utilisant que très peut de fonctionnalités
de la technologie (principalement l'imbrication des règles, l'utilisation de @extend...)

### Back

Le projet est structuré en *MVCR*. Toutes les sources sont sous src/, les vues sous views/, les modèles sous 
src/Models/ et les controlleurs sous src/Controllers. Le projet respecte les normes de nommage PSR-4.
La communication avec la BDD s'exécute avec PDO et quasi-exclusivement avec les classes enfantes de `Model` 
(qui utilise elle-même la classe `SQL` pour fonctionner correctement). 

#### Modèles

Tous les modèles sont représentés par une classe enfante de la classe `Model`.
Chaque modèle possède un identifiant unique représenté par la colonne id.

Pour définir un modèle, il nous suffit de renseigner la table correspondante dans la constante `STORAGE`, puis,
de déclarer la liste de ses attributs dans la constante `COLUMNS`. Cette constante est un tableau associatif prenant 
en clés les noms des attributs et en valeurs des booléens correspondants à la présence de valeurs par défaut dans la table pour 
la colonne renseignée en clé. 
Pour finir, il faut déclarer les attributs (autres qu’id) en tant que variables de l'objet.

> Nous travaillons en PHP moderne (7.3 - 7.4) il est donc préférable avec les nouvelles normes de travailler avec des 
> attributs déclarés avec public/protected/private plutôt qu'avec le mot clé var.

#### Controlleurs

// TODO

#### Vues

Les vues sont des fichiers php possédant la pré-extension `.htm` afin de les différencier des fichiers php standards.
Lorsque des paramètres peuvent être passés à une vue, nous le renseignons à l'aide de documentation PHPDoc dans 
l'en tête PHP du fichier.

Il existe deux types de vues, les vues standards et les layouts. Les layouts sont rangés dans `views/layouts`. 
Les layouts agissent en tant que conteneurs pour les vues, une vue sera *toujours* rendue dans un layout. Pour cela
on fournit aux layouts le paramètre `$content`.

#### Routeur

// TODO
