var routerModule = require('./_index');

routerModule.config(setupRouter);

function setupRouter($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('main', {
            url: "/",
            templateUrl: "views/main.html",
            controller: 'uiController',
            data: { access: 'user' }
        })
        .state('tasks', {
            url: "/tasks",
            templateUrl: "views/tasks/tasks.html",
            controller: 'taskController',
            data: { access: 'user' }
        })
        .state('planning', {
            url: "/planning",
            templateUrl: "views/planning/planning.html",
            controller: 'planningController',
            data: { access: 'user' }
        })

    $urlRouterProvider.otherwise("/");
}