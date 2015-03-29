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
    $clip1 = Clip::find(1);
    $clips = Clip::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($clips);
    Kint::dump($clip1);
    }
}
