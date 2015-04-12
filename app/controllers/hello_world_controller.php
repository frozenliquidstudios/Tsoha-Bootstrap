<?php

class HelloWorldController extends BaseController{

    public static function index(){
   	View::make('home.html');
    }
    
    public static function login(){
        View::make('login.html');
    }
    
    public static function clipList(){
        View::make('clipList.html');
    }

    public static function clipModify(){
        View::make('clipModify.html');
    }

    public static function sandbox(){
    $clippety = new Clip(array(
    'title' => 'hyvä title',
    'game' => 'kunnollinen pelinimi',
    'resolution' => '1920 x 1080',
    'fps' => '123',
    'description' => 'asdfasdfasdasdasdads'
  ));
  $errors = $clippety->errors();

  Kint::dump($errors);
}
}
