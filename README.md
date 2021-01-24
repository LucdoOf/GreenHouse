# GreenHouse

GreenHouse est un projet encadré de Polytech Tours permettant la gestion de maisons et d'appartements sur le plan écologique.

## Membres du projet

Garofalo Lucas - Tardieu Eliott - Le Floch Arthur - Lecoeur Louis

## Version "staging"

Pour donner un exemple d'utilisation *correcte* du site, nous avons mis à votre disposition une version en ligne du
projet hébergée par nos soins, évitez de toucher aux données de cette version, elle n'est là qu'a titre de démonstration.
Vous pouvez y accéder sur l'URL: https://greenhouse.agile-web.dev. 

> Pour vous connecter, utilisez les identifiants *lucas.garofalo@agile-web.dev* / *letmein*

## Installation du projet

1) À la demande du corps enseignant, **le projet n'utilise aucune librairie**. Nous avons recréé entièrement certaines 
librairies afin de nous prêter à l'exercice. Ainsi, nous n'utiliserons pas composer et les seules technologies utilisées 
sont PHP, SCSS et CSS ainsi que Javascript. Nous avons utilisé des outils de versionnage tels que Git pour nous permettre
d'organiser le travail ainsi que la mise en production du site.

2) Afin de garantir une phase de développement simple et un déploiement propre,
nous utilisons des fichiers de configurations, pour créer le vôtre, copier le fichier d'exemple `conf.inc.example.php` 
vers le fichier `conf.inc.php`. Il vous faudra renseigner vos identifiants SQL, le domaine que vous utiliserez pour l'application (https://localhost en développement) ainsi que le chemin relatif de votre installation apache (depuis le domaine renseigné) vers le dossier public (sans slash à la fin). 

> Par exemple si mon installation apache pointe vers `/var/www` et que mon projet est le dossier `/var/www/Polytech/GreenHouse`, je renseigne **`/Polytech/GreenHouse/public`**

3) Pour finir, si vous êtes sur un environnement linux, il est **nécessaire** de donner les droits à votre utilisateur Apache (généralement www-data) sur le dossier `data`. 

> Il est important de donner les droits **récursivement** sur le dossier data. Exemple: `sudo chown www-data:lucas data/ -R`. N.B.: Si après le premier affichage du site non fructueux, le fichier 'mois/jour.log' n'est pas créé, exécuter à nouveau la commande.

## Utilisation et développement

La phase de développement pour tous les membres du groupe s'effectue sur l'IDE Jetbrains PHPStorm, nous utilisons MYSQL
comme SGBD avec PhpMyAdmin.

### Front

