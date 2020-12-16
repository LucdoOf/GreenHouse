# GreenHouse

GreenHouse est un projet encadré de Polytech Tours permettant la gestion de maisons et d'appartements sur le plan écologique.

## Installation du projet

1) À la demande du corps enseignant, **le projet n'utilise aucune librairie**. Nous avons recréé entièrement certaines 
librairies afin de nous prêter à l'exercice. Ainsi, nous n'utiliserons pas composer.

2) Afin de garantir une phase de développement simple et un déploiement propre,
nous utilisons des fichiers de configurations, pour créer le vôtre, copier le fichier d'exemple `conf.inc.example.php` 
vers le fichier `conf.inc.php`. Il vous faudra renseigner vos identifiants SQL, le domaine que vous utiliserez pour l'application (https://localhost en développement) ainsi que le chemin relatif de votre installation apache (depuis le domaine renseigné) vers le dossier public (sans slash à la fin). 

> Par exemple si mon installation apache pointe vers `/var/www` et que mon projet est le dossier `/var/www/Polytech/GreenHouse`, je renseigne **`/Polytech/GreenHouse/public`**

3) Pour finir, si vous êtes sur un environnement linux, il est **nécessaire** de donner les droits à votre utilisateur Apache (généralement www-data) sur le dossier `data`. 

> Il est important de donner les droits **récursivement** sur le dossier data. Exemple: `sudo chown www-data:lucas data/ -R`. N.B.: Si après le premier affichage du site non fructueux, le fichier 'mois/jour.txt' n'est pas créé, exécuter à nouveau la commande.

## Utilisation et développement

La phase de développement pour tous les membres du groupe s'effectue sur l'IDE Jetbrains PHPStorm, nous utilisons MYSQL
comme SGBD avec PhpMyAdmin.

### Front

1) Nous utilisons Font Awesome (https://fontawesome.com/start) pour intégrer des icônes. Pour insérer une icône, 
il suffit d'écrire un tag `<i>` avec la classe correspondant à l'icône voulue (trouvée sur le site de Font Awesome)

> Exemple <i class="fas fa-vials"></i> correspond à une éprouvette

2) Les fichiers de style inclus dans le projet sont générés par minification et compilation de fichier SCSS. 
Par soucis de temps, nous nous contenterons d'une architecture SCSS simples en n'utilisant que très peu de fonctionnalités
de la technologie (principalement l'imbrication des règles, l'utilisation de @extend...)

3) Nous utilisons en partie **Bootstrap** (uniquement la grille) pour gérer le positionnement des éléments du projet,
son utilisation est minime sur le projet, on se sert seulement des classes `row` et des classes `col-[1-12]`. 
Bootstrap découpe les éléments en 12 colonnes de tailles égales et permet de paramétrer la taille des enfants en fonction. 
Un élément positionné en `col-12` dans un élément `row` prendra la totalité de la place du parent. Un élément en
`col-6` prendra la moitié de la place du parent, en `col-2` 2/12 de la place du parent...

### Back

Le projet est structuré en **MVCR**. Toutes les sources sont sous src/, les vues sous views/, les modèles sous 
src/Models/ et les contrôleurs sous src/Controllers. Le projet respecte les normes de nommage PSR-4.
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

#### Vues

Les vues sont des fichiers php possédant la pré-extension `.htm` afin de les différencier des fichiers php standards.
Lorsque des paramètres peuvent être passés à une vue, nous le renseignons à l'aide de documentation PHPDoc dans 
l'en tête PHP du fichier.

Il existe deux types de vues, les vues standards et les layouts. Les layouts sont rangés dans `views/layouts`. 
Les layouts agissent en tant que conteneurs pour les vues, une vue sera **toujours** rendue dans un layout. Pour cela
on fournit aux layouts le paramètre `$content`.

> Par exemple, dans un `layout` on trouvera la balise `<head>` et le contenu HTML présent sur plusieurs pages (un footer, un header...)

#### Contrôleurs

Les contrôleurs permettent d'effectuer différentes actions en fonctions de paramètres donnés.
Tous les contrôleurs sont représentés par une classe enfant de `Controller`. Les fonctions déclarées dans les classes
contrôleurs peuvent servir de fonctions appelées dans le Router, leurs paramètres sont des paramètres données en 
fonction du routeur. L'exemple le plus courant correspond au cas où on appelle une URL dépendant d'un objet.
Par exemple `/objet/[id]/update`, on pourrait passer `[id]` comme paramètre d'une fonction d'un contrôleur. 
Pour plus de détails sur le passage de paramètres et sur les routes, voir la section Routeur.

