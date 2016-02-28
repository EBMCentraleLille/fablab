# fablab
Site de gestion du FabLab de CentraleLille

## Installation

Install dependencies:

```
composer install
npm install -g bower
bower install
```

Bower will install bootstrap for layout.

## Load Data Fixtures
```
php app/console doctrine:fixtures:load
```

## Roles et control access

##### 4 rôles :
- Rôle de type normal (scope = tout le site) :
  - **ROLE_ADMIN** : Permet d'accéder à tout et d'effectuer toutes les actions
  - **ROLE_USER** : Permet de voir les projets (rôle par défaut lorsqu'on a possède un compte)
- Rôle de type projet (scope = projet) :
  - **ROLE_MEMBER** : Permet d'accéder aux pages privées du projet (rôle par défaut lorsqu'on est membre du projet)
  - **ROLE_SUPER_MEMBER** : Permet d'effectuer des actions supplémentaires dans les pages privées du projet

##### Liste de l'ensemble des utilisateurs, leurs projets et leurs rôles
URL : /users/customfosuser

##### Restreindre l'accès des pages privées du projet aux membres
Il suffit d'ajouter deux lignes de code dans la fonction
Ex : group/Project1/edit

```
/**
     * @Route("/group/{groupName}")
     */
public function editAction($groupName)
{
    $group = $this->findGroupBy('name', $groupName); // query for the post

    $this->denyAccessUnlessGranted('member', $group);

    ...
}
```

##### Ajouter un contrôle supplémentaire pour le ROLE_SUPER_MEMBER
Il suffit d'ajouter dans le template la ligne suivante :

```
{% if is_granted('ROLE_SUPER_MEMBER') %}
    <p>This part is visible only by the SUPER_MEMBER</p>
{% endif %}
```