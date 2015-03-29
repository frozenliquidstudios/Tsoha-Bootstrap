<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
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

  /////////////
 // sandbox //
/////////////

$routes->get('/modifyclip', function() {
    HelloWorldController::clipModify();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });