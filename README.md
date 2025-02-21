# Gestion des Vacances - Symfony

Description

Cette application permet de gérer les périodes de vacances des employés. Les fonctionnalités incluent :
Création, modification et suppression des périodes de vacances.
Sélection des employés et saisie des dates de début et fin.
Calcul automatique des jours fériés inclus dans la période de vacances.


    
## Installation et Configuration

1. Prérequis

Avant d'installer l'application, assurez-vous d'avoir :

```bash
PHP 8.1 ou supérieur
Composer
Symfony CLI
PostgreSQL
```

2. Cloner le projet

```bash
git clone https://github.com/anthony-cochet/gestion-vacances.git
cd gestion-vacances
```

3. Installation des dépendances

```bash
composer install
```

4. Configuration de la base de données

```bash
DATABASE_URL="postgresql://postgres:password@127.0.0.1:5432/gestion_vacances?serverVersion=14&charset=utf8"
```

5. Création de la base de données et des migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

6. Chargement des fixtures

```bash
php bin/console doctrine:fixtures:load
```


## Exécution de l'application

1. Démarrer le serveur Symfony

```bash
symfony serve
```
Par défaut, l'application sera disponible sur http://127.0.0.1:8000


2. Accéder à l'application
```bash
Interface web : http://127.0.0.1:8000
Accéder à la liste des vacances : http://127.0.0.1:8000/vacances
```
