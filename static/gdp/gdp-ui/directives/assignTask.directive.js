var uiModule = require('../_index');

uiModule.directive('assignTask',assignTask);

function assignTask() {
    return {
        restrict: 'E',
        templateUrl: 'views/tasks/assign-task.html'
    }
};

