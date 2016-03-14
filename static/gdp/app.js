require('fs');
require('./gdp-ui/_index');
require('./ui-router/_index');
//require('./auth/_index');


angular.element(document).ready(activate);

function activate() {
    var requirements = [
        'appGDP.uiModule',
        'appGDP.routerModule'
        //'appGDP.authModule'
    ];
    window.appCentralink = angular.module('appGDP',requirements);
    angular.bootstrap(document,['appGDP']);
}
