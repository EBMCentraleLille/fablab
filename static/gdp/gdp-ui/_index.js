var bulk = require('bulk-require');

module.exports = angular.module('appGDP.uiModule',['ngSanitize']);

bulk(__dirname,['./**/!(*_index).js']);