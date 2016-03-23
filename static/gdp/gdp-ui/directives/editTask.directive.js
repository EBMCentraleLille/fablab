var uiModule = require('../_index');

uiModule.directive('editTask',editTask);

function editTask() {
    return {
        restrict: 'E',
        templateUrl: 'views/tasks/edit-task.html'
    }
};