Les contrôleurs peuvent accéder à l'utilisateur connecté avec leur attribut `$user` (null si déconnecté). 
La constante `REQUIRE_AUTH` doit être mise à `true` si les fonctionnalités du contrôleur ne sont pas accessibles si 
déconnecté (généralement tout les `REQUIRE_AUTH` sont à `true` sauf sur le contrôleur de connection). Lorsque `REQUIRE_AUTH`
est à `true` et que l'utilisateur est déconnecté (et que la requête n'est pas asynchrone), il sera redirigé vers la page
de connection avec une redirection sur la page souhaité lorsque la connection aura aboutie. 

> Pour distinguer une requête asynchrone, l'attribut `$async` est mis à `true` lorsque le contrôleur a été appelé via un appel ajax du projet. 

Les deux méthodes principales des contrôleurs sont `redirect($url, $status = 302)` et `render($view, $vars = [])`.
La méthode `redirect` effectue une redirection simple, et la méthode `render` permet de rendre une vue avec une
liste de variables données. Le fichier de la vue inclue est le fichier dans `views/` portant le nom `$view.htm.php`. 

La vue sera rendue en passant par le layout du contrôleur. Le contenu de la vue correspond à la variable `$content` passée au layout.
Pour changer le layout par défaut, il faut modifier la variable `$layout` du contrôleur, le layout par défaut est `master`, ainsi 
lors de l'appel de `render`, si le layout n'a pas été changé, le layout `master` sera rendu avec comme contenu le contenu de la vue 
passée en paramètre.

Les variables passées en paramètres de `render` seront disponibles dans la vue correspondante. 
Par exemple en appelant `render('example', ['var' => 2])`, la variable `$var` de valeur `2` sera disponible dans ma vue `example`.

> Les contrôleurs disposent des méthodes `error_40[1-5]` permettant de lever des erreurs

#### Routeur

Le routeur est la clé de voute d'un projet **MVCR** moderne. Il permet d'appeler les différentes fonctions des contrôleurs en 
fonction de l'appel HTTP courant. 

Nous avons implanté un système de routes basées sur des `regex`.

Les routes sont définies dans le fichier 'src/routes.php' sous forme d'un tableau associatif. Voici un exemple d'un fichier
de route correct:

```php
<?php

use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\LoginController;

return [
    '/'         => ["GET", "/", [LoginController::class, "login"]],
    'houses'    => ["GET", "/houses", [HousesController::class, "listHouses"]]
];
```

Ici on a deux routes d'identifiants internes `/` et `houses` (cet identifiant n'est utilisé qu'en interne pour obtenir 
l'URL de ces routes, voir note plus bas). Ces deux routes sont définies comme accessibles avec la méthode HTTP `GET`. 
L'élément du tableau suivant défini l'URL via laquelle cette route est accessible et enfin le dernier élément défini le
contrôleur et la méthode à appeler. 

> Les URL des routes sont récupérables via la fonction route($routeId, $vars = [])

L'utilité principale de notre implémentation basée sur les `regex` est la possibilité de passer des paramètres aux routes,
par exemple la route définie par l'URL `/houses/(.+)` passera le contenu des parenthèses en paramètre de la méthode du
contrôleur appelé. Lorsqu'une route prend un paramètre on peut retrouver l'URL de la route pour un paramètre donné en le précisant dans le paramètre `$vars` de la méthode `route`.

> Dans l'exemple ci-dessus, pour récupérer l'URL /houses/4 (et en supposant que l'identifiant de la route est `house`), il faut appeler
> `route('house', [4])`, s’il y avait eu plusieurs paramètres il suffit de remplir le tableau passé en deuxième paramètre de la fonction
> `route` en fonction.

Pour finir, notre implémentation de routes avec un système de `regex` permet de paramétrer strictement des routes.
Par exemple, si on souhaite avoir uniquement un nombre dans l'URL ci-dessus, il faudrait renseigner dans le fichier routes: 
`/houses/([0-9]+)`, appeler `/houses/test` provoquera une 404, alors que `/houses/2` appellera correctement la méthode du 
contrôleur.
