<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
});

  $routes->get('/cliplist', function() {
  HelloWorldController::clipList();
});

  $routes->get('/modifyclip', function() {
  HelloWorldController::clipModify();
});

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });





     