'use strict';

describe('Controller: NewCommentCtrl', function () {

  // load the controller's module
  beforeEach(module('geofuApp'));

  var NewCommentCtrl, scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    NewCommentCtrl = $controller('NewCommentCtrl', {
      $scope: scope
    });
  }));

  it('should ...', function () {
    expect(1).toEqual(1);
  });
});
