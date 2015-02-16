<?php

$app->get('/', function() {
    QuestionController::index();
});

$app->get('/find/:id', function($id) {
    QuestionController::find($id);
});

$app->get('/create', function() {
    QuestionController::create();
});

$app->get('/login', function() {
    UserController::login();
});

$app->post('/login', function() {
    UserController::handle_login();
});

$app->get('/logout', function() {
UserController::logout();
});

$app->post('/add', function() {
    QuestionController::store();
});

$app->get('/question/:id/edit', function($id) {
    QuestionController::show($id);
});
    
$app->post('/question/:id/update', function($id) {
    QuestionController::update($id);
});

$app->get('/question/:id/delete', function($id) {
    QuestionController::delete($id);
});

$app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$app->get('/home', function() {
    HelloWorldController::home();
});

