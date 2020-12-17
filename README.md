# Projet Symfony

Liste de commandes pour la collaboration.

## Ajouter une fonctionnalité au projet

### Démarrer une fonctionnalité
Pour chaque *fonctionnalité*, créer une branche depuis `master`:
```shell
git checkout master
git branch ma-fonctionalite
git checkout ma-fonctionalite
```

### Terminer une fonctionnalité
Après avoir enregistré quelques *commits*, si la fonctionnalité est terminée, fusionner la branche dans `master` en veillant à récupérer les *commits* qui aurait pu être ajoutés entre temps par les autres membres de l'équipe:
```shell
git checkout master
git pull
git merge ma-fonctionnalite
```

## Mettre à jour le projet
En récupérant le code des autres membres de l'équipe, certains composants de l'applications ont peut-être été ajoutés.

### Dépendances PHP
Installer les librairies, bundles, etc avec **Composer**:
```shell
composer install
```

### Dépendances JS
Installer les librairies **JS**/**CSS** avec **npm**:
```shell
npm install
```

### Assets Front-End
Si du code source **CSS** ou **JS** a été ajouté, il faut recompiler ce code avec **Webpack Encore**:
```shell
npm run dev
```

### Base de données
Si de nouvelles *migrations* ont été générées, elles doivent être exécutées pour mettre à jour la base:
```shell
php bin/console doctrine:migrations:migrate
```
Également, les *fixtures* peuvent être rechargées:
```shell
php bin/console doctrine:fixtures:load
```
