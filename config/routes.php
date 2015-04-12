<?php

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

  //////////////
 // clipList //
//////////////

$routes->get('/clipList', function(){
    ClipController::index();
});

$routes->post('/clipList', function(){
    ClipController::store();
});

$routes->get('/clipList/newClip', function(){
    ClipController::create();
});

$routes->get('/clipList/:id', function($id){
    ClipController::show($id);
});

$routes->get('/clipList/:id/edit', function($id){
  ClipController::edit($id);
});
$routes->post('/clipList/:id/edit', function($id){
  ClipController::update($id);
});

$routes->post('/clipList/:id/destroy', function($id){
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