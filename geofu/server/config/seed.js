/**
 * Populate DB with sample data on server start
 * to disable, edit config/environment/index.js, and set `seedDB: false`
 */

'use strict';

var Course = require('../api/course/course.model');
var User = require('../api/user/user.model');

Course.find({}).remove(function() {
  Course.create({
    code : 'GE1204',
    nameEn : 'Living with the Unexpected and Unknown in Modern Society',
    loadSummary: {
        quizNum: 0,
        testNum: 1,
        assignmentNum: 4,
        hasFinal: true,
        presentationNum: 2,
        reportNum: 0
    },
  }, {
    code : 'GE2203',
    nameEn : 'Psychology for Young Professionals',
    loadSummary: {
        quizNum: 3,
        testNum: 0,
        assignmentNum: 0,
        hasFinal: false,
        presentationNum: 1,
        reportNum: 0
    },
  });
});

User.find({}).remove(function() {
  User.create({
    provider: 'local',
    name: 'Test User',
    email: 'test@test.com',
    password: 'test'
  }, {
    provider: 'local',
    role: 'admin',
    name: 'Admin',
    email: 'admin@admin.com',
    password: 'admin'
  }, function() {
      console.log('finished populating users');
    }
  );
});