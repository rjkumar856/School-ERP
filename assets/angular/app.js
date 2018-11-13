/**
 * @ngdoc overview
 * @name app
 * @description
 * # app
 *
 * Main module of the application.
 */
 var schoolApp;
(function() {
    'use strict';
    schoolApp = 
    angular
      .module('schoolApp', [
        'ngAnimate',
        'ngResource',
        'ngMaterial',
        'ngSanitize',
        'ngStorage',
      ]);
})();