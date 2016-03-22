var uiModule = require('../_index');

uiModule.directive('createTask',createTask);

function createTask() {
    return {
        restrict: 'E',
        templateUrl: 'views/tasks/create-task.html'
    }
};

