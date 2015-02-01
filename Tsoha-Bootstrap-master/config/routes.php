<?php

  $app->get('/', function() {
    QuestionController::index();
  });

  $app->get('/find/:id', function() {
    QuestionController::find($id);
  });

  $app->get('/create', function() {
    QuestionController::create();
  });

  $app->get('/signin', function() {
    QuestionController::signin();
  });

  $app->get('/add', function() {
    QuestionController::add();
  });


  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $app->get('/home', function() {
  	HelloWorldController::home();
  });

