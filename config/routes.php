<?php

function check_logged_in(){
  BaseController::check_logged_in();
}

  ///////////
 // Login //
///////////

$routes->get('/', function() {
  ClipController::index();
});
  
$routes->get('/login', function(){
  UserController::login();
});
  
$routes->post('/login', function() {
  UserController::handle_login();
});

$routes->post('/logout', function(){
  UserController::logout();
});

$routes->get('/signup', function(){
  UserController::signup();
});

$routes->post('/signup', function() {
  UserController::create_signup();
});

  //////////////
 // clipList //
//////////////

$routes->get('/yourClips', 'check_logged_in', function(){
    ClipController::yourClips();
});

$routes->get('/clipList', function(){
    ClipController::allClips();
});

$routes->post('/clipList', 'check_logged_in', function(){
    ClipController::store();
});

$routes->get('/clipList/newClip', 'check_logged_in', function(){
    ClipController::create();
});

$routes->get('/clipList/:id', 'check_logged_in', function($id){
    ClipController::show($id);
});

$routes->get('/clipList/:id/edit', 'check_logged_in', function($id){
    ClipController::edit($id);
});

$routes->post('/clipList/:id/edit', 'check_logged_in', function($id){
    ClipController::update($id);
});

$routes->post('/clipList/:id/destroy', 'check_logged_in', function($id){
    ClipController::destroy($id);
});

  /////////////
 // sandbox //
/////////////

$routes->get('/modifyclip', function() {
    HelloWorldController::clipModify();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });