var uiModule = require('../_index');
var origin = document.location.origin+'/gdp/';


uiModule.directive('editTask',editTask);

function editTask() {
    return {
        restrict: 'E',
        templateUrl: origin+'views/tasks/edit-task.html'
    }
};

