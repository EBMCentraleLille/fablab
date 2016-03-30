var uiModule = require('../_index');

uiModule.directive('fablabHeader',getHeader);

function getHeader() {
    return {
        restrict: 'E',
        templateUrl: 'views/header/header.html'
    }
};

