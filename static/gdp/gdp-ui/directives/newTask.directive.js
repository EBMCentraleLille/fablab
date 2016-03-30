var uiModule = require('../_index');
var origin = document.location.origin+'/gdp/';


uiModule.directive('newTask',newTask);

function newTask() {
    return {
        restrict: 'E',
        templateUrl: origin+'views/tasks/new-task.html'
    }
};

