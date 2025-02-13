Projet Solo "Stress Less" pour bloc Développement projet Web CESI

A partir de page 13 =>

Une documentation technique incluant :
o La modélisation physique de la base de données : MLD
o Un comparatif des solutions techniques envisagées avec critères de sélection et argumentation du choix final
o Un cahier de tests incluant des scenarios de tests complets pour les 2 modules obligatoires (comptes utilisateurs et informations) et un module facultatif au choix
o Une procédure de validation incluant un modèle de PV de recette

# Guide de démarrage du projet Symfony - StressLess

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :

- PHP (version 8.1 ou supérieure recommandée)
- Composer
- Symfony CLI (optionnel mais recommandé)
- Un serveur web (Apache, Nginx ou le serveur interne de Symfony)
- Une base de données (MySQL, PostgreSQL, SQLite...)

## Installation du projet

Cloner le projet :

```sh
git clone https://github.com/nowaklouis/StressLess.git
cd stress_less
```

Installer les dépendances :

```sh
composer install
```

Copier le fichier d'environnement et configurer la base de données :

```sh
cp .env .env.local
```

Modifier le fichier `.env.local` pour configurer l'URL de connexion à la base de données :

```
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_la_base"
```

## Initialisation de la base de données

Créer la base de données et exécuter les migrations :

```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

```sh
php bin/console doctrine:fixtures:load
```

## Démarrer le serveur Symfony

Démarrer le serveur de développement :

```sh
symfony server:start
```

Ou avec PHP :

```sh
php -S 127.0.0.1:8000 -t public
```

## Autres commandes utiles

Vider le cache :

```sh
php bin/console cache:clear
```

Mettre à jour les dépendances :

```sh
composer update
```

Lister les routes disponibles :

```sh
php bin/console debug:router
```

Vérifier la configuration :

```sh
php bin/console debug:config
```

## Tests et débogage

Exécuter les tests :

```sh
php bin/phpunit
```

Afficher les logs :

```sh
tail -f var/log/dev.log
```

## Déploiement

Si vous déployez sur un serveur, pensez à exécuter :

```sh
composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod --no-debug
```

---