1) Nous utilisons Font Awesome (https://fontawesome.com/start) pour intégrer des icônes. Pour insérer une icône, 
il suffit d'écrire un tag `<i>` avec la classe correspondant à l'icône voulue (trouvée sur le site de Font Awesome)

> Exemple \<i class="fas fa-vials">\</i>` correspond à une éprouvette

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
use GreenHouse\Controllers\AuthController;

return [
    '/'         => ["GET", "/", [AuthController::class, "login"]],
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

#### Capture d'écran de la base de donnée sous notre SGBDR (phpmyadmin)

![Image SGBDR](https://imgur.com/x4Mbi78.png)

Ici il y a le détail de toutes les tables, et nous sommes fier de notre travail global, voilà pourquoi nous n'avons pas ajouté de photo de quelques tables particulières.

## Exemple de création de page

Pour développer notre site web nous nous sommes tournés vers un site web structuré en MVC (Modèle Vue Contrôleur) afin de faciliter son développement et permettant de créer un site de manière efficace sans avoir à se compliquer la vie pour implémenter des pages.

Comme son nom l'indique, l'architecture MVC possède trois éléments.
Tout d’abord le modèle qui va nous permettre de récupérer les données de notre base de données pour les incorporer dans notre site.
La vue quant à elle va être l’interface directe entre l’utilisateur et le site, c’est ce qui sera visible.
Et enfin, le contrôleur sert de passerelle entre le modèle et la vue. C'est lui qui organise la manière dont sont affichées les vues mais aussi quelles données doivent être importées ou exportées vers le modèle.
Dans notre site, nous avons également utilisé des “routes” qui permettent de gérer au mieux les URL du site.

Exemple d’une page affichant la liste des maisons sur le site :

![Image page web](https://imgur.com/yaMsy5h.png)

Pour pouvoir intégrer cette liste dans notre site il nous faut donc 3 fichiers différents pour correspondre avec l’architecture MVC. Tout d’abord nous voulons pouvoir récupérer les données présentes dans la table maison en créant le modèle:

```php
class House extends Model {

    const STORAGE = "houses";
    const COLUMNS = [
        "id" => true,
        "zipcode" => false,
        "number" => false,
        "isolation_degree" => false,
        "name" => false,
        "eco_level" => false,
        "street" => false,
        "city_id" => false
    ];

    public $zipcode;
    public $number;
    public $isolation_degree;
    public $name;
    public $eco_level;
    public $street;
    public $city_id;

}
```

Nous renseignons les colonnes, si elles ont des valeurs par défaut ainsi que le nom de la table. (Pour plus d'informations, voir [Modèles](#Modèles).

Nous créons ensuite un contrôleur qui va importer ce modèle et ainsi va nous permettre d’utiliser ces mêmes données mais qui va de plus nous permettre d’afficher la vue correspondante à la liste des maisons. 

```php
class HousesController extends FrontController {

    public function listHouses() {
        $this->render("houses/list", ["houses" => Auth::getInstance()->user->getHouses()]);
    }

}
```

La fonction `listHouses` correspondra ici à la méthode appelée lorsqu'on souhaite afficher la liste des maisons, la méthode
`render` permet de rendre une vue avec les paramètres donnés.

Il ne reste plus qu’à créer la vue affichant la liste, cette vue sera différente selon les données précédemment envoyées en paramètre par le contrôleur
Pour un type de données un fichier pour le modèle et un fichier contrôleur suffisent. Alors qu’une vue correspond en réalité à une fonctionnalité et pas
seulement à une page, sur l’exemple précédent on peut remarquer un bandeau supérieur avec les différentes catégories du site qui représente une vue avec plusieurs redirections. Et la liste des maisons équivaut à une autre vue. 

```php
<?php
/** @var House[] $houses */

use GreenHouse\Models\House;
?>

<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($houses) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Degré d'isolation</th>
                        <th>Classement écologique</th>
                        <th><a class="button" href="<?= route('house.create.page') ?>" ><i class="fas fa-plus r"></i>Ajouter une maison</a></th>
                    </tr>
                    <?php foreach ($houses as $house): ?>
                        <tr>
                            <td><?= $house->id; ?></td>
                            <td><?= $house->name; ?></td>
                            <td><?= $house->number;  ?> <?= $house->street;?></td>
                            <td><?= $house->isolation_degree; ?></td>
                            <td><?= $house->eco_level; ?></td>
                            <td><a class="button" href="<?= route('house', [$house->id]) ?>"><i class="far fa-eye r"></i>Détails</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
```

En organisant de cette manière le site avec les vues, il est alors plus simple de rendre notre site flexible pour pouvoir réutiliser des fonctionnalités sans avoir à les coder une nouvelle fois dans leurs intégralités.
De la même manière pour gérer les URL du site un seul fichier de routage permet d’organiser toutes les redirections en un seul et même endroit, ainsi, il est plus simple de réutiliser un lien menant vers une page intrinsèque, la route
créée dans cet exemple sera:

```php
'houses' => ["GET", "/houses", [HousesController::class, "listHouses"]]
```

## Résumé de ce que ce projet nous a apporté personnellement

**Lucas Garofalo :** 
J'avais déjà travaillé sur des projets similaires de mêmes / plus grandes échelles mais en équipes de 2 ou beaucoup plus. Le format 4 personnes m'a permis d'apprendre à mieux travailler en équipe de taille moyenne.

**Eliott Tardieu :**
Avec l'aide de Lucas, ce projet m'a permis de remettre les pieds dans le php, alors que le dernier projet réalisé (avec Lucas également) 
en développement web remontait à il y a un an. Ainsi, j'ai repris les habitudes du php, du html, du (s)css, et d'un peu de js. 
C'était bien, malgré les problèmes d'organisation liés aux conditions actuelles. Pour moi ce projet a été très bénéfique, mais je pense 
qu'il fallait des bases dans le développement web pour pouvoir en profiter au maximum, chose que certains n'ont probablement pas. 
Dans l'ensemble, j'ai apprécié ce projet.

**Arthur Le Floch :**
Le projet est correct il y a pas mal de liberté pour pouvoir l’exécuter, mais il manque quand même cruellement d'une ligne directrice sur les attentes du site.

**Louis lecoeur :**
Bon ressenti global, avec l'aide de Lucas nous avons pu apprendre une architecture et des technologies interessantes dans un cadre presque profesionnel. 

