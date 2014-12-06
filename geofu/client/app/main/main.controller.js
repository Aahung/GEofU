'use strict';

angular.module('geofuApp')
  .controller('MainCtrl', function ($scope, $http, socket) {
    $scope.courses = [];

    $http.get('/api/courses').success(function(courses) {
      for (var i = 0; i < courses.length; ++i) {
        courses[i].data = [[1, 2, 3, 4.3, 2.1, 2.4]];
        courses[i].labels = ['总评', '成绩满意', '难度', '课业', '价值', '成绩'];
      }
      $scope.courses = courses;
      socket.syncUpdates('course', $scope.courses);
    });

    $scope.addThing = function() {
      if($scope.newThing === '') {
        return;
      }
      $http.post('/api/things', { name: $scope.newThing });
      $scope.newThing = '';
    };

    $scope.deleteThing = function(thing) {
      $http.delete('/api/things/' + thing._id);
    };

    $scope.$on('$destroy', function () {
      socket.unsyncUpdates('course');
    });
  });
