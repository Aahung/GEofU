'use strict';

var mongoose = require('mongoose'),
    Schema = mongoose.Schema;

var CourseSchema = new Schema({
    code: String,
    nameEn: String,
    nameCn: String,
    loadSummary: {
        quizNum: Number,
        testNum: Number,
        assignmentNum: Number,
        hasFinal: Boolean,
        presentationNum: Number,
        reportNum: Number
    },
    rateSummary: {
        overall: Number,
        gradeSatisfy: Number,
        difficulty: Number,
        loads: Number,
        value: Number,
        grade: Number
    },
});

module.exports = mongoose.model('Course', CourseSchema);