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
    QuestionController::store();
});

$app->get('/question/:id/edit', function() {
    QuestionController::edit($id);
});
    
$app->post('/question/:id/edit', function() {
    QuestionController::update($id);
});

$app->post('/question/:id/destroy', function() {
    QuestionController::destroy($id);
});

$app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$app->get('/home', function() {
    HelloWorldController::home();
});

