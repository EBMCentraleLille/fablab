var bulk = require('bulk-require');

module.exports = angular.module('appGDP.routerModule',['ui.router','ngCookies']);

bulk(__dirname,['./**/!(*_index).js']);