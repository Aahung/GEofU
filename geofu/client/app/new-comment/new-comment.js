'use strict';

angular.module('geofuApp')
  .config(function ($routeProvider) {
    $routeProvider
      .when('/new-comment', {
        templateUrl: 'app/new-comment/new-comment.html',
        controller: 'NewCommentCtrl'
      });
  });
