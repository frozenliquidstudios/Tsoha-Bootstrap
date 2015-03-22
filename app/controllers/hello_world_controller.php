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
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
  }
