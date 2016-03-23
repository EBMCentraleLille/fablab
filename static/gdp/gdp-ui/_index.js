var bulk = require('bulk-require');

module.exports = angular.module('appGDP.uiModule',['ngSanitize','toastr','draganddrop']);

bulk(__dirname,['./**/!(*_index).js']);