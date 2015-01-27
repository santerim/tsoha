<?php

  $app->get('/', function() {
    HelloWorldController::index();
  });

  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $app->get('/home', function() {
  	HelloWorldController::home();
  });

  $app->get('/signin', function() {
  	HelloWorldController::signin();
  });

  $app->get('/newquestion', function() {
  	HelloWorldController::newquestion();
  });
