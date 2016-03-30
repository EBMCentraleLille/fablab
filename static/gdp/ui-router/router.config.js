var routerModule = require('./_index');
var origin = document.location.origin+'/gdp/';

routerModule.config(setupRouter);

function setupRouter($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('tasks', {
            url: "/tasks",
            templateUrl: origin+"views/tasks/tasks.html",
            controller: 'taskController',
            data: { access: 'user' }
        })
        .state('planning', {
            url: "/planning",
            templateUrl: origin+"views/planning/planning.html",
            controller: 'planningController',
            data: { access: 'user' }
        })

    $urlRouterProvider.otherwise("/tasks");
}