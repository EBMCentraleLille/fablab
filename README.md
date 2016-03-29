# fablab
Site de gestion du FabLab de CentraleLille

## Installation

Install dependencies:

```
composer install
npm install -g bower
bower install
```

Install ElasticSearch :

Downdload & dezip V1.7.5 => https://www.elastic.co/downloads/past-releases/elasticsearch-1-7-5
Launch Elasticsearch


Bower will install bootstrap for layout.

## Dev

###Integration

Local server at : http://172.31.4.227

It actualizes from GitHub once every day.


###Tests

Scripts tests.bat or tests.sh

We use the PSR-2 PHP Standard, you can test locally with this command :

```
./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/
```
Use the code fixer with ```phpcbf``` instead of ```phpcs```

```
./vendor/squizlabs/php_codesniffer/scripts/phpcbf --standard=PSR2 src/
```

For windows :

```
php ./vendor/squizlabs/php_codesniffer/scripts/phpcs --standard=PSR2 src/ --no-patch
```

## Configure database and load Data Fixtures
```
php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load
```

## Roles et control access

##### 4 rôles :
- Rôle de type normal (scope = tout le site) :
  - **ROLE_ADMIN** : Permet d'accéder à tout et d'effectuer toutes les actions
  - **ROLE_USER** : Permet de voir les projets (rôle par défaut lorsqu'on possède un compte)
- Rôle de type projet (scope = projet) :
  - **PROJECT_MEMBER** : Permet d'accéder aux parties privées de la page projet (rôle par défaut lorsqu'on est membre du projet)
  - **PROJECT_LEADER** : Permet d'effectuer des actions supplémentaires dans les pages privées du projet

##### Liste de l'ensemble des utilisateurs, leurs projets et leurs rôles
URL : /users

##### Restreindre l'accès des pages privées du projet aux membres

Il suffit d'ajouter deux lignes de code du controlleur
Ex : ProjectController

```
    /**
     * @Route("/edit/{projectId}", name="project_edit")
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($projectId)
    {
        ...

        /**
         * Control access for members only
         */
        $this->denyAccessUnlessGranted(ProjectRole::PROJECT_ROLE_MEMBER, $project);

        return $this->render(
            'CustomFosUserBundle:Project:show.html.twig',
            array(
                'project' => $project,
                'currentUser' => $currentUser
            )
        );
    }
```

##### Ajouter un contrôle supplémentaire dans les pages twig pour le PROJECT_LEADER
Il suffit d'ajouter dans le template la ligne suivante:

```
{% if project_service.isAllowedLeader(currentUser, project) %}
    <p>This part is visible only by the PROJECT_LEADER</p>
{% endif %}
```
