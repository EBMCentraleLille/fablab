var uiModule = require('../_index');

 uiModule.directive('taskView',getTaskView);

 function getTaskView() {
    return {
        restrict: 'E',
        templateUrl: 'views/tasks/tasks-summary.html'
    }
 };

