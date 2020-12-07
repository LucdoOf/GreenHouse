# GreenHouse

GreenHouse est un projet encadré de Polytech Tours permettant le gestion de maisons et d'appartements sur le plan écologique.

## Installation du projet


1) Le projet utilise des dépendances gérées avec composer, pour installer les dépendances lancer:
```
composer install
```

2) Afin de garantir une phase de développement simple et un déploiement propre, nous utilisons des fichiers de configurations, pour créer le votre, copier le fichier d'exemple `conf.inc.example.php` vers le fichier `conf.inc.php`. Il vous faudra renseigner vos identifiants SQL, ainsi que le chemin relatif de votre installation apache vers le dossier public (sans slash à la fin). 

> Par exemple si mon installation apache pointe vers `/var/www` et que mon projet est le dossier `/var/www/Polytech/GreenHouse`, je renseigne **`/Polytech/GreenHouse/public`**

3) Pour finir, si vous êtes sur un environnement linux, il est **nécessaire** de donner les droits à votre utilisateur Apache (généralement www-data) sur le dossier `data`. 

> Il est important de donner les droits **récursivement** sur le dossier data. Exemple: `sudo chown www-data:lucas data/ -R`
